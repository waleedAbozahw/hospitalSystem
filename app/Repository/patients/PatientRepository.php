<?php


namespace App\Repository\Patients;
use App\Interfaces\patients\PatientInterface;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\single_invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientInterface
{
   public function index()
   {
       $Patients = Patient::all();
       return view('dashboard.patients.index',compact('Patients'));
   }

    public function Show($id)
    {
        $Patient = patient::findorfail($id);
        $invoices = invoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();

        return view('dashboard.Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));

    }

    public function create()
   {
       return view('dashboard.patients.create');
   }

   public function store($request)
   {
       try {
           $Patients = new Patient();
           $Patients->email = $request->email;
           $Patients->password = Hash::make($request->Phone);
           $Patients->birth_date = $request->Date_Birth;
           $Patients->Phone = $request->Phone;
           $Patients->gender = $request->Gender;
           $Patients->blood_group = $request->Blood_Group;
           $Patients->save();
           //insert trans
           $Patients->name = $request->name;
           $Patients->address = $request->Address;
           $Patients->save();
           session()->flash('add');
           return redirect()->back();
       }

       catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
   }

   public function edit($id)
   {
       $Patient = Patient::findorfail($id);
       return view('dashboard.Patients.edit',compact('Patient'));
   }
   public function update($request)
   {
       $Patient = Patient::findOrFail($request->id);
       $Patient->email = $request->email;
       $Patient->password = Hash::make($request->Phone);
       $Patient->birth_date = $request->Date_Birth;
       $Patient->Phone = $request->Phone;
       $Patient->gender = $request->Gender;
       $Patient->blood_group = $request->Blood_Group;
       $Patient->save();
       // insert trans
       $Patient->name = $request->name;
       $Patient->address = $request->Address;
       $Patient->save();
       session()->flash('edit');
       return redirect()->route('patients.index');
   }

   public function destroy($request)
   {
       Patient ::destroy($request->id);
       session()->flash('delete');
       return redirect()->back();
   }
}
