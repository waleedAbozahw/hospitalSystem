<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\LaporatoryEmployee\LaporatoryEmployeeInterface;
use Illuminate\Http\Request;

class LaporatoryEmployeeController extends Controller
{
    private $laporatory;

    public function __construct(LaporatoryEmployeeInterface $laporatory)
    {
      $this->laporatory=$laporatory;
    }
    public function index()
    {
        return $this->laporatory->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->laporatory->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->laporatory->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->laporatory->destroy($id);
    }
}
