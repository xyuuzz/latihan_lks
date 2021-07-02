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
        $title = "List Studio";
        $list_studio = Studio::latest()->paginate(10);
        $index = request("page") ? request("page") * 10 - (10-1) : 1;
        return view("Studios.index", compact("title", "list_studio", "index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Studio";
        $desc = "Isi form dibawah untuk menambahkan studio";
        $list_cabang = Branch::all();
        $url = route("studio.store");
        return view("Studios.create", compact("title", "desc", "list_cabang", "url"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudioRequest $request)
    {
        $branch = Branch::find($request->cabang);

        $branch->studio()->create([
            "name" => $request->name,
            "slug" => \Str::slug($request->name),
            "basic_price" => $request->basic_price,
            "additional_friday_price" => $request->additional_friday_price,
            "additional_saturday_price" => $request->additional_saturday_price,
            "additional_sunday_price" => $request->additional_sunday_price,
        ]);

        session()->flash("success", "Berhasil menambahkan 1 data studio");
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
        $title = "Detail Studio";
        return view("Studios.show", compact("studio", "title"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {
        $title = "Sunting Studio";
        $desc = "Ubah form dibawah jika ingin mensunting data studio";
        $list_cabang = Branch::all();
        $url = route("studio.update", ["studio" => $studio->slug]);
        return view("Studios.create", compact("title", "desc", "list_cabang", "url", "studio"));
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
            "branch_id" => $request->cabang,
            "name" => $request->name,
            "additional_friday_price" => $request->additional_friday_price,
            "additional_saturday_price" => $request->additional_saturday_price,
            "additional_sunday_price" => $request->additional_sunday_price,
        ];

        $studio->update($field);

        session()->flash("success", "Berhasil mensunting data studio");
        return redirect()->to(route("studio.show", ["studio" => $studio->slug]));
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

        session()->flash("success", "Berhasil Menghapus 1 studio dari daftar");
        return redirect()->to(route("studio.index"));
    }
}
