@extends("templates.app")


@section("content")

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5>{{ $desc }}</h5>
                <a href="{{ route("schedule.index") }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ $url }}">
                @csrf
                @if($action === "Edit")
                    @method("PATCH")
                @endif
                <div class="form-group">
                    <label for="nama">Film</label>
                    <select class="form-control col-lg-4" name="movie" id="film">
                    @foreach($list_film as $film)
                        @if(isset($schedule->movie->name))
                            @if($schedule->movie->name === $film->name)
                            <option value="{{ $film->id }}" selected>{{ $film->name }}</option>
                            @else
                            <option value="{{ $film->id }}">{{ $film->name }}</option>
                            @endif
                        @else
                            <option value="{{ $film->id }}">{{ $film->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('film')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="studio">Studio</label>
                    <select class="form-control col-lg-4" name="studio" id="studio">
                        @foreach($list_studio as $studio)
                            @if(isset($schedule->studio))
                                @if($schedule->studio->name === $studio->name)
                                <option value="{{ $studio->id }}" selected>{{ $studio->name }}</option>
                                @else
                                <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                                @endif
                            @else
                                <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('studio')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_date">Dimulai pada tanggal</label>
                    <input name="start_date" type="date" id="start_date"
                    class="form-control @error("duration") {{ "is-invalid" }} @enderror "
                    value=@if(isset($schedule->start))
                            {{ date("Y-m-d", strtotime($schedule->start))}}
                            @else
                            {{ old('start_date') }}
                            @endif
                    required>
                    @error('start_date')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_time">Dimulai pada jam : </label>
                    <input name="start_time" type="numeric" id="start_time"
                    class="form-control @error("duration") {{ "is-invalid" }} @enderror "
                    value="@if(isset($schedule->start) && ! old('start_time')){{ date("H:i", strtotime($schedule->start))}} @else {{ old('start_time') }} @endif"
                    required placeholder="Contoh 0900 : jam 9 pagi">
                    @error('start_time')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">{{ $action }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
