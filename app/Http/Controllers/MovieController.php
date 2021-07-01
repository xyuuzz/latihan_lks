<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $title = "Kelola Film";
        $daftar_film = Movie::all();
        $index = 1;
        return view("Movies.index", compact("title", "daftar_film", "index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $desc = "Tambahkan Film Dengan Mengisi Form Dibawah";
        $title = "Tambahkan Film";
        $url = route("movie.store");
        return view("Movies.create", compact("title", "desc", "url"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(MovieRequest $request)
    {
        $image = $request->file("image");
        $image_ext = $image->extension();
        $image_name = uniqid() . ".$image_ext";
        $image->storeAs("public/images", $image_name);

        // create movie
        Movie::create([
            "name" => $request->name,
            "slug" => \Str::slug($request->name),
            "duration" => $request->duration,
            "image" => $image_name,
        ]);

        session()->flash("success", "Berhasil menambahkan film!");
        return redirect()->to(route("movie.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     */
    public function show(Movie $movie)
    {
        return view("blabla", compact("movie"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     */
    public function edit(Movie $movie)
    {
        $desc = "Ganti Isi form dibawah jika ingin mensunting data film";
        $title = "Edit Film";
        $url = route("movie.update", ["movie" => $movie->slug]);
        return view("Movies.create", compact("movie", "title", "desc", "url"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $data = [
            "name" => $request->name,
            "duration" => $request->duration,
        ];

        $image = $request->file("image");
        if($image)
        {
            Storage::delete("public/images/" . $movie->image);

            $image_ext = $image->extension();
            $image_name = uniqid() . ".$image_ext";
            $image->storeAs("public/images", $image_name);

            $data["image"] = $image_name;
        }   

        $movie->update($data);

        session()->flash("success", "Berhasil mensunting data film!");
        return redirect()->to(route("movie.show", ["movie" => $movie->slug]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     */
    public function destroy(Movie $movie)
    {
        Storage::delete("public/images/" . $movie->image);
        $movie->schedule()->delete();
        $movie->delete();

        session()->flash("success", "Berhasil menghapus film!");
        return redirect()->to(route("movie.index"));
    }
}
