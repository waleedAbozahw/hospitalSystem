<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard_Laporatory_Invoice\LaporatoryInvoiceController;
use App\Http\Controllers\dashboard_patient\PatientController;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;
use App\Http\Livewire\Chat\CreatChat;
use App\Http\Livewire\Chat\Main;
use App\Models\Laporatory;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        //===========================start patient dashboard routes ============================
        Route::get('/dashboard_patient', [DashboardController::class, 'index']);


        Route::get('/dashboard/patient', function () {
            return view('dashboard.dashboard_patient.dashboard');
        })->middleware(['auth:patient'])->name('dashboard.patient');
        //=========================end patient dashboard routes =============================
        Route::middleware('auth:patient')->group(function () {
            //############################# patients route ##########################################
            Route::get('invoices', [PatientController::class, 'invoices'])->name('invoices.patient');
            Route::get('laporatories', [PatientController::class, 'laporatories'])->name('laporatories.patient');
            Route::get('view_laporatories/{id}', [PatientController::class, 'viewLaporatories'])->name('laporatories.view');
            Route::get('rays', [PatientController::class, 'rays'])->name('rays.patient');
            Route::get('view_rays/{id}', [PatientController::class, 'viewRays'])->name('rays.view');
            Route::get('payments', [PatientController::class, 'payments'])->name('payments.patient');
            Route::get('appointments', [PatientController::class, 'appointments'])->name('appointments.patient');
            Route::view('addAppointment','dashboard.patients.addAppointment')->name('patients.addAppointment');
            Route::delete('delete_appointment', [PatientController::class,'delete_appointment'])->name('deleteAppointment');
            //############################# end patients route ######################################

            //=================================start chat routes ======================================
               Route::get('list/doctors',CreatChat::class)->name('list.doctors');
               Route::get('chat/doctors',Main::class)->name('chat.doctors');


            //=================================end chat routes ======================================

        });


        require __DIR__ . '/auth.php';
    }
);
