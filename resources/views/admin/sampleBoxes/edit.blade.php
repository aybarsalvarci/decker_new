@extends('admin.layouts.master')

@section('title', 'Free Sample Düzenle: ' . $box->title_en)

@push('css')
    <style>
        .card-outline-warning { border-top: 3px solid #ffc107; }
        .section-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee; }

        /* Resim Alanları */
        .image-preview-container { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px; }
        .preview-box { flex: 1; min-width: 200px; max-width: 280px; }
        .img-wrapper {
            height: 180px; border: 2px solid #eee; border-radius: 8px;
            overflow: hidden; background: #f8f9fa; display: flex;
            align-items: center; justify-content: center;
        }
        .img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .form-control:focus { border-color: #ffc107; box-shadow: none; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card card-outline-warning shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-edit mr-1 text-warning"></i> Edit Sample Box: <span class="text-muted">{{ $box->title_en }}</span>
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.free-sample.box.index')}}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <form action="{{route('admin.free-sample.box.update', $box->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 pr-md-4 border-right">
                                    <div class="section-title text-primary"><i class="fas fa-globe-americas mr-1"></i> English Content</div>

                                    <div class="form-group">
                                        <label for="title_en">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title_en" id="title_en" required
                                               class="form-control @error('title_en') is-invalid @enderror"
                                               value="{{ old('title_en', $box->title_en) }}">
                                        @error('title_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_en">Description <span class="text-danger">*</span></label>
                                        <textarea name="description_en" id="description_en" rows="5" required
                                                  class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en', $box->description_en) }}</textarea>
                                        @error('description_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 pl-md-4">
                                    <div class="section-title text-info"><i class="fas fa-language mr-1"></i> Spanish Content</div>

                                    <div class="form-group">
                                        <label for="title_esp">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title_esp" id="title_esp" required
                                               class="form-control @error('title_esp') is-invalid @enderror"
                                               value="{{ old('title_esp', $box->title_esp) }}">
                                        @error('title_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_esp">Description <span class="text-danger">*</span></label>
                                        <textarea name="description_esp" id="description_esp" rows="5" required
                                                  class="form-control @error('description_esp') is-invalid @enderror">{{ old('description_esp', $box->description_esp) }}</textarea>
                                        @error('description_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title text-secondary"><i class="fas fa-image mr-1"></i> Sample Box Media</div>

                                    <div class="image-preview-container mb-3">
                                        <div class="preview-box">
                                            <label class="small text-muted d-block">Current Box Image</label>
                                            <div class="img-wrapper shadow-sm border">
                                                @if($box->image)
                                                    <img src="{{ asset('storage/' . $box->image) }}" alt="Current Image">
                                                @else
                                                    <span class="text-muted">No Image Uploaded</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="preview-box" id="new-preview-box" style="display: none;">
                                            <label class="small text-warning font-weight-bold d-block">New Selection Preview</label>
                                            <div class="img-wrapper border-warning shadow-sm">
                                                <img src="" id="preview-img">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Change Box Image <small class="text-muted">(Leave empty to keep current)</small></label>
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
                        </div>

                        <div class="card-footer bg-light py-3 text-right">
                            <button type="submit" class="btn btn-warning px-5 shadow-sm font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Update Sample Box
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
    </script>
@endpush
