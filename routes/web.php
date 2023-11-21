<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriveController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 
Route::middleware('auth')->group(function () {

    Route::prefix('drives/')->group(function () {

        Route::get('index', [DriveController::class, 'index'])->name('drives.index')->middleware('RuleOne') ;
        Route::get('myFiles', [DriveController::class, 'myFiles'])->name('drives.myFiles');
        Route::get('create', [DriveController::class, 'create'])->name('drives.create');
        Route::post('store', [DriveController::class, 'store'])->name('drives.store');
        Route::get('notFoundPage', [DriveController::class, 'notFoundPage'])->name('notFoundPage');

        Route::get('show/{id}', [DriveController::class, 'show'])->name('drives.show');
        Route::get('edit/{id}', [DriveController::class, 'edit'])->name('drives.edit');
        Route::post('update/{id}', [DriveController::class, 'update'])->name('drives.update');
        Route::get('destroy/{id}', [DriveController::class, 'destroy'])->name('drives.destroy');
        Route::get('changeStatus/{id}', [DriveController::class, 'changeStatus'])->name('drives.changeStatus');
    });
    Route::prefix('user/')->group(function () {

        Route::get('index', [UserController::class, 'profile'])->name('user.profile') ;
        Route::post('update-profile-image',[UserController::class, 'updateProfileImage'] )->name('update.profile.image');



    });
});





