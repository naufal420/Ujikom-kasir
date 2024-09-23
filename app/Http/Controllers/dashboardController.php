<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\member;
use App\Models\penjualan;
use App\Models\User;

function hitung_total($total_data)
{
  $total = 0;
  foreach ($total_data as $item) {
    $total++;
  }
  return $total;
}
class dashboardController extends Controller
{
  public function index()
  {
    $data = ['total_product' => product::all(), 'total_member' => member::all(), 'total_kasir' => User::where('role', 'kasir')->get(), 'total_transaksi' => penjualan::get()];
    $total_product = hitung_total($data['total_product']);
    $total_member = hitung_total($data['total_member']);
    $total_kasir = hitung_total($data['total_kasir']);
    $total_transaksi = hitung_total($data['total_transaksi']);
    return view('dashboard', compact('total_product', 'total_member', 'total_kasir', 'total_transaksi'));
  }
}
