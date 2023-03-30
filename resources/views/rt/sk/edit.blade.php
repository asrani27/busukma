@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/rt/sk" class="btn btn-flat btn-default bg-purple"><i class="fa fa-backward"></i> Kembali</a> <br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Edit Data Surat Kematian</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/rt/sk/edit/{{$data->id}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Surat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor" placeholder="Nomor Surat" value="{{$data->nomor}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Surat</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="dibuat" value="{{$data->dibuat}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <strong>Yang bertanda Tangan Di Bawah Ini :</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik" placeholder="NIK" value="{{$data->nik}}"required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$data->nama}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="jkel" class="form-control" required>
                                <option value="" selected>-pilih-</option>
                                <option value="L" {{$data->jkel == 'L' ? 'selected':''}}>L</option>
                                <option value="P" {{$data->jkel == 'P' ? 'selected':''}}>P</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" value="{{$data->alamat}}" placeholder="Alamat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Umur</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="umur" value="{{$data->umur}}"  placeholder="umur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <strong>Telah Meninggal Dunia Pada :</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hari</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="hari" value="{{$data->hari}}" placeholder="hari" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" value="{{$data->tanggal}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Di</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="di" placeholder="di" value="{{$data->di}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Disebabkan Karena</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sebab" placeholder="sebab" value="{{$data->sebab}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <strong>Surat kematian ini dibuat atas dasar yang sebenarnya,</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pelapor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pelapor" placeholder="pelapor" value="{{$data->pelapor}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hubungan dgn yg meninggal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="hubungan" placeholder="hubungan" value="{{$data->hubungan}}" required>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn bg-purple pull-right" onclick="return confirm('Yakin sudah sesuai?');"><i class="fa fa-save"></i> Update Data</button>
                </div>
                <!-- /.box-footer -->
            </form>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')

@endpush