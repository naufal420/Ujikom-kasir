@extends('layouts.app')

@section('content')
    <h3 class="text-center mb-5">Laporan Member</h3>

    <div class="container-button row mb-4">
        <div class="search btn btn-primary col-8 mx-auto py-0">
            <form action="{{ url('laporanMember') }}" method="GET" class="row">
                <input type="search" name="cari_member" class="form-control bg-transparent border-0 col text-white"
                    placeholder="Cari Member" aria-label="Search">
                <button class="btn btn-secondary col-3 d-flex align-items-center gap-3" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>Cari Member
                </button>
            </form>
        </div>
    </div>

    <table class="table table-bordered  border-secondary table-hover text-center">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Member</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $data->firstItem(); ?>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $item->Nama_member }}</td>
                    <td>{{ $item->Alamat }}</td>
                    <td>{{ $item->No_telepon }}</td>
                    <td>{{ $item->tanggal_input }}</td>
                </tr>
                <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
