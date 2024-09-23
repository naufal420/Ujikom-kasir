@extends('layouts.app')

@section('content')
    <div class="card w-50 mx-auto">
        <div class="card-header">
            <h3 class="text-center card-title">Edit Kategori</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('kategori/' . $data->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategory</label>
                    <input type="text" class="form-control border-secondary" id="nama_kategori" name="nama_kategori"
                        value="{{ $data->nama_kategori }}">
                </div>
                <div class="card-footer px-0">
                    <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
