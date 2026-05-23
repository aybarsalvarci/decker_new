@extends('admin.layouts.master')

@section('title', 'Contact Information')

@push('css')
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .section-title { font-size: 1rem; font-weight: 700; color: #495057; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f4f6f9; display: flex; align-items: center; }
        .section-title i { margin-right: 8px; color: #007bff; }

        /* Map Preview Alanı */
        .map-preview-box { width: 100%; height: 300px; border: 2px solid #dee2e6; border-radius: 8px; overflow: hidden; background: #f8f9fa; margin-bottom: 15px; position: relative; }
        .map-preview-box iframe { width: 100% !important; height: 100% !important; border: none; }
        .map-placeholder { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: #adb5bd; }

        .input-group-text { width: 42px; justify-content: center; background-color: #f8f9fa; color: #555; }
    </style>
@endpush

@section('breadcrumb-title', 'Contact Info')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Contact Information</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.contact.infoUpdate')}}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold text-primary">
                                <i class="fas fa-address-card mr-2"></i> Update Contact Details
                            </h3>
                        </div>
                        <div class="card-body">

                            <div class="section-title"><i class="fas fa-headset"></i> Communication Channels</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                                        <input type="email" name="email" id="email" required
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $contact->email ?? '') }}" placeholder="info@company.com">
                                        @error('email') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                                        <input type="text" name="phone" id="phone" required
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $contact->phone ?? '') }}" placeholder="+1 234 567 890">
                                        @error('phone') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="section-title mt-4"><i class="fas fa-map-marked-alt"></i> Location & Availability</div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="location">Physical Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="location" id="location"
                                               class="form-control @error('location') is-invalid @enderror"
                                               value="{{ old('location', $contact->location ?? '') }}"
                                               placeholder="123 Street Name, City, Country">
                                        @error('location') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="working_hours">Working Hours</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-clock"></i></span></div>
                                        <input type="text" name="working_hours" id="working_hours"
                                               class="form-control @error('working_hours') is-invalid @enderror"
                                               value="{{ old('working_hours', $contact->working_hours ?? '') }}"
                                               placeholder="Mon - Fri: 09:00 - 18:00">
                                        @error('working_hours') <span class="invalid-feedback">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="section-title mt-4"><i class="fas fa-globe-americas"></i> Google Map Embed Code</div>
                            <div class="form-group">
                                <label>Iframe Code</label>
                                <textarea name="map" id="map_input" rows="4"
                                          class="form-control font-monospace text-sm @error('map') is-invalid @enderror"
                                          placeholder='<iframe src="https://www.google.com/maps/embed...'>{{ old('map', $contact->map ?? '') }}</textarea>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle mr-1"></i> Paste the full <code>&lt;iframe&gt;</code> code from Google Maps here.
                                </small>
                                @error('map') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-outline-primary shadow-sm">
                        <div class="card-header bg-white"><h3 class="card-title font-weight-bold">Map Preview</h3></div>
                        <div class="card-body p-3">
                            <div class="map-preview-box shadow-sm" id="map-preview-container">
                                @if(!empty($contact->map))
                                    {!! $contact->map !!}
                                @else
                                    <div class="map-placeholder">
                                        <i class="fas fa-map-slash fa-3x mb-3"></i>
                                        <span>No map configured</span>
                                    </div>
                                @endif
                            </div>
                            <p class="text-muted small text-center">
                                This is how the map will appear on the contact page.
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow font-weight-bold">
                                <i class="fas fa-save mr-1"></i> UPDATE CONTACT INFO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Harita kodu değiştiğinde önizlemeyi güncelle
            $('#map_input').on('input', function() {
                var mapCode = $(this).val();
                if (mapCode.trim() !== "" && mapCode.includes('<iframe')) {
                    $('#map-preview-container').html(mapCode);
                } else {
                    $('#map-preview-container').html(`
                        <div class="map-placeholder">
                            <i class="fas fa-map-slash fa-3x mb-3"></i>
                            <span>Invalid Map Code</span>
                        </div>
                    `);
                }
            });
        });
    </script>
@endpush
