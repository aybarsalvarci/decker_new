@extends('admin.layouts.master')

@section('title', 'Edit Product: ' . $product->name_en)

@push('css')
    <style>
        .card-outline-warning { border-top: 3px solid #ffc107; }
        .current-img-wrapper {
            border: 2px solid #f4f6f9;
            border-radius: 12px;
            overflow: hidden;
            background: #f8f9fa;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .current-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .section-title { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f4f6f9; }
        .input-group-text { background-color: #f8f9fa; }

        /* --- RENK KARTI STİLLERİ (Edit Sayfası İçin) --- */
        .color-card-wrapper {
            cursor: pointer;
            position: relative;
        }
        .color-checkbox { display: none; }

        .color-card-content {
            border: 2px solid #eaecf4;
            border-radius: 8px;
            padding: 10px;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            background: #fff;
        }

        .color-card-content:hover {
            border-color: #ffc107; /* Warning rengi hover */
            background-color: #fffdf0;
        }

        /* Seçili Olduğunda (Mavi yerine Edit sayfasına uygun Sarı tonu veya standart mavi kullanılabilir.
           Burada karışıklık olmaması için standart mavi seçildiğini varsayıyorum,
           ama tema uyumu için border'ı sarı yapıyoruz) */
        .color-checkbox:checked + .color-card-content {
            border-color: #ffc107; /* Warning Color */
            background-color: #fffbf0; /* Çok açık sarı */
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        .check-indicator {
            display: none;
            color: #ffc107; /* Warning Color */
            margin-left: auto;
        }

        .color-checkbox:checked + .color-card-content .check-indicator {
            display: block;
        }

        .color-swatch {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
@endpush

@section('breadcrumb-title', 'Edit Product')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Products</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.product.update', $product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">

                    <div class="card card-outline-warning shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold"><i class="fas fa-edit mr-2 text-warning"></i> Edit Product Details</h3>
                            <div class="card-tools">
                                <a href="{{route('admin.product.index')}}" class="btn btn-default btn-sm">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="section-title text-primary"><i class="fas fa-language mr-1"></i> English Content</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name_en">Name (EN) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" id="name_en" required
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           value="{{ old('name_en', $product->name_en) }}">
                                    @error('name_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slug_en">Slug (EN)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-link"></i></span></div>
                                        <input type="text" name="slug_en" id="slug_en" required
                                               class="form-control @error('slug_en') is-invalid @enderror"
                                               value="{{ old('slug_en', $product->slug_en) }}">
                                    </div>
                                    @error('slug_en') <span class="text-danger small">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="section-title text-info mt-4"><i class="fas fa-language mr-1"></i> Spanish Content</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name_esp">Name (ESP) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_esp" id="name_esp" required
                                           class="form-control @error('name_esp') is-invalid @enderror"
                                           value="{{ old('name_esp', $product->name_esp) }}">
                                    @error('name_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slug_esp">Slug (ESP)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-link"></i></span></div>
                                        <input type="text" name="slug_esp" id="slug_esp" required
                                               class="form-control @error('slug_esp') is-invalid @enderror"
                                               value="{{ old('slug_esp', $product->slug_esp) }}">
                                    </div>
                                    @error('slug_esp') <span class="text-danger small">{{$message}}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline-warning shadow-sm mt-4">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-palette mr-2 text-warning"></i> Color Variations
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Manage the available color options for this product.</p>

                            <div class="row">

                                @if(isset($colors) && count($colors) > 0)

                                    @foreach($colors as $color)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                            <label class="color-card-wrapper w-100 mb-0">
                                                <input type="checkbox" name="colors[]" value="{{ $color->id }}"
                                                       class="color-checkbox"
                                                    {{ (in_array($color->id, $product->colors->pluck('id')->toArray())) ? 'checked' : '' }}>

                                                <div class="color-card-content">
                                                    <img src="{{ asset('storage/' . $color->image) }}"
                                                         alt="{{ $color->name_en }}"
                                                         class="color-swatch mr-3">

                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bold text-dark">{{ $color->name }}</span>
                                                    </div>

                                                    <div class="check-indicator">
                                                        <i class="fas fa-check-circle fa-lg"></i>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-light border">
                                            <i class="icon fas fa-info-circle text-warning"></i> No colors found in database.
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @error('colors') <span class="text-danger small mt-2 d-block">{{$message}}</span> @enderror
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card card-outline-warning shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Organization</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category_id" id="category" class="form-control select2">
                                    @foreach($categories as $category)
                                        <option {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{$category->id}}">
                                            {{$category->name_en}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline-warning shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Product Image</h3></div>
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <label class="info-label d-block mb-2 small text-muted font-weight-bold">CURRENT IMAGE</label>
                                <div class="current-img-wrapper shadow-sm">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" id="current-preview">
                                    @else
                                        <span class="text-muted">No image uploaded</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Change Image</label>
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input" onchange="previewImage(this)">
                                    <label class="custom-file-label" for="image">Choose new file...</label>
                                </div>
                                <small class="text-muted mt-2 d-block text-center">Leave blank to keep current image</small>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="submit" class="btn btn-warning btn-block btn-lg shadow font-weight-bold">
                                <i class="fas fa-sync-alt mr-1"></i> Update Product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#current-preview').attr('src', e.target.result).fadeIn();
                }
                reader.readAsDataURL(input.files[0]);
                $(input).next('.custom-file-label').html(input.files[0].name);
            }
        }
    </script>
@endpush
