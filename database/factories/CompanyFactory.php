<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email_address' => $faker->unique()->safeEmail,
        'website' => $faker->url,
        'logo' =>  UploadedFile::fake()->image('logo.jpg', 100, 100)
    ];
});
