@extends('front.layouts.master')

@section('title', __("estimateCost.title"))

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/estimate.css')}}"/>
    <style>
        .est-input.full-width { width: 100%; }
        .pagination-wrapper { margin-top: 30px; display: flex; justify-content: center; }
    </style>
@endpush

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@@type' => 'WebApplication',
            'name' => __("estimateCost.hero.title"),
            'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
            'description' => __("estimateCost.hero.subtitle"),
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'All',
            'browserRequirements' => 'Requires JavaScript',
            'inLanguage' => (app()->getLocale() === 'esp' ? 'es' : app()->getLocale()),

            'alternateName' => (app()->getLocale() === 'en')
                ?   __('estimateCost.title', [], 'esp')
                :   __('estimateCost.title', [], 'en'),

            'mainEntity' => [
                '@type' => 'ItemList',
                'name' => __("estimateCost.products.title"),
                'numberOfItems' => count($products),
                'itemListElement' => $products->map(function($product, $index) {
                    return [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'item' => [
                            '@type' => 'Product',
                            'name' => (app()->getLocale() == 'en' ? $product->name_en : $product->name_esp),
                            'image' => asset('storage/' . $product->mainImage->image),
                            'description' => str()->limit(app()->getLocale() == 'en' ? $product->description_en : $product->description_esp, 150),
                            'offers' => [
                                '@type' => 'Offer',
                                'availability' => 'https://schema.org/InStock',
                                'priceCurrency' => 'USD',
                                'price' => '0',
                                'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true)
                            ]
                        ]
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
                        'name' => __("estimateCost.title"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true)
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')

    <section class="estimate-hero">
        <div class="estimate-hero-content">
            <h1>{{__("estimateCost.hero.title")}}</h1>
            <p>{{__("estimateCost.hero.subtitle")}}</p>
        </div>
    </section>

    <section class="section-padding bg-light" style="padding: 60px 0; background: #f4f6f7">
        <div class="container">
            <div class="estimator-layout">
                <div class="products-area">
                    <div class="section-header" style="text-align: left; margin-bottom: 30px">
                        <span class="sub-heading" style="color: var(--accent-color); font-weight: bold; text-transform: uppercase;">
                            {{__("estimateCost.products.badge")}}
                        </span>
                        <h2 style="color: var(--primary-color)">{{__("estimateCost.products.title")}}</h2>
                        <p style="color: #666">{{__("estimateCost.products.subtitle")}}</p>
                    </div>

                    <div class="estimator-grid" id="productGrid">
                        @foreach($products as $product)
                            <div class="est-card">
                                <img src="{{asset('storage/' . $product->mainImage->image)}}" class="est-img" alt="{{$product->name_en}}"/>
                                <div class="est-details">
                                    {{-- Çok dilli isim kullanımı --}}
                                    <h3>{{ app()->getLocale() == 'en' ? $product->name_en : $product->name_esp }}</h3>
                                    <div class="est-desc">
                                        {{ str()->limit(app()->getLocale() == 'en' ? $product->description_en : $product->description_esp, 120, "...") }}
                                    </div>

                                    <div class="est-input-group">
                                        @if($product->isSized)
                                            <div class="input-row">
                                                <input type="number" min="0" placeholder="L (ft)" class="est-input" id="len-{{$product->id}}"/>
                                                <input type="number" min="0" placeholder="W (ft)" class="est-input" id="wid-{{$product->id}}"/>
                                            </div>
                                        @else
                                            <div class="input-row">
                                                <input type="number" min="1" placeholder="Qty" class="est-input full-width" id="qty-{{$product->id}}"/>
                                            </div>
                                        @endif

                                        <button class="btn-add" onclick="addToQuote({
                                            id: {{$product->id}},
                                            name: '{{ app()->getLocale() == 'en' ? $product->name_en : $product->name_esp }}',
                                            isSized: {{$product->isSized ? 'true' : 'false'}}
                                        })">
                                            {{__("estimateCost.products.button")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Sayfalama Linkleri --}}
                    <div class="pagination-wrapper">
                        {{ $products->links() }}
                    </div>
                </div>

                <div class="summary-area">
                    <div class="quote-sidebar">
                        <div class="quote-header">
                            <h3><i class="fas fa-clipboard-list"></i> {{__("estimateCost.form-section.title")}}</h3>
                        </div>

                        <ul class="quote-list" id="quoteList">
                            <li class="empty-cart-msg">{{__("estimateCost.form-section.no-items")}}</li>
                        </ul>

                        <div class="quote-total">
                            <span>{{__("estimateCost.form-section.total-area")}}:</span>
                            <span id="totalArea">0 sq ft</span>
                        </div>

                        {{-- Orijinal Form Yapısı --}}
                        <form id="quoteForm" class="quote-form" action="{{route('estimate-cost')}}" method="POST">
                            <h4 style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; font-size: 0.95rem; font-weight: 700; color: #333;">
                                {{__("estimateCost.form-section.contact-details")}}
                            </h4>

                            @csrf
                            {{-- JS buraya seçilen ürünleri hidden input olarak basacak --}}
                            <div id="hidden-cart-inputs"></div>

                            <div class="form-group">
                                <label>{{__("estimateCost.form-section.labels.full-name")}}</label>
                                <input class="{{$errors->has('full_name') ? 'invalid' : ''}}" type="text"
                                       name="full_name" required placeholder="{{__('estimateCost.form-section.placeholders.full-name')}}" value="{{old('full_name')}}"/>
                                @error('full_name')
                                <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__("estimateCost.form-section.labels.email")}}</label>
                                <input type="email" required placeholder="email@example.com" name="email"
                                       class="{{$errors->has('email') ? 'invalid' : ''}}" value="{{old('email')}}"/>
                                @error('email')
                                <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__("estimateCost.form-section.labels.phone")}}</label>
                                <input type="tel" class="{{$errors->has('phone') ? 'invalid' : ''}}" required
                                       placeholder="+1 234 567 8900" name="phone" value="{{old('phone')}}"/>
                                @error('phone')
                                <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__("estimateCost.form-section.labels.message")}}</label>
                                <textarea rows="3" name="message" class="{{$errors->has('message') ? 'invalid' : ''}}"
                                          placeholder="{{__('estimateCost.form-section.placeholders.message')}}">{{old('message')}}</textarea>
                                @error('message')
                                <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn-submit">
                                {{__("estimateCost.form-section.button")}} <span class="btn-spinner"></span>
                            </button>

                            <p style="font-size: 0.7rem; color: #888; margin-top: 10px; text-align: center;">
                                {{__("estimateCost.form-section.bottom-text")}}
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="{{asset('front/assets/js/estimate.js')}}"></script>
@endpush
