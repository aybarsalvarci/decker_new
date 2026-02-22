@extends('front.layouts.master')

@section('title', $page->title)

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/care.css')}}"/>
@endpush

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@@type' => 'WebPage',
            'name' => __("careAndMaintenance.schema.name"),
            'description' => __("careAndMaintenance.schema.description"),
            'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
            'inLanguage' => (app()->getLocale() === 'esp' ? 'es' : app()->getLocale()),

            'alternateName' => (app()->getLocale() === 'en')
                            ? __("careAndMaintenance.page-name", [], 'esp')
                            : __("careAndMaintenance.page-name", [], 'en'),

            'publisher' => [
                '@@type' => 'Organization',
                'name' => 'Deck-er',
                'logo' => [
                    '@@type' => 'ImageObject',
                    'url' => asset('storage/' . config('settings.header_logo'))
                ]
            ],
            'mainEntity' => [
                '@@type' => 'Article',
                'headline' => __("careAndMaintenance.schema.headline"),
                'abstract' => __("careAndMaintenance.schema.abstract"),
                'author' => [
                    '@@type' => 'Organization',
                    'name' => 'Deck-er'
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
                        'name' => __("resourcesMain.page-name"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), route('resources.main'), [], true)
                    ],
                    [
                        '@@type' => 'ListItem',
                        'position' => 3,
                        'name' => __("careAndMaintenance.page-name"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true)
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')

    <section class="care-hero">
        <div class="care-hero-content">
            <h1 style="font-size: 3.5rem; font-weight: 800; color: #fff; margin-bottom: 15px;">{{$page->title}}</h1>
            <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto; opacity: 0.9;">
                {{__("careAndMaintenance.hero.subtitle")}}
            </p>
        </div>
    </section>

    <div class="content-box">
        {!! $page->content !!}
    </div>

@endsection

@push('js')
    <script src="{{asset('front/assets/js/about.js')}}"></script>
@endpush
