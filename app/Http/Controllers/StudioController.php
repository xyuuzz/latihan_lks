<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Studio;
use App\Http\Requests\StudioRequest;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("blabla");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blabla");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudioRequest $request)
    {
        $branch = Branch::find($request->branch);

        $branch->studio()->create([
            "name" => $request->name,
            "slug" => \Str::slug($request->name),
            "basic_price" => 50.000,
            "additional_friday_price" => 55.000,
            "additional_saturday_price" => 75.000,
            "additional_sunday_price" => 85.000,
        ]);

        return redirect()->to(route("studio.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function show(Studio $studio)
    {
        return view("blabla", compact($studio));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {
        return view("blabla", compact("studio"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(StudioRequest $request, Studio $studio)
    {
        $field = [
            "name" => $request->name,
            "additional_friday_price" => 55.000,
            "additional_saturday_price" => 75.000,
            "additional_sunday_price" => 85.000,
        ];

        $studio->update($field);

        return redirect()->to(route("studio.show"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studio $studio)
    {
        $studio->schedule()->delete();
        $studio->delete();

        return redirect()->to(route("studio.index"));
    }
}
