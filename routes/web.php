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
Route::get('/pertanyaan/{id}', 'PertanyaanController@detail');
Route::get('/pertanyaan/{id}/edit', 'PertanyaanController@edit');
Route::put('/pertanyaan/{id}', 'PertanyaanController@update');
Route::post('/pertanyaan', 'PertanyaanController@store');
Route::delete('/pertanyaan/{id}', 'PertanyaanController@destroy');

// komentar pertanyaan route
Route::get('/pertanyaan/{id}/komentar', 'KomentarPertanyaanController@index');
Route::get('/pertanyaan/{id}/komentar/edit/{komenId}', 'KomentarPertanyaanController@edit');
Route::post('/pertanyaan/{id}/komentar', 'KomentarPertanyaanController@store');
Route::put('/pertanyaan/{id}/komentar/{komenId}', 'KomentarPertanyaanController@update');
Route::delete('/pertanyaan/{id}/komentar/{komenId}', 'KomentarPertanyaanController@delete');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Jawaban
Route::get('/jawaban/create/{pertanyaan_id}', 'JawabanController@create');
Route::post('/jawaban', 'JawabanController@store');
Route::get('/jawaban/{jawaban_id}/edit', 'JawabanController@edit');
Route::put('/jawaban/{jawaban_id}', 'JawabanController@update');
Route::delete('/jawaban/{jawaban_id}', 'JawabanController@destroy');


//Komentar Jawaban
Route::get('/jawaban/create_komentar/{jawaban_id}', 'JawabanController@createKomentar');
Route::post('/jawaban/store_komentar', 'JawabanController@storeKomentar');
Route::get('/jawaban/edit_komentar/{jawaban_id}/{komentar_id}', 'JawabanController@editKomentar');
Route::put('/jawaban/update_komentar/{komentar_id}', 'JawabanController@updateKomentar');
Route::delete('/jawaban/destroy_komentar/{id}', 'JawabanController@destroyKomentar');

Route::get('/jawaban/upvote/{jawaban_id}', 'JawabanController@upVote');
Route::get('/jawaban/downvote/{jawaban_id}', 'JawabanController@downVote');
