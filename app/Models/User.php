<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
