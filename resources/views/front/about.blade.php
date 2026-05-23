@extends('front.layouts.master')

@section('title', $about->hero_label ?? 'About Us')

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/about.css')}}"/>
@endpush

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@@type' => 'AboutPage',
            'name' => __("about.page-name"),
            'description' => __("about.schema.description"),
            'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
            'inLanguage' => (app()->getLocale() === 'esp' ? 'es' : app()->getLocale()),

            'alternateName' => (app()->getLocale() === 'en')
                ? __("about.page-name", [], 'esp')
                : __("about.page-name", [], 'en'),

            'mainEntity' => [
                '@@type' => 'Organization',
                'name' => 'Deck-er',
                'url' => url('/'),
                'logo' => asset('storage/' . config('settings.header_logo')),
                'description' => config('settings.meta_description_' . app()->getLocale()),
                'sameAs' => [
                    config("settings.facebook"),
                    config("settings.twitter"),
                    config("settings.instagram"),
                ]
            ],

            'breadcrumb' => [
                '@@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@@type' => 'ListItem',
                        'position' => 1,
                        'name' => __('homePage.page-name'),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true),
                    ],
                    [
                        '@@type' => 'ListItem',
                        'position' => 2,
                        'name' => __("about.page-name"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true)
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')

    <section class="about-hero">
        <div class="container">
            <span class="hero-subtitle">{{ $about->hero_label }}</span>
            <h1>{!! nl2br($about->hero_title) !!}</h1>
            <p class="hero-desc">
                {{ $about->hero_desc }}
            </p>
        </div>
    </section>

    <section class="about-story section-padding">
        <div class="container">
            <div class="story-wrapper">

                <div class="story-image-container">
                    <div class="image-wrapper"> {{-- Çerçeveyi buraya sabitleyeceğiz --}}
                        @if($about->story_image)
                            <img src="{{ asset('storage/'.$about->story_image) }}" alt="Decker Story" class="floating-img"/>
                        @else
                            <img src="{{ asset('front/assets/images/no-image.jpg') }}" alt="Default" class="floating-img"/>
                        @endif
                        <div class="red-border-box"></div>
                    </div>
                </div>

                <span class="sub-heading">{{ $about->story_subtitle }}</span>
                <h2 class="story-title">{{ $about->story_title }}</h2>

                <div class="story-text-content">
                    {!! $about->story_content !!}
                </div>

                <div style="clear: both;"></div>
            </div>
        </div>
    </section>

    <section class="production-hubs section-padding bg-light">
        <div class="container">
            <div class="section-header text-center">
                <span class="sub-heading">{{ $about->factory_title ?? 'OUR POWERHOUSE' }}</span>
                <h2>{{ $about->factory_title ?? 'Manufacturing Excellence' }}</h2>
                <p>
                    {{ $about->factory_desc }}
                </p>
            </div>

            <div class="hubs-wrapper">
                @foreach($factories as $factory)
                    <div class="hub-col reveal">
                        <div class="hub-header">
                            <img
                                src="{{ asset("storage/" . config("settings.header_logo")) }}"
                                alt="Decker Factory"
                                class="hub-flag"
                            />
                            <h3>{{ $factory->title }}</h3>

                            @if($factory->subtitle)
                                <small class="d-block text-muted">{{ $factory->subtitle }}</small>
                            @endif
                        </div>

                        <div class="hub-gallery">
                            <div class="hub-item">
                                <img
                                    src="{{ $factory->image1_url }}"
                                    alt="{{ $factory->image1_title }}"
                                />
                                <span class="hub-label">
                                    {{ $factory->image1_title }}
                                    @if($factory->image1_desc)
                                        <br><small
                                            style="font-size: 0.8em; opacity: 0.8">{{ $factory->image1_desc }}</small>
                                    @endif
                                </span>
                            </div>

                            <div class="hub-item">
                                <img
                                    src="{{ $factory->image2_url }}"
                                    alt="{{ $factory->image2_title }}"
                                />
                                <span class="hub-label">
                                    {{ $factory->image2_title }}
                                    @if($factory->image2_desc)
                                        <br><small
                                            style="font-size: 0.8em; opacity: 0.8">{{ $factory->image2_desc }}</small>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="values-section">
        <div class="container">
            <div class="values-intro text-center">
                <h2>{{ $about->values_title }}</h2>
                <p class="large-text">
                    "{{ $about->values_subtitle }}"
                </p>
            </div>

            <div class="values-grid">
                <div class="value-card reveal">
                    <div class="icon-box"><i class="{{ $about->val_1_icon }}"></i></div>
                    <h3>{{ $about->val1_title }}</h3>
                    <p>{{ $about->val1_desc }}</p>
                </div>

                <div class="value-card reveal">
                    <div class="icon-box"><i class="{{ $about->val_2_icon }}"></i></div>
                    <h3>{{ $about->val2_title }}</h3>
                    <p>{{ $about->val2_desc }}</p>
                </div>

                <div class="value-card reveal">
                    <div class="icon-box"><i class="{{ $about->val_3_icon }}"></i></div>
                    <h3>{{ $about->val3_title }}</h3>
                    <p>{{ $about->val3_desc }}</p>
                </div>
            </div>

            @if($about->vision)
                <div class="vision-box reveal">
                    <h3>{{ app()->getLocale() == 'esp' ? 'Nuestra Visión' : 'Our Vision' }}</h3>
                    <p>
                        {{ $about->vision }}
                    </p>
                </div>
            @endif
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="stats-wrapper">
                {{-- Stat 1 --}}
                <div class="stat-item">
                    <h3>{{ $about->stat_1_num }}</h3>
                    <span>{{ $about->stat1_text }}</span>
                </div>
                <div class="stat-item">
                    <h3>{{ $about->stat_2_num }}</h3>
                    <span>{{ $about->stat2_text }}</span>
                </div>
                <div class="stat-item">
                    <h3>{{ $about->stat_3_num }}</h3>
                    <span>{{ $about->stat3_text }}</span>
                </div>
                <div class="stat-item">
                    <h3>{{ $about->stat_4_num }}</h3>
                    <span>{{ $about->stat4_text }}</span>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="{{asset('front/assets/js/about.js')}}"></script>
@endpush
