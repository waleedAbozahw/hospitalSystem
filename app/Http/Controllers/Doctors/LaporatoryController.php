<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\LaporatoryRepositoryInterface;
use Illuminate\Http\Request;

class LaporatoryController extends Controller
{
    private $laporatory;

    public function __construct(LaporatoryRepositoryInterface $laporatory)
    {
      $this->laporatory=$laporatory;
    }



    public function store(Request $request)
    {
        return $this->laporatory->store($request);
    }


    public function update(Request $request,$id)
    {
        return $this->laporatory->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->laporatory->destroy($id);
    }
}
