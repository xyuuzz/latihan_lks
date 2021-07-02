@extends("templates.app")

@section("content")

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center text-bold">Halaman Home</h4>
        </div>
        <div class="card-body">
            <div class="d-lg-flex justify-content-between">
                <div class="divBranch">
                    <label for="searchBranch">Cari Film yang lagi tayang di kotamu pada minggu ini</label>
                    <input class="form-control mr-sm-2 searchBranch" type="search" placeholder="Cari film yang ada dikotamu" aria-label="Search">
                </div>
                <div class="mt-smm-3 divDate">
                    <label for="searchDate">Cari Film melalui tanggal</label>
                    <input class="form-control mr-sm-2 searchDate" type="date" >
                </div>
            </div>
            <div class="d-lg-flex justify-content-between">
                <div class="col-lg-7 main-v">
                    @forelse($list_jadwal as $jadwal)
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Tanggal penayangan : <b>{{ strftime("%A, %d %B %Y", strtotime($jadwal->start)) }} <b></h4>
                            <p>Tersedia di bioskop : <b>{{ $jadwal->studio->name }}<b></p>
                            <p>Kota : {{ $jadwal->studio->branch->name }}</p>
                            <p>Judul film : <b>{{ $jadwal->movie->name }}</b></p>
                            <p>Durasi : {{ $jadwal->movie->duration }} Menit </p>
                            <p>Tanggal penayangan : {{ date("d-m-Y", strtotime($jadwal->start)) }}</p>
                            <p>Jam tayang : {{ date("H:i", strtotime($jadwal->start)) }} - {{ date("H:i", strtotime($jadwal->end)) }}</p>
                            <button type="button" class="btn btn-outline-primary d-block mb-3" data-toggle="modal" data-target="#exampleModal">
                                Pesan Sekarang
                            </button>
                            <img class="rounded shadow w-img img-fluid" src="{{ asset("storage/images/{$jadwal->movie->image}") }}" alt="">
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                <div class="mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4>Segera Tayang : </h4>

                            @forelse($rec_film as $film)
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4>Judul : {{ $film->movie->name }}</h4>
                                        <p>Durasi : {{ $film->movie->duration }} Menit </p>
                                        <p>Tayang pada :
                                        <b>
                                            {{ strftime("%A, %d %B %Y", strtotime($film->start)) }}
                                        </b></p>
                                        {{-- <button class="btn btn-outline-secondary d-block mb-3" type="button">Ingatkan Jika Sudah Tersedia!</button> --}}
                                        <img class="rounded shadow w-img img-fluid" src="{{ asset("storage/images/{$film->movie->image}") }}" alt="banner film">
                                    </div>
                                </div>
                            @empty
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="text-center">Tidak ada!</h5>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

</div>

@endsection
