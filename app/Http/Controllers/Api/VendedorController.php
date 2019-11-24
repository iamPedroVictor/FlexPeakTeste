<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class VendedorController extends Controller
{
    public $successStatus = 200;
    public function register(Request $request){

        $validator = Validator::make($request->all(),
        [
            'nome' => 'required',
            'email' => 'required',
            'senha' => 'required',
            'cep' => 'required',
            'rua' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['Erro'=>$validator->errors()], 401);
        }
        $input = $request->except('senha');
        $input['password'] = bcrypt($request->senha);
        $user = User::create($input);
        $resposta['token'] = $user->createToken('Appname')->accessToken;
        return response()->json($resposta, $this->successStatus);
    }

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('senha')])){
            $usuario = Auth::user();
            $resposta['token'] = $usuario->createToken('Appname')->accessToken;
            return response()->json($resposta, $this->successStatus);
        }else{
            return reponse()->json(['Erro'=> 'Não autorizado, verifique email/senha'], 401);
        }
    }

    public function show(){
        $usuario = Auth::user();
        return response()->json($usuario, $this->successStatus);
    }


}
