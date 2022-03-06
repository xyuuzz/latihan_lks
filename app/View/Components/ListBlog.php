<?php

namespace App\View\Components;

use App\Blog;
use Illuminate\View\Component;

class ListBlog extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $blogs = Blog::getBlog();
        return view('components.list-blog', compact("blogs"));
    }
}
