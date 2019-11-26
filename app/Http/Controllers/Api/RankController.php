<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Venda;
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
                ->select('produto', DB::raw('SUM(quantidade)'))
                ->groupBy('produto')
                ->orderBy('SUM(quantidade)', 'desc')
                ->limit($limit)
                ->get();
        }else{
            $produtosId = DB::table('vendas')
                ->groupBy('produto')
                ->whereMonth('created_at', $request->mes)
                ->whereYear('created_at', $request->ano)
                ->limit($limit)
                ->select('produto', DB::raw('SUM(quantidade)'))
                ->orderBy('SUM(quantidade)', 'desc')
                ->get();
        }
        $produtosId->put("length", $produtosId->count());
        return response()->json($produtosId);
    }

    public function VendedoresRank(Request $request){
        $limit = 3;
        if($request->has('limit')){
            $limit = $request->limit;
        }
        if(!$request->has('mes') && !$request->has('ano')){
            $vendedores = DB::table('vendas')
                ->select('vendedor', DB::raw('SUM(quantidade)'))
                ->groupBy('vendedor')
                ->orderBy('SUM(quantidade)', 'desc')
                ->limit($limit)
                ->get();
        }else{
            $vendedores = DB::table('vendas')
                ->whereMonth('created_at', $request->mes)
                ->whereYear('created_at', $request->ano)
                ->select('vendedor', DB::raw('SUM(quantidade)'))
                ->groupBy('vendedor')
                ->orderBy('SUM(quantidade)', 'desc')
                ->limit($limit)
                ->get();
        }
        $vendedores->put("length", $vendedores->count());
        return response()->json($vendedores);
    }
}
