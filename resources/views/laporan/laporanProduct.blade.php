@extends('layouts.app')

@section('content')
    <h3 class="text-center mb-5">Laporan Product</h3>
    <div class="container-button row mb-4 justify-content-between">
        <div class="search btn btn-primary col-8 mx-auto py-0">
            <form action="{{ url('laporanProduct') }}" method="GET" class="row">
                <input type="search" name="cari_product" class="product col form-control bg-transparent border-0 text-white"
                    aria-label="Search" placeholder="Cari Product">
                <button class="btn btn-secondary col-3 d-flex justify-content-center align-items-center gap-1"
                    type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>Cari product
                </button>
            </form>
        </div>
    </div>
    <table class="table table-bordered  border-secondary table-hover text-center">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Product</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>kategory</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $data->firstItem(); ?>
            @foreach ($data as $item)
                <tr>
                    <td><?php echo $no; ?></td>
                    <td>{{ $item->nama_product }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->tanggal_input }}</td>
                </tr>
                <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
