@extends('templates.app')


@section("content")

<div class="container">

    @if(session("success"))
        <div class="alert alert-success mt-2 d-block" role="alert">
            {{ session("success") }}
        </div>
    @endif

    <a href="{{ route("schedule.create") }}" class="btn btn-outline-primary btn-sm mt-5">Tambah jadwal tayang</a>

    <div class="d-flex justify-content-center mt-3">
        {{ $list_jadwal->links("pagination::bootstrap-4") }}
    </div>

    <div class="mt-1">
        @forelse($list_jadwal as $jadwal)
            <div class="card mb-4 ">
                <div class="card-header">
                    Jadwal Penanyangan Film <b>{{ $jadwal->movie->name }}</b> di Studio <b>{{ $jadwal->studio->name }}</b>
                </div>
                <div class="card-body">
                    <div class="d-lg-flex justify-content-between">
                        <div>
                            <p>Nama Film : {{ $jadwal->movie->name }}</p>
                            <p>Durasi Film : {{ $jadwal->movie->duration }} Menit</p>
                            <p>Tayang pada Tanggal : {{ date("d-m-Y", strtotime($jadwal->start))  }} </p>
                            <p>Waktu : {{ date("H:i", strtotime($jadwal->start))  }} - {{ date("H:i", strtotime($jadwal->end))  }}</p>
                            {{-- <p>Studio Berada di cabang <b>{{ $jadwal->studio->branch->name }}<b></p> --}}
                        </div>
                        {{-- <small class="">Banner Film {{ $jadwal->movie->name }}</small> --}}
                        <img class="w-25 rounded img-thumbnail" src="{{ asset("storage/images/{$jadwal->movie->image}") }}" alt="banner film">
                    </div>

                    <div class="d-flex mt-3">
                        <a href="{{ route("schedule.edit", ["schedule" => $jadwal->slug]) . "?page="}}@if(null !== request("page")) {{ request("page") }} @else 1 @endif " class="btn btn-outline-warning mr-3">Edit jadwal</a>
                        <form action="{{ route("schedule.destroy", ["schedule" => $jadwal->slug, "page" => request("page") ?? 1]) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger">Hapus Jadwal</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Tidak ada jadwal penanyangan film!</h4>
                </div>
            </div>
        @endforelse
    </div>

</div>

@endsection
