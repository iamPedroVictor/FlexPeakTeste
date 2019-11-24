<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Produto;
use App\User;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class VendasController extends Controller
{
    public function index(Request $request){
        if(!$request->has('Mes')){
            //return Venda::paginate(25);
            return response()->json(["oi"=> "voltou", "usuario" => Auth::user()]);
        }
        if($request->has('Mes') && $request->has('Ano')){
            $resposta = DB::table('vendas')
            ->whereMonth('created_at', $request->Mes)
            ->whereYear('created_at', $request->Ano)
            ->get();

            return response()->json($resposta);
        }
        
    }

    public function show(Request $request){
        $limit = 3;
        if($request->has('limit')){
            $limit = $request->limit;
        }

        $produtosId = DB::select('SELECT id_produto, sum(quantidade) as Total from flex.vendas group by id_produto order by sum(quantidade) DESC limit ' . $limit);
        
        return response()->json($produtosId);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'quantidade' => 'required|numeric|min:0',
            'produto' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['Erro' => $validator->erros()], 401);
        }
        $input = $request->all();
        $input["id_vendedor"] = Auth::user()->id_usuario;
        $input["id_produto"] = $input["produto"];
        $produto = Produto::find($input["produto"]);
        $input["preco"] = $produto->preco;
        $venda = new Venda();
        $venda->fill($input);
        $venda->save();
        return response()->json($venda, 201);
    }
    
}
