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

    public function vendedor(){
        return $this->hasOne('App\User', 'id_usuario', 'id_vendedor');
    }
    public function produto(){
        return $this->hasOne('App\Produto','id_produto');
    }
}
