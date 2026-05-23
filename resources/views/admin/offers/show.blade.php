@extends('admin.layouts.master')

@section('title', 'Offer Details: ' . $offer->full_name)

@push('css')
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .label-custom { color: #888; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 5px; }
        .value-custom { color: #2c3e50; font-size: 1.0rem; font-weight: 500; display: block; margin-bottom: 15px; }

        /* Müşteri Mesaj Kutusu */
        .message-box { background: #fffbf2; color: #5e4e24; padding: 15px; border-left: 4px solid #ffc107; border-radius: 4px; font-style: italic; }

        /* Ürün Kartı Tasarımı */
        .item-card { background: #fff; border: 1px solid #e1e5eb; border-radius: 8px; margin-bottom: 20px; overflow: hidden; transition: box-shadow 0.3s; }
        .item-card:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-color: #d1d9e6; }

        /* Ürün Görseli */
        .product-img-wrapper { width: 120px; height: 120px; flex-shrink: 0; background-color: #f8f9fa; border-right: 1px solid #eef0f2; display: flex; align-items: center; justify-content: center; }
        .product-img { width: 100%; height: 100%; object-fit: cover; }
        .no-image-placeholder { color: #ccc; font-size: 2rem; }

        /* Ürün Detayları */
        .item-content { padding: 15px; flex-grow: 1; }
        .product-title { font-size: 1.15rem; font-weight: 600; color: #343a40; margin-bottom: 2px; }
        .product-subtitle { font-size: 0.85rem; color: #868e96; margin-bottom: 10px; display: block; }

        /* Boyut Rozetleri */
        .spec-box { display: inline-block; background: #f1f3f5; padding: 5px 12px; border-radius: 6px; margin-right: 10px; font-size: 0.85rem; border: 1px solid #e9ecef; }
        .spec-label { font-weight: 700; color: #adb5bd; font-size: 0.7rem; text-transform: uppercase; display: block; line-height: 1; margin-bottom: 3px; }
        .spec-value { font-weight: 600; color: #495057; font-family: 'Consolas', monospace; }

        .area-badge { background-color: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb; }
    </style>
@endpush

@section('breadcrumb-title', 'Offer Details')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.offer.index')}}">Offers</a></li>
    <li class="breadcrumb-item active">View Details</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card card-outline-primary shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold text-dark m-0">
                                <i class="fas fa-file-invoice mr-2 text-primary"></i> Offer #{{ $offer->id }}
                            </h3>
                            <div class="card-tools">
                                <a href="{{route('admin.offer.index')}}" class="btn btn-default btn-sm mr-2">
                                    <i class="fas fa-arrow-left mr-1"></i> Back
                                </a>
                                <button onclick="window.print();" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 border-right">
                                <h6 class="text-muted font-weight-bold text-uppercase mb-3">Customer Information</h6>

                                <div class="mb-3">
                                    <span class="label-custom">Full Name</span>
                                    <span class="value-custom">{{ $offer->full_name }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="label-custom">Email</span>
                                    <span class="value-custom">
                                        <a href="mailto:{{ $offer->email }}" class="text-primary">{{ $offer->email }}</a>
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <span class="label-custom">Phone</span>
                                    <span class="value-custom">
                                        <a href="tel:{{ $offer->phone }}">{{ $offer->phone }}</a>
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <span class="label-custom">Request Date</span>
                                    <span class="value-custom">
                                        {{ \Carbon\Carbon::parse($offer->created_at)->format('d M Y, H:i') }}
                                        <small class="d-block text-muted font-weight-normal mt-1">
                                            {{ \Carbon\Carbon::parse($offer->created_at)->diffForHumans() }}
                                        </small>
                                    </span>
                                </div>

                                @if($offer->message)
                                    <div class="mt-4">
                                        <span class="label-custom">Message</span>
                                        <div class="message-box">
                                            "{{ $offer->message }}"
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-8 pl-md-4">
                                <h6 class="text-muted font-weight-bold text-uppercase mb-3 d-flex justify-content-between align-items-center">
                                    <span>Requested Products</span>
                                    <span class="badge badge-primary badge-pill">{{ count($offer->items) }} Items</span>
                                </h6>

                                @forelse($offer->items as $item)
                                    <div class="item-card d-flex">
                                        <div class="product-img-wrapper">
                                            @if(isset($item->product->mainImage->image))
                                                {{-- Not: Görsel yolu storage içinde ise 'storage/'.$item... şeklinde, public'te ise direkt yazılır. --}}
                                                {{-- Sizin verinize göre 'images/...' geldiği için direkt asset() içine koyuyoruz. --}}
                                                <img src="{{ asset('storage/' . $item->product->mainImage->image) }}"
                                                     alt="{{ $item->product->name_en }}"
                                                     class="product-img">
                                            @else
                                                <div class="no-image-placeholder">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="item-content">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h5 class="product-title">{{ $item->product->name_en }}</h5>
                                                    @if(isset($item->product->name_esp))
                                                        <span class="product-subtitle">{{ $item->product->name_esp }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <a href="{{route('admin.product.edit', $item->product->id)}}" class="btn btn-xs btn-light text-muted border" title="View Product Page">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <hr class="my-2 border-light">

                                            <div class="d-flex flex-wrap">
                                                <div class="spec-box">
                                                    <span class="spec-label">Length</span>
                                                    <span class="spec-value">{{ $item->length }}</span>
                                                </div>
                                                <div class="spec-box">
                                                    <span class="spec-label">Width</span>
                                                    <span class="spec-value">{{ $item->width }}</span>
                                                </div>
                                                <div class="spec-box area-badge">
                                                    <span class="spec-label text-primary">Total Area</span>
                                                    <span class="spec-value">{{ $item->area }} sq/ft</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-warning text-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i> No items found in this offer.
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right py-3">
                        <a href="mailto:{{ $offer->email }}?subject=Your Offer Request #{{ $offer->id }}" class="btn btn-primary shadow-sm px-4">
                            <i class="fas fa-envelope mr-2"></i> Reply to Customer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
