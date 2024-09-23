@extends('layouts.app')

@include('modal/tambah_member')

@section('content')
    <h3 class="text-center mb-5">Data Member</h3>

    <div class="container-button d-flex mb-4">
        <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah_member">
            <i class="fa-solid fa-plus"></i> Tambah Member
        </button>
        <div class="search btn btn-success w-50 ms-auto py-0">
            <form action="{{ url('member') }}" method="GET" class="row">
                <input type="search" name="cari_member" class="form-control bg-transparent border-0 col text-white"
                    placeholder="Cari Member" aria-label="Search">
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
                <th>Nama Member</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
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
                    <td><a href="{{ url('member/' . $item->id_member . '/edit') }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>Edit</a></a>
                        <form onsubmit="return confirm('yakin akan menghapus data?')"
                            action="{{ url('member/' . $item->id_member) }}" class="d-inline" method="POST">
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
