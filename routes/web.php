<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');});
Route::get('/contact','ContactController@index')->name('index');
//確認ページ//
Route::post('/contact/confirm','ContactContaroller@confirm')->name('confirm'); 
//送信完了ページ//
Route::post('/contact/thanks','ContactContaroller@send')->name('send');