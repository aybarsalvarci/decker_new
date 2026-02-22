@extends('admin.layouts.master')

@section('title', 'Edit Product: ' . $product->name_en)

@push('css')
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --border-color: #e5e7eb;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
        }

        .modern-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
            border: none;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f3f4f6;
            padding: 20px 24px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.875rem;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 10px 14px;
            background-color: #f9fafb;
        }

        /* Color Selection Grid */
        .color-selection-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 12px;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
        }

        .color-item {
            position: relative;
            cursor: pointer;
        }

        .color-item input {
            position: absolute;
            opacity: 0;
        }

        .color-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 8px;
            border: 2px solid transparent;
            border-radius: 10px;
            transition: all 0.2s;
            background: #f8fafc;
        }

        .color-box img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
        }

        .color-name {
            font-size: 0.7rem;
            font-weight: 600;
            text-align: center;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
        }

        .color-item input:checked + .color-box {
            border-color: var(--primary-color);
            background-color: #eef2ff;
        }

        .selected-icon {
            position: absolute;
            top: 2px;
            right: 2px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .color-item input:checked ~ .selected-icon {
            display: flex;
        }

        .section-separator {
            display: flex;
            align-items: center;
            margin: 30px 0 20px 0;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--primary-color);
        }

        .section-separator::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
            margin-left: 15px;
        }

        /* Gallery Preview Update */
        .gallery-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .gallery-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            background: #fff;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-item .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 6px;
            width: 26px;
            height: 26px;
            font-size: 12px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .gallery-item .delete-btn:hover {
            transform: scale(1.1);
            background: #ef4444;
        }

        .main-badge {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--primary-color);
            color: white;
            font-size: 9px;
            text-align: center;
            padding: 3px 0;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-area:hover {
            border-color: var(--primary-color);
            background: #f1f5f9;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            width: 100%;
            border: none;
            transition: background 0.2s;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid pb-5">
        <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data" id="productForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-8">
                    <div class="modern-card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit mr-2 text-primary"></i> Edit Product Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="section-separator">English Content</div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name (EN) *</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en', $product->name_en) }}">
                                    @error('name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Slug (EN)</label>
                                    <input type="text" name="slug_en" id="slug_en" class="form-control" value="{{ old('slug_en', $product->slug_en) }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Description (EN)</label>
                                    <textarea name="description_en" class="form-control" rows="3">{{ old('description_en', $product->description_en) }}</textarea>
                                </div>
                            </div>

                            <div class="section-separator">Spanish Content</div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name (ESP) *</label>
                                    <input type="text" name="name_esp" id="name_esp" class="form-control @error('name_esp') is-invalid @enderror" value="{{ old('name_esp', $product->name_esp) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Slug (ESP)</label>
                                    <input type="text" name="slug_esp" id="slug_esp" class="form-control" value="{{ old('slug_esp', $product->slug_esp) }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Description (ESP)</label>
                                    <textarea name="description_esp" class="form-control" rows="3">{{ old('description_esp', $product->description_esp) }}</textarea>
                                </div>
                            </div>

                            <div class="section-separator">Technical Specifications</div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">General Size</label>
                                    <input type="text" name="size" class="form-control spec-input" value="{{ old('size', $product->size) }}">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Actual Size</label>
                                    <input type="text" name="actual_size" class="form-control spec-input" value="{{ old('actual_size', $product->actual_size) }}">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Weight</label>
                                    <input type="text" name="weight" class="form-control spec-input" value="{{ old('weight', $product->weight) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modern-card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-images mr-2 text-primary"></i> Media Gallery</h3>
                        </div>
                        <div class="card-body">
                            <div id="deleted-images-container"></div>

                            <div class="upload-area" onclick="document.getElementById('images').click()">
                                <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-primary"></i>
                                <h5>Add New Images</h5>
                                <small class="text-muted">You can select multiple files to upload.</small>
                                <input type="file" name="new_images[]" id="images" multiple style="display:none;" accept="image/*" onchange="handleFileSelect(this)">
                            </div>

                            <div class="gallery-preview-container" id="unified-preview">
                                @if($product->images)
                                    @foreach($product->images as $img)
                                        <div class="gallery-item" id="existing-img-{{ $img->id }}">
                                            <button type="button" class="delete-btn" onclick="removeExistingImage({{ $img->id }})">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <img src="{{ asset('storage/' . $img->image) }}">
                                            @if($loop->first)
                                                <div class="main-badge">CURRENT COVER</div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="modern-card">
                        <div class="card-header"><h3 class="card-title"><i class="fas fa-palette mr-2 text-primary"></i> Color Selection</h3></div>
                        <div class="card-body">
                            <label class="form-label mb-3">Select Product Colors *</label>
                            <div class="color-selection-grid">
                                @foreach($colors as $color)
                                    <label class="color-item">
                                        <input type="checkbox" name="colors[]" value="{{$color->id}}"
                                            {{ (is_array(old('colors', $product->colors->pluck('id')->toArray())) && in_array($color->id, old('colors', $product->colors->pluck('id')->toArray()))) ? 'checked' : '' }}>
                                        <div class="color-box">
                                            <img src="{{ asset('storage/' . $color->image) }}" onerror="this.src='{{ asset('admin/img/no-image.png') }}'">
                                            <span class="color-name" title="{{ $color->name }}">{{ $color->name }}</span>
                                        </div>
                                        <div class="selected-icon"><i class="fas fa-check"></i></div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="modern-card">
                        <div class="card-header"><h3 class="card-title">Settings</h3></div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label">Category *</label>
                                <select name="category_id" class="form-control select2">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{$category->name_en}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="isPriceable" value="0">
                                    <input type="checkbox" class="custom-control-input" id="isPriceable" name="isPriceable" value="1" {{ old('isPriceable', $product->isPriceable) ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="isPriceable">Is Priceable?</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="isSized" value="0">
                                    <input type="checkbox" class="custom-control-input" id="isSized" name="isSized" value="1" {{ old('isSized', $product->isSized) ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="isSized">Has Technical Specs?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modern-card p-4">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-sync-alt mr-2"></i> UPDATE PRODUCT
                        </button>
                        <a href="{{route('admin.product.index')}}" class="btn btn-light btn-block mt-2 border">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({ width: '100%' });
            toggleTechInputs();
        });

        // Slug Generator
        function generateSlug(text) {
            const trMap = {'ç':'c','ğ':'g','ı':'i','ö':'o','ş':'s','ü':'u','Ç':'C','Ğ':'G','İ':'I','Ö':'O','Ş':'S','Ü':'U'};
            for (let key in trMap) text = text.replace(new RegExp(key, 'g'), trMap[key]);
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }

        document.getElementById('name_en').addEventListener('input', function() {
            document.getElementById('slug_en').value = generateSlug(this.value);
        });
        document.getElementById('name_esp').addEventListener('input', function() {
            document.getElementById('slug_esp').value = generateSlug(this.value);
        });

        // Technical Specs Toggle
        const isSizedCheckbox = document.getElementById('isSized');
        const specInputs = document.querySelectorAll('.spec-input');
        function toggleTechInputs() {
            specInputs.forEach(input => {
                input.disabled = !isSizedCheckbox.checked;
            });
        }
        isSizedCheckbox.addEventListener('change', toggleTechInputs);

        // --- MEDIA GALLERY UPDATE LOGIC ---

        // 1. Mevcut resmi silinmek üzere işaretle
        function removeExistingImage(imageId) {
            if (confirm('Are you sure you want to remove this image? This cannot be undone.')) {
                // Görseli arayüzden kaldır
                const element = document.getElementById(`existing-img-${imageId}`);
                element.style.opacity = '0.3';
                element.style.pointerEvents = 'none';
                element.querySelector('.delete-btn').remove(); // Tekrar tıklanmasın

                // Silinecek ID'yi gizli input olarak forma ekle
                const container = document.getElementById('deleted-images-container');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'deleted_images[]';
                input.value = imageId;
                container.appendChild(input);
            }
        }

        // 2. Yeni resimleri seç ve önizleme yap (mevcutları temizlemeden ekler)
        function handleFileSelect(input) {
            const container = document.getElementById('unified-preview');

            if (input.files) {
                Array.from(input.files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'gallery-item';
                        div.style.border = '2px solid #4f46e5'; // Yeni olduğunu belli etmek için
                        div.innerHTML = `
                            <div class="main-badge" style="background:#10b981">NEW</div>
                            <img src="${e.target.result}">
                        `;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
@endpush
