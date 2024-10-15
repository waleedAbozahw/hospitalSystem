<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
    public function index();
    public function reviewInvoices();
    public function completeInvoices();

    public function show($id);
    public function showLaporatory($id);
}
