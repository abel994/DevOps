<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/proyectos', 'ProyectoController@index')->name('proyectos.index');
    Route::get('/proyectos/nuevo', 'ProyectoController@create')->name('proyectos.create');
    Route::post('/proyectos', 'ProyectoController@store')->name('proyectos.store');
    Route::get('/proyectos/{proyecto}/editar', 'ProyectoController@edit')->name('proyectos.edit');
    Route::put('/proyectos/{proyecto}', 'ProyectoController@update')->name('proyectos.update')->where('proyecto','[0-9]+');
});

Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
