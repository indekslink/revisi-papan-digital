@extends('layouts')

@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Kelola Items</h1>
</div>
@endsection



@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Detail Item</h4>
            </div>


            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <strong>Nama</strong>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    {{$item->name}}
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <strong>Jumlah Sheet</strong>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    {{$item->sheets->count()}} items
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-12 pt-5">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>List Sheets</h4>
                <a href="{{route('createSheet',$item->slug)}}" class="btn btn-primary btn-rounded-pill">Tambah Data</a>
            </div>

            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($item->sheets as $sheet)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong>{{$sheet->title}}</strong>
                            </div>
                            <div class="col-6 text-right">
                                @if($sheet->content_type == 'advance')
                                <a href="{{$sheet->content}}" class="btn btn-sm btn-info" target="_blank">View Link</a>

                                @else
                                <a href="{{route('presentation.show',$sheet->slug)}}" class="btn btn-sm btn-info" target="_blank">Preview</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="text-center text-danger">
                        Sheet masih kosong
                    </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection