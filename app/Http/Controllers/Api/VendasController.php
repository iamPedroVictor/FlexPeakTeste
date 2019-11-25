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
        $venda = DB::table('vendas')
            ->leftJoin('produtos', 'vendas.id_produto','=','produtos.id_produto')
            ->leftJoin('usuarios', 'vendas.id_vendedor', '=', 'usuarios.id_usuario')
            ->selectRaw('vendas.id_venda as Venda, vendas.quantidade as Quantidade, vendas.preco as "Preco", produtos.nome as Produto, usuarios.nome as Vendedor')
            ->where('id_venda','=',$id)
            ->get();
        if(!$venda){
            return response()->json(['Mensagem'=>'Não foi encontrado o registro da venda de id: ' . $id], 404);
        }   
        $total = number_format($venda[0]->Preco * $venda[0]->Quantidade, 2);
        $venda[0]->Total = (float)$total;
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
