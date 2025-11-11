<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewRequestController;
use App\Http\Controllers\ITF001Controller;
use App\Http\Controllers\ITF002Controller;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\InProcessController;
use App\Http\Controllers\ApprovedController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserManagementController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Main dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Request status routes
    Route::prefix('requests')->name('requests.')->group(function () {
        // Pending verification by BPO/HOD
        Route::get('/pending-verification/{form}', [PendingController::class, 'index'])
            ->name('pending-verification')
            ->where('form', 'ITF001|ITF002');
            
        // Pending approval by IT HOD
        Route::get('/pending-approval/{form}', [PendingController::class, 'pendingApproval'])
            ->name('pending-approval')
            ->where('form', 'ITF001|ITF002');
            
        // Approved but unassigned requests
        Route::get('/unassigned/{form}', [InProcessController::class, 'unassigned'])
            ->name('unassigned')
            ->where('form', 'ITF001|ITF002');
    });
});

Route::get('new.request', [NewRequestController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('new.request');

// Public routes for forms (no authentication required)
Route::get('/itf001', [ITF001Controller::class, 'index'])->name('itf001');
Route::post('/itf001', [ITF001Controller::class, 'store'])->name('itf001.store');
Route::get('/itf002', [ITF002Controller::class, 'index'])->name('itf002');
Route::post('/itf002', [ITF002Controller::class, 'store'])->name('itf002.store');

// Pending requests (HOD only)
Route::middleware(['auth', 'verified'])->prefix('pending')->name('pending.')->group(function () {
    Route::get('/', [PendingController::class, 'index'])->name('index');
    Route::get('/view/{id}', [PendingController::class, 'view'])->name('view');
    Route::post('/verify/{id}', [PendingController::class, 'verify'])->name('verify');
    Route::post('/reject/{id}', [PendingController::class, 'reject'])->name('reject');
});

// For backward compatibility
Route::get('/pending', [PendingController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('pending');

// In-process requests (HOD IT approval)
Route::middleware(['auth', 'verified'])->prefix('in-process')->name('in.process.')->group(function () {
    Route::get('/', [InProcessController::class, 'index'])->name('index');
    Route::post('/approve/{id}', [InProcessController::class, 'approve'])->name('approve');
    Route::post('/reject/{id}', [InProcessController::class, 'reject'])->name('reject');
});

// For backward compatibility
Route::get('/in-process', [InProcessController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('in.process');

// Approved requests and assignments
Route::prefix('approved')->name('approved.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ApprovedController::class, 'index'])->name('index');
    Route::post('/approve/{id}', [ApprovedController::class, 'approve'])->name('approve');
    Route::get('/unassign', [ApprovedController::class, 'unassign'])->name('unassign');
    Route::get('/assign-to-me', [ApprovedController::class, 'assignToMe'])->name('assign.to.me');
    Route::get('/assign-to-others', [ApprovedController::class, 'assignToOthers'])->name('assign.to.others');
    Route::post('/assign/{id}', [ApprovedController::class, 'assign'])->name('assign');
    Route::post('/bulk-assign', [ApprovedController::class, 'bulkAssign'])->name('bulk.assign');
    Route::post('/complete/{id}', [ApprovedController::class, 'complete'])->name('complete');
});

Route::get('history', [HistoryController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('history');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // User management (Admin only)
    Route::resource('users', UserManagementController::class);
});

require __DIR__.'/auth.php';
