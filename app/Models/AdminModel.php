<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'last_login',
        'ip'
    ];

    
}
