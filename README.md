# Base Code Application

This is a scarfolding API application with repository pattern approach.

It's built on Laravel Framework with Laravel-Modules package.

All business logic must be inside modules under the "Innerent" directory.

## Install and Setup

1) Clone the repo

```
git clone https://github.com/innerent/base-code.git

cd basecode
```

2) Copy configuration file

```
cp .env.example .env
```

3) Create an application key

```
php artisan key:generate
```

4) Create and setup a database

> On .env file
```
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=basecode
DB_USERNAME=root
DB_PASSWORD=
... 

```

5) Run migration and seed (Laravel-Modules command)

```
php artisan module:migrate
php artisan module:seed
```

6) Run tests

```
phpunit
```