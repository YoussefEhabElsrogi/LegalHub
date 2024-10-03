<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProcurationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionStatausController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

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

// Route for the login page
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Protected routes for authenticated users
Route::middleware('auth.user')->group(function () {

    // DASHBOARD ROUTES
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.home');

    // ADMIN ROUTES
    Route::resource('admins', AdminController::class)->middleware('check.role');

    // CLIENT ROUTES
    Route::resource('clients', ClientController::class);

    // PROCURATION ROUTES
    Route::resource('procurations', ProcurationController::class);

    // SESSION ROUTES
    Route::resource('sessions', SessionController::class);

    // ADDITIONAL ROUTE FOR SAVED SESSIONS
    Route::get('session/saved', [SessionStatausController::class, 'index'])->name('session.saved');

    // EXPENSES ROUTES
    Route::resource('expenses', ExpenseController::class);

    // COMPANIES ROUTES
    Route::resource('companies', CompanyController::class);

    // FILES ROUTES
    Route::prefix('attachments')->controller(FileController::class)->group(function () {
        Route::post('{entityType}/{entityId}', 'uploadFile')->name('attachments.upload');
        Route::get('download/{file}', 'downloadFile')->name('attachments.download');
        Route::delete('{id}', 'destroyFile')->name('attachments.destroy');
    });

    // PROFILE ROUTES
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/change-password', 'updatePassword')->name('update-password');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/{id}', 'edit')->name('edit');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // SETTING ROUTES
    Route::controller(SettingController::class)->name('settings.')->group(function () {
        Route::get('settings', 'show')->name('show');
        Route::get('settings/edit', 'edit')->name('edit');
        Route::put('settings', 'update')->name('update');
    });
});

// Include authentication routes
require __DIR__ . '/auth.php';
