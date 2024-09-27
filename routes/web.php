<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProcurationController;
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


Route::middleware('auth.user')->group(function () {
    // DASHBORD ROUTES
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.home');

    // ADMIN ROUTES
    Route::resource('admins', AdminController::class)
        ->middleware('check.role');

    // CLIENT ROUTES
    Route::resource('clients', ClientController::class);

    // PROCURATION ROUTES
    Route::resource('procuration', ProcurationController::class);
});


require __DIR__ . '/auth.php';












// Profile routes (can be used later if needed)
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
