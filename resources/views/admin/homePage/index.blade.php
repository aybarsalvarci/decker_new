@extends('admin.layouts.master')

@section('title', 'Homepage Settings')

@push('css')
    <style>
        :root { --accent-color: #e63946; --navy-dark: #1a252f; }
        .card-outline-navy { border-top: 3px solid var(--navy-dark); }
        .card-outline-accent { border-top: 3px solid var(--accent-color); }

        .video-preview-box {
            width: 100%; height: 220px; background: #000; border-radius: 8px;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
            border: 1px solid #ddd;
        }
        .video-preview-box video { width: 100%; height: 100%; object-fit: cover; opacity: 0.7; }

        .lang-label { font-size: 0.75rem; font-weight: 800; padding: 3px 8px; border-radius: 4px; margin-right: 5px; text-transform: uppercase; }
        .label-en { background: #007bff; color: white; }
        .label-esp { background: #17a2b8; color: white; }

        .sticky-footer {
            position: sticky; bottom: 20px; z-index: 1000;
            background: rgba(255,255,255,0.9); backdrop-filter: blur(5px);
            border: 1px solid #dee2e6; border-radius: 10px;
        }
        /* Hata mesajı stili */
        .invalid-feedback { display: block; font-weight: 600; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">

        <form action="{{ route('admin.home-settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Section 1: Hero Video --}}
            <div class="card card-outline-navy shadow-sm">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-play-circle mr-2 text-navy"></i> Section 1: Hero Video & Entrance</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <label class="font-weight-bold">Background Video (topVideo)</label>
                            <div class="video-preview-box mb-3 shadow-sm @error('topVideo') border-danger @enderror">
                                @if($settings->topVideo)
                                    <video autoplay muted loop>
                                        <source src="{{ asset('storage/' . $settings->topVideo) }}" type="video/mp4">
                                    </video>
                                @else
                                    <div class="text-center text-white">
                                        <i class="fas fa-video-slash fa-2x mb-2"></i>
                                        <p class="small mb-0">No video uploaded</p>
                                    </div>
                                @endif
                            </div>
                            <div class="custom-file">
                                <input type="file" name="topVideo" class="custom-file-input @error('topVideo') is-invalid @enderror" id="topVideo" accept="video/mp4">
                                <label class="custom-file-label" for="topVideo">Browse MP4 file...</label>
                            </div>
                            @error('topVideo') <span class="invalid-feedback text-danger small mt-1">{{ $message }}</span> @enderror
                            <p class="text-muted mt-3 small"><i class="fas fa-info-circle mr-1"></i> Suggested: 1920x1080px, Silent MP4, Max 20MB.</p>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label><span class="lang-label label-en">EN</span> Hero Title</label>
                                    <input type="text" name="topVideoTitle_en" class="form-control @error('topVideoTitle_en') is-invalid @enderror" value="{{ old('topVideoTitle_en', $settings->topVideoTitle_en) }}">
                                    @error('topVideoTitle_en') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label><span class="lang-label label-esp">ESP</span> Hero Title</label>
                                    <input type="text" name="topVideoTitle_esp" class="form-control @error('topVideoTitle_esp') is-invalid @enderror" value="{{ old('topVideoTitle_esp', $settings->topVideoTitle_esp) }}">
                                    @error('topVideoTitle_esp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label><span class="lang-label label-en">EN</span> Hero Description</label>
                                    <textarea name="topVideoDesc_en" class="form-control @error('topVideoDesc_en') is-invalid @enderror" rows="3">{{ old('topVideoDesc_en', $settings->topVideoDesc_en) }}</textarea>
                                    @error('topVideoDesc_en') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label><span class="lang-label label-esp">ESP</span> Hero Description</label>
                                    <textarea name="topVideoDesc_esp" class="form-control @error('topVideoDesc_esp') is-invalid @enderror" rows="3">{{ old('topVideoDesc_esp', $settings->topVideoDesc_esp) }}</textarea>
                                    @error('topVideoDesc_esp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: About --}}
            <div class="card card-outline-accent shadow-sm">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-leaf mr-2 text-success"></i> Section 2: Brand Story & About</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <label class="font-weight-bold">Promotion Video (iframeVideo)</label>
                            <div class="embed-responsive embed-responsive-16by9 rounded shadow-sm border mb-3 @error('iframeVideo') border-danger @enderror" style="background: #f1f1f1;">
                                {!! $settings->iframeVideo !!}
                            </div>
                            <div class="form-group">
                                <label class="small">YouTube/Vimeo Embed Code</label>
                                <textarea name="iframeVideo" class="form-control @error('iframeVideo') is-invalid @enderror" rows="2">{{ old('iframeVideo', $settings->iframeVideo) }}</textarea>
                                @error('iframeVideo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 border-right">
                                    <label class="text-primary"><span class="lang-label label-en">EN</span> About Section Title</label>
                                    <input type="text" name="homePageAboutTitle_en" class="form-control mb-2 @error('homePageAboutTitle_en') is-invalid @enderror" value="{{ old('homePageAboutTitle_en', $settings->homePageAboutTitle_en) }}">
                                    @error('homePageAboutTitle_en') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                    <label class="text-primary mt-2"><span class="lang-label label-en">EN</span> About Description</label>
                                    <textarea name="homePageAboutDesc_en" class="form-control @error('homePageAboutDesc_en') is-invalid @enderror" rows="5">{{ old('homePageAboutDesc_en', $settings->homePageAboutDesc_en) }}</textarea>
                                    @error('homePageAboutDesc_en') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="text-info"><span class="lang-label label-esp">ESP</span> About Section Title</label>
                                    <input type="text" name="homePageAboutTitle_esp" class="form-control mb-2 @error('homePageAboutTitle_esp') is-invalid @enderror" value="{{ old('homePageAboutTitle_esp', $settings->homePageAboutTitle_esp) }}">
                                    @error('homePageAboutTitle_esp') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                    <label class="text-info mt-2"><span class="lang-label label-esp">ESP</span> About Description</label>
                                    <textarea name="homePageAboutDesc_esp" class="form-control @error('homePageAboutDesc_esp') is-invalid @enderror" rows="5">{{ old('homePageAboutDesc_esp', $settings->homePageAboutDesc_esp) }}</textarea>
                                    @error('homePageAboutDesc_esp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card  shadow-lg">
                <div class="card-body p-3 text-right">
                    <button type="submit" class="btn btn-dark px-5 shadow font-weight-bold" style="background: #1a252f;">
                        <i class="fas fa-save mr-2"></i> UPDATE HOMEPAGE CONTENT
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('js')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endpush
