<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProcurationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionStatausController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------
| Register web routes for your application. These routes are loaded
| by the RouteServiceProvider and are assigned to the "web" middleware group.
| Make something great!
*/

// Public route for the login page
Route::get('/', fn() => view('auth.login'))->middleware('guest');

// Protected routes for authenticated users
Route::middleware('auth.user')->group(function () {

    // Dashboard route
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.home');

    // Resource routes for various controllers
    Route::resources([
        'clients' => ClientController::class,
        'procurations' => ProcurationController::class,
        'sessions' => SessionController::class,
        'expenses' => ExpenseController::class,
        'companies' => CompanyController::class,
    ]);

    // Resource route for admins with middleware
    Route::resource('admins', AdminController::class)->middleware('check.role');

    // Additional route for saved sessions
    Route::get('session/saved', SessionStatausController::class)->name('session.saved');

    // File attachment routes
    Route::prefix('attachments')->controller(FileController::class)->group(function () {
        Route::post('{entityType}/{entityId}', 'uploadFile')->name('attachments.upload');
        Route::get('download/{file}', 'downloadFile')->name('attachments.download');
        Route::delete('{id}', 'destroyFile')->name('attachments.destroy');
    });

    // Profile routes
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/change-password', 'updatePassword')->name('update-password');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/{id}', 'edit')->name('edit');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Search routes
    Route::controller(SearchController::class)->prefix('search')->name('search.')->group(function () {
        Route::post('/admin', 'searchAdmin')->name('admin')->middleware('check.role');
        Route::post('/client', 'searchClient')->name('client');
        Route::post('/procuration', 'searchProcuration')->name('procuration');
        Route::post('/session', 'searchSession')->name('session');
        Route::post('/expense', 'searchExpense')->name('expense');
        Route::post('/company', 'searchCompany')->name('company');
    });


    // Setting routes
    Route::controller(SettingController::class)->name('settings.')->group(function () {
        Route::get('settings', 'show')->name('show');
        Route::get('settings/edit', 'edit')->name('edit');
        Route::put('settings', 'update')->name('update');
    });
});

// Include authentication routes
require __DIR__ . '/auth.php';
