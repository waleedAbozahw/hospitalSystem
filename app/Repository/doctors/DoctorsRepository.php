<?php
namespace App\Repository\doctors;

use App\Interfaces\doctors\DoctorsRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 class DoctorsRepository  implements DoctorsRepositoryInterface
{
  use UploadTrait;
  public function index()
  {
    $doctors = Doctor::with('doctorappointments')->get();
    return view('dashboard.doctors.index',compact('doctors'));
  }

  public function create()
  {
    $sections = Section::all();
    $appointments = Appointment::all();
    return view('dashboard.doctors.add',compact('sections','appointments'));
  }

  public function store($request)
  {
    DB::beginTransaction();
    try {
        $doctors = new Doctor();
        $doctors->email = $request->email;
        $doctors->password = Hash::make($request->password);
        $doctors->section_id = $request->section_id;
        $doctors->phone = $request->phone;
        $doctors->work_days = implode("-",$request->work_days);
        $doctors->number_of_statements = $request->number_of_statements;
        $doctors->status = 1;
        $doctors->save();
        //store doctor_translation
        $doctors->name = $request->name;
        $doctors->save();

        // insert pivot_appointment_doctor table
        $doctors->doctorappointments()->attach($request->appointments);

        // upload img

        $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

        DB::commit();
        session()->flash('add');
        return redirect()->route('doctors.create');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
    }
  }
public function edit($id){

  $doctor =  Doctor::findOrFail($id);
  $sections = Section::all();
  $appointments = Appointment::all();
  $week_days=['السبت','الاحد','الاثنين','الثلاثاء','الاربعاء','الخميس'];
    return view('dashboard.doctors.edit',compact('doctor','sections','appointments','week_days'));
}

public function update($request){
    DB::beginTransaction();
    try {
        $doctors = Doctor::findOrFail($request->id);
        $doctors->email = $request->email;
        $doctors->section_id = $request->section_id;
        $doctors->phone = $request->phone;
        $doctors->work_days = implode("-",$request->work_days);
        $doctors->number_of_statements = $request->number_of_statements;
        $doctors->save();
        //update doctor_translation
        $doctors->name = $request->name;
        $doctors->save();

        // update pivot_appointment_doctor table
        $doctors->doctorappointments()->sync($request->appointments);

        // update img
        if ($request->has('photo')) {
            //delete old photo
            if ($doctors->image) {
                $old_img = $doctors->image->filename;
                $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
            }
        }
        // upload img

        $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

        DB::commit();
        session()->flash('edit');
        return redirect()->route('doctors.index');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
    }
}

  public function destroy($request){
// delete one doctor
    if ($request->page_id == 1) {
       if($request->filename){
        $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id);
       }
       Doctor::destroy($request->id);
       session()->flash('delete');
       return redirect()->route('doctors.index');

// delete all doctors
    } else {
        $delete_select_id = explode(',',$request->delete_select_id);
        foreach($delete_select_id as $ids_doctors){
          $doctor = Doctor::findOrFail($ids_doctors);
          if($doctor->image){
            $this->Delete_attachment('upload_image','doctors/'.$doctor->image->filename,$ids_doctors);
          }

        }
        Doctor::destroy($delete_select_id);
        session()->flash('delete');
        return redirect()->route('doctors.index');




    }
  }
  public function update_password($request)
  {
    try {
        $doctor = Doctor::findOrFail($request->id);
        $doctor->update([
            'password'=>Hash::make($request->password),
        ]);
        session()->flash('edit');
        return redirect()->back();

    } catch (\Exception $e) {
       return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
    }
  }

  public function update_status($request){
    try {
        $doctor = Doctor::findOrFail($request->id);
        $doctor->update([
            'status'=>$request->status
        ]);
        session()->flash('edit');
        return redirect()->back();

    } catch (\Exception $e) {
       return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
    }

  }

  public function show($id)
  {
    return $id;
  }
}

