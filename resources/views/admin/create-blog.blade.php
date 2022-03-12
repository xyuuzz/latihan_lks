@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card border-0">
            <div class="card-header bg-primary">
                <h4 class="font-weight-bold">{{$heading}}</h4>
            </div>
            <div class="card-body col-lg-8 mx-auto">
                <form action="{{$type === "store" ? "/blog" : "/blog/{$blog->slug}"}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($type === "update")
                        @method("PATCH")
                    @endif

                    <div class="form-group">
                        <x-utility.label for="title" desc="Title" />
                        <x-utility.input type="text" name="title" value='{{isset($blog) ? $blog->title : old("title")}}'/>
                        <x-utility.error input="title" />
                    </div>
                    <div class="form-group">
                        <x-utility.label for="thumbnail" desc="Thumbnail" />
                        <x-utility.input type="file" name="thumbnail" class="p-1" />
                        <x-utility.error input="thumbnail" />
                    </div>
                    <div class="form-group">
                        <x-utility.label for="body" desc="Deskripsi Blog" />
                        <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{isset($blog) ? $blog->body : old("body")}}</textarea>
                        <x-utility.error input="body" />
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/blog" class="btn btn-info text-white">Kembali Ke List Blog</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
