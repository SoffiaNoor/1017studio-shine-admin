<?php

use App\Http\Controllers\DataManagement\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/calendar', function () {
    return view('template.calendar');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/form-elements', function () {
    return view('form-elements');
});

Route::get('/form-layout', function () {
    return view('form-layout');
});

Route::get('/tables', function () {
    return view('tables');
});

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/chart', function () {
    return view('chart');
});

Route::get('/alerts', function () {
    return view('alerts');
});

Route::get('/buttons', function () {
    return view('buttons');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/signup', function () {
    return view('signup');
});


//the main code
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('authLogin');
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('registerForm');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home')->middleware(['auth']);
    Route::put('information/updatePhotos/{id}', [InformationController::class, 'updatePhotos'])->name('updatePhotos')->middleware(['auth']);
    Route::resource('/information', InformationController::class)->middleware(['auth']);
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

//Home Settings
Route::put('home_settings/why_choose_us/{id}', [HomeSettingController::class, 'storeWhyChooseUs'])->name('storeWhyChooseUs')->middleware(['auth']);
Route::put('home_settings/enquire_to_reservation/{id}', [HomeSettingController::class, 'storeEnquire'])->name('storeEnquire')->middleware(['auth']);
Route::resource('home_settings', HomeSettingController::class)->middleware(['auth']);

//Data Management
Route::resource('/services', ServiceController::class)->middleware(['auth']);
