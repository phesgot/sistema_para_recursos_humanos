<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    public function detail(){
        // cada usuário tem um user_details
        return $this->hasOne(UserDetail::class);
    }

    public function department(){
        // este usuário pertence a um departamento
        return $this->belongsTo(Department::class);
    }
}
