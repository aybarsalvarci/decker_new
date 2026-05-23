@extends('admin.layouts.master')

@section('title', 'Create Category')

@push('css')
    <style>
        /* Genel Kart ve Layout Stilleri */
        .card-outline-primary { border-top: 3px solid #007bff; }
        .section-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        .invalid-feedback { display: block; }

        /* Ana Kategori Resmi Önizleme Stilleri */
        .image-preview {
            width: 100%; max-width: 250px; height: 160px;
            border: 2px dashed #ced4da; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; margin-top: 10px; background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .image-preview img { width: 100%; height: 100%; object-fit: cover; }

        /* Font Awesome Repeater Stilleri */
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

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card card-outline-primary shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-primary">
                            <i class="fas fa-plus-circle mr-1"></i> Create New Category
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.category.index')}}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data" id="categoryForm">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 pr-md-4 border-right">
                                    <div class="section-title text-primary">
                                        <i class="fas fa-globe-americas mr-1"></i> English Content
                                    </div>

                                    <div class="form-group">
                                        <label for="name_en">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name_en" id="name_en" required
                                               class="form-control @error('name_en') is-invalid @enderror"
                                               value="{{old('name_en')}}" placeholder="e.g. Living Room">
                                        @error('name_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug_en">Slug</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-link"></i></span></div>
                                            <input type="text" name="slug_en" id="slug_en"
                                                   class="form-control @error('slug_en') is-invalid @enderror"
                                                   value="{{old('slug_en')}}" placeholder="living-room">
                                        </div>
                                        @error('slug_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_en">Short Description</label>
                                        <input type="text" name="description_en" id="description_en"
                                               class="form-control @error('description_en') is-invalid @enderror"
                                               value="{{old('description_en')}}" placeholder="Brief summary of the category">
                                        @error('description_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 pl-md-4">
                                    <div class="section-title text-info">
                                        <i class="fas fa-language mr-1"></i> Spanish Content
                                    </div>

                                    <div class="form-group">
                                        <label for="name_esp">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name_esp" id="name_esp" required
                                               class="form-control @error('name_esp') is-invalid @enderror"
                                               value="{{old('name_esp')}}" placeholder="p.ej. Sala de Estar">
                                        @error('name_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug_esp">Slug</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-link"></i></span></div>
                                            <input type="text" name="slug_esp" id="slug_esp"
                                                   class="form-control @error('slug_esp') is-invalid @enderror"
                                                   value="{{old('slug_esp')}}" placeholder="sala-de-estar">
                                        </div>
                                        @error('slug_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_esp">Short Description</label>
                                        <input type="text" name="description_esp" id="description_esp"
                                               class="form-control @error('description_esp') is-invalid @enderror"
                                               value="{{old('description_esp')}}" placeholder="Breve resumen de la categoría">
                                        @error('description_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="section-title text-secondary">
                                        <i class="fas fa-photo-video mr-1"></i> Category Media
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Category Main Image <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" required
                                                   class="custom-file-input @error('image') is-invalid @enderror"
                                                   onchange="previewImage(this)">
                                            <label class="custom-file-label" id="file-label" for="image">Choose image...</label>
                                        </div>
                                        @error('image') <span class="invalid-feedback">{{$message}}</span> @enderror

                                        <div class="image-preview shadow-sm" id="preview-container">
                                            <div id="preview-placeholder" class="text-center">
                                                <i class="fas fa-cloud-upload-alt fa-2x text-muted d-block mb-2"></i>
                                                <span class="text-muted small">Selected image preview</span>
                                            </div>
                                            <img src="" id="preview-img" style="display:none;">
                                        </div>
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

                                    <div id="icons-container"></div>

                                    <button type="button" class="btn btn-outline-success btn-sm mt-2" id="add-icon-btn">
                                        <i class="fas fa-plus mr-1"></i> Add New Feature Icon
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white py-3 text-right">
                            <button type="reset" class="btn btn-link text-muted mr-3" onclick="resetFormFull()">Reset Form</button>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="fas fa-save mr-1"></i> Save Category
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
        // --- 1. SLUG OLUŞTURMA İŞLEMLERİ ---
        const nameEn = document.getElementById('name_en');
        const slugEn = document.getElementById('slug_en');
        const nameEsp = document.getElementById('name_esp');
        const slugEsp = document.getElementById('slug_esp');

        let isSlugEnManual = slugEn.value !== "";
        let isSlugEspManual = slugEsp.value !== "";

        function convertToSlug(text) {
            const trMap = {
                'ç':'c','ğ':'g','ı':'i','ö':'o','ş':'s','ü':'u',
                'Ç':'C','Ğ':'G','İ':'I','Ö':'O','Ş':'S','Ü':'U'
            };
            for (let key in trMap) text = text.replace(new RegExp(key, 'g'), trMap[key]);
            return text.toString().toLowerCase().trim()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }

        nameEn.addEventListener('input', () => { if (!isSlugEnManual) slugEn.value = convertToSlug(nameEn.value); });
        slugEn.addEventListener('input', () => { isSlugEnManual = true; });

        nameEsp.addEventListener('input', () => { if (!isSlugEspManual) slugEsp.value = convertToSlug(nameEsp.value); });
        slugEsp.addEventListener('input', () => { isSlugEspManual = true; });

        // --- 2. ANA RESİM ÖNİZLEME ---
        function previewImage(input) {
            const img = document.getElementById('preview-img');
            const placeholder = document.getElementById('preview-placeholder');
            const label = document.getElementById('file-label');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    img.style.display = 'block';
                    placeholder.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
                label.innerText = input.files[0].name;
            }
        }

        // --- 3. ICON REPEATER (FONT AWESOME) ---
        let iconIndex = 0;
        const iconsContainer = document.getElementById('icons-container');
        const addIconBtn = document.getElementById('add-icon-btn');

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
                                       class="form-control"
                                       placeholder="fas fa-home"
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

        // İkon Önizleme
        window.updateIconPreview = function(input, index) {
            const display = document.getElementById(`icon-display-${index}`);
            const val = input.value.trim();
            if(val.length > 0) {
                display.className = val;
            } else {
                display.className = 'fas fa-circle-notch';
            }
        }

        // --- 4. FORM RESETLEME ---
        function resetFormFull() {
            // Ana resmi sıfırla
            document.getElementById('preview-img').style.display = 'none';
            document.getElementById('preview-placeholder').style.display = 'block';
            document.getElementById('file-label').innerText = 'Choose image...';

            // İkonları temizle
            document.getElementById('icons-container').innerHTML = '';
            iconIndex = 0;

            // Slug kilitlerini aç
            isSlugEnManual = false;
            isSlugEspManual = false;
        }
    </script>
@endpush
