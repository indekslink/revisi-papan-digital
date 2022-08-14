@extends('layouts')


@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Kelola Presentasi</h1>
</div>
@endsection


@section('content')


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil !!!</strong> {{ session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif

<a href="{{route('presentation.create')}}" class="btn btn-primary mb-4">Atur Data Presentasi</a>

<div class="card shadow-sm">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4>List Data Preview</h4>
                <div class="text-gray-600">Berikut adalah list serta urutan data yang siap untuk di presentasikan</div>
            </div>
            <button class="btn rounded-pill btn-lg btn-outline-primary" {{$lists->count() == 0 ? 'disabled'  :''  }}>
                <i class="fas fa-play"></i> Play Preview
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Urutan</th>
                    <th>Nama Sheet</th>
                    <th>Sheet dari Item</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lists as $list)
                <tr>
                    <td>{{$list->order}}</td>
                    <td>{{$list->sheet->title}}</td>
                    <td>{{$list->sheet->item->name}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Data masih kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection