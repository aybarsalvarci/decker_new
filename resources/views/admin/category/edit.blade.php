@extends('admin.layouts.master')

@section('title', 'Edit Category: ' . $category->name_en)

@push('css')
    <style>
        .card-outline-warning { border-top: 3px solid #ffc107; }

        /* Resim Önizleme Stilleri */
        .image-preview-container { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px; }
        .preview-box { flex: 1; min-width: 200px; max-width: 250px; }
        .img-wrapper {
            height: 160px; border: 2px solid #eee; border-radius: 8px;
            overflow: hidden; background: #f8f9fa; display: flex;
            align-items: center; justify-content: center;
        }
        .img-wrapper img { width: 100%; height: 100%; object-fit: cover; }

        /* Genel Stiller */
        .section-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        .invalid-feedback { display: block; }

        /* Icon Repeater Stilleri (Create sayfasından alındı) */
        .icon-row {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
            transition: all 0.3s;
        }
        .icon-row:hover { box-shadow: 0 3px 10px rgba(0,0,0,0.05); }

        .btn-remove-icon {
            position: absolute; top: -10px; right: -10px;
            background: #fff; border: 1px solid #dc3545; color: #dc3545;
            width: 25px; height: 25px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 10;
        }
        .btn-remove-icon:hover { background: #dc3545; color: #fff; }

        /* İkon Önizleme Kutusu */
        .input-group-text i { font-size: 1.2rem; min-width: 24px; text-align: center; }
    </style>
@endpush

@section('breadcrumb-title', 'Edit Category')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categories</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card card-outline-warning shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-edit mr-1 text-warning"></i> Edit Category: <span class="text-muted">{{ $category->name_en }}</span>
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.category.index')}}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <form action="{{route('admin.category.update', $category->id)}}" method="post" enctype="multipart/form-data" id="editCategoryForm">
                        @csrf
                        @method('PUT')

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 pr-md-4 border-right">
                                    <div class="section-title text-primary"><i class="fas fa-globe-americas mr-1"></i> English Content</div>

                                    <div class="form-group">
                                        <label for="name_en">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name_en" id="name_en" required
                                               class="form-control @error('name_en') is-invalid @enderror"
                                               value="{{ old('name_en', $category->name_en) }}">
                                        @error('name_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug_en">Slug</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link text-muted"></i></span>
                                            </div>
                                            <input type="text" name="slug_en" id="slug_en"
                                                   class="form-control @error('slug_en') is-invalid @enderror"
                                                   value="{{ old('slug_en', $category->slug_en) }}">
                                        </div>
                                        @error('slug_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_en">Short Description</label>
                                        <input type="text" name="description_en" id="description_en"
                                               class="form-control @error('description_en') is-invalid @enderror"
                                               value="{{ old('description_en', $category->description_en) }}">
                                        @error('description_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 pl-md-4">
                                    <div class="section-title text-info"><i class="fas fa-language mr-1"></i> Spanish Content</div>

                                    <div class="form-group">
                                        <label for="name_esp">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name_esp" id="name_esp" required
                                               class="form-control @error('name_esp') is-invalid @enderror"
                                               value="{{ old('name_esp', $category->name_esp) }}">
                                        @error('name_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug_esp">Slug</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link text-muted"></i></span>
                                            </div>
                                            <input type="text" name="slug_esp" id="slug_esp"
                                                   class="form-control @error('slug_esp') is-invalid @enderror"
                                                   value="{{ old('slug_esp', $category->slug_esp) }}">
                                        </div>
                                        @error('slug_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_esp">Short Description</label>
                                        <input type="text" name="description_esp" id="description_esp"
                                               class="form-control @error('description_esp') is-invalid @enderror"
                                               value="{{ old('description_esp', $category->description_esp) }}">
                                        @error('description_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title text-secondary"><i class="fas fa-image mr-1"></i> Category Media</div>

                                    <div class="image-preview-container mb-3">
                                        <div class="preview-box">
                                            <label class="small text-muted">Current Image</label>
                                            <div class="img-wrapper shadow-sm border">
                                                @if($category->image)
                                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Current">
                                                @else
                                                    <span class="text-muted small">No Image</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="preview-box" id="new-preview-box" style="display: none;">
                                            <label class="small text-primary font-weight-bold">New Selection Preview</label>
                                            <div class="img-wrapper border-primary shadow-sm">
                                                <img src="" id="preview-img">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Update Image <small class="text-muted">(Leave empty to keep current)</small></label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image"
                                                   class="custom-file-input @error('image') is-invalid @enderror"
                                                   onchange="previewImage(this)">
                                            <label class="custom-file-label" id="file-label" for="image">Choose new file...</label>
                                        </div>
                                        @error('image') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="section-title text-warning">
                                        <i class="fas fa-icons mr-1"></i> Category Features (Font Awesome)
                                    </div>

                                    <div class="alert alert-light border">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle"></i>
                                            Enter Font Awesome class names (e.g., <b>fas fa-wifi</b>, <b>fas fa-car</b>).
                                            <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank" class="text-primary font-weight-bold">Click here to find icons.</a>
                                        </small>
                                    </div>

                                    <div id="icons-container">
                                        {{-- Mevcut İkonları Listele (Veritabanından Gelen) --}}
                                        @if($category->icons->count() > 0)
                                            @foreach($category->icons as $index => $icon)
                                                <div class="icon-row shadow-sm" id="icon-row-{{ $index }}">
                                                    <div class="btn-remove-icon" onclick="removeIcon({{ $index }})" title="Remove">
                                                        <i class="fas fa-times fa-xs"></i>
                                                    </div>

                                                    <div class="row align-items-end">
                                                        <div class="col-md-3">
                                                            <label class="small text-muted mb-1">Font Awesome Class</label>
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-white">
                                                                        <i class="{{ $icon->icon }}" id="icon-display-{{ $index }}"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" name="icons[{{ $index }}][class]"
                                                                       class="form-control"
                                                                       value="{{ $icon->icon }}"
                                                                       placeholder="fas fa-home"
                                                                       oninput="updateIconPreview(this, {{ $index }})">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group mb-0">
                                                                <label class="small text-muted mb-1">Text (English)</label>
                                                                <input type="text" name="icons[{{ $index }}][text_en]"
                                                                       value="{{ $icon->text_en }}"
                                                                       class="form-control form-control-sm" placeholder="e.g. Free Wifi">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="form-group mb-0">
                                                                <label class="small text-muted mb-1">Text (Spanish)</label>
                                                                <input type="text" name="icons[{{ $index }}][text_esp]"
                                                                       value="{{ $icon->text_esp }}"
                                                                       class="form-control form-control-sm" placeholder="p.ej. Wifi Gratis">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <button type="button" class="btn btn-outline-success btn-sm mt-2" id="add-icon-btn">
                                        <i class="fas fa-plus mr-1"></i> Add New Feature Icon
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white py-3 text-right">
                            <button type="submit" class="btn btn-warning px-5 shadow-sm font-weight-bold">
                                <i class="fas fa-sync-alt mr-1"></i> Update Category
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
        const nameEn = document.getElementById('name_en');
        const slugEn = document.getElementById('slug_en');
        const nameEsp = document.getElementById('name_esp');
        const slugEsp = document.getElementById('slug_esp');

        let isSlugEnManual = true;
        let isSlugEspManual = true;

        slugEn.addEventListener('input', () => isSlugEnManual = true);
        slugEsp.addEventListener('input', () => isSlugEspManual = true);

        function convertToSlug(text) {
            const trMap = {'ç':'c','ğ':'g','ı':'i','ö':'o','ş':'s','ü':'u','Ç':'C','Ğ':'G','İ':'I','Ö':'O','Ş':'S','Ü':'U'};
            for (let key in trMap) { text = text.replace(new RegExp(key, 'g'), trMap[key]); }
            return text.toString().toLowerCase().trim()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '').replace(/-+$/, '');
        }

        nameEn.addEventListener('input', function() {
            if (slugEn.value === '') slugEn.value = convertToSlug(this.value);
        });

        nameEsp.addEventListener('input', function() {
            if (slugEsp.value === '') slugEsp.value = convertToSlug(this.value);
        });

        function previewImage(input) {
            const img = document.getElementById('preview-img');
            const newBox = document.getElementById('new-preview-box');
            const label = document.getElementById('file-label');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    newBox.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
                label.innerText = input.files[0].name;
            }
        }

        let iconIndex = {{ $category->icons->count() }};
        const iconsContainer = document.getElementById('icons-container');
        const addIconBtn = document.getElementById('add-icon-btn');

        // Yeni İkon Ekleme
        addIconBtn.addEventListener('click', function() {
            const html = `
                <div class="icon-row shadow-sm" id="icon-row-${iconIndex}">
                    <div class="btn-remove-icon" onclick="removeIcon(${iconIndex})" title="Remove">
                        <i class="fas fa-times fa-xs"></i>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label class="small text-muted mb-1">Font Awesome Class</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-circle-notch" id="icon-display-${iconIndex}"></i>
                                    </span>
                                </div>
                                <input type="text" name="icons[${iconIndex}][class]"
                                       class="form-control" placeholder="fas fa-home"
                                       oninput="updateIconPreview(this, ${iconIndex})">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="small text-muted mb-1">Text (English)</label>
                                <input type="text" name="icons[${iconIndex}][text_en]" class="form-control form-control-sm" placeholder="e.g. Free Wifi">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group mb-0">
                                <label class="small text-muted mb-1">Text (Spanish)</label>
                                <input type="text" name="icons[${iconIndex}][text_esp]" class="form-control form-control-sm" placeholder="p.ej. Wifi Gratis">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            iconsContainer.insertAdjacentHTML('beforeend', html);
            iconIndex++;
        });

        // Satır Silme
        window.removeIcon = function(index) {
            const row = document.getElementById(`icon-row-${index}`);
            if(row) row.remove();
        }

        // İkon Önizleme Güncelleme
        window.updateIconPreview = function(input, index) {
            const display = document.getElementById(`icon-display-${index}`);
            const val = input.value.trim();
            if(val.length > 0) {
                display.className = val;
            } else {
                display.className = 'fas fa-circle-notch';
            }
        }
    </script>
@endpush
