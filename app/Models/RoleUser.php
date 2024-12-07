<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected  $guarded =[];
    protected $table ="role_users";


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }
}
