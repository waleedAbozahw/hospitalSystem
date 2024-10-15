<?php
namespace App\Interfaces\finance;

interface RecieptRepositoryInterface{

public function index();

public function create();

public function store($request);

public function update($request);

public function show($id);

public function edit($id);

public function destroy($request);

}
