<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


get('/', 'FrontEnd\FrontEndController@index');
//get('/fale-conosco', 'FrontEnd\FrontEndController@FaleConosco');
get('/sobre', 'FrontEnd\FrontEndController@Sobre');

get('/promocoes/{slug}', 'FrontEnd\FrontEndController@showPromocoes');

/*Fale conosco*/
Route::get('fale-conosco', 
  ['as' => 'fale-conosco', 'uses' => 'FrontEnd\FrontEndController@FaleConosco']);

Route::post('fale-conosco', 
  ['as' => 'fale-conosco-store', 'uses' => 'FrontEnd\FrontEndController@FaleConoscoStore']);

/*Envio de promoção*/
Route::get('envie-sua-promocao', 
  ['as' => 'envie-sua-promocao', 'uses' => 'FrontEnd\FrontEndController@EnvieSuaPromocao']);

Route::post('envie-sua-promocao', 
  ['as' => 'envie-sua-promocao-store', 'uses' => 'FrontEnd\FrontEndController@EnvieSuaPromocaoStore']);


// SysAdmin area

get('sysadmin', function () {
  return redirect('/sysadmin/promocoes');
});
//return redirect('SysAdmin/PromocoesCon');



// get('/', 'LojaController@index');
// get('/fecharpedido', 'LojaController@fecharpedidoProduto');
// get('/gravaproduto', 'LojaController@gravaProduto');
// get('/apagaproduto', 'LojaController@apagaProduto');
// get('/{slug}', 'LojaController@showProduto');



$router->group([
  'namespace' => 'sysadmin',
  'middleware' => 'auth',
], function () {

  resource('sysadmin/promocoes', 'PromocoesController');
 
 });
// Logging in and out
get('auth/login', 'Auth\AuthController@getLogin');
post('auth/login', 'Auth\AuthController@postLogin');
get('auth/logout', 'Auth\AuthController@getLogout');

//Route::resource('sysadmin/promocao/create', 'SysAdmin\PromocoesController@Create');

//get('sysadmin/promocao/store', 'SysAdmin\PromocoesController@store');

//Route::get( 'sysadmin/promocao/store',  array('https', 'uses' => 'SysAdmin\PromocoesController@store', 'as' => 'promocoes.store'));