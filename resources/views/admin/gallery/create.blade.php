@extends("admin.layouts.master")

@section('title', "Upload New Photo")

@push('css')
    <style>
        /* Yükleme Alanı Tasarımı */
        .upload-area {
            border: 2px dashed #ced4da;
            border-radius: 10px;
            background: #f8f9fa;
            padding: 50px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .upload-area:hover {
            background: #e9ecef;
            border-color: #007bff;
        }

        .upload-area input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            font-size: 50px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        /* Önizleme Alanı */
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .preview-image-box {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid #dee2e6;
        }

        .preview-image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Upload New Photo')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.resources.gallery.index')}}">Gallery</a></li>
    <li class="breadcrumb-item active">Yükle</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline shadow-sm" style="border-top: 3px solid #28a745;">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-cloud-upload-alt mr-2 text-success"></i> Bulk Photo Upload
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.resources.gallery.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back To List
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Hata Mesajları --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.resources.gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Select Photos (You can make multiple selections)</label>
                                <div class="upload-area" id="uploadArea">
                                    <i class="fas fa-images upload-icon"></i>
                                    <h5 class="text-muted">Click or drag to select photos</h5>
                                    <p class="small text-secondary mb-0">Desteklenen formatlar: JPG, PNG, JPEG</p>

                                    <input type="file" name="images[]" id="images" multiple accept="image/*" required>
                                </div>
                            </div>

                            <div class="preview-container" id="previewContainer"></div>

                            <div class="form-group mt-4 text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                    <i class="fas fa-save mr-2"></i> Save Photos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#images').on('change', function() {
                var previewContainer = $('#previewContainer');
                previewContainer.html('');

                if (this.files) {
                    var filesAmount = this.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var html = `
                                <div class="preview-image-box animated fadeIn">
                                    <img src="${event.target.result}" alt="Preview">
                                </div>
                            `;
                            $($.parseHTML(html)).appendTo(previewContainer);
                        }

                        reader.readAsDataURL(this.files[i]);
                    }
                }
            });

            $('.upload-area').on('dragover', function(){
                $(this).addClass('bg-light border-primary');
            });
            $('.upload-area').on('dragleave drop', function(){
                $(this).removeClass('bg-light border-primary');
            });
        });
    </script>
@endpush
