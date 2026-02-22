@extends('admin.layouts.master')

@section('title', 'Admin Dashboard Summary')

@push('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        /* Kartlar için stiller */
        .small-box { border-radius: 12px; overflow: hidden; transition: transform 0.3s; }
        .small-box:hover { transform: translateY(-5px); }
        .small-box .icon { color: rgba(255,255,255,0.3); }

        /* Tablo ve Metin stilleri */
        .info-card-title { font-weight: 700; font-size: 1.1rem; color: #444; }
        .latest-item-img { width: 45px; height: 45px; object-fit: cover; border-radius: 8px; }
        .table-dashboard td { vertical-align: middle !important; }

        /* Item Badge Stili */
        .offer-item-badge {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 5px 8px;
            margin-bottom: 4px;
            display: block; /* Alt alta dizilmesi için */
            font-size: 0.9rem;
        }
        .offer-dims {
            font-size: 0.8rem;
            color: #6c757d;
            margin-left: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-primary shadow">
                    <div class="inner">
                        <h3>{{ $productsCount ?? '0' }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon"><i class="ion ion-ios-box"></i></div>
                    <a href="{{ route('admin.product.index') }}" class="small-box-footer">View Inventory <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-success shadow">
                    <div class="inner">
                        <h3>{{ $offersCount ?? '0' }}</h3>
                        <p>Offer Requests</p>
                    </div>
                    <div class="icon"><i class="ion ion-ios-paperplane"></i></div>
                    <a href="{{ route('admin.offer.index') }}" class="small-box-footer">Check Offers <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-warning shadow text-white">
                    <div class="inner text-white">
                        <h3>{{ $samplesCount ?? '0' }}</h3>
                        <p>Sample Requests</p>
                    </div>
                    <div class="icon"><i class="ion ion-ios-flask"></i></div>
                    <a href="{{ route('admin.free-sample.index') }}" class="small-box-footer" style="color: rgba(255,255,255,0.8) !important;">Manage Samples <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-danger shadow">
                    <div class="inner">
                        <h3>{{ $subscribersCount ?? '0' }}</h3>
                        <p>Subscribers</p>
                    </div>
                    <div class="icon"><i class="ion ion-ios-email"></i></div>
                    <a href="{{ route('admin.email-subscription.index') }}" class="small-box-footer">Mailing List <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h3 class="card-title info-card-title">
                            <i class="fas fa-file-invoice-dollar mr-2 text-primary"></i> Latest Offer Requests
                        </h3>
                        <div class="card-tools">
                            <span class="badge badge-light p-2 border">Last 5 Requests</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dashboard table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 25%">Customer</th>
                                    <th style="width: 45%">Requested Items</th>
                                    <th class="text-center" style="width: 15%">Date</th>
                                    <th class="text-right" style="width: 15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($latestOffers ?? [] as $offer)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold text-dark">{{ $offer->full_name }}</div>
                                            <div class="small text-muted"><i class="fas fa-envelope mr-1"></i> {{ $offer->email }}</div>
                                        </td>
                                        <td>
                                            {{-- Items Döngüsü --}}
                                            @if($offer->items->isNotEmpty())
                                                @foreach($offer->items as $item)
                                                    <div class="offer-item-badge">
                                                        {{-- Ürün Adı (Product İlişkisinden) --}}
                                                        <span class="text-primary font-weight-bold">
                                                            {{-- name_en yoksa name, o da yoksa ID göster --}}
                                                            {{ $item->product->name_en ?? $item->product->name ?? 'Product #'.$item->product_id }}
                                                        </span>
                                                        {{-- Ölçüler --}}
                                                        <span class="offer-dims">
                                                            <i class="fas fa-ruler-combined"></i>
                                                            {{ $item->length }}x{{ $item->width }}
                                                            (Area: {{ $item->area }})
                                                        </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <span class="text-muted font-italic small">No items found</span>
                                            @endif
                                        </td>
                                        <td class="text-center small text-muted">
                                            {{ $offer->created_at->diffForHumans() }}
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.offer.show', $offer->id) }}" class="btn btn-xs btn-outline-primary px-3 shadow-sm">
                                                View <i class="fas fa-chevron-right ml-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3 text-light"></i><br>
                                            No pending offers found.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('admin.offer.index') }}" class="small text-muted font-weight-bold text-uppercase">View All Offers</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title info-card-title">
                            <i class="fas fa-box-open mr-2 text-success"></i> Recently Added Products
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @forelse($latestProducts ?? [] as $product)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ asset('storage/'.$product->mainImage->image) }}" alt="Product Image" class="latest-item-img shadow-sm border">
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="product-title font-weight-bold text-dark">
                                            {{ $product->name_en }}
                                            <span class="badge badge-info float-right small">{{ $product->category->name ?? 'N/A' }}</span>
                                        </a>
                                        <span class="product-description small text-muted">
                                            {{ \Illuminate\Support\Str::limit($product->slug_en, 40) }}
                                        </span>
                                    </div>
                                </li>
                            @empty
                                <li class="p-4 text-center text-muted small">No products added yet.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary px-4">
                            <i class="fas fa-plus mr-1"></i> Add New Product
                        </a>
                    </div>
                </div>

                <div class="info-box shadow-sm mb-3">
                    <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-paper-plane"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text font-weight-bold">Quick Newsletter</span>
                        <span class="info-box-number small text-muted font-weight-normal mb-1">Send update to all subscribers</span>
                        <a href="{{ route('admin.sent-mail.send') }}" class="btn btn-xs btn-outline-danger mt-1" style="width: fit-content;">Compose New Mail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
@endpush
