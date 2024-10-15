<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\finance\RecieptRepositoryInterface;
use Illuminate\Http\Request;

class RecieptAccountController extends Controller
{
    private $receipt;

    public function __construct(RecieptRepositoryInterface $receipt)
    {
      return $this->receipt = $receipt;
    }
    public function index()
    {
        return $this->receipt->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->receipt->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->receipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->receipt->destroy($request);
    }
}
