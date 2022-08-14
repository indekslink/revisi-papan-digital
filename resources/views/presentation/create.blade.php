@extends('layouts')


@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Atur Data Presentasi</h1>
</div>
@endsection

@section('content')

<div class="alert alert-success mb-4" role="alert">
    <h4 class="alert-heading font-weight-bold">Informasi !!!</h4>
    <p>Untuk menampilkan data presentasi, Anda hanya perlu mengisi <b>no urut</b> pada baris sheet yang tersedia</p>
</div>

<div class="btn-group w-100 mb-4 btn-group-lg">
    <button class="btn btn-primary">Simpan</button>
    <button class="btn btn-danger">Reset No Urut</button>
</div>

<div>
    @forelse($itemAndSheets as $list)
    <div class="card mb-2">
        <div class="card-header">
            <h5 class="mb-0">
                {{$list->name}}
            </h5>
        </div>
        @if($list->sheets->count()>0)
        <div class="card-body">
            @foreach($list->sheet as $sheet)
            <div class="row align-items-center">
                <div class="col-2">
                    <input type="number" class="form-control" name="order">
                </div>
                <div class="col-10">
                    {{$sheet->title}}
                </div>
            </div>
        </div>
        @endif
    </div>

    @empty
    <div class="text-center">
        Data Item masih kosong, Silahkan buat Item terlebih dahulu
    </div>
    @endforelse
</div>

@endsection