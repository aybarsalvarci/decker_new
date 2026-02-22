@extends('admin.layouts.master')

@section('title', 'Create New Report')

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
    <style>
        .card-outline-success { border-top: 3px solid #28a745; }
        .section-title { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f4f6f9; }
        .image-preview { width: 100%; max-height: 200px; border: 2px dashed #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #f8f9fa; margin-top: 10px; }
        .image-preview img { width: 100%; height: 100%; object-fit: cover; }

        /* Çoklu Görsel Önizleme Stilleri */
        .multiple-preview-container { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .preview-item-wrapper { position: relative; width: 80px; height: 80px; }
        .preview-item { width: 100%; height: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6; }

        .note-editor { box-shadow: none !important; border-color: #dee2e6 !important; }
        /* Summernote hata durumu için */
        .is-invalid + .note-editor { border-color: #dc3545 !important; }
    </style>
@endpush

@section('breadcrumb-title', 'Create Report')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.report.index')}}">Reports</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.report.store')}}" method="post" enctype="multipart/form-data" id="reportForm">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-outline-success shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold text-success"><i class="fas fa-file-alt mr-2"></i> Report Content</h3>
                        </div>
                        <div class="card-body">
                            <div class="section-title text-primary"><i class="fas fa-language mr-1"></i> English Version</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title_en">Title (EN) <span class="text-danger">*</span></label>
                                    <input type="text" name="title_en" id="title_en"
                                           class="form-control @error('title_en') is-invalid @enderror"
                                           value="{{old('title_en')}}" placeholder="Enter English title">
                                    @error('title_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slug_en">Slug (EN)</label>
                                    <input type="text" name="slug_en" id="slug_en"
                                           class="form-control @error('slug_en') is-invalid @enderror"
                                           value="{{old('slug_en')}}" placeholder="auto-generated-slug">
                                    @error('slug_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="content_en">Main Content (EN)</label>
                                    <textarea name="content_en" id="content_en" class="summernote @error('content_en') is-invalid @enderror">{{old('content_en')}}</textarea>
                                    @error('content_en') <span class="text-danger small font-italic">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <hr class="my-5">

                            <div class="section-title text-info"><i class="fas fa-language mr-1"></i> Spanish Version</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title_esp">Title (ES) <span class="text-danger">*</span></label>
                                    <input type="text" name="title_esp" id="title_esp"
                                           class="form-control @error('title_esp') is-invalid @enderror"
                                           value="{{old('title_esp')}}" placeholder="Ingrese el título">
                                    @error('title_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slug_esp">Slug (ES)</label>
                                    <input type="text" name="slug_esp" id="slug_esp"
                                           class="form-control @error('slug_esp') is-invalid @enderror"
                                           value="{{old('slug_esp')}}" placeholder="slug-automatico">
                                    @error('slug_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="content_esp">Main Content (ES)</label>
                                    <textarea name="content_esp" id="content_esp" class="summernote @error('content_esp') is-invalid @enderror">{{old('content_esp')}}</textarea>
                                    @error('content_esp') <span class="text-danger small font-italic">{{$message}}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-outline-success shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Settings</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="type">Report Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror shadow-sm">
                                    <option value="">Select Type</option>
                                    <option value="news" {{ old('type') == "news" ? 'selected' : '' }}>News</option>
                                    <option value="exhibition" {{ old('type') == "exhibition" ? 'selected' : '' }}>Exhibition</option>
                                </select>
                                @error('type') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline-success shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Cover Image</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file mb-2">
                                    <input type="file" name="image" id="image"
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           onchange="previewImage(this)">
                                    <label class="custom-file-label" for="image">Choose cover...</label>
                                </div>
                                @error('image') <span class="text-danger small d-block mb-2">{{$message}}</span> @enderror

                                <div class="image-preview" id="preview-container">
                                    <div id="preview-text" class="text-muted small">No cover selected</div>
                                    <img src="" id="preview-img" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline-success shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Slider Gallery</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file mb-2">
                                    <input type="file" name="images[]" id="images" multiple
                                           class="custom-file-input @error('images.*') is-invalid @enderror @error('images') is-invalid @enderror"
                                           onchange="previewMultipleImages(this)">
                                    <label class="custom-file-label" for="images">Choose images...</label>
                                </div>
                                @error('images') <span class="text-danger small d-block">{{$message}}</span> @enderror
                                @error('images.*') <span class="text-danger small d-block">{{$message}}</span> @enderror

                                <div id="multiple-preview-container" class="multiple-preview-container">
                                </div>
                                <small class="text-muted">You can select multiple files.</small>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success btn-block btn-lg shadow font-weight-bold">
                                <i class="fas fa-save mr-1"></i> SAVE REPORT
                            </button>
                            <a href="{{route('admin.report.index')}}" class="btn btn-link btn-block text-muted">
                                Cancel and Return
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{asset('back/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // Summernote Editor Configuration
            $('.summernote').summernote({
                height: 350,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function (files) { uploadImage(files[0], $(this)); },
                    onMediaDelete: function (target) { deleteFile(target[0].src); }
                }
            });

            // Single Image Preview (Cover)
            window.previewImage = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img').attr('src', e.target.result).show();
                        $('#preview-text').hide();
                    }
                    reader.readAsDataURL(input.files[0]);
                    $(input).next('.custom-file-label').html(input.files[0].name);
                }
            }

            // Multiple Image Preview (Slider)
            window.previewMultipleImages = function(input) {
                const container = $('#multiple-preview-container');
                container.empty();

                if (input.files) {
                    const filesAmount = input.files.length;
                    $(input).next('.custom-file-label').html(filesAmount + ' files selected');

                    for (let i = 0; i < filesAmount; i++) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const html = `
                                <div class="preview-item-wrapper">
                                    <img src="${event.target.result}" class="preview-item">
                                </div>
                            `;
                            container.append(html);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            }

            // Smart Slug Generator
            function convertToSlug(text) {
                const trMap = {'ç':'c','ğ':'g','ı':'i','ö':'o','ş':'s','ü':'u','Ç':'C','Ğ':'G','İ':'I','Ö':'O','Ş':'S','Ü':'U'};
                for (let key in trMap) { text = text.replace(new RegExp(key, 'g'), trMap[key]); }
                return text.toString().toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-').replace(/^-+/, '').replace(/-+$/, '');
            }

            $('#title_en').on('input', function() { $('#slug_en').val(convertToSlug($(this).val())); });
            $('#title_esp').on('input', function() { $('#slug_esp').val(convertToSlug($(this).val())); });

            // Summernote Image Upload
            function uploadImage(file, editor) {
                let data = new FormData();
                data.append("image", file);
                data.append("_token", CSRF_TOKEN);
                $.ajax({
                    url: "{{ route('admin.report.upload-image') }}",
                    cache: false, contentType: false, processData: false,
                    data: data, type: "POST",
                    success: function (response) { editor.summernote('insertImage', response.url); },
                    error: function () { alert("Image upload failed!"); }
                });
            }

            function deleteFile(src) {
                $.ajax({
                    url: "{{ route('admin.report.delete-image') }}",
                    type: "POST",
                    data: { src: src, _token: CSRF_TOKEN }
                });
            }
        });
    </script>
@endpush
