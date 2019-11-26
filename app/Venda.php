<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'vendedor',
        'produto',
        'preco',
        'quantidade'
    ];
    protected $primaryKey = 'id_venda';
    protected $table = "vendas";
}
