<?php
use Illuminate\Support\Facades\Route;

// Root Controller
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

// SBP Controller
use App\Http\Controllers\PostLoginController;
use App\Http\Controllers\UserBackcheckController;
use App\Http\Controllers\UserBrandingController;
use App\Http\Controllers\UserAktivitasController;
use App\Http\Controllers\UserInfoKompetitorController;
use App\Http\Controllers\UserSummaryController;
// Internal Controller

// Regional Controller


// Root Route
Route::get('/', [HomeController::class, 'index'])->middleware('role.redirect');

// Logged In Route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // SBP Routes
    Route::middleware('role.redirect:1')->group(function () {
        Route::get('/login/jabatan', [PostLoginController::class, 'show'])->name('post-login.show');
        Route::post('/login/jabatan', [PostLoginController::class, 'store'])->name('post-login.store');
        Route::middleware('ensure.jabatan')->group(function(){
            // Home
            Route::get('/user/home', [HomeController::class, 'index'])->name('user.home');
            // Backcheck
            Route::get('/user/backcheck', [UserBackcheckController::class, 'index'])->name('backcheck.index');
            Route::post('/user/backcheck', [UserBackcheckController::class, 'store'])->name('backcheck.store');
            // Branding
            Route::get('/user/branding', [UserBrandingController::class, 'index'])->name('branding.index');
            Route::post('/user/branding', [UserBrandingController::class, 'store'])->name('branding.store');
            // Activity
            Route::get('/user/aktivitas', [UserAktivitasController::class, 'index'])->name('aktivitas.index');
            Route::post('/user/aktivitas', [UserAktivitasController::class, 'store'])->name('aktivitas.store');
            // Info Kompetitor
            Route::get('/user/infokompetitor', [UserInfoKompetitorController::class, 'index'])->name('infokompetitor.index');
            Route::post('/user/infokompetitor', [UserInfoKompetitorController::class, 'store'])->name('infokompetitor.store');
            // Summary
            Route::get('/user/summary', [UserSummaryController::class, 'index'])->name('summary.index');
            Route::get('/user/summary/{userId}', [UserSummaryController::class, 'detail'])->name('summary.detail');
        });
    });

    // General routes (outside role-specific middleware)
    Route::get('/post-login', function () {
        return view('post-login');
    });

    Route::get('/post-submit', function () {
        return view('post-submit');
    }); // ✅ FIXED: Added missing closing bracket

    // Internal Routes
    Route::middleware('role.redirect:2')->group(function () {
        Route::get('/internal/home', [HomeController::class, 'index'])->name('branch.home');
    });

    // Regional Routes
    Route::middleware('role.redirect:3')->group(function () {
        Route::get('/regional/home', [HomeController::class, 'index'])->name('regional.home');
    });
});

require __DIR__.'/auth.php';