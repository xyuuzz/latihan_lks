@extends("templates.app")

@section("content")

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Detail Film {{ $movie->nama }}</h4>
            <a class="btn btn-sm btn-outline-warning float-right" href="{{ route("movie.index") }}">List Film</a>
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
                {{-- {{ dd($movie->schedule()->where("end", ">", date("Y-m-d"))->get()->groupBy("studio_id")) }} --}}
                {{-- {{ dd(DB::select("SELECT studio_id, COUNT(studio_id) FROM schedules GROUP BY studio_id ")) }} --}}
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5>Judul Film : {{ $movie->name }}</h5>
                            <p>Durasi Film : {{ $movie->duration }} menit</p>
                            <p>Tersedia di Kota : </p>
                            <ul>
                                {{-- ke table schedule melalui relasi, pilih field yang value end nya lebih dari hari ini, ambil semua, lalu group sesuai studio_id --}}
                                @foreach($movie->schedule()->where("end", ">", date("Y-m-d"))->get()->groupBy("studio_id") as $sche)
                                    <li>{{ $sche[0]->studio->branch->name }}</li>
                                @endforeach
                            </ul>

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
