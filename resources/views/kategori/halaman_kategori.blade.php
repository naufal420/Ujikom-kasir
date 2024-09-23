@extends('layouts.app')
@include('modal/tambah_kategori')
@section('content')
    <h3 class="text-center mb-5">Data Kategori</h3>

    <div class="container-button d-flex mb-4">
        <div class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah_kategori">
            <i class="fa-solid fa-plus"></i> Tambah Kategori
        </div>
        <div class="search btn btn-success w-50 ms-auto py-0">
            <form action="{{ url('kategori') }}" class="row" method="GET">
                <input type="text" class="form-control bg-transparent border-0 col text-white"
                    placeholder="cari Kategori" name="cari_kategori" aria-label="Search">
                <button class="btn btn-secondary col-2" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>Cari
                </button>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-hover text-center">
        <thead class="table-primary">
            <tr>
                <th>Id Kategory</th>
                <th>Nama Kategory</th>
                <th>Jumlah Product</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id_kategori }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>{{ $item->product_count }}</td>
                    <td><a href="{{ url('kategori/' . $item->id_kategori . '/edit') }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>Edit</a>
                        <form onsubmit="return comfirm('Yakin akan Menghapus data')"
                            action="{{ url('kategori/' . $item->id_kategori) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger text-white">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
