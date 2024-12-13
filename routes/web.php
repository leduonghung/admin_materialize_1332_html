<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\DomainExtensionController;


// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::middleware('auth')->name('admin')->group(function () {
    // ->prefix('domain')
    Route::controller(DomainController::class)->name('.domain')->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::post('/exists', 'exists')->name('.exists');
        Route::post('/edit/{id}', 'edit')->name('.edit')->where('id', '[0-9]+');
        Route::post('/update/{id}', 'update')->name('.update')->where('id', '[0-9]+');
        Route::delete('/delete/{id}', 'destroy')->name('.delete')->where('id', '[0-9]+');
        Route::get('/resource', 'resource')->name('.resource');
        Route::get('loadAjax', 'loadAjax')->name('.loadAjax')->where('id', '[0-9]+');
    });

    Route::controller(DomainExtensionController::class)->prefix('domain/extension')->name('.domain.extension')->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::post('/edit/{id}', 'edit')->name('.edit')->where('id', '[0-9]+');
        Route::post('/update/{id}', 'update')->name('.update')->where('id', '[0-9]+');
        Route::post('/exists', 'exists')->name('.exists');
        Route::delete('/delete/{id}', 'destroy')->name('.delete')->where('id', '[0-9]+');
        Route::get('loadAjax', 'loadAjax')->name('.loadAjax')->where('id', '[0-9]+');
    });
    Route::controller(UserController::class)->prefix('user')->name('.user')->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/edit/{id}', 'edit')->name('.edit')->where('id', '[0-9]+');
        Route::post('/update/{id}', 'update')->name('.update')->where('id', '[0-9]+');
        Route::delete('/delete/{id}', 'destroy')->name('.delete')->where('id', '[0-9]+');
        Route::get('loadAjax', 'loadAjax')->name('.loadAjax')->where('id', '[0-9]+');
    });
    Route::controller(RequestController::class)->prefix('request')->name('.request')->group(function () {
        Route::post('/domain', 'domain')->name('.domain');
        Route::post('/dot-domain', 'dotDomain')->name('.dotDomain');
    });
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
// Auth::routes();

// Route::get('home', [HomeController::class, 'index'])->name('home'); 

// Route::group(['middleware' => ['auth', 'admin']], function () {
//     Route::get('admin-home', [HomeController::class, 'adminHome'])->name('admin.home');
// });
// Route::prefix('admin')->middleware(['admin','locale']) ->group(base_path('routes/backendRoutes.php'));
