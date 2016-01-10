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


get('/', 'frontend\FrontEndController@index');
//get('/fale-conosco', 'FrontEnd\FrontEndController@FaleConosco');
get('/sobre', 'frontend\FrontEndController@Sobre');

get('/promocoes/{slug}', 'frontend\FrontEndController@showPromocoes');

/*Fale conosco*/
Route::get('fale-conosco', 
  ['as' => 'fale-conosco', 'uses' => 'frontend\FrontEndController@FaleConosco']);

Route::post('fale-conosco', 
  ['as' => 'fale-conosco-store', 'uses' => 'frontend\FrontEndController@FaleConoscoStore']);

/*Envio de promoção*/
Route::get('envie-sua-promocao', 
  ['as' => 'envie-sua-promocao', 'uses' => 'frontend\FrontEndController@EnvieSuaPromocao']);

Route::post('envie-sua-promocao', 
  ['as' => 'envie-sua-promocao-store', 'uses' => 'frontend\FrontEndController@EnvieSuaPromocaoStore']);

Route::get('politica-de-privacidade', 
  ['as' => 'politica-de-privacidade', 'uses' => 'frontend\FrontEndController@PoliticaPrivacidade']);
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