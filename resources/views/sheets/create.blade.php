@extends('layouts')


@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Tambah Data Sheets</h1>
    <button class="btn btn-lg btn-primary" type="button" onclick="simpanData(this)">
        Simpan Data
    </button>
</div>
@endsection


@section('content')
<div class="parent-error mb-4 d-none">

</div>
<div class="row">
    <div class="col-12">
        <form action="{{route('sheets.store')}}" method="post" id="formAdd">
            @csrf
            <div class="row">
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control form-control-lg value-add" name="title" id="title">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="form-group">
                        <label for="subtitle">Sub Title</label>
                        <input type="text" class="form-control form-control-lg value-add" name="subtitle" id="subtitle">
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="form-group">
                        <label for="item_id">Items</label>
                        <select class="form-control form-control-lg value-add" name="item_id" id="item_id">
                            <option value="" disabled selected>Pilih Salah Satu</option>
                            @foreach($items as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="content">Content</label>
                    <div class="accordion" id="accordion-content">
                        <div class="shadow-sm rounded mb-3">
                            <div id="headingOne" class="custom-control custom-radio py-4 px-5 ">
                                <input type="radio" id="customRadio1" name="content" value="classic" class="custom-control-input value-content">
                                <label class="custom-control-label" for="customRadio1" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">Classic</label>
                                <div style="font-size: 13px;" class="text-gray-600">
                                    Membuat isi konten layaknya anda membuat Dokumen menggunakan Aplikasi Word / Aplikasi Edit dokumen pada umum nya
                                </div>

                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-content">
                                <div class="card-body">

                                    <!-- The toolbar will be rendered in this container. -->
                                    <div id="toolbar-container"></div>

                                    <!-- This container will become the editable. -->
                                    <div id="editor">
                                        <p>Silahkan isi konten disini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shadow-sm rounded">

                            <div id="headingTwo" class="custom-control custom-radio py-4 px-5 ">
                                <input type="radio" id="customRadio2" name="content" class="custom-control-input value-content" value="advance">
                                <label class="custom-control-label" for="customRadio2" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">Advance</label>
                                <div style="font-size: 13px;" class="text-gray-600">
                                    Membuat isi dengan menggunakan layanan aplikasi pihak ketiga (Canva), yang dimana nanti link outputnya akan di pakai oleh Web Papan Digital
                                </div>

                            </div>
                            <div id="collapseTwo" class="collapse pt-3" aria-labelledby="headingTwo" data-parent="#accordion-content">
                                <div class="card-body">
                                    <p>Silahkan buka website <a href="https://canva.com">Canva</a> dan buat desain, konten yang Anda mau</p>

                                    <div>
                                        Setelah selesai membuat desain konten yang Anda inginkan , Silahkan paste link output pada form dibawah :
                                        <div class="form-group row">
                                            <label for="inputLink" class="col-sm-2 col-form-label">Link output canva</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" onkeyup="previewCanva(this)" onkeydown="previewCanva(this)" onchange="previewCanva(this)" id="inputLink">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="preview-canva d-none">
                                        <div>Preview : <a href="" target="_blank">Lihat</a></div>
                                        <iframe src="" frameborder="0" class="w-100"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="content_value" id="content_value">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/decoupled-document/ckeditor.js"></script>

<script>
    let dataEditor = '';
    DecoupledEditor
        .create(document.querySelector('#editor'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .then(editor => {
            const toolbarContainer = document.querySelector('#toolbar-container');

            toolbarContainer.appendChild(editor.ui.view.toolbar.element);

            editor.model.document.on('change:data', () => {
                dataEditor = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });


    function previewCanva(el) {
        const val = el.value;
        const parent = document.querySelector('.preview-canva');
        if (val == '') {
            return parent.classList.add('d-none');
        }
        parent.classList.remove('d-none');
        parent.children[0].children[0].href = val;
        parent.children[1].src = val;
    }

    function simpanData(el) {
        el.disabled = true;
        el.textContent = 'Loading';
        let data = {};
        // berisi element input title,subtitle, dan id items
        let valueAdd = Array.from(document.querySelectorAll('.value-add'));
        valueAdd = valueAdd.map(el => {
            return {
                [el.name]: el.value
            }
        })
        data = Object.assign({}, ...valueAdd)


        let valueContent = document.querySelectorAll('.value-content');
        valueContent.forEach(el => {
            if (el.checked) {
                data[el.name] = el.value;
            }
        })

        const hasError = validate(data);
        if (hasError.length > 0) {
            el.disabled = false;
            el.textContent = 'Simpan Data';
            return handledError(hasError);
        }

        const inputContent = document.querySelector('#content_value')
        if (data.content == 'classic') {
            inputContent.value = dataEditor
        } else {
            inputContent.value = document.querySelector('#inputLink').value;
        }


        document.querySelector('#formAdd').submit();
    }

    function validate(data) {
        const requiredField = ['title', 'subtitle', 'item_id', 'content'];
        let msg = [];
        requiredField.forEach(field => {

            // jika field tidak ada atau field ada namun tidak ada isinya
            if (!(field in data) || data[field] == '') {
                msg.push(`${field} harus di isi`);
            }
        })

        return msg;
    }

    function handledError(errors) {
        const parentError = document.querySelector('.parent-error');
        parentError.innerHTML = ''
        parentError.classList.remove('d-none');
        errors.forEach(error => $(parentError).append(myAlert('danger', error)));
    }
</script>
@endsection