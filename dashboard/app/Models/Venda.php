<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = "venda";

    public $fillable = ['produto','valor', 'data_cadastro', 'user_id'];

    public function user()
    {
        // belongsTo pertence a

        return $this->belongsTo('App\Models\User');
    }

}

