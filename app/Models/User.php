<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserCustomDetail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'status',
        'contact',
        'gender',
        'image',
        'profile_image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function customDetail()
    {
        return $this->hasOne(UserCustomDetail::class, 'user_id');
    }


    protected $appends = ['image_url', 'profile_image_url'];


    public function getImageUrlAttribute($value)
    {
        return !empty($this->attributes['image']) && Storage::exists($this->attributes['image'])
            ? Storage::url($this->attributes['image'])
            : null;
    }

    public function getProfileImageUrlAttribute($value)
    {
        return !empty($this->attributes['profile_image']) && Storage::exists($this->attributes['profile_image'])
            ? Storage::url($this->attributes['profile_image'])
            : null;
    }
}
