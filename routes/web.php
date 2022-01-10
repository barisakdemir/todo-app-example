<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

/*todo routes*/
Route::get('/', [TodoController::class, 'dashboard'])->name('dashboard');
Route::post('/store', [TodoController::class, 'store'])->name('store');
Route::get('edit/{id}', [TodoController::class, 'edit'])->name('edit');
Route::patch('edit/{id}', [TodoController::class, 'patch'])->name('patch');
Route::delete('delete/{id}', [TodoController::class, 'delete'])->name('delete');
/*todo routes finish*/
