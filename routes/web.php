<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContoroller;

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
Route::post('/users/createback',[UserContoroller::class, 'createback'])->name('createback');




Route::get('/users',[UserContoroller::class, 'index'])->name('users');

Route::get('/users/create',[UserContoroller::class, 'create'])->name('create');

Route::post('/users/check',[UserContoroller::class, 'check'])->name('check');

Route::post('/users/store',[UserContoroller::class, 'store'])->name('store');

Route::get('/users/edit/{user}',[UserContoroller::class, 'edit'])->name('edit');

Route::post('/users/editcheck/{user}',[UserContoroller::class, 'editCheck'])->name('editcheck');

Route::put('/users/put/{user}',[UserContoroller::class, 'update'])->name('put');

Route::delete('/users/delete/{user}',[UserContoroller::class, 'delete'])->name('delete');


