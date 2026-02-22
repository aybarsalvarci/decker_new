@extends('admin.layouts.master')

@section('title', 'Manage Care & Maintenance')

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
    <style>
        /* Yeşil Tema (Bakım/Temizlik hissi için) */
        .card-outline-success { border-top: 3px solid #28a745; }

        .section-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-left: 5px solid #28a745; /* Yeşil kenarlık */
            margin-bottom: 20px;
            font-weight: bold;
            color: #495057;
        }

        .note-editor { border-radius: 4px; border: 1px solid #ced4da; }
    </style>
@endpush

@section('breadcrumb-title', 'Care & Maintenance')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Care & Maintenance</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.resources.care-and-maintenance')}}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-9">
                    <div class="card card-outline-success shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-tools mr-2 text-success"></i> Care & Maintenance Content
                            </h3>
                        </div>

                        <div class="card-body p-4">
                            <div class="section-header">
                                <i class="flag-icon flag-icon-us mr-2"></i> English Content
                            </div>
                            <div class="form-group">
                                <label for="title_en">Page Title (EN)</label>
                                <input type="text" name="title_en" id="title_en" required
                                       class="form-control @error('title_en') is-invalid @enderror"
                                       value="{{ old('title_en', $page->title_en ?? 'Care & Maintenance') }}">
                            </div>
                            <div class="form-group">
                                <label for="content_en">Main Content (EN)</label>
                                <textarea name="content_en" id="content_en" class="summernote">
                                    {!! old('content_en', $page->content_en ?? '') !!}
                                </textarea>
                            </div>

                            <hr class="my-5">

                            <div class="section-header">
                                <i class="flag-icon flag-icon-es mr-2"></i> Spanish Content
                            </div>
                            <div class="form-group">
                                <label for="title_esp">Page Title (ES)</label>
                                <input type="text" name="title_esp" id="title_esp"
                                       class="form-control @error('title_esp') is-invalid @enderror"
                                       value="{{ old('title_esp', $page->title_esp ?? 'Cuidado y Mantenimiento') }}">
                            </div>
                            <div class="form-group">
                                <label for="content_esp">Main Content (ES)</label>
                                <textarea name="content_esp" id="content_esp" class="summernote">
                                    {!! old('content_esp', $page->content_esp ?? '') !!}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="card shadow-sm">
                        <div class="card-body p-3">
                            <button type="submit" class="btn btn-success btn-block btn-lg shadow font-weight-bold">
                                <i class="fas fa-save mr-2"></i> UPDATE PAGE
                            </button>

                            @if(isset($page->updated_at))
                                <div class="text-center mt-3 text-muted small">
                                    Last updated: <br>
                                    <strong>{{ $page->updated_at->format('d M Y, H:i') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="callout callout-info mt-3">
                        <h5 class="small font-weight-bold">Formatting Tips</h5>
                        <p class="small m-0 text-muted">
                            Since this page contains tables and instructions, ensure tables are responsive using the editor's table tools.
                        </p>
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

            $('.summernote').summernote({
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
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
