<?php
namespace App\Interfaces\rayEmployee;

interface RayEmployeeInterface{
    public function index();

    public function store($request);

    public function update($request,$id);
    
    public function destroy($id);
}
