@extends('admin.layouts.master')

@section('title', 'Edit Video: ' . $video->title_en)

@push('css')
    <style>
        .card-outline-info { border-top: 3px solid #17a2b8; }
        .video-preview-box {
            background: #000;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
        }
        .video-preview-box iframe {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Edit Video')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.resources.installation-guides.index')}}">Installation Guides</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.resources.installation-guides.update', $video->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline-info shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-edit mr-2 text-info"></i> Edit Video Details
                            </h3>
                            <div class="card-tools">
                                <a href="{{route('admin.resources.installation-guides.index')}}" class="btn btn-default btn-sm">
                                    <i class="fas fa-arrow-left mr-1"></i> Back
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title (English) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="flag-icon flag-icon-us"></i></span>
                                            </div>
                                            <input type="text" name="title_en" class="form-control" required
                                                   value="{{old('title_en', $video->title_en)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title (Spanish)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="flag-icon flag-icon-es"></i></span>
                                            </div>
                                            <input type="text" name="title_esp" class="form-control"
                                                   value="{{old('title_esp', $video->title_esp)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label class="font-weight-bold">Embed Code (Iframe) <span class="text-danger">*</span></label>
                                <textarea name="video" class="form-control font-monospace" rows="8" required>{{old('video', $video->video)}}</textarea>
                                <small class="text-muted">Edit the iframe code here to change the video source.</small>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-info btn-block shadow-sm font-weight-bold">
                                <i class="fas fa-sync-alt mr-1"></i> UPDATE VIDEO
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h3 class="card-title font-weight-bold" style="font-size: 1rem;">Current Video Preview</h3>
                        </div>
                        <div class="card-body p-2 bg-secondary">
                            <div class="video-preview-box">
                                {!! $video->video !!}
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center text-muted small">
                            If the video above is working, your iframe code is correct.
                        </div>
                    </div>

                    <div class="callout callout-info mt-3">
                        <h5 class="small font-weight-bold">Note:</h5>
                        <p class="small m-0 text-muted">Changing the width/height in the iframe code will not affect the responsive design on the frontend.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
