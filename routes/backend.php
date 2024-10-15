<?php

use App\Events\MyEvent;
use App\Http\Controllers\dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\appointments\appointmentsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaporatoryEmployeeController;
use App\Http\Controllers\dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\RecieptAccountController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\dashboard\SingleServiceController;
use App\Http\Controllers\ProfileController;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Group;
use App\Models\LaporatoryEmployee;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Service;
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
        //===========================start admin dashboard routes ============================
        Route::get('/dashboard_admin', [DashboardController::class, 'index']);


        Route::get('/dashboard/admin', function () {

            $data['single_service'] = Service::count();
            $data['group_services'] = Group::count();
            $data['doctors'] = Doctor::count();
            $data['patients'] = Patient::count();
            $data['sections'] = Section::count();
            $data['appointments'] = Appointment::all();
            return view('dashboard.admin.dashboard',$data);
        })->middleware(['auth:admin'])->name('dashboard.admin');
        //=========================end admin dashboard routes =============================



        Route::middleware(['auth:admin'])->group(function () {


            //------------------------ sections routes --------------------
            Route::resource('sections', SectionController::class);

            //------------------------ doctors routes --------------------
            Route::resource('doctors', DoctorController::class);
            Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
            Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');

            //--------------------------- services routes -------------------------
            Route::resource('service', SingleServiceController::class);

            //---------------------------- group service route-----------------------
            Route::view('add_group_services', 'livewire.GroupServices.include_create')->name('add_group_services');

            //---------------------------------- insurance ----------------------------
            Route::resource('insurance', InsuranceController::class);

            //---------------------------------- ambulance ----------------------------
            Route::resource('ambulance', AmbulanceController::class);


            //---------------------------------- patients ----------------------------
            Route::resource('patients', PatientController::class);

            //---------------------------- group invoices route-----------------------
            Route::view('single_invoice', 'livewire.SingleInvoice.index')->name('single_invoice');

            Route::view('print_single_invoice', 'livewire.SingleInvoice.print')->name('print_single_invoice');

            //---------------------------- single invoices route-----------------------
            Route::view('group_invoices', 'livewire.group_invoices.index')->name('group_invoices');

            Route::view('print_group_invoice', 'livewire.group_invoices.print')->name('print_group_invoice');

            //---------------------------------- reciept ----------------------------
            Route::resource('reciept', RecieptAccountController::class);

            //---------------------------------- reciept ----------------------------
            Route::resource('payment', PaymentController::class);
            //---------------------------------- rayEmployee ------------------------
            Route::resource('ray_employee', RayEmployeeController::class);
            //---------------------------------- laporatoryEmployee ------------------------
            Route::resource('laporatory_employee', LaporatoryEmployeeController::class);
            //---------------------------------- appointments ------------------------
            Route::get('appointments', [appointmentsController::class,'index'])->name('appointments.index');
            Route::put('appointments/approval/{id}', [appointmentsController::class,'approval'])->name('appointments.approval');
            Route::get('appointments/approval', [appointmentsController::class,'index2'])->name('appointments.index2');
            Route::delete('appointments/delete', [appointmentsController::class,'destroy'])->name('appointments.destroy');
            Route::get('appointments/finished', [appointmentsController::class,'index3'])->name('appointments.index3');
            
        });




        //=========================== end admin dashboard routes ============================


        //============================= user dashboard routes =====================
        Route::get('/dashboard/user', function () {
            return view('dashboard.user.dashboard');
        })->middleware(['auth'])->name('dashboard.user');



        require __DIR__ . '/auth.php';
    }
);
