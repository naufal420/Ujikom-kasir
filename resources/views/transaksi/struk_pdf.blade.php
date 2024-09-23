<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .struk-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="struk-container">
        <div class="header">
            <h2>Struk Transaksi</h2>
            <p>Tanggal: {{ $penjualan->tanggal_penjualan }}</p>
            <br>
            @if ($penjualan->member)
                <h3>Nama member = {{ $penjualan->member->Nama_member }}</h3>
            @endif
        </div>

        <table class="center">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan->detailpenjualan as $detail)
                    <tr class="center">
                        <td>{{ $detail->product->nama_product }}</td>
                        <td class="center">{{ $detail->jumlah_product }}</td>
                        <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                @if (!empty($diskon))
                    <tr>
                        <td colspan="2">Diskon :</td>
                        <td>{{ $diskon }}</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="2">Total Harga :</td>
                    <td style="font-weight: bold"> Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2">Jumlah Bayar :</td>
                    <td>{{ $jumlah_bayar }}</td>
                </tr>
                <tr>
                    <td colspan="2">Kembalian :</td>
                    <td>{{ $kembalian }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
