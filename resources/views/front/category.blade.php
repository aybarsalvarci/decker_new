@extends('front.layouts.master')


@section('title', $category->name)


@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/decking.css')}}"/>
@endpush

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@@type' => 'CollectionPage',
            'name' => $category->name . ' | Deck-er',
            'description' => __("category.hero.subtitle"),
            'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
            'inLanguage' => (app()->getLocale() === 'esp' ? 'es' : app()->getLocale()),

            'alternateName' => (app()->getLocale() === 'en')
                ?   $category->name_esp . ' | Deck-er'
                :   $category->name_en . ' | Deck-er',

            'mainEntity' => [
                '@@type' => 'ItemList',
                'numberOfItems' => count($category->products),
                'itemListElement' => $category->products->map(function($product, $index) {
                    return [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'name' => $product->name,
                        'image' => asset('storage/' . $product->mainImage->image),

                        'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true) . "#product-" . $product->id,
                    ];
                })
            ],

            'breadcrumb' => [
                '@@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@@type' => 'ListItem',
                        'position' => 1,
                        'name' => __("homePage.page-name"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true),
                    ],
                    [
                        '@@type' => 'ListItem',
                        'position' => 2,
                        'name' => $category->name,
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true)
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')

    <section class="atlas-hero">
        <div class="atlas-content">
            <h1 style="font-size: 3.5rem; font-weight: 800; margin: 10px 0; color: #fff;">{{strtoupper($category->name)}}</h1>
            <p style="font-size: 1.2rem; max-width: 600px; margin: 0 auto; opacity: 0.9;">
                {{__("category.hero.subtitle")}}
            </p>
        </div>
    </section>

    <section class="features-strip">
        <div class="container">
            <div class="features-grid">
                @foreach($category->icons as $icon)
                    <div class="feature-item">
                        <div class="feature-icon-box"><i class="{{$icon->icon}}"></i></div>
                        <span class="feature-title">{{$icon->text}}</span>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="section-padding bg-light" style="padding: 60px 0;">
        <div class="container">
            @forelse($category->products as $product)
                <div class="product-display-table" id="deep-embossed">
                    <div class="thumb-col">
                        @foreach($product->images as $image)
                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                class="thumb-img {{ $loop->first ? 'active' : '' }}"
                                onclick="switchImage(this, 'main-product-{{ $product->id }}')"
                            >
                        @endforeach
                    </div>

                    <div class="main-img-col">
                        <img
                            src="{{ asset('storage/' . $product->mainImage->image) }}"
                            id="main-product-{{ $product->id }}"
                            class="main-img"
                            alt="{{ $product->name }}"
                        >
                    </div>

                    <div class="info-col">
                        <div>
                            <h2 class="product-title">{{$product->name}}</h2>
                            <p class="product-desc">
                                {{$product->description}}
                            </p>
                            <span class="read-more-btn"
                                  onclick="toggleReadMore(this)">{{__("category.product.read-more")}}</span>
                        </div>
                        @if($product->size == null && $product->weight == null && $product->actual_size == null)
                        @else
                            <div class="product-specs">
                                @if($product->size != null)
                                    <div class="spec-item">
                                        <span class="spec-label">{{__("category.product.dimensions")}}</span>
                                        <span class="spec-value">{{$product->size}}</span>
                                    </div>
                                @endif

                                @if($product->weight != null)
                                    <div class="spec-item">
                                        <span class="spec-label">{{__("category.product.weight")}}</span>
                                        <span class="spec-value">{{$product->weight}}</span>
                                    </div>
                                @endif

                                @if($product->actual_size != null)
                                    <div class="spec-item" style="grid-column: span 2;">
                                        <span class="spec-label">{{__("category.product.actual-dimensions")}}</span>
                                        <span class="spec-value">{{$product->actual_size}}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div>
                            @if(count($product->colors) != 0)

                                <span class="color-label">{{__("category.product.available-colors")}}</span>
                                <div class="decking-colors">
                                    @foreach($product->colors as $color)
                                        <div class="color-card">
                                            <div class="d-swatch">
                                                <img src="{{asset('storage/' . $color->image)}}"
                                                     alt="{{$color->name}}">
                                            </div>
                                            <span class="color-name">{{$color->name}}</span>
                                        </div>
                                    @endforeach

                                </div>
                            @endif

                        </div>
                        @if($product->isPriceable)
                            <a href="{{route('estimate-cost')}}" class="btn-quote">{{__("category.product.button")}}</a>
                        @endif
                    </div>
                </div>
            @empty

                <div class="empty-state-container">
                    <div class="empty-icon">
                        <i class="fas fa-box-open"></i>
                    </div>

                    <h3 class="empty-title">{{__("category.no-product.title")}}</h3>

                    <p class="empty-desc">
                        {{__("category.no-product.text")}}
                    </p>

                    <a href="{{ route('home') }}" class="btn-empty-back">
                        <i class="fas fa-arrow-left mr-2"></i> {{__("category.no-product.button")}}
                    </a>
                </div>

            @endforelse
        </div>
    </section>
@endsection

@push('js')
    <script src="{{asset('front/assets/js/decking.js')}}"></script>

@endpush
