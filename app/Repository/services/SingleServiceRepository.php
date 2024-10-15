<?php

namespace App\Repository\services;

use App\Interfaces\services\SingleServiceInterface;
use App\Models\Service;

class SingleServiceRepository implements SingleServiceInterface
{

    public function index()
    {

        $services = Service::all();
        return view('dashboard.services.Single Service.index', compact('services'));
    }

    public function store($request)
    {
        try {
            $singleService = new Service();
            $singleService->price = $request->price;
            $singleService->description = $request->description;
            $singleService->status = 1;
            $singleService->save();

            // store trans
            $singleService->name = $request->name;
            $singleService->save();

            session()->flash('add');
            return redirect()->route('service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $singleService = Service::findOrFail($request->id);
            $singleService->price = $request->price;
            $singleService->description = $request->description;
            $singleService->status = 1;
            $singleService->save();

            // store trans
            $singleService->name = $request->name;
            $singleService->save();

            session()->flash('edit');
            return redirect()->route('service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
    }

    public function destroy($request)
    {
        Service::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('service.index');
    }
}
