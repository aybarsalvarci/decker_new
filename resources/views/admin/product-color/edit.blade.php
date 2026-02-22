@extends('admin.layouts.master')

@section('title', 'Edit Product Color: ' . $color->name)

@push('css')
    <style>
        .card-outline-warning { border-top: 3px solid #ffc107; }
        .color-preview-edit {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            object-fit: cover;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }
        .preview-container-edit {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            border: 1px solid #eee;
        }
        .input-group-text { background-color: #f8f9fa; }
    </style>
@endpush

@section('breadcrumb-title', 'Edit Product Color')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product-color.index')}}">Product Colors</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-outline-warning shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-palette mr-2 text-warning"></i> Edit Color Variant
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.product-color.index')}}" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back
                            </a>
                        </div>
                    </div>

                    <form action="{{route('admin.product-color.update', $color->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold text-muted">Color Name <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" required
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $color->name) }}">
                                </div>
                                @error('name') <span class="invalid-feedback d-block">{{$message}}</span> @enderror
                            </div>

                            <hr class="my-4">

                            <div class="form-group text-center">
                                <label class="font-weight-bold d-block text-left text-muted mb-3">Color Texture / Image</label>

                                <div class="preview-container-edit shadow-xs">
                                    @if($color->image)
                                        <img src="{{ asset('storage/' . $color->image) }}"
                                             class="color-preview-edit" id="main-preview"
                                             alt="{{ $color->name }}">
                                        <p class="small text-muted mb-0" id="preview-status">Current Active Texture</p>
                                    @else
                                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:150px; height:150px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                        <p class="small text-muted">No image found</p>
                                    @endif

                                    <div class="mt-4 text-left">
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image"
                                                   class="custom-file-input @error('image') is-invalid @enderror"
                                                   onchange="previewFile(this)">
                                            <label class="custom-file-label" for="image">Choose new texture...</label>
                                        </div>
                                        <small class="text-muted d-block mt-2 text-center">Leave blank if you don't want to change the image.</small>
                                    </div>
                                </div>
                                @error('image') <span class="text-danger small mt-2 d-block">{{$message}}</span> @enderror
                            </div>
                        </div>

                        <div class="card-footer bg-white p-0">
                            <button type="submit" class="btn btn-warning btn-block shadow-none py-3 font-weight-bold">
                                <i class="fas fa-sync-alt mr-1"></i> UPDATE COLOR VARIANT
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
        function previewFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#main-preview').attr('src', e.target.result).hide().fadeIn();
                    $('#preview-status').html('<span class="text-success font-weight-bold">New Texture Selected!</span>');
                }
                reader.readAsDataURL(input.files[0]);
                $(input).next('.custom-file-label').html(input.files[0].name);
            }
        }
    </script>
@endpush
