@extends("templates.app")

@section("content")

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center text-bold">Halaman Home</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Avangers</h4>
                            <p>Durasi : 143 Menit </p>
                            <p>Tersedia di Kota : ...</p>
                            <button type="button" class="btn btn-outline-primary d-block mb-3" data-toggle="modal" data-target="#exampleModal">
                                Pesan Sekarang
                            </button>
                            <img class="rounded shadow w-img img-fluid" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.eMZEc1Hd9mWFPvWEeV-9dwHaEI%26pid%3DApi&f=1" alt="">
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Avangers</h4>
                            <p>Durasi : 143 Menit </p>
                            <p>Tersedia di Kota : ...</p>
                            <button type="button" class="btn btn-outline-primary d-block mb-3" data-toggle="modal" data-target="#exampleModal">
                                Pesan Sekarang
                            </button>
                            <img class="rounded shadow w-img img-fluid" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.eMZEc1Hd9mWFPvWEeV-9dwHaEI%26pid%3DApi&f=1" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4>Rekomendasi Film: </h4>

                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4>Avangers</h4>
                                    <p>Durasi : 143 Menit </p>
                                    <p>Tersedia di Kota : -</p>
                                    <button class="btn btn-outline-secondary d-block mb-3" type="button">Ingatkan Jika Sudah Tersedia!</button>
                                    <img class="rounded shadow w-img img-fluid" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.eMZEc1Hd9mWFPvWEeV-9dwHaEI%26pid%3DApi&f=1" alt="">
                                </div>
                            </div>
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
