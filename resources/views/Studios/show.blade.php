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
        <p>Daftar Film Yang diputar di Studio <b>{{ $studio->name }}</b> pekan ini</p>
        <ul class="list-group ml-4">
            @forelse($studio->schedule()->where("start", ">", date("Y-m-d"))->where("end", "<", date("Y-m-d", strtotime("next week")))->get() as $sche)
                <li class="list-item">{{ $sche->movie->name }}</li>
            @empty
                <li class="list-item">Tidak ada</li>
            @endforelse
        </ul>
            <br>
        <p>Harga Normal (Senin-Kamis) : Rp {{ number_format($studio->additional_friday_price,2,',','.') }}</p>
        <p>Harga hari Jum'at : Rp. {{ number_format($studio->additional_friday_price,2,',','.') }}</p>
        <p>Harga hari Sabtu : Rp. {{ number_format($studio->additional_saturday_price,2,',','.') }}</p>
        <p>Harga hari Minggu : Rp. {{ number_format($studio->additional_sunday_price,2,',','.') }}</p>


        <a href="{{ route("studio.edit", ["studio" => $studio->slug]) }}" class="btn btn-primary btn-sm">Edit</a>
        <form action="{{ route("studio.destroy", ["studio" => $studio->slug]) }}" method="POST" class="d-inline">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger btn-sm mt-2sm ">Hapus</button>
        </form>
    </div>
</div>

@endsection
