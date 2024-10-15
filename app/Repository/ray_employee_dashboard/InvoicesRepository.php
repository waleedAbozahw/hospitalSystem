<?php

namespace App\Repository\ray_employee_dashboard;

use App\Interfaces\ray_employee_dashboard\InvoicesRepositoryInterface;
use App\Models\Ray;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $invoices = Ray::where('case',0)->get();
        return view('dashboard.dashboard_RayEmployee.invoices.index', compact('invoices'));
    }
    public function store($request)
    {
    }
    public function edit($id)
    {
        $invoice = Ray::findOrFail($id);
        return view('dashboard.dashboard_RayEmployee.invoices.add_diagnosis', compact('invoice'));
    }
    public function update($request, $id)
    {

            $invoice = Ray::findOrFail($id);
            $invoice->update([
                'employee_id' => auth()->user()->id,
                'description_employee' => $request->description_employee,
                'case' => 1,
            ]);

            if($request->hasFile('photos')){
                foreach($request->photos as $photo){
                    $this->verifyAndStoreImageForeach($photo,'rays','upload_image',$invoice->id,'App\Models\Ray');
                }
            }



           

            session()->flash('edit');
            return redirect()->route('ray_employee_invoices.index');

    }

    public function complete_invoices(){
        $invoices = Ray::where('case',1)->where('employee_id',auth()->user()->id)->get();
        return view('dashboard.dashboard_RayEmployee.invoices.completed_invoices', compact('invoices'));
    }

    public function viewRays($id)
    {
        $rays = Ray::where('employee_id',auth()->user()->id)->findOrFail($id);
        return view('dashboard.dashboard_RayEmployee.invoices.patient_details', compact('rays'));
    }
    public function destroy($request, $id)
    {
    }
}
