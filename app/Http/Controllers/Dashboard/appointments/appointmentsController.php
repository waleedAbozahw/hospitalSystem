<?php

namespace App\Http\Controllers\Dashboard\appointments;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfigration;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class appointmentsController extends Controller
{


    public function index()
    {
        $appointments = Appointment::where('type', 'غير مؤكد')->get();
        return view('dashboard.appointments.index', compact('appointments'));
    }
    public function index2()
    {
        $appointments = Appointment::where('type', 'مؤكد')->get();
        return view('dashboard.appointments.index2', compact('appointments'));
    }

    public function index3()
    {
        $appointments = Appointment::where('type', 'منتهي')->get();
        return view('dashboard.appointments.index3', compact('appointments'));
    }

    public function approval(Request $request, $id)
    {
        $appointments = Appointment::findOrFail($id);
        $appointments->update([
            'type' => 'مؤكد',
            'appointment' => $request->appointment
        ]);
        // send email
        // Mail::to($appointments->email)->send(new AppointmentConfigration($appointments->name, $appointments->appointment));

        // send sms message

        // $receiverNumber = $appointments->phone;
        // $message = "عزيزي المريض" . " " . $appointments->name . " " . "تم حجز موعدك بتاريخ " . $appointments->appointment;

        // $sid = env('TWILIO_SID');
        // $token = env('TWILIO_AUTH_TOKEN');
        // $fromNumber = env('TWILIO_NUMBER');
        // $client = new Client($sid, $token);
        // $client->messages->create($receiverNumber, [
        //     'from' => $fromNumber,
        //     'body' => $message
        // ]);

        session()->flash('add');
        return back();
    }

    public function destroy(Request $request){
        Appointment::destroy($request->id);
        session()->flash('delete');
        return back();
    }
}
