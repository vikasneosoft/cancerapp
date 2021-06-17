<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminModel extends Authenticatable
{
    use HasFactory;
    protected $guard_name = 'admin';

    protected $table = 'admins';
    protected $fillable = ['name','email','password'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
