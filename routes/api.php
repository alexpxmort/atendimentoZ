<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['prefix'=>'servicos'], function(){

    Route::delete('/{servico}','ServicoController@delete');
    
    Route::get('/all','ServicoController@index');

    Route::get('/find/{servico}','ServicoController@show');

    Route::put('/update/{servico}','ServicoController@update');

    Route::post('/create','ServicoController@store');

    Route::post('/addFuncionario/{servico}','ServicoController@storeFuncionario');

});



Route::group(['prefix'=>'clientes'], function(){

    Route::delete('/{cliente}','ClienteController@delete');
    
    Route::get('/all','ClienteController@index');

    Route::get('/find/{cliente}','ClienteController@show');

    Route::put('/update/{cliente}','ClienteController@update');

    Route::post('/create','ClienteController@store');

    Route::post('/addServicos/{cliente}','ClienteController@storeServicos');

});



Route::group(['prefix'=>'funcionarios'], function(){

    Route::delete('/{funcionario}','FuncionarioController@delete');
    
    Route::get('/all','FuncionarioController@index');

    Route::get('/find/{funcionario}','FuncionarioController@show');

    Route::put('/update/{funcionario}','FuncionarioController@update');

    Route::post('/create','FuncionarioController@store');

});


Route::post('/upload','UploadController@uploadImage');