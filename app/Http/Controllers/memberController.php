<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;

class memberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari_member = $request->cari_member;
        if (strlen($cari_member)) {
            $data = member::where('nama_member', 'like', "%$cari_member%")->paginate();
        } else {
            $data = member::paginate(4);
        }
        return view('member.halaman_member', compact('data'));
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
            'Nama_member' => $request->Nama_member,
            'Alamat' => $request->Alamat,
            'No_telepon' => $request->No_telepon,
        ];
        member::create($data);
        return redirect()->to('member')->with('success', 'data berhasil di tambahkan');
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
        $data = member::where('id_member', $id)->first();
        return view('member.edit_member', compact('data'));
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
            'Nama_member' => $request->Nama_member,
            'Alamat' => $request->Alamat,
            'No_telepon' => $request->No_telepon,
        ];
        member::where('id_member', $id)->update($data);
        return redirect()->to('member')->with('success', 'data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        member::where('id_member', $id)->delete();
        return redirect()->to('member');
    }
}
