<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\Models\diagnosis;
use App\Models\invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class  DiagnosisRepository implements DiagnosisRepositoryInterface
{

    public function index()
    {
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {

            $invoice_status = invoice::findOrFail($request->invoice_id);
            $invoice_status->update([
                'invoice_status' => 3
            ]);

            $diagnosis = new diagnosis();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();
            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function addReview($request)
    {
        DB::beginTransaction();
        try {

            $invoice_status = invoice::findOrFail($request->invoice_id);
            $invoice_status->update([
                'invoice_status' => 2
            ]);

            $diagnosis = new diagnosis();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->review_date = date('Y-m-d H:i:s');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();
            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $patient_records = diagnosis::where('patient_id', $id)->get();
        return view('dashboard.doctor.invoices.patient_record', compact('patient_records'));
    }
}
