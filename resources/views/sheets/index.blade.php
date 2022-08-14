@extends('layouts')

@section('style')
<style>
    table th,
    table td {
        vertical-align: middle !important;
    }
</style>
@endsection

@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Kelola Sheets</h1>
</div>
@endsection


@section('content')
@error('nama_item')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Gagal !!!</strong> {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@enderror

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil !!!</strong> {{ session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif
<a href="{{route('sheets.create')}}" class="mb-4 btn btn-primary">Tambah Data</a>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <!-- <th>Nama Item</th> -->
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sheets as $sheet)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$sheet->title}}</td>
                        <td>{{$sheet->subtitle}}</td>
                        <!-- <td>{{$sheet->item->name}}</td> -->
                        <td>
                            <a href="{{route('sheets.show',$sheet->slug)}}" class="btn btn-sm btn-info ">Detail</a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Data masih kosong</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection