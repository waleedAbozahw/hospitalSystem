<?php
namespace App\Interfaces\LaporatoryEmployee;

interface LaporatoryEmployeeInterface{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}
