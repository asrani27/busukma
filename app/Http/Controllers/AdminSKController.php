<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lurah;
use App\Models\Kematian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;

class AdminSKController extends Controller
{
    public function index()
    {
        $data = Kematian::orderBy('id', 'DESC')->paginate(15);
        return view('admin.sk.index', compact('data'));
    }
    public function create()
    {
        $lurah = Lurah::first();
        return view('admin.sk.create', compact('lurah'));
    }
    public function edit($id)
    {
        $data = Kematian::find($id);
        return view('admin.sk.edit', compact('data'));
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
            Kematian::create($req->all());
            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/sk');
        } else {
            Session::flash('error', 'NIK ini sudah pernah di input');
            return back();
        }
    }
    public function update(Request $req, $id)
    {
        Kematian::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/sk');
    }
    public function cetak($id)
    {
        $data = Kematian::find($id);

        $word = new TemplateProcessor('surat_kematian.docx');
        $word->setValues([
            'nomor' => $data->nomor,
            'nik' => $data->nik,
            'nama' => $data->nama,
            'jkel' => $data->jkel,
            'alamat' => $data->alamat,
            'umur' => $data->umur,
            'hari' => $data->hari,
            'tanggal' => Carbon::parse($data->tanggal)->translatedFormat('d F Y'),
            'di' => $data->di,
            'sebab' => $data->sebab,
            'pelapor' => $data->pelapor,
            'hubungan' => $data->hubungan,
            'dibuat' => Carbon::parse($data->dibuat)->translatedFormat('d F Y'),
            'nip_lurah' => $data->nip_lurah,
            'nama_lurah' => $data->nama_lurah,
        ]);

        $file = 'suratkematian.docx';
        $word->saveAs('suratkematian.docx');

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

        readfile($file);
    }
}
