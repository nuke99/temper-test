# Laravel Test



### Installing

Please follow the following steps to install and test the application

install necessary modules & plugins

```
composer update
npm install
```

Rename the .env.example file to .env

```
cp .env.example .env
```
Create a database fill the related information in the .env file 

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tempertest
DB_USERNAME=test
DB_PASSWORD=test
```

Execute Migration 

```
php artisan migrate
```

Seed the database 

```
php artisan db:seed
```

Generate a Key for Laravel

```
php artisan key:generate
```

Generate a Key for JWT

```
php artisan jwt:secret
```

Now everything is set . just run the server with artisan serve

```
php artisan serve
```

You can Change the default admin email and password in .env file 
```
DEFAULT_ADMIN_EMAIL= admin@localhost.com
DEFAULT_ADMIN_PASSWORD= S3cr3tP4ssw0rd
```



## Running the tests

You can execute the tests with 
```
vendor/bin/phpunit 
```



