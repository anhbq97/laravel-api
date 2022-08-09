<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Redis;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['role_name'];
    
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

    public function role()
    {
        return $this->hasMany(RoleHasPermission::class, 'role_id');
    }

    public function setRoleNameAttribute()
    {
        $this->appends['role_name'] = 'rolenamene';
    }

    public function getRoleNameAttribute()
    {
        return $this->appends;
    }

    public function hasRole($permission)
    {
        $key = $this->id . ':' . $permission;

        try {
            if ($value = Redis::get($key)) {

                if ($value === 'true') {
                    return true;
                } else {
                    return false;
                }
            } 

            $perm = RoleHasPermission::leftJoin('users_permission', 'users_permission.id', '=', 'role_has_permission.permission_id')
            ->where('role_has_permission.role_id', $this->role_id)
            ->where('users_permission.name', $permission)->first();
    
            if (!$perm) {
                Redis::set($key, 'false');

                return false;
            }

            Redis::set($key, 'true');

            return true;
        } catch (\Exception $e) {
            echo "Something Error in\n" . $e->getMessage() . "\n";
            return false;
        }
    }

}
