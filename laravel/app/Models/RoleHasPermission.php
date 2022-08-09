<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;
    protected $table = 'role_has_permission';
    protected $fillable = ['id', 'role_id', 'permission_id'];

    public function getRoleName()
    {
        return $this->belongsTo(UserRole::class);
    }
}
