<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_active',
        'role_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $hasRole;

    // public function getHasRoleAttribute($permission)
    // {
    //     return 'a';
    // }

    public function hasRole($permission)
    {
        try {
            $permission = RolePermission::leftJoin('users_permission', 'users_permission.id', '=', 'role_permission.permission_id')
            ->where('role_permission.role_id', $this->role_id)
            ->where('users_permission.name', $permission)->first();
    
            if (!$permission) {
                return false;
            }
    
            return true;
        } catch (\Exception $e) {
            echo 'Something Error in' . $e->getMessage() . "\n";
            return false;
        }
    }
}
