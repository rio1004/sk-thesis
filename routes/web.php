<?php

use App\Http\Controllers\AbcController;
use App\Http\Controllers\Admin\Manage;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BudgetController;
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
use App\Http\Controllers\ProfileController;
use App\Models\Announcement;
use App\Models\Budget;
use App\Models\Disbursement;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use App\Services\Constant;
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
    $budget = Budget::where('fy_year', date('Y'))->first();
    $pr=PurchaseRequest::get()->count();
    $po=PurchaseOrder::get()->count();
    $dv=Disbursement::where('status', 'released')->get()->count();
    $brgys= Constant::getBarangays();
    $suppliers = Supplier::get();
    return view('dashboard', compact('announcements', 'budget', 'pr', 'po','dv', 'brgys'));
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
    Route::controller(Manage::class)->group(function(){
        Route::group([
            'prefix' => 'manage'
        ], function(){
            Route::get('/purchase-request', 'pr_index')->name('manage.pr');
            Route::get('/purchase-order', 'po_index')->name('manage.po');
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
    Route::resource('budget', BudgetController::class);
    Route::resource('profile', ProfileController::class);
    Route::post('purchase-request/filter', [PurchaseRequestController::class, 'filterBy'])->name('purchase-request.filter');
    Route::post('purchase-request/', [PurchaseRequestController::class, 'clear'])->name('purchase-request.clear');
    Route::post('purchase-request/search', [PurchaseRequestController::class, 'search'])->name('purchase-request.search');
    Route::put('/update-my-password/{id}', [ProfileController::class, 'changePassword'])->name('update-my-password');


});

require __DIR__.'/auth.php';
