@extends("templates.app")

@section("content")

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Detail Studio {{ $studio->name }}</h4>
            <a class="btn btn-sm btn-outline-warning float-right" href="{{ route("studio.index") }}">Kembali ke List Studio</a>
        </div>
    <div class="card-body">

        @if(session("success"))
            <div class="alert alert-success mt-2 d-block" role="alert">
                {{ session("success") }}
            </div>
        @endif
        <h5>Nama Studio : {{ $studio->name }}</h5>
        <p>Studio Berada di Cabang : {{ $studio->branch->name }}</p>
        <p>Film Yang diputar di Studio <b>{{ $studio->name }}</b></p>
        <ul class="list-group ml-4">
            <li class="list-item">Avangers</li>
        </ul>
            <br>
        <p>Harga Normal (Senin-Kamis) : Rp {{ $studio->basic_price }}</p>
        <p>Harga hari Jum'at : Rp. {{ $studio->additional_friday_price }}</p>
        <p>Harga hari Sabtu : Rp. {{ $studio->additional_saturday_price }}</p>
        <p>Harga hari Minggu : Rp. {{ $studio->additional_sunday_price }}</p>


        <a href="{{ route("studio.edit", ["studio" => $studio->slug]) }}" class="btn btn-primary btn-sm">Edit</a>
        <form action="{{ route("studio.destroy", ["studio" => $studio->slug]) }}" method="POST" class="d-inline">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger btn-sm mt-2sm ">Hapus</button>
        </form>
    </div>
</div>

@endsection
