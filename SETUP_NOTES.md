# Laravel 13 Dockerisation Notes (Local Setup → Docker → Docker Hub)

## 1. Project Overview

* Existing project: Laravel 13 application
* Status before Docker:

  * Fully working locally on Windows
  * PHP 8.5 installed via ZIP (manually configured in PATH)
  * MySQL installed locally
  * phpMyAdmin running via PHP built-in server (`php -S 127.0.0.1:8080`)
* Goal:

  * Dockerise the Laravel project
  * Enable sharing via Docker Hub and Cloudflare Tunnel

---

## 2. Goal After Dockerisation

* Run entire stack using Docker:

  * Laravel application (PHP + Apache)
  * MySQL database container
  * phpMyAdmin container
* Enable:

  * `docker compose up -d --build`
  * Portable setup for any machine
  * Future deployment via Docker Hub image
  * External sharing via Cloudflare Tunnel

---

## 3. Docker Setup Created

Inside Laravel project root, the following files were created:

### 3.1 `.dockerignore`

Purpose: exclude unnecessary files from Docker build context.

Typical contents:

* vendor/
* node_modules/
* .git/
* .env
* storage/logs/

---

### 3.2 `Dockerfile`

Purpose: build Laravel application container.

Key responsibilities:

* Uses PHP Apache image
* Installs required PHP extensions:

  * pdo
  * pdo_mysql
  * zip
* Installs Composer
* Copies Laravel project into container
* Runs `composer install`
* Enables Apache rewrite module
* Sets correct permissions for Laravel storage/cache
* Configures Apache DocumentRoot to `/public`
* Later updated to include:

```dockerfile
COPY .env.example .env
```

for Docker Hub image testing.

---

### 3.3 `docker-compose.yml`

Purpose: define full application stack.

Services included:

#### app (Laravel)

* Builds from Dockerfile
* Exposes port:

  * `8000:80`
* Mounts project directory into container
* Depends on MySQL

#### mysql

* Image: `mysql:8.0`
* Exposed port:

  * `3307:3306` (host mapped to avoid conflict with local MySQL)
* Environment:

  * MYSQL_ROOT_PASSWORD=root
  * MYSQL_DATABASE=laravel
* Persistent volume for database storage

#### phpmyadmin

* Image: `phpmyadmin/phpmyadmin`
* Exposed port:

  * `8080:80`
* Connected to MySQL container

---

## 4. Environment Configuration Changes

Laravel `.env` updated for Docker networking:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

Important:

* DB_HOST must be `mysql` (service name in docker-compose)

---

## 5. Build & Run Process

### Initial build

```bash
docker compose up -d --build
```

### Stop containers

```bash
docker compose down
```

### Rebuild after changes

```bash
docker compose up -d --build
```

### Access containers

```bash
docker exec -it laravel_app bash
```

### Run migrations

```bash
php artisan migrate:fresh --seed
```

---

## 6. Issues Encountered & Fixes

### Issue 1: Docker build failed (apt-get 403 error)

Cause:

* Debian repository access/network issue

Fix:

* Switched WiFi network

---

### Issue 2: MySQL port conflict

Cause:

* Local MySQL already using port 3306

Fix:

```yaml
ports:
  - "3307:3306"
```

---

### Issue 3: Laravel 403 Forbidden on Apache

Cause:

* Apache serving `/var/www/html`
* Laravel requires `/var/www/html/public`

Fix:

* Updated Apache DocumentRoot to `/public`

---

### Issue 4: Laravel page stuck loading

Cause:

* Initial Laravel bootstrap/configuration issue

Fix:

```bash
docker exec -it laravel_app bash
php artisan migrate:fresh --seed
```

---

### Issue 5: Docker image build command failed

Command used:

```bash
docker build -t suvajitbardhan/laravel-ebook:v1
```

Error:

```text
docker buildx build requires 1 argument
```

Cause:

* Missing build context

Fix:

```bash
docker build -t suvajitbardhan/laravel-ebook:v1 .
```

---

### Issue 6: Docker Hub image returns HTTP 500

Command:

```bash
docker run -p 9000:80 suvajitbardhan/laravel-ebook:v1
```

Result:

* Apache starts successfully
* Laravel returns HTTP 500

Investigation:

* Container did not contain `.env`

Error:

```text
file_get_contents(/var/www/html/.env):
No such file or directory
```

Fix attempt:

* Added to Dockerfile:

```dockerfile
COPY .env.example .env
```

---

### Issue 7: APP_KEY missing in standalone image

Inside container:

```bash
docker exec -it <container> bash
php artisan key:generate
```

Initially failed because `.env` was missing.

After Dockerfile update:

```bash
cp .env.example .env
php artisan key:generate
```

worked successfully.

---

### Issue 8: SQLite readonly database error

Current issue while testing standalone Docker Hub image:

Error:

```text
SQLSTATE[HY000]: General error: 8
attempt to write a readonly database
```

Connection shown by Laravel:

```text
Connection: sqlite
Database: /var/www/html/database/database.sqlite
```

Cause:

* Standalone image is using SQLite instead of MySQL.
* Docker Compose setup uses MySQL correctly.
* Docker Hub image currently falls back to SQLite configuration.

Next investigation step:

Inside container:

```bash
cat .env
```

Verify whether:

```env
DB_CONNECTION=sqlite
```

or

```env
DB_CONNECTION=mysql
```

Current expectation:

* Docker Hub image needs proper environment configuration and should use MySQL rather than SQLite.

---

## 7. Current Working State

Docker Compose Environment:

* Laravel:

  * http://localhost:8000
* phpMyAdmin:

  * http://localhost:8080
* MySQL:

  * Host port 3307
* Migrations:

  * Working
* Seeders:

  * Working

Status:

```text
Docker Compose Setup: WORKING
Docker Hub Standalone Image: NOT YET WORKING
```

---

## 8. Docker Hub Progress

Completed:

```bash
docker login
docker build -t suvajitbardhan/laravel-ebook:v1 .
```

Image successfully built.

Test command:

```bash
docker run -p 9000:80 suvajitbardhan/laravel-ebook:v1
```

Current blocker:

* Image boots Laravel but uses SQLite and fails with readonly database error.

---

## 9. Cloudflare Tunnel Progress

Not started yet.

Planned command:

```bash
cloudflared tunnel --url http://localhost:8000
```

Expected result:

```text
https://random-subdomain.trycloudflare.com
```

to share with seniors.

---

## 10. Key Learning Outcomes

* Understood Laravel containerization
* Learned Docker image vs Docker Compose concepts
* Learned Docker networking using service names
* Resolved port conflicts
* Configured Apache for Laravel
* Built and tagged Docker Hub images
* Learned difference between:

  * Local environment
  * Docker Compose environment
  * Standalone Docker image environment
* Identified environment/configuration issues caused by missing `.env` and SQLite fallback
* Need to make Docker Hub image self-contained and environment-independent
