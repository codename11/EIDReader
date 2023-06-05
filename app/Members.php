<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'surname', 
        'parentGivenName', 
        "givenName",
        "dateOfBirth",
        "placeOfBirth",
        'stateOfBirth', 
        'docRegNo', 
        "personalNumber",
        "issuingDate",
        "expiryDate",
        "portrait"
    ];

}
