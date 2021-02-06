<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Http\Requests\Sections\CreateSectionRequest;
use App\Http\Requests\Sections\UpdateSectionsRequest;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('sections.index')->with('sections', Section::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSectionRequest $request)
    {
        Section::create([
          'name' => $request->name
        ]);

        session()->flash('success', 'Section created successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        if ($section->stories->count() > 0) {
          session()->flash('error', 'Section cannot be edited, because it is associated to some stories.');

          return redirect()->back();
        }        
        return view('sections.create')->with('section', $section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionsRequest $request, Section $section)
    {
         $section->update([
          'name' => $request->name
        ]);

        session()->flash('success', 'Section updated successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        if ($section->stories->count() > 0) {
          session()->flash('error', 'Section cannot be deleted, because it is associated to some stories.');

          return redirect()->back();
        }

        $section->delete();

        session()->flash('success', 'Section deleted successfully.');

        return redirect(route('sections.index'));
    }
}
