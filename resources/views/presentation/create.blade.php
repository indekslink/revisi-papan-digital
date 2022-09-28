@extends('layouts')

@section('style')
<style>
    /* Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    /* input[type=number] {
        width: 80px;
    } */
</style>
@endsection

@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Atur Data Presentasi</h1>
</div>
@endsection

@section('content')
@if($itemAndSheets->count() > 0)
<div class="alert alert-success mb-0" role="alert">
    <h4 class="alert-heading font-weight-bold">Informasi !!!</h4>
    <p>Untuk menampilkan data presentasi, Anda hanya perlu mengisi <b>no urut</b> pada baris sheet yang tersedia</p>
</div>

<div class="div py-3 my-4 d-flex justify-content-around bg-light">
    <button class="btn btn-primary  rounded-pill mr-4 btn-lg shadow" type="button" onclick="saveData(this)">Simpan Data</button>
    <button class="btn btn-outline-danger btn-lg rounded-pill  shadow" type="button" onclick="resetOrder()">Reset No Urut</button>
</div>

<div>
    @foreach($itemAndSheets as $list)
    @if($list->sheets->count() > 0)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                {{$list->name}}
            </h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($list->sheets as $sheet)
                <li class="list-group-item px-0">

                    <div class="row align-items-center">
                        <div class="col-4 col-sm-3 col-md-2 col-lg-1">
                            <input type="number" class="form-control text-center input-order" name="order" data-id="{{$sheet->id}}" value="{{$sheet->presentation ? $sheet->presentation->order : ''}}">
                        </div>
                        <div class="col-8 col-sm-9 col-md-10 col-lg-11 text-truncate">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div class="mr-5">

                                    <div class="font-weight-bold mb-1 text-truncate">
                                        {{$sheet->title}}
                                    </div>
                                    <div class="text-gray-600 text-truncate" style="font-size: 12px;">
                                        {{$sheet->subtitle}}
                                    </div>
                                </div>
                                <button onclick="showModal('#exampleModal',this)" data-href="{{route('presentation.show',$sheet->slug)}}" class="btn btn-sm btn-info my-3">View</button>
                            </div>

                        </div>
                    </div>

                </li>

                @endforeach
            </ul>
        </div>

    </div>

    @else

    <div class="alert alert-warning mb-3">
        Sheet dari item
        <b>
            {{$list->name}}
        </b>
        masih kosong
    </div>

    @endif

    @endforeach


    <form action="{{route('presentation.store')}}" method="post" id="form_store_presentation">
        @csrf
        <input type="hidden" id="data" name="data">
    </form>



</div>
<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview Sheet</h5>
                <button type="button" class="close" onclick="closeModal('#exampleModal',this)" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="" class="w-100  preview" frameborder="0"></iframe>
            </div>

        </div>
    </div>
</div>
@else
<div class="alert alert-danger text-center py-5">
    <h3>Data masih kosong, silahkan buat data terlebih dahulu</h3>
    <div class="mt-5 d-flex align-items-center justify-content-around">
        <a href="{{route('items.index')}}" class="btn btn-primary btn-lg">Buat item</a>
        <a href="{{route('sheets.create')}}" class="btn btn-info btn-lg">Buat Sheet</a>
    </div>
</div>
@endif
@endsection

@section('script')

<script>
    function showModal(id, e) {
        const iframe = document.querySelector('iframe.preview')
        const href = e.getAttribute('data-href');

        iframe.height = window.innerHeight + 'px';
        iframe.src = href;
        $(id).modal('show')
    }

    function closeModal(id, e) {
        const iframe = document.querySelector('iframe.preview');
        iframe.src = '';
        $(id).modal('hide')
    }
    let numberExist = JSON.parse(' {!! $noUrut !!} ');

    const inputOrder = document.querySelectorAll('.input-order');

    inputOrder.forEach(input => {

        input.addEventListener('keyup', function() {

            const val = input.value;
            if (val != '') {
                cekNumber(val, input);
            }
        })


    })

    function refreshNumber() {
        numberExist = [];

        inputOrder.forEach(i => {
            if (i.value) {

                numberExist.push({
                    sheet_id: i.getAttribute('data-id'),
                    order: Number(i.value)
                })
            }
        })
    }

    function cekNumber(val, el) {
        const value = Number(val);

        const orderIsExist = numberExist.map(key => key.order);

        if (orderIsExist.includes(value)) {
            el.value = '';
            alert(`No urut ${value} sudah terpakai, silahkan input nomer urut lainnya`)
        }
        refreshNumber()



    }


    function resetOrder() {
        let msg = 'Anda belum mengisi no urut';
        if (numberExist.length > 0) {
            numberExist = [];
            inputOrder.forEach(i => i.value = '');
            msg = 'No urut berhasil di reset';
        }
        alert(msg);
    }

    function saveData(btn) {
        let msg = 'Silahkan isi no urut terlebih dahulu';
        if (!(numberExist.length > 0)) {
            return alert('');
        }

        btn.disabled = true;

        const form = document.querySelector('#form_store_presentation');
        const data = document.querySelector('#form_store_presentation #data');



        data.value = JSON.stringify(numberExist);
        form.submit();
    }
</script>

@endsection