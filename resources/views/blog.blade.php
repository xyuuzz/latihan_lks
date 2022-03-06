@extends("layouts.app")

@section("content")
    <div class="container col-md-8 mt-5">
        <div id="card-blog" class="mb-3">
            <div class="d-flex justify-content-between">
                <h1 class="blog-title font-weight-bold">{{Str::title($blog->title)}}</h1>
            </div>
            <div>
                <p style="overflow-wrap: break-word;" class="blog-body">{!! Str::of(nl2br($blog->body))->ucfirst() !!}</p>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button onClick="toHome()" class="btn btn-primary">Kembali Ke Home</button>
            <div class="d-flex justify-content-between">
                <button onClick="editForm(`{{$blog->title}}`, `{{ $blog->body }}`)" class="btn-edit btn btn-outline-info mr-3" data-toggle="modal" data-target="#fromModal">Edit</button>
                <x-delete-blog :blog=$blog />
            </div>
        </div>

        <x-form-blog :blog=$blog :type="$type"/>
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
