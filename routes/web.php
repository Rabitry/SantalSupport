<?php

use App\Http\Controllers\PopulationController;
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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::resource('population', PopulationController::class);

// Public routes
Route::get('/population', [PopulationController::class, 'index'])->name('population.index');
// Route::get('/population/{id}', [PopulationController::class, 'show'])->name('population.show');

// Auth-protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/population/create', [PopulationController::class, 'create'])->name('population.create');
    Route::post('/population', [PopulationController::class, 'store'])->name('population.store');
    Route::get('/population/{id}/edit', [PopulationController::class, 'edit'])->name('population.edit');
    Route::put('/population/{id}', [PopulationController::class, 'update'])->name('population.update');
    Route::delete('/population/{id}', [PopulationController::class, 'destroy'])->name('population.destroy');
});


require __DIR__.'/auth.php';
