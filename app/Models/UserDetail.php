<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $fillable = [
        'address',
        'zip_code',
        'city',
        'phone',
        'salary',
        'admission_date'
    ];

    // um user_detail pertence a um usuário
    public function user(){
        return $this->belongsTo(User::class);
    }
}
