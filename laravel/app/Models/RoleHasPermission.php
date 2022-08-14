<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;
    protected $table = 'role_has_permission';
    protected $fillable = ['id', 'role_id', 'permission_id'];
    protected $with = ['permission'];

    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function permission()
    {
        return $this->belongsToMany(UserPermission::class, $this->table, 'id', 'permission_id');
    }
}
