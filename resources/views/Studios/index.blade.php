@extends("templates.app")


@section("content")

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Kelola Studio</h4>
        </div>
        <div class="card-body">
            <a href="{{ route("studio.create") }}" class="btn btn-secondary mb-3">Tambahkan List Studio</a>

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
                        <th scope="col">Cabang</th>
                        <th scope="col">Harga Normal Studio</th>
                        <th scope="col">Hari Jumat</th>
                        <th scope="col">Hari Sabtu</th>
                        <th scope="col">Hari Minggu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list_studio as $studio)
                    <tr class="text-center">
                        <th scope="row">{{ $index++ }}</th>
                        <td class="pr-5" >{{ $studio->name }}</td>
                        <td>{{ $studio->branch->name }}</td>
                        <td>Rp. {{ $studio->basic_price }}</td>
                        <td>Rp. {{ $studio->additional_friday_price }}</td>
                        <td>Rp. {{ $studio->additional_saturday_price }}</td>
                        <td>Rp. {{ $studio->additional_sunday_price }}</td>
                        <td>
                            <a href="{{ route("studio.show", ["studio" => $studio->slug]) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                        </td>
                    </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7"><h4>Tidak ada studio di data</h4></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection
