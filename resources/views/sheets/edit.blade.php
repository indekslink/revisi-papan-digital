@extends('layouts')


@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark font-weight-bold">Edit Data Sheets</h1>
    <button class="btn btn-lg btn-primary" type="button" onclick="simpanData(this)">
        Update Data
    </button>
</div>
@endsection


@section('content')
<div class="parent-error mb-4 d-none">

</div>
<div class="row">
    <div class="col-12">

        <div class="row">

            <div class="col-12 py-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" value="{{$sheet->title}}" class="form-control form-control-lg value-add" name="title" id="title">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="subtitle">Sub Title</label>
                                    <input type="text" value="{{$sheet->subtitle}}" class="form-control form-control-lg value-add" name="subtitle" id="subtitle">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">

                                <div class="form-group">
                                    <label for="item_id" class="font-weight-bold text-dark h5">Items</label>
                                    <select class="form-control form-control-lg value-add" name="item_id" id="item_id">
                                        <option value="" disabled selected>Pilih Salah Satu</option>
                                        @foreach($items as $item)
                                        <option value="{{$item->id}}" {{$item->id == $sheet->item_id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 py-3">
                <div class="card">
                    <div class="card-body">

                        <label for="content" class="font-weight-bold text-dark h5">Content Type</label>
                        <div class="accordion" id="accordion-content">
                            <div id="section-classic" class="shadow-sm rounded">
                                <div id="headingOne" class="custom-control custom-radio py-4 px-5 ">
                                    <input type="radio" id="customRadio1" name="content" value="classic" class="custom-control-input value-content" {{$sheet->content_type == 'classic' ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customRadio1" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">Classic</label>
                                    <div style="font-size: 13px;" class="text-gray-600">
                                        Membuat isi konten layaknya anda membuat Dokumen menggunakan Aplikasi Word / Aplikasi Edit dokumen pada umum nya
                                    </div>

                                </div>

                                <div id="collapseOne" class="collapse  {{$sheet->content_type == 'classic' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordion-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control form-control-lg value-add" name="title" id="title">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="subtitle">Sub Title</label>
                                                    <input type="text" class="form-control form-control-lg value-add" name="subtitle" id="subtitle">
                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="editor">Isi Konten</label>
                                                    <div id="toolbar-container"></div>

                                                    <!-- This container will become the editable. -->
                                                    <div id="editor">
                                                        @if($sheet->content_type == 'classic')
                                                        {!! $sheet->content !!}
                                                        @else
                                                        <p>Silahkan isi konten disini.</p>
                                                        @endif
                                                    </div>

                                                </div>
                                                <!-- The toolbar will be rendered in this container. -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="section-advance" class="shadow-sm rounded mt-5">

                                <div id="headingTwo" class="custom-control custom-radio py-4 px-5 ">
                                    <input type="radio" id="customRadio2" name="content" {{$sheet->content_type == 'advance' ? 'checked' : ''}} class="custom-control-input value-content" value="advance">
                                    <label class="custom-control-label" for="customRadio2" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">Advance</label>
                                    <div style="font-size: 13px;" class="text-gray-600">
                                        Membuat isi dengan menggunakan layanan aplikasi pihak ketiga (Canva), yang dimana nanti link outputnya akan di pakai oleh Web Papan Digital
                                    </div>

                                </div>
                                <div id="collapseTwo" class="collapse  {{$sheet->content_type == 'advance' ? 'show' : ''}} pt-3" aria-labelledby="headingTwo" data-parent="#accordion-content">
                                    <div class="card-body">
                                        <p>Silahkan buka website <a href="https://canva.com">Canva</a> dan buat desain, konten yang Anda mau</p>

                                        <div>
                                            Setelah selesai membuat desain konten yang Anda inginkan , Silahkan paste link output pada form dibawah :
                                            <div class="form-group row">
                                                <label for="inputLink" class="col-sm-2 col-form-label">Link output canva</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="{{$sheet->content_type == 'advance' ? $sheet->content : ''}}" class="form-control" onkeyup="previewCanva(this)" onkeydown="previewCanva(this)" onchange="previewCanva(this)" id="inputLink">
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
                            <div id="section-gallery" class="shadow-sm rounded mt-5">

                                <div id="headingThree" class="custom-control custom-radio py-4 px-5 ">
                                    <input type="radio" id="customRadio3" name="content" {{$sheet->content_type == 'gallery' ? 'checked' : ''}} class="custom-control-input value-content" value="gallery">
                                    <label class="custom-control-label" for="customRadio3" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">Gallery</label>
                                    <div style="font-size: 13px;" class="text-gray-600">
                                        Membuat konten yang berisi kumpulan foto-foto
                                    </div>

                                </div>
                                <div id="collapseThree" class="collapse {{$sheet->content_type == 'gallery' ? 'show' : ''}} pt-3" aria-labelledby="headingThree" data-parent="#accordion-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control form-control-lg value-add" name="title" id="title">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="subtitle">Sub Title</label>
                                                    <input type="text" class="form-control form-control-lg value-add" name="subtitle" id="subtitle">
                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="editor" class="d-block">Isi Konten</label>
                                                    <button type="button" class="btn position-relative btn-info btn-lg">
                                                        Pilih Foto
                                                        <input type="file" name="content_image[]" class="upload-konten-foto" style="position:absolute;inset:0;z-index:2;opacity:0;" multiple>
                                                    </button>
                                                    <div style="font-size: 13px;" class="text-gray-600 ">
                                                        Anda dapat memilih foto lebih dari satu
                                                    </div>
                                                    <div class="row mt-3 parent-gallery">
                                                        @if($sheet->content_type == 'gallery')
                                                        @foreach(json_decode($sheet->content) as $img)
                                                        <div class="col-6 col-md-4 col-lg-3 py-2">
                                                            <img src="/img/{{$img}}" alt="preview-img" class="img-fluid">
                                                        </div>

                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('sheets.update',$sheet->slug)}}" method="post" id="formAdd" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="data" id="data_presentation">

            <!-- <input type="hidden" name="content_value" id="content_value"> -->
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/decoupled-document/ckeditor.js"></script>

<script>
    let dataEditor = `{!! $sheet->content_type == 'classic' ? $sheet->content : '' !!}`;

    // variabel untuk mengecek apakah sudah ada gambar yang diupload saat memilih type content gallery
    let mustUpload = (`{{ $sheet->content_type == 'gallery' ? 'true' : 'false' }}` ==    'true');

    // let resultFiles = new FormData;
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
        parent.children[1].style.height = val != '' ? 'calc(50vh + 10vw)' : '0px';
    }

    function simpanData(el) {
        el.disabled = true;
        el.textContent = 'Loading';
        let data = {};
        // berisi element input title,subtitle, dan id items


        let valueContent = document.querySelectorAll('.value-content');
        valueContent.forEach(el => {
            if (el.checked) {
                data['content_type'] = el.value;
            }
        })

        // let valueAdd = Array.from(document.querySelectorAll(`.value-add`));

        // if (data.content_type != 'advance') {
        let titleAndSubtitle = Array.from(document.querySelectorAll(`.value-add`));
        console.log(titleAndSubtitle);
        titleAndSubtitle.forEach(e => {
            data[e.name] = e.value;
        });
        // }
        data['item_id'] = document.querySelector('.value-add[name="item_id"]').value;


        const inputContent = document.querySelector('#content_value')


        const form = document.querySelector('#formAdd');
        switch (data.content_type) {
            case 'classic':
                data['content'] = dataEditor
                break;
            case 'advance':
                data['content'] = document.querySelector('#inputLink').value;
                break;
            case 'gallery':
                data['content'] = true;

                break;
        }

        const hasError = validate(data);
        if (hasError.length > 0) {
            el.disabled = false;
            el.textContent = 'Simpan Data';
            return handledError(hasError);
        }
        if (data.content_type == 'gallery') {
            const fileInput = document.querySelector('.upload-konten-foto');
            $(form).append(fileInput);
            if (mustUpload == false) {
                el.disabled = false;
                el.textContent = 'Simpan Data';
                return alert('silahkan pilih gambar terlebih dahulu');
            }
        }

        // return console.log(data);
        document.querySelector('#formAdd #data_presentation').value = JSON.stringify(data);
        // return console.log(form);
        form.submit();
    }

    function validate(data) {
        const requiredField = ['item_id'];
        const requiredNextField = ['title', 'subtitle']
        let msg = [];
        requiredField.forEach(field => {
            // jika field tidak ada atau field ada namun tidak ada isinya
            if (!(field in data) || data[field] == '') {
                msg.push(`${field} harus di isi`);
            }
        })

        if (!('content_type' in data)) {
            msg.push('Silahkan pilih type konten')
        } else {
            // if (data.content_type != 'advance') {
            requiredNextField.forEach(field => {
                // jika field tidak ada atau field ada namun tidak ada isinya
                if (!(field in data) || data[field] == '') {
                    msg.push(`${field} harus di isi`);
                }
            })
            // }
            if (!('content' in data) || data.content == '') {
                msg.push('Silahkan lengkapi isi konten terlebih dahulu')
            }
        }
        return msg;
    }

    function handledError(errors) {
        const parentError = document.querySelector('.parent-error');
        parentError.innerHTML = ''
        parentError.classList.remove('d-none');
        errors.forEach(error => $(parentError).append(myAlert('danger', error)));
    }



    const inputFoto = document.querySelector('.upload-konten-foto')

    inputFoto.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);


        const parentView = $('.parent-gallery')
        if (files.length > 0) {
            let result = '';
            files.forEach(file => {
                result += templateFoto(URL.createObjectURL(file));
                // resultFiles.append('image', file)
            })
            mustUpload = true;
            return parentView.html(result);
        }
        mustUpload = false;
        return parentView.empty();
    })

    function templateFoto(src) {
        return `<div class="col-6 col-md-4 col-lg-3 py-2">
                    <img src="${src}" alt="preview-img" class="img-fluid">
                </div>`
    }
</script>
@endsection