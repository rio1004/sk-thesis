<?php

use App\Http\Controllers\OfficialController;
use App\Http\Controllers\UserController;
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


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['role:super-admin']], function () {
    Route::controller(UserController::class)->group(function () {
        Route::group([
            'prefix' => 'user'
        ],function(){
            Route::get('/', 'index')->name('user.index');
            Route::get('/create', 'create')->name('user.create');
            Route::post('/store', 'store')->name('user.store');
        });
    });
});
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('official', OfficialController::class);
});

require __DIR__.'/auth.php';
