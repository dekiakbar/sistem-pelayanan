<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\User;
use Auth;

use App\Ktp;
use App\Skk;
use App\Pengaduan;
use App\Sk;
use App\Skematian;
use App\Sktm;
use App\Sptjm;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $nKtp       = Ktp::where('status','=','pending')->count();
        $nPengaduan = Pengaduan::where('status','=','pending')->count();
        $nSk        = Sk::where('status','=','pending')->count();
        $nSkematian = Skematian::where('status','=','pending')->count();
        $nSkk       = Skk::where('status','=','pending')->count();
        $nSktm      = Sktm::where('status','=','pending')->count();
        $nSptjm     = Sptjm::where('status','=','pending')->count();
        
        $datas = Kategori::Where('slug','!=','peraturan-desa')
                 ->Where('slug','!=','keuangan-desa')
                 ->Where('slug','!=','kekayaan-desa')
                 ->Where('slug','!=','pengurus-bpd')
                 ->Where('slug','!=','pengurus-lpm')
                 ->Where('slug','!=','pengurus-pkk')
                 ->Where('slug','!=','karang-taruna')
                 ->Where('slug','!=','rw-rt')
                 ->Where('slug','!=','kader-posyandu')
                 ->Where('slug','!=','linmas')
                 ->Where('slug','!=','mui-desa')
                 ->Where('slug','!=','gapoktan')
                 ->paginate(10);
        if (Auth::user()->roles->first()->name == "Kepala Desa") {
            return view('kades.kategori.index',compact('datas','nKtp','nPengaduan','nSk','nSkematian','nSkk','nSktm','nSptjm'))->with('no',($req->input('page',1)-1)*10);
        }else{
            return view('admin.kategori.index',compact('datas','nKtp','nPengaduan','nSk','nSkematian','nSkk','nSktm','nSptjm'))->with('no',($req->input('page',1)-1)*10);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Kategori::insert([
            'nama' => $request->input('nama'),
            'slug' => slugify($request->input('nama')),
        ]);
        if ($data){
            session()->flash('status','Sukses');
            session()->flash('pesan','Kategori berhasil di simpan');
        }else{
            session()->flash('status','Gagal');
            session()->flash('pesan','Kategori gagal di simpan');
        }
        return back();
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
        $data = Kategori::findOrFail($id);
        $data->nama = $request->input('nama');
        $data->slug = slugify($request->input('nama'));
        if ($data->save()) {
            session()->flash('status','Sukses');
            session()->flash('pesan','Kategori berhasil di ubah');
        }else{
            session()->flash('status','Gagal');
            session()->flash('pesan','Kategori gagal di ubah');
        }
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
        $data = Kategori::findOrFail($id);
        if ($data->delete()) {
            session()->flash('status','Sukses');
            session()->flash('pesan','Kategori berhasil di hapus');
        }else{
            session()->flash('status','Gagal');
            session()->flash('pesan','Kategori gagal di hapus');
        }
        return back();
    }
}
