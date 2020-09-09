<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email_address' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'company_id' => factory(App\Company::class)
    ];
});
