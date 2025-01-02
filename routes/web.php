<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSearchController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PositionContoller;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\PositionMiddleware;
use App\Livewire\EmpJobManager;
use App\Livewire\EmployerView;
use App\Livewire\JobView;
use App\Livewire\UserJobView;
use App\Livewire\UserView;
use Illuminate\Support\Facades\Route;

// general user view routes
Route::get('/', [JobController::class, 'index'])->name('home');
Route::get('/all-jobs', UserJobView::class);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'verifyEmail'])->name('forgot-password.verify');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('/reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('reset-password.submit');

Route::middleware('auth')->group(function () {
    //user info update routes
    Route::get('/update-password', [PasswordController::class, 'edit']);
    Route::post('/update-password', [PasswordController::class, 'updatePassword']);
});

//auth routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('signupForm');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('loginForm');
    Route::post('/login', [LoginController::class, 'store'])->name('login');
});
Route::delete('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware(['auth', 'employer'])->group(function () {
    // employers job and info update routes
    Route::get('/employers/{employer:id}', [EmployerController::class, 'edit']);
    Route::patch('/employers/{employer}', [EmployerController::class, 'update']);

    //employer job create and update routes
    Route::get('/tags', [JobController::class, 'fetchTags']);
    Route::get('/jobs/create', [JobController::class, 'create']);
    Route::post('/jobs', [JobController::class, 'store']);
    Route::get('/emp-job-view', EmpJobManager::class);
   
});

// Route::get('/search', JobSearchController::class);

//clicking on any tag, view related active job including with tag
Route::get('/tags/{tag:name}', TagController::class);

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/users', UserView::class);
    Route::get('/jobs', JobView::class);
    Route::get('/employers', EmployerView::class);
    
    Route::get('/roles', [PositionContoller::class, 'list']);
    Route::get('/roles/add', [PositionContoller::class, 'add']);
    Route::post('/roles/add', [PositionContoller::class, 'insert']);
    Route::get('/roles/edit/{id}', [PositionContoller::class, 'edit']);
    Route::post('/roles/edit/{id}', [PositionContoller::class, 'update']);
    Route::post('/roles/delete/{id}', [PositionContoller::class, 'delete']);
});
