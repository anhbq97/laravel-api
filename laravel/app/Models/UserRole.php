<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'users_role';
    protected $fillable = ['id', 'name', 'status', 'description'];
    protected $with = ['permission'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function permission()
    {
        return $this->hasMany(RoleHasPermission::class, 'role_id');
    }
}
