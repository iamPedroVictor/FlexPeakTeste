<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RankController extends Controller
{
    public function ProdutosRank(Request $request){
        $limit = 3;
        if($request->has('limit')){
            $limit = $request->limit;
        }
        if(!$request->has('mes') && !$request->has('ano')){
            $produtosId = DB::table('vendas')
                ->groupBy('vendas.id_produto')
                ->orderBy('sum(vendas.quantidade)','desc')
                ->limit($limit)
                ->leftJoin('produtos', 'vendas.id_produto', '=', 'produtos.id_produto')
                ->selectRaw('vendas.id_produto as Id, sum(quantidade) as Total, produtos.nome as Nome')
                ->get();
        }else{
            $produtosId = DB::table('vendas')
                ->groupBy('vendas.id_produto')
                ->orderBy('sum(vendas.quantidade)','desc')
                ->whereMonth('vendas.created_at', $request->mes)
                ->whereYear('vendas.created_at', $request->ano)
                ->limit($limit)
                ->join('produtos', 'vendas.id_produto', '=', 'produtos.id_produto')
                ->selectRaw('vendas.id_produto as Id, sum(quantidade) as "Total de quantidade", produtos.nome as Nome')
                ->get();
            $count = 0;
            foreach ($produtosId as $produto) {
                $count++;
                $produto->Posicao = $count;
            }
        }
        $produtosId->put("length", $produtosId->count());
        return response()->json($produtosId);
    }
}
