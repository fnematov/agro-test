## Agro bank test application

Requirements
___
* [PHP][php] 8.1+
* [Postgres][postgres] 14.5+


[php]: https://www.php.net/
[postgres]: https://www.postgresql.org/

## Running
### 1. Clone the project
```shell
git clone git@github.com:fnematov/agro-test.git
```
### 2. Update composer dependencies
```shell
cd agro-test
composer update
```
### 3. Migrate database and seeders
```shell
php artisan migrate --seed
```
### 4. Run project
```shell
php artisan serve
```
Open from your browser [http://localhost:8000](http://localhost:8000)

## Documentation
1. Download [postman](https://www.postman.com/)
2. Import [Agro test.postman_collection.json](Agro%20test.postman_collection.json) file

## Additionally
1. Emails will generate randomly
2. All passwords are `password`
3. System has `ADMIN`, `ORGANIZATION` and `EMPLOYEE` roles
4. `ADMIN` endpoints not implemented yet
5. Routes which are depended on `ORGANIZATION` only accessible for all organizations. `EMPLOYEE` can't use these routes and vise verse. Returns `403` error
6. After login, you don't need to set password to action. It saves access token to every request automatically by test
