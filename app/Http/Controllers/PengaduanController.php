<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pengaduan;
class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $req)
    {
        $data = Pengaduan::create([
            'user_id' => $req->input('user_id'),
            'nama' => $req->input('nama'),
            'nik' => $req->input('nik'),
            'tanggal_lahit' => $req->input('tanggal_lahit'),
            'pekerjaan' => $req->input('pekerjaan'),
            'alamat' => $req->input('alamat'),
            'sasaran' => $req->input('sasaran'),
            'isi' => $req->input('isi'),
            'alternatif' => $req->input('alternatif'),
        ]);

        $data->save();
        return back();
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
        $data = Pengaduan::findOrFail($id);
        $data->user_id = $req->input('user_id');
        $data->nama = $req->input('nama');
        $data->nik = $req->input('nik');
        $data->tanggal_lahit = $req->input('tanggal_lahit');
        $data->pekerjaan = $req->input('pekerjaan');
        $data->alamat = $req->input('alamat');
        $data->sasaran = $req->input('sasaran');
        $data->isi = $req->input('isi');
        $data->alternatif = $req->input('alternatif');

        $data->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengaduan::findOrFail($id);
        $data->detele();
        return back();
    }
}