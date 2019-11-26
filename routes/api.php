<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::post('login', 'VendedorController@login');
    Route::post('register', 'VendedorController@register');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('Vendedor', 'VendedorController@show');
        Route::delete('Vendedor', 'VendedorController@delete');
        Route::put('Vendedor', 'VendedorController@update');
        Route::resource('Vendas', 'VendasController',
            ['only' => ['index','show','store']]);
        Route::get('Faturamento/{mes}', 'FaturamentoController@Mensal');
        Route::get('Rank/Produtos', 'RankController@ProdutosRank');
        Route::get('Rank/Vendedores', 'RankController@VendedoresRank');
        Route::resource('Produtos', 'ProdutosController',
            ['except' => ['create','edit', 'head', 'options']]);
    });
});