@extends('admin.layouts.master')

@section('title', 'Sample Request Details: ' . $sample->full_name)

@push('css')
    <style>
        .card-outline-teal { border-top: 3px solid #20c997; }
        .info-label { font-weight: 600; color: #888; font-size: 0.8rem; text-transform: uppercase; display: block; margin-bottom: 2px; }
        .info-value { color: #2c3e50; font-size: 1.05rem; font-weight: 500; display: block; margin-bottom: 15px; }

        /* Box Detay Kartı */
        .box-detail-card { background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #eee; }
        .box-image-top { width: 100%; height: 220px; object-fit: cover; border-bottom: 3px solid #20c997; }
        .box-content { padding: 20px; }
        .box-title { font-size: 1.25rem; font-weight: 800; color: #333; margin-bottom: 10px; }
        .box-desc { font-size: 0.9rem; color: #666; line-height: 1.5; background: #f9f9f9; padding: 15px; border-radius: 8px; }

        .address-box { background: #fdfdfd; border: 1px dashed #ced4da; padding: 15px; border-radius: 8px; line-height: 1.6; color: #444; min-height: 100px; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <div class="card card-outline-teal shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-box-open mr-2 text-teal"></i>Requested Sample Box
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($sample->box))
                            <div class="box-detail-card">
                                <img src="{{ asset('storage/' . $sample->box->image) }}" class="box-image-top" alt="Box Image">
                                <div class="box-content">
                                    <div class="mb-3">
                                        <span class="badge badge-primary">EN</span>
                                        <h5 class="box-title d-inline-block ml-1">{{ $sample->box->title_en }}</h5>
                                        <p class="box-desc italic">{{ $sample->box->description_en }}</p>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <span class="badge badge-info">ESP</span>
                                        <h5 class="box-title d-inline-block ml-1" style="font-size: 1.1rem;">{{ $sample->box->title_esp }}</h5>
                                        <p class="box-desc">{{ $sample->box->description_esp }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-4 text-center">
                                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                <p class="text-muted">The requested sample box information is no longer available in the database.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card card-outline-teal shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold"><i class="fas fa-info-circle mr-2 text-teal"></i>Customer & Shipping Details</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.free-sample.index')}}" class="btn btn-default btn-sm mr-1">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <h5 class="text-teal font-weight-bold mb-4 border-bottom pb-2">
                                    <i class="fas fa-user mr-2"></i> Contact Information
                                </h5>

                                <span class="info-label">Full Name</span>
                                <span class="info-value">{{ $sample->full_name }}</span>

                                <span class="info-label">Email Address</span>
                                <span class="info-value">
                                    <a href="mailto:{{ $sample->email }}" class="text-primary">{{ $sample->email }}</a>
                                </span>

                                <span class="info-label">Phone Number</span>
                                <span class="info-value">
                                    <a href="tel:{{ $sample->phone }}">{{ $sample->phone }}</a>
                                </span>
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-danger font-weight-bold mb-4 border-bottom pb-2">
                                    <i class="fas fa-map-marker-alt mr-2"></i> Shipping Address
                                </h5>

                                <div class="row">
                                    <div class="col-6">
                                        <span class="info-label">State</span>
                                        <span class="info-value">{{ $sample->state }}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="info-label">Town</span>
                                        <span class="info-value">{{ $sample->town }}</span>
                                    </div>
                                </div>

                                <span class="info-label">Street Address</span>
                                <div class="address-box">
                                    {{ $sample->address }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white mt-3">
                        <div class="row text-muted" style="font-size: 0.85rem;">
                            <div class="col-sm-6">
                                <strong>Request ID:</strong> #{{ $sample->id }} |
                                <i class="far fa-calendar-alt ml-2 mr-1"></i> {{ \Carbon\Carbon::parse($sample->created_at)->format('d M Y, H:i') }}
                            </div>
                            <div class="col-sm-6 text-md-right">
                                <span class="badge badge-light border">
                                    <i class="fas fa-history mr-1"></i> Received {{ \Carbon\Carbon::parse($sample->created_at)->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
