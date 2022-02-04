<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = "users";
    protected $fillable = ['name', 'username', 'password', 'password_default', 'role'];
}
