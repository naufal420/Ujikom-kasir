@extends('layouts.app')

@section('content')
    <h3 class="text-center mb-5">Laporan Kasir</h3>
    <div class="container-button row mb-4 justify-content-between">
        <div class="search btn btn-success col-8 mx-auto py-0">
            <form action="{{ url('laporanKasir') }}" method="GET" class="row">
                <input type="search" name="cari_kasir" class="col form-control bg-transparent border-0 text-white"
                    placeholder="Cari kasir" aria-label="Search">
                <button class="btn btn-primary col-5" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>Cari Kasir
                </button>
            </form>
        </div>
    </div>
    <table class="table table-bordered  border-secondary table-hover text-center">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama kasir</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $data->firstItem(); ?>
            @foreach ($data as $item)
                <tr>
                    <td><?php echo $no; ?></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>{{ $item->tanggal_input }}</td>
                </tr>
                <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
