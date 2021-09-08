<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = "produto";

    protected $fillable = ['nome', 'valor', 'data_cadastro', 'user_id'];

    public function user()
    {
        // belongsTo pertence a
        return $this->belongsTo('App\Models\User');
    }
}
