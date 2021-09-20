<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    public $fillable = ['name','email','cpf', 'data_cadastro', 'user_id'];

    public function user()
    {
        // belongsTo pertence a

        return $this->belongsTo('App\Models\User');
    }

}

