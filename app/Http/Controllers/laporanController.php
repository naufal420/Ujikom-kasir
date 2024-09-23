<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\penjualan;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class laporanController extends Controller
{
    public function laporanProduct(Request $request)
    {
        $cari_product = $request->cari_product;
        if (strlen($cari_product)) {
            $data = product::where('nama_product', 'like', "%$cari_product%")->orWhere('harga', 'like', "%$cari_product%")->orWhere('stock', 'like', "%$cari_product%")->paginate(3);
        } else {
            $data = product::with('kategori')->paginate(4);
        }
        return view('laporan.laporanProduct', compact('data'));
    }
    public function laporanMember(Request $request)
    {
        $cari_member = $request->cari_member;
        if (strlen($cari_member)) {
            $data = member::where('nama_member', 'like', "%$cari_member%")->paginate();
        } else {
            $data = member::paginate(4);
        }
        return view('laporan.laporanMember', compact('data'));
    }
    public function laporanKasir(Request $request)
    {
        $cari_kasir = $request->cari_kasir;
        if (strlen($cari_kasir)) {
            $data = User::where('name', 'like', "%$cari_kasir%")->paginate(3);
        } else {
            $data = User::where('role', 'kasir')->paginate(4);
        }
        return view('laporan.laporanKasir', compact('data'));
    }
    public function laporanTransaksi()
    {
        $data = penjualan::with('member')->paginate(4);
        return view('laporan.laporanTransaksi', compact('data'));
    }
    public function laporanDetail($id)
    {
        $data = penjualan::with('detailpenjualan.product')->find($id);

        return view('laporan.detail_laporan_transaksi', compact('data'));
    }
}
