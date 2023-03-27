<?php

namespace App\Http\Controllers;

use App\Models\Tkrk;
use PDF;
use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TkrkController extends Controller
{
    public function create($id)
    {
        $data = Tpermohonan::find($id);
        return view('pemohon.krk_kkpr.create', compact('data', 'id'));
    }

    public function store(Request $req, $id)
    {

        $req->validate([
            'nama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'no' => 'required',
            'jalan' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'telepon' => 'required',
            'atas_nama' => 'required',
            'kelurahan2' => 'required',
            'kecamatan2' => 'required',
            'luas_tanah' => 'required',
            'jenis_peruntukan' => 'required',
            'lampiran1'  => 'mimes:pdf,jpe,jpeg,png|max:1024',
            'lampiran2'  => 'mimes:pdf,jpe,jpeg,png|max:1024',
            'lampiran3'  => 'mimes:pdf,jpe,jpeg,png|max:1024',
            'lampiran4'  => 'mimes:pdf,jpe,jpeg,png|max:1024',
            'lampiran5'  => 'mimes:pdf,jpe,jpeg,png|max:1024',
            'lampiran6'  => 'mimes:pdf,jpe,jpeg,png|max:1024',
        ]);
        $req->flash();


        $file1 = $req->lampiran1 == null ? null : 'LAMPIRAN1_' . $id . '.' . $req->lampiran1->getClientOriginalExtension();
        $file2 = $req->lampiran2 == null ? null : 'LAMPIRAN2_' . $id . '.' . $req->lampiran2->getClientOriginalExtension();
        $file3 = $req->lampiran3 == null ? null : 'LAMPIRAN3_' . $id . '.' . $req->lampiran3->getClientOriginalExtension();
        $file4 = $req->lampiran4 == null ? null : 'LAMPIRAN4_' . $id . '.' . $req->lampiran4->getClientOriginalExtension();
        $file5 = $req->lampiran5 == null ? null : 'LAMPIRAN5_' . $id . '.' . $req->lampiran5->getClientOriginalExtension();
        $file6 = $req->lampiran6 == null ? null : 'LAMPIRAN6_' . $id . '.' . $req->lampiran6->getClientOriginalExtension();

        if ($req->hasFile('lampiran1')) {
            $req->lampiran1->storeAs('/public/krk/' . $id, $file1);
        }
        if ($req->hasFile('lampiran2')) {
            $req->lampiran2->storeAs('/public/krk/' . $id, $file2);
        }
        if ($req->hasFile('lampiran3')) {
            $req->lampiran3->storeAs('/public/krk/' . $id, $file3);
        }
        if ($req->hasFile('lampiran4')) {
            $req->lampiran4->storeAs('/public/krk/' . $id, $file4);
        }
        if ($req->hasFile('lampiran5')) {
            $req->lampiran5->storeAs('/public/krk/' . $id, $file5);
        }
        if ($req->hasFile('lampiran6')) {
            $req->lampiran6->storeAs('/public/krk/' . $id, $file6);
        }

        $attr = $req->all();
        $attr['t_permohonan_id'] = $id;
        $attr['lampiran1'] = $file1;
        $attr['lampiran2'] = $file2;
        $attr['lampiran3'] = $file3;
        $attr['lampiran4'] = $file4;
        $attr['lampiran5'] = $file5;
        $attr['lampiran6'] = $file6;

        Tkrk::create($attr);
        Session::flash('success', 'Pengajuan KRK/KKPR berhasil Di Simpan');
        return redirect('/pemohon/' . $id . '/berkas');
    }

    public function edit($id, $krk_id)
    {
        $data = Tpermohonan::find($id);
        $krk  = Tkrk::find($krk_id);
        return view('pemohon.krk_kkpr.edit', compact('data', 'id', 'krk', 'krk_id'));
    }

    public function update(Request $req, $id, $krk_id)
    {
        $attr = $req->all();
        $attr['t_permohonan_id'] = $id;

        Tkrk::find($krk_id)->update($attr);
        Session::flash('success', 'Pengajuan KRK/KKPR berhasil Di Update');
        return redirect('/pemohon/' . $id . '/berkas');
    }

    public function pdf($id, $krk_id)
    {
        $data = Tkrk::find($krk_id);
        if ($data->status == 0) {
            Session::flash('error', 'Status Masih di proses belum bisa di print');
            return back();
        } else {

            $pdf = PDF::loadView('admin.krk.pdf', compact('data'))->setPaper('legal');
            return $pdf->stream();
        }
    }
}
