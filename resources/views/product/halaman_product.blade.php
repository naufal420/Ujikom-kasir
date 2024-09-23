@extends('layouts.app')
@include('modal/tambah_product')

@section('content')
    <h3 class="text-center mb-5">Data Product</h3>
    <div class="container-button d-flex mb-4 justify-content-between">
        @if (Auth::user()->role == 'admin')
            <button class="button-tambah btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah_product">
                <i class="fa-solid fa-plus"></i> Tambah Product
            </button>
        @endif

        <div class="search btn btn-success w-50 py-0 mx-auto">
            <form action="{{ url('product') }}" method="GET" class="row">
                <input type="search" name="cari_product"
                    class="product col form-control bg-transparent border-0 text-white" aria-label="Search"
                    placeholder="Cari Product">
                <button class="btn btn-secondary col-2" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>Cari
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
                @if (Auth::user()->role == 'admin')
                    <th>Aksi</th>
                @endif
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
                    @if (Auth::user()->role == 'admin')
                        <td>
                            <a href="{{ url('product/' . $item->id_product . '/edit') }}"class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>Edit</a>
                            <form onsubmit="return confirm('yakin akan menghapus data?')"
                                action="{{ url('product/' . $item->id_product) }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger text-white">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
                <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
