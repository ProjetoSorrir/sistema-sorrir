<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Livewire\Volt\Volt;

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

//Route::view('/', 'welcome');

require __DIR__ . '/auth.php';


Route::middleware(['guest'])->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');
});

Route::get('/', function () {
    return 'lp';
});

Route::middleware('auth')->group(function () {
    Route::middleware('IsAdmin')->group(function () {
        Route::get('/dashboard', function () {
            return view('central.dashboard');
        })->name('dashboard');

    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/user/dashboard', function () {
        return view('central.user.dashboard');
    })->name('user.dashboard');
});

// Try master set
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});
