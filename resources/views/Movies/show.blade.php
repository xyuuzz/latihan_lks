@extends("templates.app")

@section("content")

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Detail Film {{ $movie->nama }}</h4>
            <a class="btn btn-sm btn-outline-warning float-right" href="{{ route("movie.index") }}">List Siswa</a>
        </div>
    <div class="card-body">
        @if(session("success"))
            <div class="alert alert-success mt-2 d-block" role="alert">
                {{ session("success") }}
            </div>
        @endif
        <div class="row">
            <div class="d-flex">
                <div class="col-lg-4">
                    <img class="rounded img-thumbnail " src="{{ asset("storage/images/{$movie->image}") }}" alt="gambar foto">
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5>Judul Film : {{ $movie->name }}</h5>
                            <p>Durasi Film : {{ $movie->duration }} menit</p>
                            <p>Tersedia di Kota : ...</p>

                            <a href="{{ route("movie.edit", ["movie" => $movie->slug]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route("movie.destroy", ["movie" => $movie->slug]) }}" method="POST" class="d-inline">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm mt-2sm ">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
