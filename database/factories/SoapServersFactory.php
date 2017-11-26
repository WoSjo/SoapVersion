<?php

use Faker\Generator as Faker;
use SoapVersion\Models\Dashboard\SoapServers;
use SoapVersion\Models\User;

$factory->define(SoapServers::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'name' => $domainName = $faker->domainName,
        'slug' => str_slug($domainName),
        'host' => $faker->url,
        'post' => '80'
    ];
});
