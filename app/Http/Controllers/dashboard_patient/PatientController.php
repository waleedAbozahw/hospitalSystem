<?php

namespace App\Http\Controllers\dashboard_patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\invoice;
use App\Models\Laporatory;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use App\Models\Section;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function invoices(){

        $invoices = invoice::where('patient_id',auth()->user()->id)->get();
        return view('dashboard.dashboard_patient.invoices',compact('invoices'));
    }

    public function laporatories(){

        $laporatories = Laporatory::where('patient_id',auth()->user()->id)->get();
        return view('dashboard.dashboard_patient.laboratories',compact('laporatories'));
    }

    public function viewLaporatories($id){

        $laporatory = Laporatory::findorFail($id);
        if($laporatory->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('dashboard.dashboard_LaboratorieEmployee.invoices.patient_details', compact('laporatory'));
    }

    public function rays(){

        $rays = Ray::where('patient_id',auth()->user()->id)->get();
        return view('dashboard.dashboard_patient.rays',compact('rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findorFail($id);
        if($rays->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('dashboard.dashboard_RayEmployee.invoices.patient_details', compact('rays'));
    }

    public function payments(){

        $payments = ReceiptAccount::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.payments',compact('payments'));
    }

    public function appointments(){

        $appointments = Appointment::where('email',auth()->user()->email)->get();
        $sections = Section::all();
        return view('dashboard.patients.appointments',compact('appointments','sections'));
    }

    public function delete_appointment(Request $request){
        Appointment::destroy($request->id);
        session()->flash('delete');
        return redirect()->back();

    }
}
