<?php

namespace App\Http\Controllers;

use App\Models\RegistKlien;
use App\Models\RegistStatus;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('regist.index');
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
        $request->validate([

            'captcha' => 'required|captcha'
        ]);

        $storeData = [
            'id_perusahaan' => $request->input('id_perusahaan'),
            'jenis_badan_usaha' => $request->input('jenis_badan_usaha'),
            'nama_perusahaan' => $request->input('nama_perusahaan'),
            'ln_dn' => $request->input('ln_dn'),
            'nama' => $request->input('nama'),
            'posisi' => $request->input('posisi'),
            'perusahaan' => $request->input('perusahaan'),
            'email_regist' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];


        RegistKlien::create($storeData);

        $postStatus = [
            'id_pelanggan' => $request->input('id_perusahaan'),
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status' => 0,
        ];

        RegistStatus::create($postStatus);

        $post = [
            'kode_pengguna' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'nama_pengguna' => $request->input('nama_perusahaan'),
            'email' => $request->input('email'),
            'id_perusahaan' => $request->input('id_perusahaan'),
            'id_unit_kerja' => 99,
            'status' => 1
        ];

        Pengguna::create($post);

        return redirect('regist')->with('alert-success', 'Registrasi Berhasil')->withInput();
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
