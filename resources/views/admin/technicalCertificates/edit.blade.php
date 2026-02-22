@extends('admin.layouts.master')

@section('title', 'Edit Certificate: ' . $technical->title_en)

@push('css')
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .section-title { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f4f6f9; }

        /* Resim Önizleme Alanı */
        .current-img-wrapper { border: 2px solid #e9ecef; border-radius: 8px; overflow: hidden; background: #f8f9fa; height: 220px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; }
        .current-img-wrapper img { width: 100%; height: 100%; object-fit: contain; }

        /* PDF Bilgi Alanı */
        .current-file-info { background: #e3f2fd; border: 1px solid #bbdefb; border-radius: 6px; padding: 10px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; }
        .file-icon { color: #dc3545; font-size: 1.5rem; margin-right: 10px; }

        .custom-file-label::after { content: "Browse"; }
    </style>
@endpush

@section('breadcrumb-title', 'Edit Certificate')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.resources.technical-certificates.index')}}">Certificates</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.resources.technical-certificates.update', $technical->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold text-primary">
                                <i class="fas fa-edit mr-2"></i> Edit Certificate Details
                            </h3>
                            <div class="card-tools">
                                <a href="{{route('admin.resources.technical-certificates.index')}}" class="btn btn-default btn-sm">
                                    <i class="fas fa-arrow-left mr-1"></i> Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="section-title text-primary"><i class="fas fa-flag-usa mr-2"></i> English Details</div>
                            <div class="form-group">
                                <label for="title_en">Title (EN) <span class="text-danger">*</span></label>
                                <input type="text" name="title_en" id="title_en" required
                                       class="form-control @error('title_en') is-invalid @enderror"
                                       value="{{ old('title_en', $technical->title_en) }}">
                                @error('title_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc_en">Description (EN)</label>
                                <textarea name="desc_en" id="desc_en" rows="4"
                                          class="form-control @error('desc_en') is-invalid @enderror">{{ old('desc_en', $technical->desc_en) }}</textarea>
                                @error('desc_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>

                            <hr class="my-4">

                            <div class="section-title text-info"><i class="fas fa-globe-europe mr-2"></i> Spanish Details</div>
                            <div class="form-group">
                                <label for="title_esp">Title (ES) <span class="text-danger">*</span></label>
                                <input type="text" name="title_esp" id="title_esp" required
                                       class="form-control @error('title_esp') is-invalid @enderror"
                                       value="{{ old('title_esp', $technical->title_esp) }}">
                                @error('title_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc_esp">Description (ES)</label>
                                <textarea name="desc_esp" id="desc_esp" rows="4"
                                          class="form-control @error('desc_esp') is-invalid @enderror">{{ old('desc_esp', $technical->desc_esp) }}</textarea>
                                @error('desc_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Document File (PDF)</h3></div>
                        <div class="card-body">

                            @if($technical->file)
                                <div class="current-file-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf file-icon"></i>
                                        <div style="line-height: 1.2;">
                                            <span class="d-block small font-weight-bold text-dark">Current File Exists</span>
                                            <a href="{{ asset('storage/' . $technical->file) }}" target="_blank" class="small text-primary">View PDF</a>
                                        </div>
                                    </div>
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Change PDF File</label>
                                <div class="custom-file">
                                    <input type="file" name="file" id="file" accept=".pdf"
                                           class="custom-file-input @error('file') is-invalid @enderror">
                                    <label class="custom-file-label" for="file">Choose new PDF...</label>
                                </div>
                                <small class="form-text text-muted mt-2">Leave empty to keep current PDF.</small>
                                @error('file') <span class="text-danger small d-block mt-1">{{$message}}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Cover Image</h3></div>
                        <div class="card-body">
                            <div class="current-img-wrapper shadow-sm">
                                <img src="{{ asset('storage/' . $technical->image) }}" id="main-preview" alt="Current Image">
                            </div>

                            <div class="form-group">
                                <label>Change Image</label>
                                <div class="custom-file mb-2">
                                    <input type="file" name="image" id="image" accept="image/*"
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           onchange="previewImage(this)">
                                    <label class="custom-file-label" for="image">Choose new image...</label>
                                </div>
                                <small class="text-muted">Leave empty to keep current image.</small>
                                @error('image') <span class="text-danger small">{{$message}}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow font-weight-bold">
                                <i class="fas fa-sync-alt mr-1"></i> UPDATE CERTIFICATE
                            </button>
                            <a href="{{route('admin.resources.technical-certificates.index')}}" class="btn btn-link btn-block text-muted">
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        // Dosya adı gösterme (Bootstrap Custom File Input)
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Resim Önizleme Fonksiyonu
        window.previewImage = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#main-preview').attr('src', e.target.result).fadeIn();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
