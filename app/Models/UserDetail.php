<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    // um user_detail pertence a um usuário
    public function user(){
        return $this->belongsTo(User::class);
    }
}
