@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Surat Kematian</h3>

            <div class="box-tools">
              <a href="/rt/sk/create" class="btn btn-flat btn-sm btn-default bg-purple"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Sebab</th>
                <th>pelapor</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{\Carbon\Carbon::parse($item->dibuat)->format('d-m-Y')}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->sebab}}</td>
                <td>{{$item->pelapor}}</td>
                <td>
                  <a href="/rt/sk/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-default bg-purple"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/rt/sk/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-default bg-purple" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                  
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
