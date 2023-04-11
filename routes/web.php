<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagemTesteEmail;

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

Auth::routes(['verify'=> true]);

Route::get('tarefa/exportacao/{extencao}', 'App\Http\Controllers\TarefaController@exportarTarefasParaExcel')->name('tarefa.export');
Route::get('tarefa/exportar', 'App\Http\Controllers\TarefaController@exportarPdf')->name('tarefa.exportar');
Route::resource('tarefa', 'App\Http\Controllers\TarefaController')->middleware('verified');
Route::get('/mensagem-teste', function(){
    return new MensagemTesteEmail();
    // Mail::to('carancho.asp@gmail.com')->send(new MensagemTesteEmail());
    // return 'Email enviado com sucesso';
});
