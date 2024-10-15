<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\rayEmployee\RayEmployeeInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    private $rayEmployee;

    public function __construct(RayEmployeeInterface $rayEmployee)
    {
      $this->rayEmployee=$rayEmployee;
    }
    
    public function index()
    {
        return $this->rayEmployee->index();
    }


    public function store(Request $request)
    {
        return $this->rayEmployee->store($request);
    }

    public function update(Request $request,$id)
    {
        return $this->rayEmployee->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->rayEmployee->destroy($id);
    }
}
