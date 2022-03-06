<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
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

//        memasukan data ke table blog
        Blog::create([
            "title" => $request->title,
            "body" => $request->body,
            "slug" => $slug
        ]);

        $blogs = Blog::getBlog();
        $element = "";

        foreach($blogs as $blog)
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

        return $element;
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

        return view("blog", compact("blog", "type"));
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
//        update field pada model binding blog dengan semua data yang dikirimkan
        $blog->update($request->all());

        $element = '
            <h1 class="blog-title font-weight-bold">' . \Str::title($blog->title) . '</h1>
            <div>
                <p class="blog-body" style="overflow-wrap: break-word;" >' . \Str::of(nl2br($blog->body))->ucfirst() . '</p>
            </div>
        ';

        return $element;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
//        hapus blog
        $blog->delete();

//        kembalikan halaman home (root element nya adalah id app)
        return redirect()->to("/");
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
                <div class="card-blog card mr-lg-5 mb-3">
                    <div class="card-header">' .  $blog->title . '</div>
                    <div class="card-body">
                        <div>' . \Str::limit($blog->body, 150, ".") . '</div>
                        <a href="/blog/' . $blog->id . '">Read More..</a>
                    </div>
                </div>
            ';
        }

//        jika query bernilai true, maka kembalikan variabel element, jika tidak kembalikan halaman home (root element nya adalah id app)
        return $query ? $element : redirect()->to("/");
    }
}
