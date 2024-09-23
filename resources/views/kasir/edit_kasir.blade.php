@extends('layouts.app')

@section('content')
    <div class="card w-50 mx-auto" style="background-color: #F5F7F8">
        <div class="card-header">
            <h3 class="text-center card-title">Edit Kasir</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('kasir/' . $data->email) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama kasir</label>
                    <input type="text" class="form-control border-secondary" id="name" name="name"
                        value="{{ $data->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control border-secondary" id="email" name="email"
                        value="{{ $data->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="number" class="form-control border-secondary" id="no_telepon" name="no_telepon"
                        value="{{ $data->no_telepon }}">
                </div>
                <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
