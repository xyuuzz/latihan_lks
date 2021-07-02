<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $title = "Kelola Cabang Studio";
        $daftar_cabang = Branch::latest()->paginate(7);
        $index = request("page") ? request("page") * 7 - (7-1) : 1;
        return view("Branch.index", compact("title", "daftar_cabang", "index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view("Branch.create");
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

        session()->flash("success", "Berhasil Menambahkan Cabang!");
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
            "editName" => "required|string|min:4|max:20"
        ], [
            "editName.required" => "Jika ingin disunting, nama cabang wajib diisi!",
            "editName.string" => "Nama cabang wajib berupa string",
            "editName.min" => "Nama cabang minimal 4",
            "editName.max" => "Nama cabang maximal 20"
        ]);

        $branch->update([
            "name" => $request->editName,
            "slug" => \Str::slug($request->editName)
        ]);

        session()->flash("success", "Berhasil Mensunting Data Cabang");
        return redirect()->to(route("branch.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     */
    public function destroy(Branch $branch)
    {
        // delete schedule
        $studio = $branch->studio()->get("id")->toArray(); # dapatkan semua studio yang related dengan branch
        // jika studio ada isinya
        if((count($studio)))
        {
            // cari semua schedule yang related dengan studio dan hapus
            Schedule::whereIn("studio_id", ...$studio)->delete();
        }
        // delete studio
        $branch->studio()->delete();
        // delete branch
        $branch->delete();

        session()->flash("success", "Berhasil Menghapus Data Cabang");
        return redirect()->to(route("branch.index"));
    }
}
