@extends('layouts.app')

@section('content')
    <h1 class="text-center">Transaksi</h1>
    <div class="container-from row justify-content-between mb-5">
        <form action="{{ url('transaksi') }}" class="col-5" method="GET" id="productSelectForm">
            <select name="selected_product" class="form-control border border-secondary col-5" id="productSelect"
                aria-label="Default select example">
                <option value="">Pilih Product</option>
                @foreach ($all_products as $product)
                    <option value="{{ $product->id_product }}">{{ $product->nama_product }}
                    </option>
                @endforeach
            </select>

        </form>
        <form action="{{ url('transaksi') }}" class="col-5" method="GET" id="memberSelectForm">
            <select name="selected_member" id="memberSelect" class="form-control border border-secondary"
                aria-label="Default select example">
                <option value="">Pilih Member</option>
                @foreach ($all_members as $member)
                    <option value="{{ $member->id_member }}" {{ $selected_member == $member->id_member ? 'selected' : '' }}>
                        {{ $member->Nama_member }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    @if ($data && $data->isNotEmpty())
        <form action="{{ route('transaksi.deleteAllProduct') }}" method="POST" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-danger">Hapus Semua</button>
        </form>
    @endif
    <form action="{{ route('transaksi.simpanTransaksi') }}" method="POST" id="transactionForm">
        @csrf
        <table class="table table-bordered table-hover text-center">
            <thead class="table-primary text-white">
                <tr>
                    <th>Nama Product</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>kategory</th>
                    <th>Jumlah beli</th>
                    <th>Sub total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->nama_product }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>
                            <input type="number" name="jumlah_beli[{{ $item->id_product }}]" placeholder="jumlah beli"
                                class="jumlah_beli_input text-center" data-harga="{{ $item->harga }}"
                                data-id="{{ $item->id_product }}"
                                value="{{ session('jumlah_beli')[$item->id_product] ?? '' }}">
                        </td>
                        <td>
                            <input type="number" name="sub_total[{{ $item->id_product }}]" placeholder="Sub total"
                                class="sub_total_input text-center"
                                value="{{ session('sub_total')[$item->id_product] ?? '' }}"
                                id="subtotal-{{ $item->id_product }}" readonly>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger delete-product-btn"
                                data-id="{{ $item->id_product }}">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form bg-danger w-50 mx-auto">
            <table class="table table-borderless text-center">
                @if (!empty($selected_member))
                    <tr>
                        <td colspan="4"><strong>Diskon Member</strong></td>
                        <td colspan="2">
                            <input type="text" id="diskon" name="diskon" class="form-control text-center" readonly>
                            <input type="text" name="id_member" value="{{ $selected_member }}" hidden>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="4"><strong>Total Harga</strong></td>
                    <td colspan="2">
                        <input type="number" id="total-harga" name="total_harga" class="form-control text-center" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Jumlah Bayar</strong></td>
                    <td colspan="2">
                        <input type="number" id="jumlah-bayar" name="jumlah_bayar" class="form-control text-center">
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Kembalian</strong></td>
                    <td colspan="2">
                        <input type="number" id="kembalian" class="form-control text-center" name="kembalian" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Tanggal Pembelian</strong></td>
                    <td colspan="2">
                        <input type="date" class="form-control text-center" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <button type="submit" class="btn btn-primary btn-block">Simpan Transaksi</button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    @if (session('pdfUrl'))
        <script>
            // Buka struk di tab baru
            window.open("{{ session('pdfUrl') }}", '_blank');

            // Download otomatis setelah tab baru terbuka
            const link = document.createElement('a');
            link.href = "{{ session('pdfUrl') }}";
            link.download = 'struk-transaksi.pdf';
            link.click();
        </script>
    @endif
    <script>
        document.getElementById('memberSelect').addEventListener('change', function() {
            document.getElementById('memberSelectForm').submit();
        });

        document.getElementById('productSelect').addEventListener('change', function() {
            document.getElementById('productSelectForm').submit();
        });

        function hitungTotalHarga() {
            let total = 0;
            document.querySelectorAll('.sub_total_input').forEach(input => {
                total += parseFloat(input.value) || 0;
            })
            let totalHargaInput = document.getElementById('total-harga');
            totalHargaInput.value = total || 0;

            let selectedMember = "{{ $selected_member }}";
            if (selectedMember && total >= 30000) {
                let diskonPersen = Math.floor(Math.random() * (20 - 10 + 1)) + 10;
                let diskon = (diskonPersen / 100) * totalHargaInput.value;
                document.getElementById('diskon').value = `${diskonPersen}%`;
                totalHargaInput.value = totalHargaInput.value - diskon;
            }
        }
        // Event listener untuk setiap input jumlah beli
        document.querySelectorAll('.jumlah_beli_input').forEach(input => {
            input.addEventListener('input', function() {
                const harga = this.getAttribute('data-harga'); // Mendapatkan harga produk
                const jumlahBeli = this.value; // Jumlah beli yang dimasukkan user
                const productId = this.getAttribute('data-id'); // ID produk
                //  Hitung subTotal
                const subtotal = harga * jumlahBeli;
                // Masukkan hasil subtotal ke input yang sesuai
                document.getElementById(`subtotal-${productId}`).value = subtotal;
                hitungTotalHarga();

                // Simpan data ke session melalui AJAX
                fetch('{{ route('transaksi.updateSession') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_product: productId,
                        jumlah_beli: jumlahBeli,
                        sub_total: subtotal
                    })
                })
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            hitungTotalHarga();
        });
        // Event listener untuk menghitung kembalian setelah input jumlah bayar
        document.getElementById('jumlah-bayar').addEventListener('input', function() {
            let totalHarga = parseFloat(document.getElementById('total-harga').value) || 0;
            let jumlahBayar = parseFloat(this.value) || 0;
            let kembalian = jumlahBayar - totalHarga;
            document.getElementById('kembalian').value = kembalian || 0;
        })

        document.querySelectorAll('.delete-product-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');

                // Lakukan permintaan untuk menghapus produk melalui fetch
                fetch(`/transaksi/deleteProduct/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.closest('tr').remove();
                            // Hitung ulang total harga
                            hitungTotalHarga();
                        } else {
                            alert('Gagal menghapus produk.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
