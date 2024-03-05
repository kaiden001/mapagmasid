<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnumeratorController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [AuthenticatedSessionController::class, 'Redirect'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/view', [ProfileController::class, 'viewProfile'])->name('profile.view');
    Route::post('profile/store', [ProfileController::class, 'EditProfile'])->name('profile.edit');
    Route::get('change/password', [ProfileController::class, 'ChangePassword'])->name('change.password');
    Route::get('/logout', [AuthenticatedSessionController::class, 'Logout'])->name('user.logout');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/login-page', [AdminController::class, 'AdminLogin'])->name('admin.login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});


Route::middleware(['auth', 'role:enumerator'])->group(function () {
    Route::get('/enumerator/dashboard', [EnumeratorController::class, 'EnumeratorDashboard'])->name('enumerator.dashboard');
});




Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'AllType')->name('all.type');
        Route::get('/add/type', 'AddType')->name('add.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(AmenitiesController::class)->group(function () {
        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
        Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
        Route::post('/amenities/get-amenities', 'GetAmenitiesData')->name('get.amenities');
        Route::post('/amenities/modal', 'GetAmenitiesModal')->name('modal.amenities');
        Route::post('/amenities/count', 'CountAmenities')->name('count.amenities');
    });
});
