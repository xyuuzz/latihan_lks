@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3>Laravel Blog</h3>

                <div class="d-lg-flex justify-content-between mb-4">
                    <a href="/blog/create" class="btn btn-info mb-3 mt-3">
                        Tambah Blog Saya
                    </a>
                    <div class="d-flex justify-content-between align-items-center">
                        <form class="search-form">
                            <input type="text" class="w-lg-25 form-control search-bar" placeholder="Search Blog">
                        </form>
                        <button onClick="ajax(null, '/search', 'search')" class="search-btn btn btn-outline-primary ml-2 mr-5">Search</button>
                    </div>
                </div>
                <hr>
                <x-blog.list-blog />

{{--                <x-blog.form-blog />--}}
            </div>
        </div>
    </div>
@endsection
