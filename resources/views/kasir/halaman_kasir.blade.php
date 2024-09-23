@extends('layouts.app')
@include('modal/tambah_kasir')

@section('content')
    <h3 class="text-center mb-5">Data Kasir</h3>
    <div class="container-button d-flex mb-4 justify-content-between">
        <button class="button-tambah btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah_kasir">
            <i class="fa-solid fa-plus"></i> Tambah kasir
        </button>
        <div class="search btn btn-success w-50 py-0">
            <form action="{{ url('kasir') }}" method="GET" class="row">
                <input type="search" name="cari_kasir" class="col form-control bg-transparent border-0 text-white"
                    placeholder="Cari kasir" aria-label="Search">
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
                <th>Nama kasir</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Aksi</th>
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
                    <td>
                        <a href="{{ url('kasir/' . $item->email . '/edit') }}"class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>Edit</a>
                        <form onsubmit="return confirm('yakin akan menghapus data?')"
                            action="{{ url('kasir/' . $item->email) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger text-white">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
