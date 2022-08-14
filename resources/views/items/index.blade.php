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
    <h1 class="h3 mb-0 text-dark font-weight-bold">Kelola Items</h1>
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
<button data-toggle="modal" data-target="#modalAdd" class="mb-4 btn btn-primary">Tambah Data</button>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Sheet</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->sheets->count()}}</td>
                        <td>
                            <div style="gap:5px" class="d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-sm btn-warning" onclick="editData(this)" data-name="{{$item->name}}" data-slug="{{$item->slug}}">Edit</button>

                                <form action="{{route('items.destroy',$item->slug)}}" method="post" class="d-inline-block" onclick="handledDelete(this)">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-sm btn-danger" type="button">
                                        Hapus
                                    </button>
                                </form>

                                <a href="{{route('items.show',$item->slug)}}" class="btn btn-sm btn-info ">Detail</a>


                            </div>

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

<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="modalAddLabel">Form Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('items.store')}}" method="post" onsubmit="handledSubmit(this,'.save-data')">
                    @csrf
                    <div class="form-group">
                        <label for="nama_item">Nama Item</label>
                        <input class="form-control form-control-lg" type="text" name="nama_item" id="nama_item" required autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary save-data float-right">Simpan</button>
                </form>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="modalEditLabel">Form Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="form-update" onsubmit="handledSubmit(this,'.edit-data')">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="nama_item">Nama Item</label>
                        <input class="form-control form-control-lg" type="text" name="nama_item" id="nama_item" required autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary edit-data float-right">Update</button>
                </form>
            </div>


        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function editData(el) {
        let url = `{{route('items.update','slug')}}`;
        const name = el.getAttribute('data-name');
        const slug = el.getAttribute('data-slug');
        url = url.replace('slug', slug);
        $('#modalEdit input#nama_item').val(name)
        $('.form-update').attr('action', url)
        $('#modalEdit').modal('show')
    }

    function handledDelete(form) {
        const ask = confirm('Apakah anda yakin ?');
        if (ask) {
            form.children[2].disabled = true;
            form.children[2].textContent = 'Loading...';
            return form.submit();
        }
        return false;
    }
</script>
@endsection