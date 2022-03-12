@extends("layouts.app")

@section("content")
    <div class="container col-md-8 mt-5">
        <div class="mb-3">
            <div class="">
                <h2 class="blog-title font-weight-bold">{{Str::title($blog->title)}}</h2>
                <span class="text-secondary">Published Date : {{$blog->created_at->format("d M Y")}}</span>
            </div>
            <hr>
            <div class="col-lg-10 ">
                <img class="w-25 float-left mb-3 mr-4" src="{{$blog->getThumbnail()}}" alt="Thumbnail blog {{$blog->title}}">
                <p style="overflow-wrap: break-word;" class="blog-body clearfix ml-3">{!! Str::of(nl2br($blog->body))->ucfirst() !!}</p>
            </div>
        </div>

        <div class="d-flex justify-content-between pt-3">
            <button onClick="toHome()" class="btn btn-primary">Kembali Ke Home</button>
            <div class="d-flex justify-content-between">
                <a class="btn btn-outline-success mr-3" href={{"/blog/{$blog->slug}/edit"}}>Edit</a>
                <x-blog.delete-blog :blog=$blog />
            </div>
        </div>

        <x-blog.form-blog :blog=$blog :type="$type"/>
    </div>
@stop

{{--<div class="card-header d-flex justify-content-between">
    {{$blog->title}}
    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-info mr-3">Edit</button>
        <button class="btn btn-outline-danger">Hapus</button>
    </div>
</div>
<div class="card-body">
    <div>
        {{$blog->body}}
    </div>
</div>--}}
