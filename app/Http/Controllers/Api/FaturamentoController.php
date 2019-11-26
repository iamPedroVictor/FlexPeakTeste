<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaturamentoController extends Controller
{
    public function Mensal(Request $request, $mes){
        $faturamento = 0;
        if($request->has('Ano')){
            $ano = $request->Ano;
            $vendas = DB::table('vendas')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->get();

            $faturamento = $this->CalcularFaturamento($vendas);          
        }else{
            $ano = Carbon::now()->year;
            $vendas = DB::table('vendas')
                ->whereMonth('created_at', $mes)
                ->whereYear('created_at', $ano)
                ->get();

            $faturamento = $this->CalcularFaturamento($vendas);
        }
        $mesInfo = $this->RecuperarMes($mes);

        return response()->json([
            "faturamento" => $faturamento,
            "mes-nome" => $mesInfo["Nome"],
            "mes-numero" => $mesInfo["Numero"],
            "ano" => $ano
            ]);
    }

    private function RecuperarMes($mes){
        $mes++;
        $Mes = Carbon::createFromFormat('Y-m-d', '0000-' . $mes . '-00')
            ->locale('pt-br');
        return ["Nome" => $Mes->monthName, "Numero" => $Mes->month];
    }

    private function CalcularFaturamento($listaVendas){
        $faturamento = 0;
        foreach ($listaVendas as $venda) {
            $faturamento += ($venda->preco * $venda->quantidade);
        }
        return $faturamento;
    }
}
