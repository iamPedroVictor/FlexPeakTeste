<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'id_vendedor',
        'id_produto',
        'preco',
        'quantidade'
    ];
    protected $primaryKey = 'id_venda';
    protected $table = "vendas";

    public function Vendedor(){
        return $this->hasOne('App\User');
    }
    public function Produto(){
        return $this->hasOne('App\Produto');
    }
}
