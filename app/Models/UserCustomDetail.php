<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class UserCustomDetail extends Model
{
    protected $fillable = [
        'user_id',
        'custom_detail',
    ];
    protected $table = 'users_custom_detail';


}