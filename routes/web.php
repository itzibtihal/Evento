<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Organizer\OrganizerController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
       
    });
   
    Route::prefix('organizer')->group(function () {
        Route::get('/index', [OrganizerController::class, 'index'])->name('organizer.index');
       
    });

   
    Route::prefix('guest')->group(function () {
        Route::get('/index', [GuestController::class, 'index'])->name('guest.index');
        
    });
});