@extends('admin.layouts.master')

@section('title', 'Create New Certificate')

@push('css')
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .section-title { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f4f6f9; }
        /* Resim Önizleme Alanı */
        .image-preview { width: 100%; height: 200px; border: 2px dashed #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #f8f9fa; margin-top: 10px; }
        .image-preview img { width: 100%; height: 100%; object-fit: contain; }
        /* Dosya Seçim Alanı */
        .custom-file-label::after { content: "Browse"; }
    </style>
@endpush

@section('breadcrumb-title', 'Create Certificate')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.resources.technical-certificates.index')}}">Certificates</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.resources.technical-certificates.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold text-primary"><i class="fas fa-file-signature mr-2"></i> Certificate Details</h3>
                        </div>
                        <div class="card-body">

                            <div class="section-title text-primary"><i class="fas fa-flag-usa mr-2"></i> English Details</div>
                            <div class="form-group">
                                <label for="title_en">Title (EN) <span class="text-danger">*</span></label>
                                <input type="text" name="title_en" id="title_en" required
                                       class="form-control @error('title_en') is-invalid @enderror"
                                       value="{{old('title_en')}}" placeholder="e.g. TSE Certificate">
                                @error('title_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc_en">Description (EN)</label>
                                <textarea name="desc_en" id="desc_en" rows="4"
                                          class="form-control @error('desc_en') is-invalid @enderror"
                                          placeholder="Short description about the certificate...">{{old('desc_en')}}</textarea>
                                @error('desc_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>

                            <hr class="my-4">

                            <div class="section-title text-info"><i class="fas fa-globe-europe mr-2"></i> Spanish Details</div>
                            <div class="form-group">
                                <label for="title_esp">Title (ES) <span class="text-danger">*</span></label>
                                <input type="text" name="title_esp" id="title_esp" required
                                       class="form-control @error('title_esp') is-invalid @enderror"
                                       value="{{old('title_esp')}}" placeholder="ej. Certificado TSE">
                                @error('title_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc_esp">Description (ES)</label>
                                <textarea name="desc_esp" id="desc_esp" rows="4"
                                          class="form-control @error('desc_esp') is-invalid @enderror"
                                          placeholder="Descripción corta...">{{old('desc_esp')}}</textarea>
                                @error('desc_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Document File (PDF)</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Upload PDF <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" name="file" id="file" required accept=".pdf"
                                           class="custom-file-input @error('file') is-invalid @enderror">
                                    <label class="custom-file-label" for="file">Choose PDF file...</label>
                                </div>
                                <small class="form-text text-muted mt-2">Allowed: .pdf only</small>
                                @error('file') <span class="text-danger small d-block mt-1">{{$message}}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Cover Image</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Preview Image <span class="text-danger">*</span></label>
                                <div class="custom-file mb-2">
                                    <input type="file" name="image" id="image" required accept="image/*"
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           onchange="previewImage(this)">
                                    <label class="custom-file-label" for="image">Choose image...</label>
                                </div>
                                @error('image') <span class="text-danger small">{{$message}}</span> @enderror

                                <div class="image-preview" id="preview-container">
                                    <div id="preview-text" class="text-muted small">No image selected</div>
                                    <img src="" id="preview-img" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow font-weight-bold">
                                <i class="fas fa-save mr-1"></i> SAVE CERTIFICATE
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
                    $('#preview-img').attr('src', e.target.result).show();
                    $('#preview-text').hide();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
