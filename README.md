## Instagram Follower

### installation

#### 1. install composer
```shell
composer install
```
#### 2. create env file from example 
```shell
cp .env.example .env
```
#### 3. run key generation command
```shell
php artisan key:generate
```
#### 4. update mysql data in .env file
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=insta
DB_USERNAME=root
DB_PASSWORD=
```
#### 5. run migration command
```shell
php artisan migrate
```
#### 6. run seeder command
```shell
php artisan db:seed
```
#### 7. now you can use one or more tokens from "tokens" table to make request
#### 8. import the postman collection from docs folder

