<?php

use Illuminate\Support\Facades\Auth;
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

// pertanyaan route
Route::get('/', 'PertanyaanController@index');
Route::get('/pertanyaan/create', 'PertanyaanController@create');
Route::get('/pertanyaan/{$id}', 'PertanyaanController@detail');
Route::get('/pertanyaan/{$id}/edit', 'PertanyaanController@edit');
Route::put('/pertanyaan/{$id}', 'PertanyaanController@update');
Route::post('/pertnyaan/{$id}', 'PertanyaanController@store');
Route::delete('/pertanyaan/{$id}', 'PertanyaanController@destroy');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/jawaban','JawabanController');