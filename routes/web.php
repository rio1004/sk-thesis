<?php

use App\Http\Controllers\AbcController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CanvassController;
use App\Http\Controllers\DisbursementController;
use App\Http\Controllers\NoaController;
use App\Http\Controllers\NtpController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RequestQoutationController;
use App\Http\Controllers\UserController;
use App\Models\Announcement;
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
    $announcements = Announcement::get();
    return view('dashboard', compact('announcements'));
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
    Route::resource('purchase-request', PurchaseRequestController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('qoutation', RequestQoutationController::class);
    Route::resource('purchase-order', PurchaseOrderController::class);
    Route::resource('abstract-canvass', CanvassController::class);
    Route::resource('abc', AbcController::class);
    Route::resource('notice-of-award', NoaController::class);
    Route::resource('notice-to-proceed', NtpController::class);
    Route::resource('announcement', AnnouncementController::class);
    Route::resource('dibursement', DisbursementController::class);
});

require __DIR__.'/auth.php';
