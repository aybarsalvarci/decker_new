@extends('front.layouts.master')

@section('title', __("freeSamples.title"))

@push('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/samples.css') }}"/>
    <style>
        .sample-card { cursor: pointer; transition: all 0.3s ease; border: 2px solid transparent; }
        .sample-card.selected { border-color: #007bff; background: #f0f7ff; transform: translateY(-5px); }
        .sample-card.selected::after {
            content: '\f058'; font-family: 'Font Awesome 5 Free'; font-weight: 900;
            position: absolute; top: 10px; right: 10px; color: #007bff; font-size: 1.5rem;
        }
        .sample-details p { font-size: 0.9rem; color: #666; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
@endpush

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@@type' => 'CheckoutPage',
            'name' => __("freeSamples.hero.title"),
            'description' => __("freeSamples.hero.subtitle"),
            'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
            'inLanguage' => (app()->getLocale() === 'esp' ? 'es' : 'en'),

            'alternateName' => (app()->getLocale() === 'en')
                ? __("freeSamples.title", [], 'esp')
                : __("freeSamples.title", [], 'en'),

            'mainEntity' => [
                '@@type' => 'ItemList',
                'name' => __("freeSamples.products.title"),
                'numberOfItems' => count($samples),
                'itemListElement' => $samples->map(function($sample, $index) {
                    return [
                        '@@type' => 'ListItem',
                        'position' => $index + 1,
                        'item' => [
                            '@@type' => 'Product',
                            'name' => $sample->title,
                            'image' => asset('storage/' . $sample->image),
                            'description' => str()->limit($sample->description, 150),
                            'offers' => [
                                '@@type' => 'Offer',
                                'price' => '0.00',
                                'priceCurrency' => 'USD',
                                'availability' => 'https://schema.org/InStock'
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
                        'name' => __("freeSamples.title"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true)
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')

    <section class="samples-hero">
        <div class="samples-hero-overlay"></div>
        <div class="samples-hero-content">
            <span class="hero-badge">{{__("freeSamples.hero.badge")}}</span>
            <h1>{{__("freeSamples.hero.title")}}</h1>
            <p>{{__("freeSamples.hero.subtitle")}}</p>
        </div>
    </section>

    <section class="section-padding bg-light" style="padding: 60px 0;">
        <div class="container">
            <div class="sample-layout">

                <div class="product-selection">
                    <div class="section-header" style="text-align: left; margin-bottom: 30px;">
                        <span class="sub-heading" style="display:block; color:#777; font-weight:600; margin-bottom:5px;">
                            {{__("freeSamples.products.badge")}}
                        </span>
                        <h2 style="margin-top:0;">{{__("freeSamples.products.title")}}</h2>
                        <p class="text-muted">{{__("freeSamples.products.subtitle")}}</p>
                    </div>

                    <div class="sample-grid" id="productGrid">
                        @foreach($samples as $sample)
                            @php
                                $title = app()->getLocale() == 'es' ? $sample->title_esp : $sample->title_en;
                                $desc = app()->getLocale() == 'es' ? $sample->description_esp : $sample->description_en;
                            @endphp
                            <div class="sample-card position-relative"
                                 onclick="selectSampleBox(this)"
                                 data-id="{{ $sample->id }}"
                                 data-name="{{ $title }}">

                                <img src="{{ asset('storage/' . $sample->image) }}" alt="{{ $title }}">
                                <div class="sample-details">
                                    <h4>{{ $title }}</h4>
                                    <p title="{{ $desc }}">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="checkout-area">
                    <div class="sample-box-display">
                        <h3><i class="fas fa-box-open"></i> {{__("freeSamples.sample-box.title")}}</h3>
                        <div id="selectedList" class="selected-items-list">
                            <p class="empty-msg">{{__("freeSamples.sample-box.no-samples")}}</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <form id="sampleForm" action="{{route('free-samples')}}" method="post">
                            @csrf
                            <div style="text-align: center; margin-bottom: 20px;">
                                <img src="{{ asset('storage/' . config('settings.logo')) }}" alt="Logo" style="max-width: 150px; display: block; margin: 0 auto;" onerror="this.style.display='none'"/>
                            </div>

                            <input type="hidden" name="sample_box_id" id="selectedBoxInput" value="">

                            <h4 class="form-title">{{__("freeSamples.form.title")}}</h4>
                            <p class="form-desc">{{__("freeSamples.form.subtitle")}}</p>

                            <div class="form-group">
                                <label class="form-label">{{__("freeSamples.form.labels.name")}}*</label>
                                <input type="text" class="form-control @error('full_name') invalid @enderror" name="full_name" value="{{ old('full_name') }}" required placeholder="John Doe"/>
                                @error('full_name') <span class="error-message">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__("freeSamples.form.labels.email")}}*</label>
                                <input type="email" class="form-control @error('email') invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="john@example.com"/>
                                @error('email') <span class="error-message">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__("freeSamples.form.labels.phone")}}*</label>
                                <input type="tel" class="form-control @error('phone') invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="+1 234 567 8900"/>
                                @error('phone') <span class="error-message">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__("freeSamples.form.labels.state")}}*</label>
                                <select id="stateSelect" class="form-control @error('state') invalid @enderror" name="state" required>
                                    <option value="">{{__("freeSamples.form.placeholders.state")}}</option>
                                </select>
                                @error('state') <span class="error-message">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__("freeSamples.form.labels.town")}}*</label>
                                <select id="townSelect" name="town_select" class="form-control @error('town_select') invalid @enderror" required disabled>
                                    <option value="">{{__("freeSamples.form.placeholders.state-first")}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__("freeSamples.form.labels.address")}}*</label>
                                <textarea class="form-control @error('address') invalid @enderror" rows="3" required name="address" placeholder="{{__("freeSamples.form.placeholders.address")}}">{{ old('address') }}</textarea>
                                @error('address') <span class="error-message">{{$message}}</span> @enderror
                            </div>

                            <div style="display: flex; gap: 10px; margin-bottom: 20px; align-items: flex-start;">
                                <input type="checkbox" id="declaration" required style="margin-top: 5px;"/>
                                <label for="declaration" style="font-size: 0.85rem; color: #555;">
                                    {{__("freeSamples.form.labels.checkbox")}}
                                </label>
                            </div>

                            <button type="submit" class="form-btn">{{__("freeSamples.form.button")}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="{{ asset('front/assets/js/samples.js') }}"></script>
@endpush
