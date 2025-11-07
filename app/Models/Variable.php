<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{

    public static  $gender = [
        'Female' => 'Female',
        'Male' => 'Male',
        'Other' => 'Other'
    ];
}
