<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class kasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari_kasir = $request->cari_kasir;
        if (strlen($cari_kasir)) {
            $data = User::where('name', 'like', "%$cari_kasir%")->paginate(3);
        } else {
            $data = User::where('role', 'kasir')->paginate(4);
        }
        return view('kasir.halaman_kasir', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_telepon' => $request->no_telepon,
            'role' => 'kasir',
        ];
        User::create($data);
        return redirect()->to('kasir')->with('success', 'data berhasil di tambahkan');
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
        $data = User::where('email', $id)->first();
        return view('kasir.edit_kasir', compact('data'));
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
            'name' => $request->name,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        User::where('email', $id)->update($data);

        return redirect()->to('kasir')->with('success', 'data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('email', $id)->delete();
        return redirect()->to('kasir');
    }
}
