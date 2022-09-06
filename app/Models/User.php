<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'phone',
        'status',
    ];
    protected $table = 'users';
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
