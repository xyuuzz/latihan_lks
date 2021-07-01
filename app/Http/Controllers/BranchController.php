<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view("bla");
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view("bla");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|min:4|max:20"
        ]);

        Branch::create([
            "name" => $request->name,
            "slug" => \Str::slug($request->name)
        ]);

        return redirect()->to(route("branch.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     */
    public function show(Branch $branch)
    {
        return view("blabla", compact($branch));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     */
    public function edit(Branch $branch)
    {
        return view("bla", compact($branch));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            "name" => "required|string|min:4|max:20"
        ]);

        $branch->update([
            "name" => $request->name
        ]);

        return redirect()->to(route("branch.show", ["branch" => $branch->slug]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     */
    public function destroy(Branch $branch)
    {
        $branch->studio()->delete();
        $branch->delete();

        return redirect()->to(route("branch.index"));
    }
}
