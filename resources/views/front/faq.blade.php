@extends('front.layouts.master')

@section('title', __("faq.title"))

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/faq.css')}}"/>
@endpush

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@@type' => 'FAQPage',
            'mainEntity' => $faqs->map(function($faq) {
                return [
                    '@@type' => 'Question',
                    'name' => strip_tags($faq->title),
                    'acceptedAnswer' => [
                        '@@type' => 'Answer',
                        'text' => trim(html_entity_decode(strip_tags($faq->content)))
                    ]
                ];
            })->toArray(),
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
                        'name' => __("faq.title"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')

    <section class="page-header">
        <div class="container">
            <h1>{{__("faq.hero.title")}}</h1>
            <p>{{__("faq.hero.subtitle")}}</p>
        </div>
    </section>

    <section class="section-padding bg-light" style="padding: 80px 0">
        <div class="container">
            <div class="faq-container">
                @forelse($faqs as $faq)
                    <div class="faq-item">
                        <div class="faq-question">
                            {{$faq->title}}
                            <i class="fas fa-plus faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                {!! $faq->content !!}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="no-data-found text-center"
                         style="padding: 50px; background: #fff; border-radius: 8px; border: 1px dashed #ddd;">
                        <i class="far fa-question-circle fa-3x text-muted mb-3" style="opacity: 0.5;"></i>
                        <h4 style="color: #555; font-weight: 600; margin-bottom: 10px;">{{__("faq.no-data.title")}}</h4>
                        <p class="text-muted" style="margin: 0;">{{__("faq.no-data.text")}}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="{{asset('front/assets/js/faq.js')}}"></script>
@endpush
