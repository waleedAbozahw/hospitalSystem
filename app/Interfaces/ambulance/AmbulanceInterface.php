<?php
namespace App\Interfaces\ambulance;

interface AmbulanceInterface{

  public function index();

  public function create();

  public function store($request);

  public function destroy($request);

  public function edit($id);

  public function update($request);


}
