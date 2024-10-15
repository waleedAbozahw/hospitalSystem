<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthDoctorController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthLaporatoryEmployee;
use App\Http\Controllers\Auth\AuthPatient;
use App\Http\Controllers\Auth\AuthRayEmployeeController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// // user login
// Route::get('/login', [AuthenticatedSessionController::class, 'create'])
// ->name('login');

// Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.user');

// // user logout
// Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// // admin login
// Route::post('/login/admin', [AdminController::class, 'store'])->middleware('guest')->name('login.admin');

 //################################## Route User ##############################################

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login.user');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout.user');

//################################## Route Admin ##############################################

Route::post('/login/admin', [AdminController::class, 'store'])->middleware('guest')->name('login.admin');

Route::post('/logout/admin', [AdminController::class, 'destroy'])->middleware('auth:admin')->name('logout.admin');

//################################## Route Doctor ##############################################

Route::post('/login/doctor', [AuthDoctorController::class, 'store'])->middleware('guest')->name('login.doctor');

Route::post('/logout/doctor', [AuthDoctorController::class, 'destroy'])->middleware('auth:doctor')->name('logout.doctor');

//################################## Route Ray Employee ##############################################

Route::post('/login/ray_employee', [AuthRayEmployeeController::class, 'store'])->middleware('guest')->name('login.ray_employee');

Route::post('/logout/ray_employee', [AuthRayEmployeeController::class, 'destroy'])->middleware('auth:ray_employee')->name('logout.ray_employee');
//################################## Route Laporatory Employee ##############################################

Route::post('/login/laporatory_employee', [AuthLaporatoryEmployee::class, 'store'])->middleware('guest')->name('login.laporatory_employee');

Route::post('/logout/laporatory_employee', [AuthLaporatoryEmployee::class, 'destroy'])->middleware('auth:laporatory_employee')->name('logout.laporatory_employee');

//################################## Route Patient  ##############################################

Route::post('/login/patient', [AuthPatient::class, 'store'])->middleware('guest')->name('login.patient');

Route::post('/logout/patient', [AuthPatient::class, 'destroy'])->middleware('auth:patient')->name('logout.patient');



Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);




    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});
