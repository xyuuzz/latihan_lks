@extends("templates.app")

@section("content")

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Film</h4>
        </div>
        <div class="card-body">
            <a href="{{ route("movie.create") }}" class="btn btn-secondary mb-3">Tambah Film</a>

            @if(session("success"))
                <div class="alert alert-success mt-2 d-block" role="alert">
                    {{ session("success") }}
                </div>
            @endif

            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Film</th>
                        <th scope="col">Banner</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftar_film as $film)
                    <tr>
                    <th scope="row">{{ $index++ }}</th>
                    <td class="pr-5" >{{ $film->name }}</td>
                    <td class="text-center">
                        <img class="rounded img-thumbnail w-img" src="{{ asset("storage/images/" . $film->image) }}" alt="">
                    </td>
                    <td>{{ $film->duration }} Menit</td>
                    <td>
                        <a href="{{ route("movie.edit", ["movie" => $film->slug]) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route("movie.destroy", ["movie" => $film->slug]) }}" method="POST" class="d-inline">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm mt-2sm ">Hapus</button>
                        </form>
                    </td>
                    </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5"><h4>Tidak ada film</h4></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection
