<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function users(){
        // cada departamento pode ser preenchido com varios usuários
        return $this->belongsToMany(User::class);
    }
}
