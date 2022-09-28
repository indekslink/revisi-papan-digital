@extends('layouts')

@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Detail Sheet</h1>
</div>
@endsection



@section('content')

<div class="row">
    <div class="col-lg-4 col-12 ">
        <div class="card shadow">
            <div class="card-header">
                <h4>Informasi Sheet</h4>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <strong>Title</strong>
                            </div>
                            <div class="col-6 text-right">
                                {{$sheet->title}}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <strong>Sub Title</strong>
                            </div>
                            <div class="col-6 text-right">
                                {{$sheet->subtitle}}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-12 text-center">
                                <a href="{{route('sheets.edit',$sheet->slug)}}" class="btn mr-3 btn-warning btn-sm">Edit</a>
                                <form class="d-inline-block" action="{{route('sheets.edit',$sheet->slug)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn mr-3 btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-12 pt-5 pt-lg-0">
        <div class="card shadow">
            <div class="card-header">
                <h4>Preview Content</h4>
            </div>
            <div class="card-body">
                @if($sheet->content_type == 'advance')

                <iframe src="{{$sheet->content}}" class="w-100" frameborder="0"></iframe>

                @else

                <iframe src="{{route('presentation.show',$sheet->slug)}}" class="w-100" frameborder="0"></iframe>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    document.querySelector('iframe').height = window.innerHeight + 'px';
</script>

@endsection