<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;
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


        //===========================start rayEmployee dashboard routes ============================
        Route::get('/dashboard_rayEmployee', [DashboardController::class, 'index']);


        Route::get('/dashboard/ray_employee', function () {
            return view('dashboard.dashboard_RayEmployee.dashboard');
        })->middleware(['auth:ray_employee'])->name('dashboard.rayEmployee');
        //=========================end doctor dashboard routes =============================
        Route::middleware('auth:ray_employee')->group(function(){

            Route::resource('ray_employee_invoices',InvoiceController::class);
            Route::get('complete_invoices',[InvoiceController::class,'complete_invoices'])->name('complete_invoices');
            Route::get('view_rays/{id}',[InvoiceController::class,'viewRays'])->name('view_rays');
        });


        require __DIR__ . '/auth.php';
    }
);

