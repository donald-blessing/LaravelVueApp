<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionsResource;
use App\Models\Section;
use App\Models\Sections;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_id  = request('class_id', null);
        $sections = Section::where('class_id', $class_id)->get();

        return SectionsResource::collection($sections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sections $sections)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sections $sections)
    {
        //
    }
}
