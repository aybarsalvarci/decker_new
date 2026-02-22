@extends('admin.layouts.master')

@section('title', 'Edit Question')

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        /* Hata mesajlarının görünürlüğü */
        .invalid-feedback { display: block; }

        /* Editörün varsayılan yüksekliği */
        .note-editor .note-editable { min-height: 200px; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card card-outline-primary shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-primary">
                            <i class="fas fa-edit mr-1"></i> Edit FAQ
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.faqs.index')}}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    {{-- Form Action: Update rotasına gider ve ID parametresi alır --}}
                    <form action="{{route('admin.faqs.update', $faq->id)}}" method="post" id="faqForm">
                        @csrf
                        @method('PUT') {{-- ÖNEMLİ: Update işlemi için PUT metodu --}}

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 pr-md-4 border-right">
                                    <div class="section-title text-primary">
                                        <i class="fas fa-globe-americas mr-1"></i> English Content
                                    </div>

                                    <div class="form-group">
                                        <label for="title_en">Question (EN) <span class="text-danger">*</span></label>
                                        {{-- Value: Önce eski inputa bakar, yoksa veritabanından gelen veriyi yazar --}}
                                        <input type="text" name="title_en" id="title_en" required
                                               class="form-control @error('title_en') is-invalid @enderror"
                                               value="{{old('title_en', $faq->title_en)}}"
                                               placeholder="e.g. How do I install the decking?">
                                        @error('title_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="content_en">Answer (EN) <span class="text-danger">*</span></label>
                                        <textarea name="content_en" id="content_en" required
                                                  class="form-control summernote @error('content_en') is-invalid @enderror">
                                            {{old('content_en', $faq->content_en)}}
                                        </textarea>
                                        @error('content_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 pl-md-4">
                                    <div class="section-title text-info">
                                        <i class="fas fa-language mr-1"></i> Spanish Content
                                    </div>

                                    <div class="form-group">
                                        <label for="title_esp">Question (ESP) <span class="text-danger">*</span></label>
                                        <input type="text" name="title_esp" id="title_esp" required
                                               class="form-control @error('title_esp') is-invalid @enderror"
                                               value="{{old('title_esp', $faq->title_esp)}}"
                                               placeholder="p.ej. ¿Cómo instalo la cubierta?">
                                        @error('title_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="content_esp">Answer (ESP) <span class="text-danger">*</span></label>
                                        <textarea name="content_esp" id="content_esp" required
                                                  class="form-control summernote @error('content_esp') is-invalid @enderror">
                                            {{old('content_esp', $faq->content_esp)}}
                                        </textarea>
                                        @error('content_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white py-3 text-right">
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-link text-muted mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="fas fa-sync-alt mr-1"></i> Update Question
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('back/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            $('.summernote').summernote({
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush
