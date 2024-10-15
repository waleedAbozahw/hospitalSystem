<?php

namespace App\Providers;

use App\Interfaces\ambulance\AmbulanceInterface;
use App\Interfaces\dashboard_laporatory_employee\LaporatoryInvoiceInterface;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Interfaces\doctor_dashboard\LaporatoryRepositoryInterface;
use App\Interfaces\doctor_dashboard\RaysRepositoryInterface;
use App\Interfaces\doctors\DoctorsRepositoryInterface;
use App\Interfaces\finance\PaymentRepositoryInterface;
use App\Interfaces\finance\RecieptRepositoryInterface;
use App\Interfaces\insurance\InsuranceInterface;
use App\Interfaces\LaporatoryEmployee\LaporatoryEmployeeInterface;
use App\Interfaces\patients\PatientInterface;
use App\Interfaces\ray_employee_dashboard\InvoicesRepositoryInterface as Ray_employee_dashboardInvoicesRepositoryInterface;
use App\Interfaces\rayEmployee\RayEmployeeInterface;
use App\Interfaces\sections\SectionsRepositoryInterface;
use App\Interfaces\services\SingleServiceInterface;
use App\Repository\ambulance\AmbulanceRepository;
use App\Repository\dashboard_laporatory_employee\LaporatoryInvoicesRepository;
use App\Repository\doctor_dashboard\DiagnosisRepository;
use App\Repository\doctor_dashboard\InvoicesRepository;
use App\Repository\doctor_dashboard\LaporatoryRepository;
use App\Repository\doctor_dashboard\RaysRepository;
use App\Repository\doctors\DoctorsRepository;
use App\Repository\finance\PaymentRepository;
use App\Repository\finance\RecieptRepository;
use App\Repository\insurance\InsuranceRepository;
use App\Repository\LaporatoryEmployee\LaporatoryEmployeeRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\ray_employee_dashboard\InvoicesRepository as Ray_employee_dashboardInvoicesRepository;
use App\Repository\rayEmployee\RayEmployeeRepository;
use App\Repository\sections\SectionsRepository;
use App\Repository\services\SingleServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // start admin

        $this->app->bind(
            SectionsRepositoryInterface::class,
            SectionsRepository::class,

        );
        $this->app->bind(
            DoctorsRepositoryInterface::class,
            DoctorsRepository::class,
        );
        $this->app->bind(
            SingleServiceInterface::class,
            SingleServiceRepository::class,
        );
        $this->app->bind(
            InsuranceInterface::class,
            InsuranceRepository::class,
        );
        $this->app->bind(
            AmbulanceInterface::class,
            AmbulanceRepository::class,
        );
        $this->app->bind(
            PatientInterface::class,
            PatientRepository::class,
        );
        $this->app->bind(
            RecieptRepositoryInterface::class,
            RecieptRepository::class,
        );
        $this->app->bind(
            PaymentRepositoryInterface::class,
            PaymentRepository::class,
        );
        // end admin

        // start doctor
        $this->app->bind(
            InvoicesRepositoryInterface::class,
            InvoicesRepository::class,
        );
        $this->app->bind(
            DiagnosisRepositoryInterface::class,
            DiagnosisRepository::class,
        );
        $this->app->bind(
            RaysRepositoryInterface::class,
            RaysRepository::class,
        );
        $this->app->bind(
            LaporatoryRepositoryInterface::class,
            LaporatoryRepository::class,
        );
        $this->app->bind(
            RayEmployeeInterface::class,
            RayEmployeeRepository::class,
        );
        $this->app->bind(
            Ray_employee_dashboardInvoicesRepositoryInterface::class,
            Ray_employee_dashboardInvoicesRepository::class,
        );
        $this->app->bind(
            LaporatoryEmployeeInterface::class,
            LaporatoryEmployeeRepository::class,
        );
        $this->app->bind(
            LaporatoryInvoiceInterface::class,
            LaporatoryInvoicesRepository::class,
        );


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
