<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/confirm', fn () => redirect()->route('contacts.index'));
Route::post('/contacts/confirm',[ContactController::class,'confirm'])->name('contacts.confirm');
Route::get('/contacts/confirm', fn() => redirect()->route('contacts.index'));
Route::post('/contacts/thanks',[ContactController::class,'store']);
Route::post('/contacts/back', [ContactController::class, 'back'])->name('contacts.back');

Route::get('/admin',[ContactController::class,'admin'])->middleware(['auth'])->name('admin');


Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

Route::get('/contacts/export',[ContactController::class,'export'])->name('contacts.export');