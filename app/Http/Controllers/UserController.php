<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $datas = User::with('roles')->paginate(10);        
        return view('admin.user.indexUser',compact('datas'))->with('no',($req->input('page',1)-1)*10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('admin.user.tambahUser',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
          'name'     => $request->input('name'),
          'email'    => $request->input('email'),
          'password' => bcrypt($request->input('password')),
        ]);
        
        $user->roles()->attach(Role::where('id', $request->input('role'))->first());

        return redirect()->route('pengguna.create');
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
        $data = User::findOrFail($id);
        $data->name     = $request->input('name');
        $data->email    = $request->input('email');
        $data->password = $data->password;
        $data->save();
        $data->roles()->attach($data->roles->first());

        return redirect()->route('pengguna.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->roles()->detach();
        $data->delete();
        return redirect()->route('pengguna.index');
    }
}