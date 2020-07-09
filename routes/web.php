<?php

use App\pertanyaan;
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

Route::get('/', 'PertanyaanController@index');
Route::get('/pertanyaan/create', 'PertanyaanController@create');
Route::get('/pertanyaan/{$id}', 'PertanyaanController@detail');
Route::get('/pertanyaan/{$id}/edit', 'PertanyaanController@edit');
Route::put('/pertanyaan/{$id}', 'PertanyaanController@update');
Route::post('/pertnyaan/{$id}', 'PertanyaanController@store');
Route::delete('/pertanyaan/{$id}', 'PertanyaanController@destroy');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//create, store, index, show, edit, update, delete
Route::get('/jawaban/create/{pertanyaan_id}','JawabanController@create');
Route::post('/jawaban','JawabanController@store');
Route::get('/jawaban/{pertanyaan_id}/edit','JawabanController@edit');
Route::put('/jawaban/{pertanyaan_id}','JawabanController@update');
Route::delete('/jawaban/{pertanyaan_id}','JawabanController@destroy');

Route::post('/jawaban/store_komentar','JawabanController@storeKomentar');

Route::get('/jawaban/upvote/{jawaban_id}','JawabanController@upVote');
Route::get('/jawaban/downvote/{jawaban_id}','JawabanController@downVote');
