@extends('layouts.app')

@section('content')
    <div class="container-card row justify-content-between mt-5 gy-4">
        <div class="card col-5 flex-row text-white rounded-4 p-3" style="background-color: #369FFF">
            <div class="card-text mt-2 d-flex flex-column">
                <h3 class="mb-auto">Total Product</h3>
                <span class="h4">{{ $total_product }}</span>
            </div>
            <img src="{{ asset('img/product.svg') }}" alt="" class="ms-auto">
        </div>
        <div class="card col-5 flex-row text-white rounded-4 p-3" style="background-color: #FF993A">
            <div class="card-text mt-2 d-flex flex-column">
                <h3 class="mb-auto">Total transaksi</h3>
                <span class="h4">{{ $total_transaksi }}</span>
            </div>
            <img src="{{ asset('img/transaksi.svg') }}" alt="" class="ms-auto">
        </div>
        <div class="card col-5 flex-row text-white rounded-4 p-3" style="background-color: #FFD143">
            <div class="card-text mt-2 d-flex flex-column">
                <h3 class="mb-auto">Total Kasir</h3>
                <span class="h4">{{ $total_kasir }}</span>
            </div>
            <img src="{{ asset('img/kasir.svg') }}" alt="" class="ms-auto">
        </div>
        <div class="card col-5 flex-row text-white rounded-4 p-3" style="background-color: #8AC53E">
            <div class="card-text mt-2 d-flex flex-column">
                <h3 class="mb-auto">Total Member</h3>
                <span class="h4">{{ $total_member }}</span>
            </div>
            <img src="{{ asset('img/member.svg') }}" alt="" class="ms-auto">
        </div>
    </div>
@endsection
