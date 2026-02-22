@extends('admin.layouts.master')

@section('title', 'Yeni Free Sample Oluştur')

@push('css')
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .section-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee; }

        /* Resim Önizleme */
        .image-preview {
            width: 100%; max-width: 300px; height: 180px;
            border: 2px dashed #ced4da; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; margin-top: 10px; background-color: #f8f9fa;
        }
        .image-preview img { width: 100%; height: 100%; object-fit: cover; }

        .form-control:focus { border-color: #007bff; box-shadow: none; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card card-outline-primary shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-primary">
                            <i class="fas fa-box-open mr-1"></i> Add New Free Sample Box
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.free-sample.index')}}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <form action="{{route('admin.free-sample.box.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 pr-md-4 border-right">
                                    <div class="section-title text-primary">
                                        <i class="fas fa-globe-americas mr-1"></i> English Content
                                    </div>

                                    <div class="form-group">
                                        <label for="title_en">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title_en" id="title_en" required
                                               class="form-control @error('title_en') is-invalid @enderror"
                                               value="{{old('title_en')}}" placeholder="e.g. Cosmetic Starter Pack">
                                        @error('title_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_en">Description <span class="text-danger">*</span></label>
                                        <textarea name="description_en" id="description_en" rows="4" required
                                                  class="form-control @error('description_en') is-invalid @enderror"
                                                  placeholder="Detailed description for English users...">{{old('description_en')}}</textarea>
                                        @error('description_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 pl-md-4">
                                    <div class="section-title text-info">
                                        <i class="fas fa-language mr-1"></i> Spanish Content
                                    </div>

                                    <div class="form-group">
                                        <label for="title_esp">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title_esp" id="title_esp" required
                                               class="form-control @error('title_esp') is-invalid @enderror"
                                               value="{{old('title_esp')}}" placeholder="p.ej. Pack de Inicio Cosmético">
                                        @error('title_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_esp">Description <span class="text-danger">*</span></label>
                                        <textarea name="description_esp" id="description_esp" rows="4" required
                                                  class="form-control @error('description_esp') is-invalid @enderror"
                                                  placeholder="Descripción detallada para usuarios españoles...">{{old('description_esp')}}</textarea>
                                        @error('description_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="section-title text-secondary">
                                        <i class="fas fa-image mr-1"></i> Sample Box Media
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">Box Image <span class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" name="image" id="image" required
                                                           class="custom-file-input @error('image') is-invalid @enderror"
                                                           onchange="previewImage(this)">
                                                    <label class="custom-file-label" id="file-label" for="image">Choose box image...</label>
                                                </div>
                                                <small class="text-muted mt-2 d-block">Recommended size: 800x600px (JPG, PNG)</small>
                                                @error('image') <span class="invalid-feedback">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="image-preview shadow-sm" id="preview-container">
                                                <div id="preview-placeholder" class="text-center text-muted">
                                                    <i class="fas fa-cloud-upload-alt fa-2x d-block mb-2"></i>
                                                    <span>Preview will appear here</span>
                                                </div>
                                                <img src="" id="preview-img" style="display:none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light py-3 text-right">
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="fas fa-save mr-1"></i> Save Sample Box
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
        // Image Preview Logic
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
    </script>
@endpush
