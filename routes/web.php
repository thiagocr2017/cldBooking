<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::controller(ClientController::class)->group(function(){
//     Route::get('/client', 'index')->name('client.index');
//     Route::get('/client/create', 'create')->name('client.create');
//     Route::get('client/{client}', 'show')->name('client.show');
//     Route::get('/client/{client}/edit', 'edit')->name('client.edit');
//     Route::post('/client', 'store')->name('client.store');
//     Route::put('/client/{client}', 'update')->name('client.update');
//     Route::delete('/client/{client}', 'destroy')->name('client.destroy');
// });
Route::resources([
    'client' => ClientController::class,
    // 'list' => ListController::class
]);