@extends('layouts.app')

@section('content')
    <h3 class="text-center mb-4">Detail Laporan Transaksi</h3>
    @if ($data->member != null)
        <p class="lead fw-bold fs-5">Nama Member : {{ $data->member->Nama_member }}</p>
    @endif
    <table class="table table-bordered table-hover text-center">
        <thead class="table-primary text-white">
            <tr>
                <th>Nama Product</th>
                <th>jumlah Product</th>
                <th>sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->detailpenjualan as $item)
                <tr>
                    <td>{{ $item->product->nama_product }}</td>
                    <td>{{ $item->jumlah_product }}</td>
                    <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            @if ($data->member != null)
                <td colspan="2">Diskon</td>
                <td>{{ $data->diskon }}</td>
            @endif
            <tr>
                <td colspan="2">Total Harga</td>
                <td>{{ number_format($data->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2">Jumlah Bayar</td>
                <td>{{ number_format($data->jumlah_bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2">Kembalian</td>
                <td>{{ number_format($data->kembalian, 0, ',', '.') }}</td>
            </tr>

        </tbody>
    </table>
@endsection
