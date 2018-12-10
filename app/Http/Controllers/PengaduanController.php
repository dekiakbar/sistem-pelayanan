<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pengaduan;
use Auth;
use DB;
use Excel;
use App\User;
class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $datas = Pengaduan::where('status','pending')->orderBy('created_at','desc')->paginate(10);
        if (Auth::user()->roles->first()->name == "Kepala Desa") {
            return view('kades.pengaduan.index',compact('datas'))->with('no',($req->input('page',1)-1)*10);
        }else{
            return view('admin.pengaduan.index',compact('datas'))->with('no',($req->input('page',1)-1)*1);
        }   
    }

    public function indexAcc(Request $req)
    {
        $datas = Pengaduan::with('user')->where('status','acc')->orderBy('created_at','desc')->paginate(10);
        $export = Pengaduan::whereRaw('status = "acc"')
                  ->select(DB::raw('count(id) as `data`'),DB::raw("MONTH(created_at) as month,YEAR(created_at) as year"))
                  ->groupby('month','year')->orderBy('year','desc')->orderBy('month','desc')->get();

        $user = User::whereHas('roles',function($q){
                    $q->where('role_id',3);
                })->orWhereHas('roles',function($q){
                    $q->where('role_id',2);
                })->get();

        if (Auth::user()->roles->first()->name == "Kepala Desa") {
            return view('kades.pengaduan.indexAcc',compact('datas','export','user'))->with('no',($req->input('page',1)-1)*10);
        }else{
            return view('admin.pengaduan.indexAcc',compact('datas','export','user'))->with('no',($req->input('page',1)-1)*10);
        }
    }

    public function acc(Request $req)
    {
        $data = Pengaduan::findOrFail($req->id);

        $data->status = "acc";

        $data->save();
        return back();
    }
    
    public function csv(Request $r)
    {
        $q = explode('-', $r->input('export'));
        $datas = Pengaduan::whereRaw('YEAR(created_at) ='.$q[1])->whereRaw('MONTH(created_at) ='.$q[0])->get();
        return Excel::loadView('excel.pengaduan',compact('datas'))
                        ->setTitle("Laporan Bulanan")
                        ->sheet(bulan($q[1]).'-'.$q[0])
                        ->export('xls');
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
            'user_id' => Auth::id(),
            'nama' => $req->input('nama'),
            'nik' => $req->input('nik'),
            'tanggal_lahir' => date('Y-m-d',strtotime($req->input('tanggal_lahir'))),
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $data = Pengaduan::findOrFail($id);
        $data->user_id       = Auth::id();
        $data->nama          = $req->input('nama');
        $data->nik           = $req->input('nik');
        $data->tanggal_lahir = date('Y-m-d',strtotime($req->input('tanggal_lahir')));
        $data->pekerjaan     = $req->input('pekerjaan');
        $data->alamat        = $req->input('alamat');
        $data->sasaran       = $req->input('sasaran');
        $data->isi           = $req->input('isi');
        $data->alternatif    = $req->input('alternatif');

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
        $data->delete();
        return back();
    }
}
