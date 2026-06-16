#!/bin/bash

# Wait for MySQL to be ready
echo "Waiting for MySQL..."
until php -r "new PDO('mysql:host=mysql;dbname=laravel', 'root', 'root');" 2>/dev/null; do
    sleep 2
done
echo "MySQL is ready."

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

if ! grep -q "^APP_KEY=.\+" .env; then
    php artisan key:generate
fi

if [ ! -d "vendor" ]; then
    composer install --no-interaction --prefer-dist
fi

# Fix storage permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Only fresh seed on first run, normal migrate after
if [ ! -f ".env.seeded" ]; then
    php artisan migrate:fresh --seed --force
    touch .env.seeded
else
    php artisan migrate --force
fi

apache2-foreground