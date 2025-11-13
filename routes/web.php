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

Route::get('/users',[UserContoroller::class, 'index'])->name('users');

Route::get('/users/create',[UserContoroller::class, 'create'])->name('create');

Route::post('/users/check',[UserContoroller::class, 'check'])->name('check');

Route::post('/users/store',[UserContoroller::class, 'store'])->name('store');

Route::get('/users/{user}',[UserContoroller::class, 'edit'])->name('edit');

Route::post('/users/{user}/check',[UserContoroller::class, 'editCheck'])->name('editcheck');

Route::put('/users/{user}/put',[UserContoroller::class, 'update'])->name('put');

Route::delete('/users/{user}/delete',[UserContoroller::class, 'delete'])->name('delete');
