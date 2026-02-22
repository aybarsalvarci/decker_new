@extends('admin.layouts.master')

@section('title', 'Add New Product Color')

@push('css')
    <style>
        .card-outline-teal { border-top: 3px solid #20c997; }
        .color-preview-wrapper {
            width: 120px;
            height: 120px;
            border: 3px dashed #dee2e6;
            border-radius: 50%; /* Renk numunesi olduğu için daire formunda */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f8f9fa;
            margin: 15px auto;
            transition: all 0.3s;
        }
        .color-preview-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .input-group-text { background-color: #f8f9fa; }
    </style>
@endpush

@section('breadcrumb-title', 'Product Colors')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product-color.index')}}">Product Colors</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-outline-teal shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-palette mr-2 text-teal"></i> New Color Variant
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.product-color.index')}}" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back
                            </a>
                        </div>
                    </div>

                    <form action="{{route('admin.product-color.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Color Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" required
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{old('name')}}" placeholder="e.g. Anthracite Grey">
                                </div>
                                @error('name') <span class="invalid-feedback d-block">{{$message}}</span> @enderror
                            </div>

                            <hr>

                            <div class="form-group text-center">
                                <label class="font-weight-bold d-block text-left">Color Texture / Image <span class="text-danger">*</span></label>

                                <div class="color-preview-wrapper shadow-sm" id="preview-container">
                                    <div id="preview-placeholder">
                                        <i class="fas fa-eye-dropper fa-2x text-muted"></i>
                                    </div>
                                    <img src="" id="preview-img" style="display:none;">
                                </div>

                                <div class="custom-file text-left mt-3">
                                    <input type="file" name="image" id="image" required
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           onchange="previewColor(this)">
                                    <label class="custom-file-label" for="image">Choose color sample...</label>
                                </div>
                                @error('image') <span class="text-danger small mt-2 d-block">{{$message}}</span> @enderror
                                <small class="text-muted d-block mt-2">Recommended: Square 500x500px JPG or PNG.</small>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-teal btn-block shadow-sm py-2 font-weight-bold" style="background-color: #20c997; border-color: #20c997; color: white;">
                                <i class="fas fa-save mr-1"></i> Save Color Variant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Renk numunesi önizleme
        function previewColor(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('preview-img').style.display = 'block';
                    document.getElementById('preview-placeholder').style.display = 'none';
                    document.getElementById('preview-container').style.borderStyle = 'solid';
                }
                reader.readAsDataURL(input.files[0]);
                // Dosya adını label'a yaz
                $(input).next('.custom-file-label').html(input.files[0].name);
            }
        }
    </script>
@endpush
