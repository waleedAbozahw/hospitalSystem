<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\doctors\DoctorsRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $doctor;
   public function __construct(DoctorsRepositoryInterface $doctor)
   {
      $this->doctor = $doctor;
   }
    public function index()
    {
       return $this->doctor->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->doctor->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->doctor->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->doctor->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->doctor->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->doctor->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       return $this->doctor->destroy($request);
    }

    public function update_password(Request $request){

        $this->validate($request,[
           'password'=> 'required|min:6|confirmed',
           'password_confirmation'=> 'required|min:6',
        ]);
       return $this->doctor->update_password($request);
    }

    public function update_status(Request $request){
        $this->validate($request,[
            'status'=> 'required|in:0,1',
         ]);
        return $this->doctor->update_status($request);

    }


}
