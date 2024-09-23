<?php
// controller
namespace App\Http\Controllers;

use App\Models\detailpenjualan;
use App\Models\member;
use App\Models\penjualan;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;


class transaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $all_products = product::all();
        $all_members = member::all();
        $selected_product = $request->selected_product;
        $selected_member = $request->selected_member;
        $tambah_product = session('tambah_product', []);
        if (!empty($selected_product)) {
            $tambah_product[] = $selected_product;
            session(['tambah_product' => $tambah_product]);
        }
        $data = product::whereIn('id_product', $tambah_product)->get();
        // Ambil data jumlah_beli dan sub_total dari session
        $jumlah_beli = session('jumlah_beli', []);
        $sub_total = session('sub_total', []);

        return view('transaksi.halaman_transaksi', compact('data', 'all_products', 'all_members', 'jumlah_beli', 'sub_total', 'tambah_product', 'selected_member'));
    }

    public function updateSession(Request $request)
    {
        // menangani penyimpanan data jumlah_beli dan sub_total ke session.
        $id_product = $request->id_product;
        $jumlah_beli = $request->jumlah_beli;
        $sub_total = $request->sub_total;

        // Simpan jumlah_beli dan sub_total ke session
        $jumlah_beli_session = session('jumlah_beli', []);
        $sub_total_session = session('sub_total', []);

        $jumlah_beli_session[$id_product] =  $jumlah_beli;
        $sub_total_session[$id_product] = $sub_total;

        session(['jumlah_beli' => $jumlah_beli_session]);
        session(['sub_total' => $sub_total_session]);

        return response()->json(['success' => true]);
    }

    public function deleteProduct($id)
    {
        // Hapus produk dari session
        $tambah_product = session('tambah_product', []);

        // Filter produk yang tidak dihapus
        $updatedProducts = array_filter($tambah_product, function ($productId) use ($id) {
            return $productId != $id;
        });

        // Hapus juga jumlah_beli dan sub_total untuk produk yang dihapus
        $jumlah_beli = session('jumlah_beli', []);
        $sub_total = session('sub_total', []);

        unset($jumlah_beli[$id]);
        unset($sub_total[$id]);

        // Update session dengan produk yang tersisa
        session(['tambah_product' => array_values($updatedProducts)]);
        session(['jumlah_beli' => $jumlah_beli]);
        session(['sub_total' => $sub_total]);

        return response()->json(['success' => true]);
    }

    // Fungsi untuk menghapus semua produk
    public function deleteAllProduct()
    {
        session()->forget('tambah_product');
        session()->forget('jumlah_beli');
        session()->forget('sub_total');
        return redirect('transaksi');
    }
    public function simpanTransaksi(Request $request)
    {
        // validasi input
        $request->validate([
            'jumlah_bayar' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        // Variabel untuk menampung produk dengan stok tidak mencukupi
        $stok_kurang = [];

        $jumlah_beli = $request->input('jumlah_beli', []);
        $sub_total = $request->input('sub_total', []);

        // Periksa stok semua produk terlebih dahulu sebelum melakukan transaksi
        foreach ($jumlah_beli as $id_product => $jumlah) {
            $product = product::find($id_product);

            // Cek apakah stok mencukupi
            if (!$product || $jumlah > $product->stock) {
                $stok_kurang[] = $product->nama_product;
            }
        }

        // Jika ada produk yang stoknya kurang, tidak simpan transaksi
        if (!empty($stok_kurang)) {
            $nama_produk_kurang = implode(', ', $stok_kurang);
            return redirect('transaksi')->with('danger', "Stok untuk produk berikut tidak mencukupi: $nama_produk_kurang");
        }

        // Jika semua stok mencukupi, lanjutkan proses simpan transaksi
        DB::beginTransaction();
        try {
            // Simpan ke tabel penjualan
            $penjualan = new penjualan();

            $penjualan->total_harga =  $request->total_harga;
            $penjualan->tanggal_penjualan = now();
            $penjualan->id_member = $request->id_member;
            $penjualan->diskon = $request->diskon;
            $penjualan->jumlah_bayar = $request->jumlah_bayar;
            $penjualan->kembalian = $request->kembalian;
            $penjualan->save();

            foreach ($jumlah_beli as $id_product => $jumlah) {
                // Simpan detail penjualan
                $detail_penjualan = new detailpenjualan();
                $detail_penjualan->id_penjualan = $penjualan->id_penjualan;
                $detail_penjualan->id_product = $id_product;
                $detail_penjualan->jumlah_product = $jumlah;
                $detail_penjualan->sub_total = $sub_total[$id_product] ?? 0;
                $detail_penjualan->save();

                // Kurangi stok produk
                $product = product::find($id_product);
                $product->stock -= $jumlah;
                $product->save();
            }

            DB::commit(); // Simpan semua perubahan

            // Hapus session setelah transaksi berhasil
            session()->forget('tambah_product');
            session()->forget('jumlah_beli');
            session()->forget('sub_total');

            $jumlah_bayar = $request->jumlah_bayar;
            $kembalian = $request->kembalian;

            $diskon = null;

            if ($request->diskon) {
                $diskon = $request->diskon;
            }

            $penjualan = penjualan::with('detailpenjualan.product', 'member')->find($penjualan->id_penjualan);

            $pdf = PDF::loadView('transaksi.struk_pdf', compact('penjualan', 'jumlah_bayar', 'kembalian', 'diskon'));

            // Simpan sementara di storage/public untuk diakses
            $pdfPath = 'struks/struk-transaksi' . time() . '.pdf';
            Storage::disk('public')->put($pdfPath, $pdf->output());

            // Simpan URL file PDF untuk download dan ditampilkan
            $pdfUrl = Storage::url($pdfPath);

            // Redirect dengan notifikasi dan link PDF
            return redirect()->back()->with([
                'success' => 'Transaksi berhasil disimpan!',
                'pdfUrl' => $pdfUrl
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('transaksi')->with('error', 'Terjadi kesalahan saat menyimpan transaksi.');
        }
    }

    public function downloadStruk($filename)
    {
        $filePath = storage_path("app/public/struks/{$filename}");

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File tidak ditemukan.');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
