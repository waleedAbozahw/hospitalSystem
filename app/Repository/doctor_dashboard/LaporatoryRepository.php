<?php
namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\LaporatoryRepositoryInterface;
use App\Models\Laporatory;

class LaporatoryRepository implements LaporatoryRepositoryInterface{
    public function store($request){
        try {

            Laporatory::create([
                'description'=>$request->description,
                'invoice_id'=>$request->invoice_id,
                'patient_id'=>$request->patient_id,
                'doctor_id'=>$request->doctor_id,
            ]);
            session()->flash('add');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request, $id)
    {
        try {
            $Laboratorie = Laporatory::findOrFail($id);
            $Laboratorie->update([
                'description' => $request->description,
            ]);
            session()->flash('edit');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            Laporatory ::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
