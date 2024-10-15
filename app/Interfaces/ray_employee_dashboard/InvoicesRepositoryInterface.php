<?php
namespace App\Interfaces\ray_employee_dashboard;
interface InvoicesRepositoryInterface{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($request,$id);
    public function edit($id);
    public function complete_invoices();
    public function viewRays($id);

}
