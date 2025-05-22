<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use Notifiable;
    protected $fillable = [
        'no', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
