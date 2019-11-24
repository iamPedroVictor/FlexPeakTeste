<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProdutosController extends Controller
{

    public function index(){
        return Produto::paginate(10);
    }

    public function show($id){
        $produto = Produto::find($id);
        if(!$produto){
            return response()->json(['Mensagem'=>'Não foi encontrado o produto com id: ' . $id], 404);
        }
        return response()->json($produto);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'preco' => 'required|numeric|min:0'
        ]);
        if($validator->fails()){
            return response()->json(['Erro'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $produto = new Produto();
        $produto->fill($input);
        $produto->save();
        return response()->json($produto, 201);
    }

}
