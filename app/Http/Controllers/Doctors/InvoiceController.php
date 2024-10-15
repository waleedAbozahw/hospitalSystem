<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $invoices;
    public function __construct(InvoicesRepositoryInterface $invoices)
    {
       $this->invoices = $invoices;
    }
    public function index()
    {
        return $this->invoices->index();
    }

    public function completeInvoices(){
        return $this->invoices->completeInvoices();
    }
    public function reviewInvoices(){
        return $this->invoices->reviewInvoices();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->invoices->show($id);
    }

    public function showLaporatory($id){
        return $this->invoices->showLaporatory($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
