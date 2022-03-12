<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     *
     * @return View Blde
     */
    public function index()
    {
        return view("admin.list-blog");
    }

    public function create()
    {
        $type = "store";
        $heading = "Form Tambah Blog";
        return view("admin.create-blog", compact("heading", "type"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
//        membuat slug dari field title
        $slug = \Str::slug($request->title);

        $thumbnail = $request->file("thumbnail");
        $thumbnail_name = uniqid('', true) . "." . $thumbnail->extension();
        $thumbnail->storeAs("public/thumbnail_blog", $thumbnail_name);

//        memasukan data ke table blog
        Blog::create([
            "title" => $request->title,
            "body" => $request->body,
            "slug" => $slug,
            "thumbnail" => $thumbnail_name
        ]);

        return redirect()->to("/blog");
        /*foreach($blogs as $blog)
        {
            $element .= '
                <div class="card-blog card mr-lg-5 mb-3">
                    <div class="card-header">' .  $blog->title . '</div>
                    <div class="card-body">
                        <div>' . \Str::limit($blog->body, 150, ".") . '</div>
                        <a href="/blog/' . $blog->id . '">Read More..</a>
                    </div>
                </div>
            ';
        }

        $element .= '
            <div class="d-flex justify-content-center">' . $blogs->links() . '</div>
        ';

        return $element;*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
//        variabel ini nantinya akan digunakan sebagai pembeda saat melakukan ajax
        $type = "update";

        return view("admin.show-blog", compact("blog", "type"));
    }

    public function edit(Blog $blog)
    {
        $type = "update";
        $heading = "Edit Blog {$blog->title}";
        return view("admin.create-blog", compact("heading", "blog", "type"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BlogRequest  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        if( $thumbnail = $request->file("thumbnail") )
        {
            Storage::delete("public/thumbnail_blog/{$blog->thumbnail}");

            $thumbnail_name = uniqid('', true) . "." . $thumbnail->extension();
            $thumbnail->storeAs("public/thumbnail_blog", $thumbnail_name);
        }

        // update field pada model binding blog dengan semua data yang dikirimkan
        $blog->update($request->all());

        return redirect()->to("/blog/{$blog->slug}");

        /*$element = '
            <h1 class="blog-title font-weight-bold">' . \Str::title($blog->title) . '</h1>
            <div>
                <p class="blog-body" style="overflow-wrap: break-word;" >' . \Str::of(nl2br($blog->body))->ucfirst() . '</p>
            </div>
        ';

        return $element;*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if($blog->thumbnail)
        {
            Storage::delete("public/thumbnail_blog/{$blog->thumbnail}");
        }
//        hapus blog
        $blog->delete();
    }

    /*
     * Mencari field title atau body secara spesifik
     *
     * Dengan Parameter nya adalah request...
     * */
    public function search(Request $request)
    {
//        dapatkan value query search
        $query = $request->get("query");

//        cari title atau body dengan kata yang mengandung value dari query
        $blogs = Blog::where("body", "LIKE", "%{$query}%")->orWhere("title", "like", "%{$query}%")->get();

        $element = '';

        foreach($blogs as $blog)
        {
            $element .= '
                <div class="d-flex justify-content-center">
                    <div class="card mr-lg-5 mb-3 w-75">
                        <img src="' . $blog->getThumbnail() . '" alt="Thumbnail Blog ' . $blog->title . '" class="w-100 img-fluid">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-capitalize">' . $blog->title . '</h5>
                            <p class="text-secondary d-inline">' . \Str::limit($blog->body, 150, "...") . '</p>
                            <a class="pl-md-2" href="/blog/' . $blog->slug . '"> Read more...</a>
                        </div>
                    </div>
                </div>
            ';
        }

//        jika query bernilai true, maka kembalikan variabel element, jika tidak kembalikan halaman home (root element nya adalah id app)
        return $query ? $element : redirect()->to("/blog");
    }
}
