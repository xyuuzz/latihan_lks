@extends("layouts.app")

@section("content")
    <div class="bg-secondary">
        <div class="container bg-white">
            <x-landing-page.hero />
            <x-landing-page.about />
            <x-landing-page.blogs />
            <x-landing-page.contact />
            <x-landing-page.footer />
        </div>
    </div>
@stop
