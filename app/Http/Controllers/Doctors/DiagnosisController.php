<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    private $diagnosis;
    public function __construct(DiagnosisRepositoryInterface $diagnosis)
    {
       $this->diagnosis = $diagnosis;
    }
    public function index()
    {
       return $this->diagnosis->index();
    }


    public function create()
    {
        return 'cccccccccccccccccccccccc';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       return $this->diagnosis->store($request);
    }

    public function addReview(Request $request)
    {
       return $this->diagnosis->addReview($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->diagnosis->show($id);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
