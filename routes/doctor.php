<?php

use App\Http\Controllers\dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\dashboard\InsuranceController;
use App\Http\Controllers\dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\RecieptAccountController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\dashboard\SingleServiceController;
use App\Http\Controllers\Doctors\DiagnosisController;
use App\Http\Controllers\Doctors\InvoiceController;
use App\Http\Controllers\Doctors\LaporatoryController;
use App\Http\Controllers\Doctors\PatientDetailsController;
use App\Http\Controllers\Doctors\RayController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Chat\CreatChat;
use App\Http\Livewire\Chat\Main;
use App\Models\Appointment;
use App\Models\diagnosis;
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


        //===========================start doctor dashboard routes ============================
        Route::get('/dashboard_doctor', [DashboardController::class, 'index']);


        Route::get('/dashboard/doctor', function () {
            $data['appointments'] = Appointment::where('doctor_id',auth()->user()->id)->get();
            return view('dashboard.doctor.dashboard',$data);
        })->middleware(['auth:doctor'])->name('dashboard.doctor');
        //=========================end doctor dashboard routes =============================

        Route::middleware(['auth:doctor'])->prefix('doctor')->group(function () {

            //==================== invoices routes ==============================
            Route::get('completeInvoices',[InvoiceController::class,'completeInvoices'])->name('completeInvoices');
            Route::get('reviewInvoices',[InvoiceController::class,'reviewInvoices'])->name('reviewInvoices');
            Route::resource('invoices', InvoiceController::class);
            Route::resource('diagnosis',DiagnosisController::class);
            Route::post('add_review',[DiagnosisController::class,'addReview'])->name('add_review');
            //==================== end invoices routes ==========================

            //==================== rays ================================
            Route::resource('rays',RayController::class);
            Route::get('patient_details/{id}',[PatientDetailsController::class,'index'])->name('patient_details');
            //====================end rays ================================
            //==================== start laporatory ==============================
            Route::resource('laporatory',LaporatoryController::class);
            Route::get('show_laporatory/{id}',[InvoiceController::class,'showLaporatory'])->name('show_laporatory');
            //===================== end laporatory ==========================

            //=================================start chat routes ======================================
            Route::get('list/patients',CreatChat::class)->name('list.patients');
            Route::get('chat/patients',Main::class)->name('chat.patients');


         //=================================end chat routes ======================================



        });



        require __DIR__ . '/auth.php';
    }
);
