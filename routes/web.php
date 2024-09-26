<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

// Route for the homepage/dashboard (requires authentication)
Route::get('/', function () {
    return view('dashboard.home');
})->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {

    require __DIR__ . '/auth.php';

    Route::middleware('auth.user')->group(function () {
        // Route for the admin dashboard
        Route::get('/dashboard', [HomeController::class, 'index'])->name('index');

        // AdminController routes
        Route::controller(AdminController::class)->middleware('check.role')->group(function () {
            Route::get('/', 'index')->name('home'); // Admin home page
            Route::get('/create', 'create')->name('create'); // Form to create
            Route::post('/', 'store')->name('store'); // Store new data (POST)

            // New routes for show, edit, and delete
            Route::get('/{id}', 'show')->name('show'); // Show specific admin
            Route::get('/{id}/edit', 'edit')->name('edit'); // Edit specific admin
            Route::put('/{id}', 'update')->name('update'); // Update specific admin
            Route::delete('/{id}', 'destroy')->name('destroy'); // Delete specific admin
        });
    });
});



// Profile routes (can be used later if needed)
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
