<?php

namespace App\Http\Controllers\Dashboard_Ray_Employee;

use App\Http\Controllers\Controller;
use App\Interfaces\ray_employee_dashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private  $ray_employee_invoices;

   public function __construct(InvoicesRepositoryInterface $ray_employee_invoices)
   {
      $this->ray_employee_invoices=$ray_employee_invoices;
   }
    public function index()
    {
        return $this->ray_employee_invoices->index();
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
        return $this->ray_employee_invoices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->ray_employee_invoices->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->ray_employee_invoices->update($request,$id);
    }

    public function complete_invoices(){
        return $this->ray_employee_invoices->complete_invoices();
    }
    public function destroy(Request $request,$id)
    {
        return $this->ray_employee_invoices->destroy($request,$id);
    }
    public function viewRays($id)
    {
        return $this->ray_employee_invoices->viewRays($id);
    }
}
