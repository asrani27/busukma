<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RtController extends Controller
{
    public function index()
    {
        $data = Rt::orderBy('id', 'DESC')->paginate(15);
        return view('admin.rt.index', compact('data'));
    }
    public function create()
    {
        return view('admin.rt.create');
    }
    public function edit($id)
    {
        $data = Rt::find($id);
        return view('admin.rt.edit', compact('data'));
    }
    public function store(Request $req)
    {
        $check = Rt::where('nomor', $req->nomor)->first();
        if ($check == null) {

            $role = Role::where('name', 'rt')->first();
            $rt = Rt::create($req->all());

            //buat user
            $user = new User;
            $user->name = 'RT ' . $req->nomor;
            $user->username = 'rt' . $req->nomor;
            $user->password = bcrypt('123456');
            $user->save();
            $user->roles()->attach($role);

            $rt->update(['user_id' => $user->id]);

            Session::flash('success', 'User : ' . $user->username . ', Password : 123456');
            return redirect('/superadmin/rt');
        } else {
            Session::flash('error', 'Sudah ada');
            return back();
        }
    }
    public function update(Request $req, $id)
    {
        Rt::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Diupdate ');
        return redirect('/superadmin/rt');
    }
    public function delete($id)
    {
        Rt::find($id)->user->delete();
        Rt::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function reset($id)
    {
        Rt::find($id)->user->update(['password' => bcrypt('123456')]);

        Session::flash('success', 'Password : 123456');
        return back();
    }
    public function ganti_pass()
    {
        return view('rt.gp');
    }
    public function ganti_password(Request $req)
    {
        if (Hash::check($req->password_lama, Auth::user()->password)) {
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Baru Tidak sama');
                return back();
            } else {
                Auth::user()->update(['password' => bcrypt($req->password1)]);
                Session::flash('success', 'Password Berhasil Di ubah, login dengan password baru');
                Auth::logout();
                return redirect('/login');
            }
        } else {
            Session::flash('error', 'Password Lama Salah');
            return back();
        }
    }
}
