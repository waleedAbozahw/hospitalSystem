<?php

namespace App\Repository\dashboard_laporatory_employee;

use App\Interfaces\dashboard_laporatory_employee\LaporatoryInvoiceInterface;
use App\Models\Laporatory;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class LaporatoryInvoicesRepository implements LaporatoryInvoiceInterface
{
    use UploadTrait;

    public function index()
    {
        $invoices = Laporatory::where('case',0)->get();
        return view('dashboard.dashboard_LaboratorieEmployee.invoices.index', compact('invoices'));
    }

    public function edit($id)
    {
        $invoice = Laporatory::findOrFail($id);
        return view('dashboard.dashboard_LaboratorieEmployee.invoices.add_diagnosis', compact('invoice'));
    }
    public function update($request, $id)
    {

            $invoice = Laporatory::findOrFail($id);
            $invoice->update([
                'employee_id' => auth()->user()->id,
                'description_employee' => $request->description_employee,
                'case' => 1,
            ]);

            if($request->hasFile('photos')){
                foreach($request->photos as $photo){
                    $this->verifyAndStoreImageForeach($photo,'laporatory','upload_image',$invoice->id,'App\Models\Laporatory');
                }
            }

            session()->flash('edit');
            return redirect()->route('ray_employee_invoices.index');

    }

    public function complete_invoices(){
        $invoices = Laporatory::where('case',1)->where('employee_id',auth()->user()->id)->get();
        return view('dashboard.dashboard_LaboratorieEmployee.invoices.completed_invoices', compact('invoices'));
    }

    public function viewLaporatory($id)
    {
        $laporatory = Laporatory::where('employee_id',auth()->user()->id)->findOrFail($id);
        return view('dashboard.dashboard_LaboratorieEmployee.invoices.patient_details', compact('laporatory'));
    }

}
