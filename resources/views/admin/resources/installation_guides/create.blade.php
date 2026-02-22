@extends('admin.layouts.master')

@section('title', 'Add New Installation Video')

@push('css')
    <style>
        .card-outline-info { border-top: 3px solid #17a2b8; }
        .help-block { font-size: 0.85rem; color: #6c757d; margin-top: 5px; }
        code { color: #e83e8c; background: #f8f9fa; padding: 2px 4px; border-radius: 4px; }
    </style>
@endpush

@section('breadcrumb-title', 'Add New Video')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.resources.installation-guides.index')}}">Installation Guides</a></li>
    <li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline-info shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-plus-circle mr-2 text-info"></i> New Video Form
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.resources.installation-guides.index')}}" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <form action="{{route('admin.resources.installation-guides.store')}}" method="POST">
                        @csrf
                        <div class="card-body p-4">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title (English) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    EN
                                                </span>
                                            </div>
                                            <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror"
                                                   placeholder="e.g. Deck Installation Guide" value="{{old('title_en')}}" required>
                                        </div>
                                        @error('title_en') <span class="text-danger small">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title (Spanish) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    ES
                                                </span>
                                            </div>
                                            <input type="text" name="title_esp" class="form-control"
                                                   placeholder="e.g. Guía de instalación" value="{{old('title_esp')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="form-group">
                                <label class="font-weight-bold">Embed Code (Iframe) <span class="text-danger">*</span></label>
                                <textarea name="video" class="form-control font-monospace @error('video') is-invalid @enderror"
                                          rows="6" required placeholder='<iframe width="560" height="315" src="https://www.youtube.com/embed/..." ...></iframe>'>{{old('video')}}</textarea>

                                @error('video') <span class="text-danger small">{{$message}}</span> @enderror

                                <div class="alert alert-light border mt-3">
                                    <h6 class="text-info"><i class="fas fa-info-circle mr-1"></i> How to get the code?</h6>
                                    <ol class="small pl-3 mb-0">
                                        <li>Go to YouTube or Vimeo video page.</li>
                                        <li>Click <b>Share</b> button and select <b>Embed</b>.</li>
                                        <li>Copy the code starting with <code>&lt;iframe...</code> and paste it above.</li>
                                    </ol>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-white text-right">
                            <button type="submit" class="btn btn-info px-5 shadow-sm">
                                <i class="fas fa-save mr-1"></i> Save Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
