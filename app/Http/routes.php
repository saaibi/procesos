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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('procesosfifo', 'ProcesosfifoController@index');

Route::get('procesosfifo/{id}/delete', [
    'as' => 'procesosfifo.delete',
    'uses' => 'ProcesosfifoController@destroy',
]);
Route::get('procesosfifo/{id}/show', [
    'as' => 'procesosfifo.show',
    'uses' => 'ProcesosfifoController@show',
]);


Route::resource('procesos', 'ProcesosController');

Route::get('procesos/{id}/delete', [
    'as' => 'procesos.delete',
    'uses' => 'ProcesosController@destroy',
]);
Route::get('procesos/{id}/show', [
    'as' => 'procesos.show',
    'uses' => 'ProcesosController@show',
]);

Route::resource('modelNames', 'ModelNameController');

Route::get('modelNames/{id}/delete', [
    'as' => 'modelNames.delete',
    'uses' => 'ModelNameController@destroy',
]);
