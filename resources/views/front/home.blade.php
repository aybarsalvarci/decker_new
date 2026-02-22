@extends('front.layouts.master')

@section('title', 'Homepage')

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/homepage.css')}}">
@endpush

@section('og_title', "")
@section('og_description', "")
@section('og_image', "")
@section('og_title', "")

@push('schema')
    @php
        $schemaData = [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "LocalBusiness",
                    "name" => config('settings.site_title_' . app()->getLocale()),
                    "url" => url('/'),
                    "logo" => asset('storage/' . config('settings.logo')),
                    "telephone" => config('settings.phone_number'),
                    "email" => config('settings.email'),
                    "address" => [
                        "@type" => "PostalAddress",
                        "streetAddress" => config('settings.address'),
                        "addressLocality" => "Miami",
                        "addressRegion" => "FL",
                        "addressCountry" => "US"
                    ],
                    "sameAs" => array_filter([
                        config('settings.facebook'),
                        config('settings.twitter'),
                        config('settings.instagram')
                    ])
                ],
                [
                    "@type" => "WebSite",
                    "url" => url('/'),
                    "name" => "Deck-er"
                ]
            ]
        ];
    @endphp

    <script type="application/ld+json">
        {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    <section class="hero-slider">
        <div class="slide active">
            <video class="slide-bg" autoplay muted loop playsinline>
                <source src="{{asset('storage/' . $homePageSettings->topVideo)}}" type="video/mp4"/>
            </video>
            <div class="slide-overlay"></div>
            <div class="hero-content">
                <h1>{{$homePageSettings->topVideoTitle}}</h1>
                <p>{{$homePageSettings->topVideoDesc}}</p>
            </div>
        </div>
    </section>

    <section class="info-strip">
        <div class="container">
            <div class="info-grid">
                <div class="info-box">
                    <i class="fas fa-calculator info-icon"></i>
                    <div>
                        <a href="{{route('estimate-cost')}}">
                            <h3>{{__('homePage.estimate-cost.title')}}</h3>
                        </a>
                        <p>{{__('homePage.estimate-cost.description')}}</p>
                    </div>
                </div>
                <div class="info-box">
                    <i class="fas fa-box-open info-icon"></i>
                    <div>
                        <a href="{{route('free-samples')}}">
                            <h3>{{__('homePage.free-sample.title')}}</h3>
                        </a>
                        <p>{{__('homePage.free-sample.description')}}</p>
                    </div>
                </div>
                <div class="info-box">
                    <i class="fas fa-lightbulb info-icon"></i>
                    <div>
                        <a href="{{route('resources.get-inspired-page')}}">
                            <h3>{{__('homePage.get-inspired.title')}}</h3>
                        </a>
                        <p>{{__('homePage.get-inspired.description')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="sub-heading">{{__('homePage.our-products.title')}}</span>
                <h2>{!! __('homePage.our-products.subtitle') !!}</h2>
                <p>{{__('homePage.our-products.description')}}</p>
            </div>

            <div class="product-grid">
                @forelse($categories as $category)

                    <a href="{{route('category', $category->slug)}}" class="product-card">
                        <div class="product-img">
                            <img src="{{asset('storage/' . $category->image)}}" alt="{{$category->name}} image"/>
                            <div class="card-overlay">
                                <span class="btn-link">{{__('homePage.view-details')}}</span>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>{{$category->name}}</h3>
                            <p>{{ str()->limit($category->description, 80) }}</p>
                        </div>
                    </a>

                @empty

                    <div class="no-categories-state">
                        <div class="no-cat-icon">
                            <i class="fas fa-layer-group"></i></div>
                        <h3 class="no-cat-title">{{__("homePage.our-products.no-product.title")}}</h3>
                        <p class="no-cat-desc">
                            {{__("homePage.our-products.no-product.text")}}
                        </p>
                    </div>

                @endforelse
            </div>
        </div>
    </section>

    <section class="video-feature-section bg-white">
        <div class="container">
            <div class="split-content-centered">
                <span class="sub-heading">{{__("homePage.discover")}}</span>
                <h2>{{$homePageSettings->homePageAboutTitle}}</h2>
                <p>{{$homePageSettings->homePageAboutDesc}}</p>
            </div>

            <div class="video-preview-box" data-bs-toggle="modal" data-bs-target="#videoPopup">

                <div class="video-overlay">
                    <div class="play-btn-circle"></div>
                </div>

                <div class="iframe-wrapper" id="previewIframeContainer">
                    {!! $homePageSettings->iframeVideo !!}
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="videoPopup" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 position-relative">
                    <button type="button" class="btn-video-close" data-bs-dismiss="modal" aria-label="Close">&times;
                    </button>

                    <div class="ratio ratio-16x9 shadow-lg"
                         style="border-radius: 15px; overflow: hidden; background: #000;">
                        <iframe id="modalIframe" src="" frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="whats-new-section">
        <div class="container">
            <div class="section-header">
                <span class="sub-heading">{{__('homePage.whats-new.badge')}}</span>
                <h2>{{__('homePage.whats-new.title')}}</h2>
            </div>

            @if($reports->count() > 0)
                <div class="news-slider-wrapper">
                    <button class="news-nav-btn prev-news">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="news-nav-btn next-news">
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <div class="news-track">
                        @foreach($reports as $report)
                            <a href="{{route('news', [$report->slug, $report->id])}}" class="news-card">
                                <div class="news-img">
                                    <img src="{{asset('storage/' . $report->image)}}" alt="{{$report->title}}"/>
                                </div>
                                <div class="news-content">
                                    <span class="news-date">{{$report->created_at->format("d.m.Y")}}</span>
                                    <h3>{{$report->title}}</h3>
                                    <p>
                                        {{str()->limit(strip_tags($report->content), 100, "...")}}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Haberler Varken Görünen Buton --}}
                <div class="news-footer-action mt-5 text-center">
                    <a href="{{ route('all-news') }}" class="btn-view-all">
                        {{ __('homePage.whats-new.view-all') }}
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>

            @else
                <div class="no-news-state">
                    <div class="no-news-icon">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <h3 class="no-news-title">{{__('homePage.whats-new.no-news.title')}}</h3>
                    <p class="no-news-desc">
                        {{__('homePage.whats-new.no-news.text')}}
                    </p>

                </div>
            @endif

        </div>
    </section>
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const previewBox = document.querySelector('.video-preview-box');
            const previewContainer = document.getElementById('previewIframeContainer');
            const videoModal = document.getElementById('videoPopup');
            const modalIframe = document.getElementById('modalIframe');

            let originalSrc = "";
            let previewIframe = null;

            if (previewContainer) {
                previewIframe = previewContainer.querySelector('iframe');
                if (previewIframe) {
                    originalSrc = previewIframe.src;
                }
            }

            function addParams(url, params) {
                if (!url) return "";
                let separator = url.indexOf('?') > -1 ? '&' : '?';
                return url + separator + params;
            }

            if (previewBox && previewIframe && originalSrc && videoModal && modalIframe) {

                previewBox.addEventListener('mouseenter', function () {
                    let hoverUrl = "";

                    if (originalSrc.includes('youtube') || originalSrc.includes('youtu.be')) {
                        hoverUrl = addParams(originalSrc, "autoplay=1&mute=1&controls=0&modestbranding=1&rel=0");
                    } else if (originalSrc.includes('vimeo')) {
                        hoverUrl = addParams(originalSrc, "autoplay=1&muted=1&background=1");
                    } else {
                        hoverUrl = addParams(originalSrc, "autoplay=1&muted=1");
                    }

                    previewIframe.src = hoverUrl;
                });

                previewBox.addEventListener('mouseleave', function () {
                    previewIframe.src = originalSrc;
                });

                videoModal.addEventListener('shown.bs.modal', function () {
                    let playUrl = "";

                    if (originalSrc.includes('youtube') || originalSrc.includes('youtu.be')) {
                        playUrl = addParams(originalSrc, "autoplay=1&rel=0");
                    } else {
                        playUrl = addParams(originalSrc, "autoplay=1");
                    }

                    modalIframe.setAttribute('src', playUrl);

                    previewIframe.src = originalSrc;
                });

                videoModal.addEventListener('hide.bs.modal', function () {
                    modalIframe.setAttribute('src', '');
                });
            }
        });
    </script>
@endpush
