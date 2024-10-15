<?php

namespace App\Interfaces\services;

interface SingleServiceInterface
{
    public function index();

    public function store($request);

    public function update($request);

    public function show($id);

    public function destroy($request);
}
