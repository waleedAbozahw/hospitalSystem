<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\sections\SectionsRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{
     private $sections;

     public function __construct(SectionsRepositoryInterface $sections)
     {
         $this->sections=$sections;
     }



    public function index()
    {
      return $this->sections->index();
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
        return $this->sections->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->sections->show($id);
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
    public function update(Request $request)
    {
        return $this->sections->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       return $this->sections->destroy($request);
    }
}
