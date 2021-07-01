@extends("templates.app")

@section("content")

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5>{{ $desc }}</h5>
                    <a href="{{ route("movie.index") }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ $url }}">
                    @csrf
                    @if($title === "Edit Film")
                        @method("PATCH")
                    @endif
                    <div class="form-group">
                        <label for="nama">Nama Film  </label>
                        <input name="name" type="text" id="nama" placeholder="Nama Film" required autofocus
                        class="form-control @error("name") {{ "is-invalid" }} @enderror"
                        value="{{ $movie->name ?? old("name") }}">
                        @error('name')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="durasi">Durasi Film (menit)</label>
                        <input name="duration" type="numeric" id="durasi" placeholder="Durasi Film" required
                        class="form-control @error("duration") {{ "is-invalid" }} @enderror "
                        value="{{ $movie->duration ?? old("duration") }}">
                        @error('duration')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Banner Film</label>
                        <input name="image" type="file" id="image" onchange="previewImage()"
                        {{ $movie->image ? "" : "required" }}
                        class="form-control @error("image") {{ "is-invalid" }} @enderror " >
                        @error('image')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <small>Preview Banner Film : </small>
                    <img class="rounded shadow-lg img-thumbnail w-img d-block img-preview"
                    src="{{ isset($movie->image) ?  asset("storage/images/{$movie->image}") : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F3.bp.blogspot.com%2F-JeNYd1w2idQ%2FVVcOzjRxzPI%2FAAAAAAAAKTk%2FDcoXRVtyAJo%2Fs1600%2Fgambar%252Bsinga%252B(14).jpg&f=1&nofb=1" }}" >

                    <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                </form>
            </div>
        </div>
    </div>

@endsection
