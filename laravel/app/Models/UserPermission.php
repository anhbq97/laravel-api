<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;
    protected $table = 'users_permission';
    protected $fillable = ['id', 'name', 'status', 'description'];
}
