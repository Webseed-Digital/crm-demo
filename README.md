<p align="center">
<a href="https://travis-ci.com/github/Webseed-Digital/crm-demo"><img src="https://travis-ci.com/Webseed-Digital/crm-demo.svg?branch=master" alt="Build Status"></a>
</p>

## Laravel CRM Demo

This is a basic CRM demo using [AdminLTE](https://adminlte.io/) as a basic back-end style framework.

There are two resource types in this CRM demo: `Companies` and `Employees`. An `Employee` must belong to one `Company` and a `Company` can own many `Employees`.

Authenticated users can create new `Companies` and `Employees` using the dashboard. `Company` logos are stored in the `public` local storage and are validated to be a minimum of `100`x`100`.

## Install

This project uses `Docker` for local development so should only require the following steps to set up:
- Run `docker-compose up --build` from the root directory
- Once build is complete, run `docker exec -it app sh` to gain shell access to the PHP container
- Run the following commands 
    - `composer install`
    - `cp .env.example .env`
    - `php artisan key:generate`
    - `php artisan storage:link`
    - `php artisan migrate --seed`

The front end of the site should now be accessible at [http://localhost:3050](http://localhost:3050).

## Tests

Basic functionality tests for the home page/authentication redirects and `Companies`/`Employees` CRUD features are available by running `php artisan test`. 

## PHPMyAdmin

The `docker-compose` file also sets up PHPMyAdmin available at [http://localhost:8081](http://localhost:8081) for the sake of ease in development of checking the database values directly. 
