<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Members::class, function (Faker $faker) {
    return [
        "surname" => "ПЕТРОВИЋ",
        "parentGivenName" => "ПЕТАР",
        "givenName" => "МАРКО",
        "dateOfBirth" => "12.09.1976",
        "placeOfBirth" => "SMEDEREVO",
        "stateOfBirth" => "REPUBLIKA SRBIJA",
        "docRegNo" => "479368248",
        "personalNumber" => "428054275432",
        "issuingDate" => "06.09.2022",
        "expiryDate" => "06.09.2032",
        "portrait" => "479368248/avatar.jpg"
    ];
});
