<?php


use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;   
use App\Http\Controllers\CommentController; 
use App\Http\Controllers\ComplaintController;   
use App\Http\Controllers\PopulationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
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

// Public Population Routes
Route::get('/population', [PopulationController::class, 'index'])->name('population.index');

// Auth-protected Population Routes (Only for approved users)
Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/population/create', [PopulationController::class, 'create'])->name('population.create');
    Route::post('/population', [PopulationController::class, 'store'])->name('population.store');
    Route::get('/population/{id}/edit', [PopulationController::class, 'edit'])->name('population.edit');
    Route::put('/population/{id}', [PopulationController::class, 'update'])->name('population.update');
    Route::delete('/population/{id}', [PopulationController::class, 'destroy'])->name('population.destroy');
    Route::get('/population/{id}', [PopulationController::class, 'show'])->name('population.show');
});

// Profile Routes (Laravel Breeze) - Only for approved users
Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', function () {
        $totalUsers = \App\Models\User::count();
        $totalPopulations = \App\Models\Population::count();
        $totalAdmins = \App\Models\User::where('role', 'admin')->count();
        $totalStudents = \App\Models\Population::where('occupation', 'Student')->count();
        $pendingUsers = \App\Models\User::where('status', 'pending')->count();
        $approvedUsers = \App\Models\User::where('status', 'approved')->count();
        $rejectedUsers = \App\Models\User::where('status', 'rejected')->count();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalPopulations', 
            'totalAdmins', 
            'totalStudents',
            'pendingUsers',
            'approvedUsers',
            'rejectedUsers'
        ));
    })->name('dashboard');

    // Admin Population Management
    Route::get('/populations', [PopulationController::class, 'adminIndex'])->name('populations.index');
    Route::get('/populations/{id}', [PopulationController::class, 'adminShow'])->name('populations.show');
    Route::get('/populations/{id}/edit', [PopulationController::class, 'adminEdit'])->name('populations.edit');
    Route::put('/populations/{id}', [PopulationController::class, 'adminUpdate'])->name('populations.update');
    Route::delete('/populations/{id}', [PopulationController::class, 'adminDestroy'])->name('populations.destroy');

    // ==================== USER MANAGEMENT ROUTES ====================
    // Using AdminUserController for all user management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/pending', [AdminUserController::class, 'pendingUsers'])->name('users.pending');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::post('/users/{id}/approve', [AdminUserController::class, 'approveUser'])->name('users.approve');
    Route::post('/users/{id}/reject', [AdminUserController::class, 'rejectUser'])->name('users.reject');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Admin Statistics
    Route::get('/statistics', function () {
        $populationStats = \App\Models\Population::selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN occupation = "Student" THEN 1 ELSE 0 END) as students,
            SUM(CASE WHEN occupation = "Jobholder" THEN 1 ELSE 0 END) as jobholders,
            SUM(CASE WHEN sex = "Male" THEN 1 ELSE 0 END) as males,
            SUM(CASE WHEN sex = "Female" THEN 1 ELSE 0 END) as females
        ')->first();

        $bloodGroupStats = \App\Models\Population::whereNotNull('blood_group')
            ->selectRaw('blood_group, COUNT(*) as count')
            ->groupBy('blood_group')
            ->get();

        $districtStats = \App\Models\Population::selectRaw('district, COUNT(*) as count')
            ->groupBy('district')
            ->orderBy('count', 'desc')
            ->get();

        // User statistics
        $userStats = \App\Models\User::selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = "rejected" THEN 1 ELSE 0 END) as rejected
        ')->first();

        return view('admin.statistics', compact(
            'populationStats', 
            'bloodGroupStats', 
            'districtStats',
            'userStats'
        ));
    })->name('statistics');
});

// Route::resource('posts', PostController::class);
// Route::resource('comments', CommentController::class);
// Route::resource('complaints', ComplaintController::class);

// routes/web.php
// routes/web.php

// Public post routes
Route::resource('posts', PostController::class);
Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Admin post routes - SIMPLIFIED
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('/posts/complaints', [AdminPostController::class, 'complaints'])->name('posts.complaints');
    Route::get('/posts/{id}', [AdminPostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{id}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/complaints/{id}/resolve', [AdminPostController::class, 'resolveComplaint'])->name('complaints.resolve');
});

require __DIR__.'/auth.php';