<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome', 'preco'
    ];
    protected $primaryKey = 'id_produto';
    protected $table = "produtos";
}
