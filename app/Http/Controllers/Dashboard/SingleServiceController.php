<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSingleServiceRequest;
use App\Interfaces\services\SingleServiceInterface;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{
    protected $services;
    public function __construct(SingleServiceInterface $services)
    {
     return $this->services = $services;
    }
    public function index()
    {
        return $this->services->index();
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
    public function store(StoreSingleServiceRequest $request)
    {
        return $this->services->store($request);
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
    public function update(StoreSingleServiceRequest $request)
    {
        return $this->services->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->services->destroy($request);
    }
}
