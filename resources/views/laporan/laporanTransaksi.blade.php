@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Laporan Transaksi</h1>
    <table class="table table-bordered table-hover text-center">
        <thead class="table-primary text-white">
            <tr>
                <th>id penjualan</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th>Member</th>
                <th>Lihat Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id_penjualan }}</td>
                    <td>{{ $item->tanggal_penjualan }}</td>
                    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    @if ($item->member != null)
                        <td>{{ $item->member->Nama_member }}</td>
                    @else
                        <td>bukan Member</td>
                    @endif

                    <td>
                        <a href="{{ url('laporan/detail/' . $item->id_penjualan) }}" class="lead">
                            <i class="fa-solid fa-eye"></i> Lihat
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
