<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $doctor_id;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $phone;
    public $notes,$work_days;
    public $appointment_patient;
    public $message = false;
    public $message2 = false;
    // show doctors based on sections
    public function mount()
    {
        $this->sections = Section::get();
        $this->doctors = collect();
    }
    // show doctors based on sections
    public function render()
    {

        return view(
            'livewire.appointments.create',
            [
                'sections' => Section::get()
            ]
        );
    }
    // show doctors based on sections
    public function updatedsection($section_id)
    {
        $this->doctors = Doctor::where('section_id', $section_id)->get();
    }
    public function updateddoctor($doctor)
    {
        $this->work_days = Doctor::where('id', $doctor)->pluck('work_days');
    }
    // show doctors based on sections
    public function store()
    {
        // check number of statements
        $appointments_count = Appointment::where('doctor_id', $this->doctor)->where('type','غير مؤكد')
            ->where('appointment_patient', $this->appointment_patient)->count();
        $doctor_info = Doctor::find($this->doctor);
        if ($appointments_count == $doctor_info->number_of_statements) {
            $this->message2 = true;
            return back();
        }
        $appointments = new Appointment();
        $appointments->doctor_id = $this->doctor;
        $appointments->section_id = $this->section;
        $appointments->name = $this->name;
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
        $appointments->appointment_patient = $this->appointment_patient;
        $appointments->save();
        $this->message = true;
    }
}
