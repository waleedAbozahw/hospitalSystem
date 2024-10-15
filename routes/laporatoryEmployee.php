<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard_Laporatory_Invoice\LaporatoryInvoiceController;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;
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


        //===========================start laporatoryEmployee dashboard routes ============================
        Route::get('/dashboard_laporatoryEmployee', [DashboardController::class, 'index']);


        Route::get('/dashboard/laporatory_employee', function () {
            return view('dashboard.dashboard_LaboratorieEmployee.dashboard');
        })->middleware(['auth:laporatory_employee'])->name('dashboard.laporatoryEmployee');
        //=========================end laporatoryEmployee dashboard routes =============================
        Route::middleware('auth:laporatory_employee')->group(function(){
         Route::get('get_laporatory',[LaporatoryInvoiceController::class,'index'])->name('get_laporatory');
         Route::get('add_diagnosis/{id}',[LaporatoryInvoiceController::class,'edit'])->name('add_diagnosis');
         Route::put('update_laporatory_invoice/{id}',[LaporatoryInvoiceController::class,'update'])->name('update_laporatory_invoice');
         Route::get('complete_invoices',[LaporatoryInvoiceController::class,'complete_invoices'])->name('complete_invoices');
         Route::get('view_laporatory/{id}',[LaporatoryInvoiceController::class,'viewLaporatory'])->name('viewLaporatory');

        });


        require __DIR__ . '/auth.php';
    }
);
