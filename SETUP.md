To setup a Laravel project

First enter this command (te copy a new env from an existing env)
>>>> cp .env.example .env

Next (To get all necessary packages to run laravel project)
>>>> composer update

To set Application key 
>>>> php artisan key:generate

Setup Database in .env >>>>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_ebook
DB_USERNAME=root
DB_PASSWORD=

Migrate Fresh Database, with seeding
>>>> php artisan migrate:fresh --seed

PROJECT SERVE in 8000 PORT
>>>> php artisan serve