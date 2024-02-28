<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {return view('welcome');});
//お問い合わせフォーム//
Route::get('contact',[ContactController::class,'index'])->name('contact.index');
//確認ページ//
Route::post('contact/confirm',[ContactController::class,'confirm'])->name('contact.confirm'); 
//送信完了ページ//
Route::post('contact/thanks',[ContactController::class,'send'])->name('contact.send');
//管理画面//
Route::get('contact/list', [ContactController::class, 'list'])->name('contact.list');
//詳細ページ//
Route::get('contact/detail/{id}/', [ContactController::class, 'detail'])->name('contact.detail');
//削除機能//
Route::get('contact/delete/{id}/', [ContactController::class, 'delete'])->name('contact.delete');

//ログイン機能//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
