@extends('layouts.app')

@section('content')
    <div class="card w-50 mx-auto" style="background-color: #F5F7F8">
        <div class="card-header">
            <h3 class="text-center card-title">Edit Member</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('member/' . $data->id_member) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_product" class="form-label">Nama Member</label>
                    <input type="text" class="form-control border-secondary" id="nama_product" name="Nama_member"
                        value="{{ $data->Nama_member }}" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Alamat</label>
                    <input type="text" class="form-control border-secondary" id="harga" name="Alamat"
                        value="{{ $data->Alamat }}" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">No Telepon</label>
                    <input type="number" class="form-control border-secondary" id="stock" name="No_telepon"
                        value="{{ $data->No_telepon }}">
                </div>
                <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
