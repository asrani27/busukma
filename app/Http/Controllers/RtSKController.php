<?php

namespace App\Http\Controllers;

use App\Models\Lurah;
use App\Models\Kematian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RtSKController extends Controller
{
    public function index()
    {
        $data = Kematian::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);
        return view('rt.sk.index', compact('data'));
    }
    public function create()
    {
        $lurah = Lurah::first();
        return view('rt.sk.create', compact('lurah'));
    }
    public function edit($id)
    {
        $data = Kematian::find($id);
        return view('rt.sk.edit', compact('data'));
    }
    public function delete($id)
    {
        $data = Kematian::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function store(Request $req)
    {
        $checkNik = Kematian::where('nik', $req->nik)->first();
        if ($checkNik == null) {
            $param = $req->all();
            $param['user_id'] = Auth::user()->id;
            Kematian::create($param);
            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/rt/sk');
        } else {
            Session::flash('error', 'NIK ini sudah pernah di input');
            return back();
        }
    }
    public function update(Request $req, $id)
    {
        Kematian::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/rt/sk');
    }
}
