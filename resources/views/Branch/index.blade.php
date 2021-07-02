@extends("templates.app")

@section("content")

<div class="container">
    <div class="card">
        <div class="card-header">
            Kelola Cabang
        </div>
    </div>
    <div class="card-body">
        <button class="btn btn-secondary mb-3 addCabang">Tambahkan Cabang</button>

        <form action="{{ route("branch.store") }}" method="post" class="formCabang {{ request()->old("name") ? "" : "d-none"}}">
            @csrf
            <div class="form-group">
                <label for="nama">Cabang di Kota  </label>
                <input name="name" type="text" id="nama" placeholder="Nama Kota" required autofocus
                class="form-control @error("name") {{ "is-invalid" }} @enderror col-lg-5"
                value="{{ $cabang->name ?? old("name") }}">
                @error('name')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-primary mb-4">Tambahkan Cabang</button>
        </form>
        
        @error('editName')
            <div class="alert alert-danger mt-2" role="alert">
                {{ $message }}
            </div>
        @enderror

        @if(session("success"))
            <div class="alert alert-success mt-2 d-block" role="alert">
                {{ session("success") }}
            </div>
        @endif

        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Cabang</th>
                    <th scope="col">Studio Yang Tersedia</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftar_cabang as $cabang)
                <tr class="text-center">
                <th scope="row">{{ $index++ }}</th>
                <td class="fieldNamaCabang text-center">
                    <div class="active">
                        {{ $cabang->name }}
                    </div>
                    <div class="d-none">
                        <form action="{{ route("branch.update", ["branch" => $cabang->slug]) }}" method="POST" class="d-inline">
                            @method("PATCH")
                            @csrf
                            <input class="form-control col-8" type="text" name="editName" placeholder="Masukan Nama Baru cabang" required>
                    </div>
                </td>
                <td>Studio ..</td>
                <td class="buttonEdit">
                    <div class="d-none">
                        <button type="submit" class="btn btn-success btn-sm">Sunting!</button>
                        </form>

                        <button type="button" class="btn btn-primary btn-sm editBranch genBranch mt-2sm">Kembali</button>
                    </div>

                    <div>
                        <button type="button" class="btn btn-primary btn-sm editBranch">Edit</button>
                        <form action="{{ route("branch.destroy", ["branch" => $cabang->slug]) }}" method="POST" class="d-inline">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm mt-2sm ">Hapus</button>
                        </form>
                    </div>


                </td>
                </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="5"><h4>Tidak ada Cabang Yang Dibuka</h4></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $daftar_cabang->links("pagination::bootstrap-4") }}
    </div>
</div>

@endsection
