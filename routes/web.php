<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return redirect()->route('login');
// });
Route::middleware('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    // Route::middleware([
    //     'auth:sanctum',
    //     config('jetstream.auth_session'),
    //     'verified',
    // ])->group(function () {
    //     Route::get('/dashboard', function () {
    //         return view('dashboard');
    //     })->name('dashboard');
    // });
});
// Auth::routes();

// Route::get('home', [HomeController::class, 'index'])->name('home'); 

// Route::group(['middleware' => ['auth', 'admin']], function () {
//     Route::get('admin-home', [HomeController::class, 'adminHome'])->name('admin.home');
// });
// Route::prefix('admin')->middleware(['admin','locale']) ->group(base_path('routes/backendRoutes.php'));
