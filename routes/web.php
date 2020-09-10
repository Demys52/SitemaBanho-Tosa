<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//  CLIENTE
// get
Route::get('/cliente', ['uses'=>'ClienteController@index','as'=>'cliente.index']);
Route::get('/cliente/adicionar', ['uses'=>'ClienteController@adicionar','as'=>'cliente.adicionar']);
Route::get('/cliente/editar/{id}', ['uses'=>'ClienteController@editar','as'=>'cliente.editar']);
Route::get('/cliente/deletar/{id}', ['uses'=>'ClienteController@deletar','as'=>'cliente.deletar']);
Route::get('/cliente/detalhe/{id}', ['uses'=>'ClienteController@detalhe','as'=>'cliente.detalhe']);
//post
Route::post('/cliente/salvar', ['uses'=>'ClienteController@salvar','as'=>'cliente.salvar']);
//put
Route::put('/cliente/atualizar/{id}', ['uses'=>'ClienteController@atualizar','as'=>'cliente.atualizar']);

// TELEFONE
//get
Route::get('/telefone/adicionar/{id}', ['uses'=>'TelefoneController@adicionar','as'=>'telefone.adicionar']);
Route::get('/telefone/editar/{id}', ['uses'=>'TelefoneController@editar','as'=>'telefone.editar']);
Route::get('/telefone/deletar/{id}', ['uses'=>'TelefoneController@deletar','as'=>'telefone.deletar']);
//post
Route::post('/telefone/salvar/{id}', ['uses'=>'TelefoneController@salvar','as'=>'telefone.salvar']);
//put
Route::put('/telefone/atualizar/{id}', ['uses'=>'TelefoneController@atualizar','as'=>'telefone.atualizar']);

// PET
//get
Route::get('/pet/adicionar/{id}', ['uses'=>'PetController@adicionar','as'=>'pet.adicionar']);
Route::get('/pet/editar/{id}', ['uses'=>'PetController@editar','as'=>'pet.editar']);
Route::get('/pet/deletar/{id}', ['uses'=>'PetController@deletar','as'=>'pet.deletar']);
//post
Route::post('/pet/salvar/{id}', ['uses'=>'PetController@salvar','as'=>'pet.salvar']);
//put
Route::put('/pet/atualizar/{id}', ['uses'=>'PetController@atualizar','as'=>'pet.atualizar']);

// SERVIÇOS
//get
Route::get('/servico', ['uses'=>'ServicoController@index','as'=>'servico.index']);
Route::get('/servico/deletar/{id}', ['uses'=>'ServicoController@deletar','as'=>'servico.deletar']);
Route::get('/servico/finalizar', ['uses'=>'ServicoController@finalizar','as'=>'servico.finalizar']);
Route::get('/servico/servicos', ['uses'=>'ServicoController@servicos','as'=>'servico.servicos']);
Route::get('/servico/adicionar/{id}', ['uses'=>'ServicoController@adicionar','as'=>'servico.adicionar']);
Route::get('/servico/incluir/{id}', ['uses'=>'ServicoController@incluir','as'=>'servico.incluir']);
//post
Route::post('/servico/salvar/{id}', ['uses'=>'ServicoController@salvar','as'=>'servico.salvar']);
Route::post('/servico/incluirServico/{id}', ['uses'=>'ServicoController@incluirServico','as'=>'servico.incluirServico']);
Route::post('/servico/pagamento', ['uses'=>'ServicoController@pagamento','as'=>'servico.pagamento']);
Route::post('/servico/acertar', ['uses'=>'ServicoController@acertar','as'=>'servico.acertar']);

// RELATORIOS
//get
Route::get('/relatorio', ['uses'=>'RelatorioController@index','as'=>'relatorio.index']);
//post
Route::post('/relatorio/exibir/{id}', ['uses'=>'RelatorioController@exibir','as'=>'relatorio.exibir']);