<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\OrganizController;
use App\Http\Controllers\Admin\UserController;
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
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/organizer-users', [OrganizController::class, 'index'])->name('admin.organizer.index');
        Route::put('/users/{user}/update-status', [UserController::class, 'updateStatus'])->name('admin.users.update-status');
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');

        Route::get('/evento-events', [EventController::class, 'index'])->name('admin.event.index');
        Route::get('/evento-pendingevents', [EventController::class, 'getUnverifiedEvents'])->name('admin.event.getUnverifiedEvents');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
        Route::get('/booking', [AdminController::class, 'booking'])->name('admin.users.booking');
    });
   
    Route::prefix('organizer')->group(function () {
        Route::get('/index', [OrganizerController::class, 'index'])->name('organizer.index');
       
    });

   
    Route::prefix('guest')->group(function () {
        Route::get('/index', [GuestController::class, 'index'])->name('guest.index');
        
    });
});