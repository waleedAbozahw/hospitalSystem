<?php

namespace App\Interfaces\dashboard_laporatory_employee;

interface LaporatoryInvoiceInterface
{
    public function index();

    public function update($request, $id);

    public function edit($id);
    public function complete_invoices();
    public function viewLaporatory($id);
}
