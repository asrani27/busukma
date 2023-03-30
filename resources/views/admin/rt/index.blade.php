@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data RT</h3>

            <div class="box-tools">
              <a href="/superadmin/rt/create" class="btn btn-flat btn-sm btn-default bg-purple"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>RT</th>
                <th>Nama Ketua RT</th>
                <th>Telp</th>
                <th>username</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->nomor}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->telp}}</td>
                <td>{{$item->user->username}}</td>
                <td>
                  <a href="/superadmin/rt/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-default bg-purple"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/rt/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-default bg-purple" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                  <a href="/superadmin/rt/reset/{{$item->id}}" target="_blank" class="btn btn-flat btn-sm btn-default bg-purple"><i class="fa fa-file"></i> Reset Password</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
