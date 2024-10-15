<?php
namespace App\Interfaces\doctors;

interface DoctorsRepositoryInterface{

  public function index();

  public function create();

  public function store($request);

  public function destroy($request);

  public function edit($id);
  
  public function show($id);

  public function update($request);

  public function update_password($request);

  public function update_status($request);

}
