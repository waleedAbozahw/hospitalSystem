<?php
namespace App\Interfaces\sections;

interface SectionsRepositoryInterface{

public function index();

public function store($request);

public function update($request);

public function show($id);

public function destroy($request);

}
