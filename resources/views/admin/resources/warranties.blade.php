@extends('admin.layouts.master')

@section('title', 'Manage Warranty Page')

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }

        .section-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-left: 5px solid #007bff;
            margin-bottom: 20px;
            font-weight: bold;
            color: #495057;
            display: flex;
            align-items: center;
        }

        .invalid-feedback { display: block; }
    </style>
@endpush

@section('breadcrumb-title', 'Warranty Page')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Warranty Page</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.resources.warranties')}}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-9">
                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-shield-alt mr-2 text-primary"></i> Warranty Page Content
                            </h3>
                        </div>

                        <div class="card-body p-4">

                            {{-- ENGLISH SECTION --}}
                            <div class="section-header">
                                <span style="font-size: 1.2rem;" class="mr-2">🇺🇸</span> English Content
                            </div>

                            <div class="form-group">
                                <label for="title_en">Page Title (EN)</label>
                                <input type="text" name="title_en" id="title_en"
                                       class="form-control @error('title_en') is-invalid @enderror"
                                       value="{{ old('title_en', $page->title_en ?? 'Warranty & Registration') }}" required>
                                @error('title_en') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="content_en">Main Content (EN)</label>
                                <textarea name="content_en" id="content_en" class="summernote @error('content_en') is-invalid @enderror">
                                    {!! old('content_en', $page->content_en ?? '') !!}
                                </textarea>
                                @error('content_en') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <hr class="my-5">

                            {{-- SPANISH SECTION --}}
                            <div class="section-header">
                                <span style="font-size: 1.2rem;" class="mr-2">🇪🇸</span> Spanish Content
                            </div>

                            <div class="form-group">
                                <label for="title_esp">Page Title (ES)</label>
                                <input type="text" name="title_esp" id="title_esp"
                                       class="form-control @error('title_esp') is-invalid @enderror"
                                       value="{{ old('title_esp', $page->title_esp ?? 'Garantía y Registro') }}">
                                @error('title_esp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="content_esp">Main Content (ES)</label>
                                <textarea name="content_esp" id="content_esp" class="summernote @error('content_esp') is-invalid @enderror">
                                    {!! old('content_esp', $page->content_esp ?? '') !!}
                                </textarea>
                                @error('content_esp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- SAĞ KOLON: AKSİYONLAR --}}
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body p-3">
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow font-weight-bold">
                                <i class="fas fa-save mr-2"></i> UPDATE PAGE
                            </button>

                            @if(isset($page->updated_at))
                                <div class="text-center mt-3 text-muted small">
                                    <i class="far fa-clock mr-1"></i> Last updated: <br>
                                    <strong>{{ $page->updated_at->format('d M Y, H:i') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="callout callout-info mt-3 shadow-sm">
                        <h5 class="small font-weight-bold text-info"><i class="fas fa-info-circle"></i> Did you know?</h5>
                        <p class="small m-0 text-muted">You can copy-paste images directly into the text editor. Tables are also supported for warranty periods.</p>
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

            // Summernote Ayarları
            $('.summernote').summernote({
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function (files) { uploadImage(files[0], $(this)); },
                    onMediaDelete: function (target) { deleteFile(target[0].src); }
                }
            });

            // Summernote Image Upload
            function uploadImage(file, editor) {
                let data = new FormData();
                data.append("image", file);
                data.append("_token", CSRF_TOKEN);
                $.ajax({
                    url: "{{ route('admin.resources.upload-image') }}",
                    cache: false, contentType: false, processData: false,
                    data: data, type: "POST",
                    success: function (response) { editor.summernote('insertImage', response.url); },
                    error: function () { alert("Image upload failed!"); }
                });
            }

            function deleteFile(src) {
                $.ajax({
                    url: "{{ route('admin.resources.delete-image') }}",
                    type: "POST",
                    data: { src: src, _token: CSRF_TOKEN }
                });
            }
        });
    </script>
@endpush
