<?php

namespace App\Repository\LaporatoryEmployee;

use App\Interfaces\LaporatoryEmployee\LaporatoryEmployeeInterface;
use App\Models\LaporatoryEmployee;
use Illuminate\Support\Facades\Hash;

class LaporatoryEmployeeRepository implements LaporatoryEmployeeInterface
{
    public function index()
    {
        $laboratorie_employees = LaporatoryEmployee::all();
        return view('Dashboard.laboratorie_employee.index', compact('laboratorie_employees'));
    }
    public function store($request)
    {
        try {

            $laboratorie_employee = new LaporatoryEmployee();
            $laboratorie_employee->name = $request->name;
            $laboratorie_employee->email = $request->email;
            $laboratorie_employee->password = Hash::make($request->password);
            $laboratorie_employee->save();
            session()->flash('add');
            return back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request, $id)
    {
        $ray_employee = LaporatoryEmployee::find($id);
        $ray_employee->name = $request->name;
        $ray_employee->email = $request->email;
        if (empty($request->password)) {
            $ray_employee->password = $ray_employee->password;
        } else

            $ray_employee->password = Hash::make($request->password);
        $ray_employee->save();

        session()->flash('edit');
        return redirect()->back();
    }
    public function destroy($id)
    {
        try {
            LaporatoryEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
