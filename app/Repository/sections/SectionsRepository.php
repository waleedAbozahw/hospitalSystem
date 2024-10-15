<?php
namespace App\Repository\sections;

use App\Interfaces\sections\SectionsRepositoryInterface;
use App\Models\Section;

class SectionsRepository implements SectionsRepositoryInterface{

  public function index(){
    $sections = Section::all();
    return view('dashboard.sections.index',compact('sections'));
  }

  public function store($request)
  {
       Section::create([
        'name' => $request->input('name'),
       ]);
       session()->flash('add');
       return redirect()->route('sections.index');
  }

  public function update($request)
  {
    $section = Section::findOrFail($request->id);
    $section->update([
        'name' => $request->input('name'),
    ]);


    session()->flash('edit');
    return redirect()->route('sections.index');
  }

  public function destroy($request)
  {
    Section::destroy($request->id);
    session()->flash('delete');
    return redirect()->route('sections.index');
  }

  public function show($id){
    $doctors = Section::findOrFail($id)->doctors;
    $section = Section::findOrFail($id);
    return view('dashboard.sections.show_doctors',compact('doctors','section'));
  }

}
