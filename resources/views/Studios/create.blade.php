@extends("templates.app")

@section("content")

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="d-inline">{{ $desc }}</h5>
                <a href="{{ route("movie.index") }}" class="btn btn-warning float-right">Kembali</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ $url }}">
                    @csrf
                    @if($title === "Sunting Studio")
                        @method("PATCH")
                    @endif
                    <div class="form-group">
                        <label for="nama">Nama Studio </label>
                        <input name="name" type="text" id="nama" placeholder="Nama studio..." required autofocus
                        class="form-control @error("name") {{ "is-invalid" }} @enderror"
                        value="{{ $studio->name ?? old("name") }}">
                        @error('name')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cabang">Berada di Cabang : </label>
                        <select name="cabang" id="cabang" class="form-control">
                            @foreach($list_cabang as $cabang)
                                @if(isset($studio->branch->name))
                                    @if($studio->branch->name === $cabang->name)
                                    <option value="{{ $cabang->id }}" selected>{{ $cabang->name }}</option>
                                    @else
                                    <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                                    @endif
                                @else
                                    <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="basic_price">Harga Normal</label>
                        <input name="basic_price" type="numeric" id="basic_price" placeholder="Harga normal, hari Senin - Kamis"
                        class="form-control @error("duration") {{ "is-invalid" }} @enderror "
                        value="{{ $studio->basic_price ?? old("basic_price") }}" required>
                        @error('basic_price')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="additional_friday_price">Hari Jum'at</label>
                        <input name="additional_friday_price" type="numeric" id="additional_friday_price" placeholder="Harga Hari Jumat!"
                        class="form-control @error("additional_friday_price") {{ "is-invalid" }} @enderror "
                        value="{{ $studio->additional_friday_price ?? old("duration") }}" required>
                        @error('additional_friday_price')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="additional_saturday_price">Hari Sabtu</label>
                        <input name="additional_saturday_price" type="numeric" id="additional_saturday_price" placeholder="Harga Hari Sabtu!"
                        class="form-control @error("additional_saturday_price") {{ "is-invalid" }} @enderror "
                        value="{{ $studio->additional_saturday_price ?? old("additional_saturday_price") }}" required>
                        @error('additional_saturday_price')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="additional_sunday_price">Hari Minggu</label>
                        <input name="additional_sunday_price" type="numeric" id="additional_sunday_price" placeholder="Harga Hari Minggu!"
                        class="form-control @error("additional_sunday_price") {{ "is-invalid" }} @enderror "
                        value="{{ $studio->additional_sunday_price ?? old("additional_sunday_price") }}" required>
                        @error('additional_sunday_price')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                </form>
            </div>
        </div>
    </div>

@endsection
