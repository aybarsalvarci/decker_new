@extends('admin.layouts.master')

@section('title', 'General Settings')

@push('css')
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .section-title { font-size: 1rem; font-weight: 700; color: #495057; margin-bottom: 15px; padding-bottom: 5px; border-bottom: 2px solid #f4f6f9; display: flex; align-items: center; }
        .section-title i { margin-right: 8px; color: #007bff; }

        .logo-preview-box { width: 100%; max-width: 250px; height: 120px; border: 2px dashed #dee2e6; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; overflow: hidden; margin-bottom: 10px; }
        .logo-preview-box img { max-width: 100%; max-height: 100%; object-fit: contain; }

        .favicon-preview-box { width: 64px; height: 64px; border: 2px dashed #dee2e6; border-radius: 12px; display: flex; align-items: center; justify-content: center; background: #ffffff; overflow: hidden; margin: 0 auto 10px auto; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .favicon-preview-box img { width: 32px; height: 32px; object-fit: contain; }

        .branding-divider { border-top: 1px solid #ebedef; margin: 25px 0; position: relative; }
        .branding-divider span { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #fff; padding: 0 15px; color: #adb5bd; font-size: 0.8rem; text-transform: uppercase; font-weight: bold; }

        .input-group-text { width: 42px; justify-content: center; background-color: #f8f9fa; }
        .seo-helper { font-size: 0.75rem; color: #6c757d; display: block; margin-top: 4px; }
    </style>
@endpush

@section('breadcrumb-title', 'Settings')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">General Settings</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold"><i class="fas fa-cogs mr-2"></i> Configuration Portal</h3>
                        </div>
                        <div class="card-body">

                            <div class="section-title"><i class="fas fa-globe"></i> Website Titles</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="site_title_en">Site Title (EN)</label>
                                    <input type="text" name="site_title_en" id="site_title_en"
                                           class="form-control @error('site_title_en') is-invalid @enderror"
                                           value="{{ old('site_title_en', $settings->site_title_en) }}">
                                    @error('site_title_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="site_title_esp">Site Title (ES)</label>
                                    <input type="text" name="site_title_esp" id="site_title_esp"
                                           class="form-control @error('site_title_esp') is-invalid @enderror"
                                           value="{{ old('site_title_esp', $settings->site_title_esp) }}">
                                    @error('site_title_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="section-title mt-4"><i class="fas fa-search"></i> SEO Meta Configuration</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="meta_keywords_en">Meta Keywords (EN)</label>
                                    <textarea name="meta_keywords_en" id="meta_keywords_en" class="form-control @error('meta_keywords_en') is-invalid @enderror" rows="2" placeholder="wpc, decker, ...">{{ old('meta_keywords_en', $settings->meta_keywords_en) }}</textarea>
                                    @error('meta_keywords_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    <span class="seo-helper">Separated by commas.</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_keywords_esp">Meta Keywords (ES)</label>
                                    <textarea name="meta_keywords_esp" id="meta_keywords_esp" class="form-control @error('meta_keywords_esp') is-invalid @enderror" rows="2" placeholder="wpc, decker, ...">{{ old('meta_keywords_esp', $settings->meta_keywords_esp) }}</textarea>
                                    @error('meta_keywords_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    <span class="seo-helper">Separado por comas.</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_description_en">Meta Description (EN)</label>
                                    <textarea name="meta_description_en" id="meta_description_en" class="form-control @error('meta_description_en') is-invalid @enderror" rows="3">{{ old('meta_description_en', $settings->meta_description_en) }}</textarea>
                                    @error('meta_description_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    <span class="seo-helper">Target: 150-160 characters.</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_description_esp">Meta Description (ES)</label>
                                    <textarea name="meta_description_esp" id="meta_description_esp" class="form-control @error('meta_description_esp') is-invalid @enderror" rows="3">{{ old('meta_description_esp', $settings->meta_description_esp) }}</textarea>
                                    @error('meta_description_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    <span class="seo-helper">Objetivo: 150-160 caracteres.</span>
                                </div>
                            </div>

                            <div class="section-title mt-4"><i class="fas fa-envelope-open-text"></i> Contact Information</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">Public Email Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $settings->email) }}">
                                        @error('email') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone_number">Contact Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $settings->phone_number) }}">
                                        @error('phone_number') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Headquarters Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $settings->address) }}">
                                        @error('address') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="section-title mt-4"><i class="fas fa-columns"></i> Footer Configuration</div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Footer Address (Optional)</label>
                                    <input type="text" name="footer_address" class="form-control @error('footer_address') is-invalid @enderror" placeholder="If different from main address..." value="{{ old('footer_address', $settings->footer_address) }}">
                                    @error('footer_address') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Footer Description (EN)</label>
                                    <textarea name="footer_desc_en" class="form-control @error('footer_desc_en') is-invalid @enderror" rows="3">{{ old('footer_desc_en', $settings->footer_desc_en) }}</textarea>
                                    @error('footer_desc_en') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Footer Description (ES)</label>
                                    <textarea name="footer_desc_esp" class="form-control @error('footer_desc_esp') is-invalid @enderror" rows="3">{{ old('footer_desc_esp', $settings->footer_desc_esp) }}</textarea>
                                    @error('footer_desc_esp') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="section-title mt-4"><i class="fas fa-share-alt"></i> Social Media Links</div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Facebook</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text text-primary"><i class="fab fa-facebook-f"></i></span></div>
                                        <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $settings->facebook) }}">
                                        @error('facebook') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>X (Twitter)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text text-dark"><i class="fab fa-x-twitter"></i></span></div>
                                        <input type="text" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $settings->twitter) }}">
                                        @error('twitter') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Instagram</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text text-danger"><i class="fab fa-instagram"></i></span></div>
                                        <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $settings->instagram) }}">
                                        @error('instagram') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white">
                            <h3 class="card-title font-weight-bold"><i class="fas fa-fingerprint mr-2"></i> Identity & Branding</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group text-center">
                                <label class="d-block text-left mb-2">Header Logo</label>
                                <div class="logo-preview-box shadow-sm mx-auto">
                                    <img src="{{ $settings->header_logo ? asset('storage/' . $settings->header_logo) : asset('admin/img/no-image.png') }}"
                                         id="header-logo-preview" alt="Header Logo">
                                </div>
                                <div class="custom-file mt-2">
                                    <input type="file" name="header_logo" id="header_logo" class="custom-file-input @error('header_logo') is-invalid @enderror" onchange="previewImage(this, '#header-logo-preview')">
                                    <label class="custom-file-label text-left" for="header_logo">Update Header Logo...</label>
                                    @error('header_logo') <span class="invalid-feedback d-block">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="branding-divider"><span>AND</span></div>

                            <div class="form-group text-center">
                                <label class="d-block text-left mb-2">Footer Logo</label>
                                <div class="logo-preview-box shadow-sm mx-auto" style="background: #343a40;"> <img src="{{ $settings->footer_logo ? asset('storage/' . $settings->footer_logo) : asset('admin/img/no-image.png') }}"
                                                                                                                   id="footer-logo-preview" alt="Footer Logo">
                                </div>
                                <div class="custom-file mt-2">
                                    <input type="file" name="footer_logo" id="footer_logo" class="custom-file-input @error('footer_logo') is-invalid @enderror" onchange="previewImage(this, '#footer-logo-preview')">
                                    <label class="custom-file-label text-left" for="footer_logo">Update Footer Logo...</label>
                                    @error('footer_logo') <span class="invalid-feedback d-block">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="branding-divider"><span>AND</span></div>

                            <div class="form-group text-center">
                                <label class="d-block text-left mb-2">Browser Favicon</label>
                                <div class="favicon-preview-box mx-auto">
                                    <img src="{{ $settings->favicon ? asset('storage/' . $settings->favicon) : asset('admin/img/favicon-placeholder.png') }}"
                                         id="favicon-preview" alt="Favicon">
                                </div>
                                <div class="custom-file mt-2">
                                    <input type="file" name="favicon" id="favicon" class="custom-file-input @error('favicon') is-invalid @enderror" onchange="previewImage(this, '#favicon-preview')">
                                    <label class="custom-file-label text-left" for="favicon">Choose Favicon...</label>
                                    @error('favicon') <span class="invalid-feedback d-block">{{$message}}</span> @enderror
                                </div>
                                <small class="text-muted d-block mt-2">Recommended: 32x32px .png or .ico</small>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 bg-transparent">
                        <div class="card-body p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg font-weight-bold py-3">
                                <i class="fas fa-save mr-2"></i> UPDATE SETTINGS
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
