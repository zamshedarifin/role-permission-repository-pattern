<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected  $guarded =[];
    protected $table ="users";

    use HasApiTokens, HasFactory, Notifiable;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }


    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }

    public function hasPermission($permissionName)
    {
        return $this->permissions->contains('name', $permissionName) ||
            $this->roles->pluck('permissions')->flatten()->contains('name', $permissionName);
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
