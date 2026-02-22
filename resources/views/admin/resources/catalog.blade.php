@extends('admin.layouts.master')

@section('title', 'Online Catalog Management')

@push('css')
    <style>
        /* PDF Kırmızısı Tonlaması */
        .card-outline-danger { border-top: 3px solid #dc3545; }
        .catalog-box { max-width: 800px; /* Genişliği biraz artırdım ki iki input rahat sığsın */ margin: 20px auto; }
        .current-file-box {
            background-color: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .pdf-icon-large { font-size: 2.5rem; color: #dc3545; margin-right: 15px; }
        .help-text { font-size: 0.85rem; color: #6c757d; margin-top: 5px; }
    </style>
@endpush

@section('breadcrumb-title', 'Resources')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Online Catalog</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="catalog-box">
            <div class="card card-outline-danger shadow-sm">

                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-file-pdf mr-1 text-danger"></i> Manage Online Catalog
                    </h3>
                </div>

                <form action="{{route('admin.resources.catalog.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">
                        @if(isset($catalog) && $catalog->file)
                            <div class="form-group">
                                <label>Current Active Catalog:</label>
                                <div class="current-file-box">
                                    <i class="fas fa-file-pdf pdf-icon-large"></i>
                                    <div style="flex-grow: 1;">
                                        <h5 class="m-0 font-weight-bold">{{ $catalog->title_en ?? 'Online Catalog' }}</h5>
                                        <small class="text-muted">Uploaded: {{ $catalog->updated_at->format('d.m.Y H:i') }}</small>
                                    </div>
                                    <a href="{{ asset('storage/' . $catalog->file) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-download mr-1"></i> View / Download
                                    </a>
                                </div>
                            </div>
                            <hr>

                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_en">Catalog Title (English)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light">EN</span>
                                        </div>
                                        <input type="text" name="title_en" id="title_en"
                                               class="form-control"
                                               value="{{ old('title_en', $catalog->title_en) }}"
                                               placeholder="e.g. 2026 Product Collection">
                                    </div>
                                    @error('title_en') <span class="text-danger small">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_es">Catalog Title (Spanish)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light">ES</span>
                                        </div>
                                        <input type="text" name="title_esp" id="title_es"
                                               class="form-control"
                                               value="{{ old('title_es', $catalog->title_esp) }}"
                                               placeholder="ej. Catálogo de Productos 2026">
                                    </div>
                                    @error('title_esp') <span class="text-danger small">{{$message}}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="catalog_file" class="font-weight-bold">Upload New PDF File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('catalog_file') is-invalid @enderror"
                                           id="catalog_file" name="file" accept=".pdf">
                                    <label class="custom-file-label" for="catalog_file">Choose PDF file...</label>
                                </div>
                            </div>

                            @error('file')
                            <span class="text-danger small mt-1 d-block">{{$message}}</span>
                            @enderror

                            <p class="help-text">
                                <i class="fas fa-info-circle mr-1"></i> Uploading a new file will <u>replace</u> the existing catalog. Max size: 10MB.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right py-3">
                        <button type="submit" class="btn btn-danger px-5 shadow-sm">
                            <i class="fas fa-save mr-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('back/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
