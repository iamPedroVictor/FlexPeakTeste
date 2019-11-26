<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class VendasController extends Controller
{
    public function index(Request $request){
        if(!$request->has('Mes')){
            return Venda::paginate(25);
        }
        if($request->has('Mes') && $request->has('Ano')){
            $resposta = DB::table('vendas')
            ->whereMonth('created_at', $request->Mes)
            ->whereYear('created_at', $request->Ano)
            ->get();

            return response()->json($resposta);
        }
        
    }

    public function show($id){
        $venda = Venda::find($id);
        if(!$venda){
            return response()->json(['Mensagem'=>'Não foi encontrado o registro da venda de id: ' . $id], 404);
        }   
        $total = number_format($venda->Preco * $venda->Quantidade, 2);
        $venda->Total = (float)$total;
        return response()->json($venda[0]);
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
        $input["vendedor"] = Auth::user()->nome;
        $produto = Produto::find($input["produto"]);
        $input["produto"] = $produto->nome;
        $input["preco"] = $produto->preco;
        $venda = new Venda();
        $venda->fill($input);
        $venda->save();
        return response()->json($venda, 201);
    }    
}
