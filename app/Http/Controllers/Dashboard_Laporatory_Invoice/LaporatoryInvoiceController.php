<?php

namespace App\Http\Controllers\Dashboard_Laporatory_Invoice;

use App\Http\Controllers\Controller;
use App\Interfaces\dashboard_laporatory_employee\LaporatoryInvoiceInterface;
use Illuminate\Http\Request;

class LaporatoryInvoiceController extends Controller
{
    private  $laporatory_employee_invoices;

    public function __construct(LaporatoryInvoiceInterface $laporatory_employee_invoices)
    {
        $this->laporatory_employee_invoices = $laporatory_employee_invoices;
    }
    public function index()
    {
        return $this->laporatory_employee_invoices->index();
    }

    public function edit($id)
    {
        return $this->laporatory_employee_invoices->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->laporatory_employee_invoices->update($request, $id);
    }

    public function complete_invoices()
    {
        return $this->laporatory_employee_invoices->complete_invoices();
    }

    public function viewLaporatory($id)
    {
        return $this->laporatory_employee_invoices->viewLaporatory($id);
    }
}
