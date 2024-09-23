<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\kategori;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari_product = $request->cari_product;
        $kategori = kategori::all();
        if (strlen($cari_product)) {
            $data = product::where('nama_product', 'like', "%$cari_product%")->orWhere('harga', 'like', "%$cari_product%")->orWhere('stock', 'like', "%$cari_product%")->paginate(3);
        } else {
            $data = product::with('kategori')->paginate(4);
        }
        return view('product.halaman_product', compact('data', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  return view('app.form_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_product' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ], [
            'nama_product.required' => "Nama product wajib diisi",
            'harga.required' => 'Harga wajib diisi',
            'stock.required' => 'stock wajib diisi',
        ]);
        $data = [
            'nama_product' => $request->nama_product,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'id_kategori' => $request->id_kategori,
        ];
        product::create($data);
        return redirect()->back()->with('success', "Berhasil menambahkan data");
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
        if (Auth::user()->role == 'admin') {
            $data = product::where('id_product', $id)->first();
            $kategori = kategori::all();
            return view('product.edit_product', compact('data', 'kategori'));
        } else {
            return redirect()->to('product')->with('danger', 'anda tidak diperbolehkan');
        }
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
        $request->validate([
            'nama_product' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ], [
            'nama_product.required' => "Nama product wajib diisi",
            'harga.required' => 'Harga wajib diisi',
            'stock.required' => 'stock wajib diisi',
        ]);
        $data = [
            'nama_product' => $request->nama_product,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'id_kategori' => $request->id_kategori,
        ];
        product::where('id_product', $id)->update($data);
        return redirect('product')->with('success', "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::where('id_product', $id)->delete();
        return redirect()->back()->with('success', "Berhasil menambahkan data");
    }
}
