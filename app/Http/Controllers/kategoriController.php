<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use App\Models\product;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari_kategori = $request->cari_kategori;
        if (strlen($cari_kategori)) {
            $data = kategori::where('nama_kategori', 'like', "%$cari_kategori%")->withCount('product')->paginate(3);
        } else {
            $data = kategori::withCount('product')->paginate(3);
        }
        return view('kategori.halaman_kategori', (compact('data')));
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
        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];
        kategori::create($data);
        return redirect()->to('kategori')->with('success', 'berhasil menambahkan data');
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
        $data = kategori::where('id_kategori', $id)->first();
        return view('kategori.edit_kategori', compact('data'));
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
        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];
        kategori::where('id_kategori', $id)->update($data);
        return redirect()->to('kategori')->with('success', 'berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kategori::where('id_kategori', $id)->delete();
        return redirect()->to('kategori')->with('success', 'berhasil menghapus data');
    }
}
