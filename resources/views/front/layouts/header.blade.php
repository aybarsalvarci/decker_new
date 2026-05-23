<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="CSRF_TOKEN" content="{{csrf_token()}}">

    <meta name="keywords" content="@yield('keywords', config('settings.meta_keywords_' . app()->getLocale()))">
    <meta name="description" content="@yield('description', config('settings.meta_description_' . app()->getLocale()))">


    <title>
        @if(request()->routeIs('home'))
            {{config('settings.site_title_' . app()->getLocale())}}
        @else
            @yield('title') | {{config('settings.site_title_' . app()->getLocale())}}
        @endif
    </title>

    @if(config('settings.favicon'))
        <link rel="icon" type="image/png" href="{{ asset("storage/" . config("settings.favicon")) }}">
        <link rel="apple-touch-icon" href="{{ asset("storage/" . config("settings.favicon")) }}">
    @endif

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <link rel="alternate"
              hreflang="{{ $localeCode === 'esp' ? 'es' : $localeCode }}"
              href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
    @endforeach

    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">

    <meta property="og:site_name" content="Deck-er">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title') | {{ config('settings.site_title_' . app()->getLocale()) }}">
    <meta property="og:description"
          content="@yield('og_description', config('settings.meta_description_' . app()->getLocale()))">
    <meta property="og:image" content="@yield('og_image', asset('storage/' . config('settings.header_logo')))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title') | {{ config('settings.site_title_' . app()->getLocale()) }}">
    <meta name="twitter:description"
          content="@yield('og_description', config('settings.meta_description_' . app()->getLocale()))">
    <meta name="twitter:image"
          content="{{ asset('storage/' . config('settings.header_logo')) }}">


    <link rel="canonical" href="{{url()->current()}}">

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@300;400;600&display=swap"
        rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('back/plugins/fontawesome-free/css/all.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}"/>
    @stack('css')

    @stack('schema')
</head>

<body>
<div class="top-bar">
    <div class="container">
        <div class="top-info">
            <a href="tel:{{config('settings.phone_number')}}">
                <i class="fas fa-phone-alt"></i> {{config('settings.phone_number')}}
            </a>
            <span class="sep">•</span>
            <a href="mailto:{{config('settings.email')}}">
                <i class="fas fa-envelope"></i> {{config('settings.email')}}
            </a>
        </div>
        <div class="top-social">
            <span>Follow us:</span>
            <a href="{{config('settings.instagram')}}" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="{{config('settings.twitter')}}" aria-label="x"><i class="fab fa-twitter"></i></a>
            <a href="{{config('settings.facebook')}}" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
        </div>
    </div>
</div>

<header id="main-header">
    <div class="container">
        <div class="nav-wrapper">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('storage/' . config('settings.header_logo'))}}" alt="DECKER" class="logo-img"
                     onerror="this.style.display='none'; document.getElementById('text-logo').style.display='block';"/>
                <span id="text-logo" class="logo-text" style="display: none">DECKER</span>
            </a>

            <nav class="main-nav">
                <ul class="nav-links">
                    <li>
                        <a href="{{route('home')}}#products"
                           class="nav-link {{request()->routeIs('products') ? 'active' : ''}}">
                            {{__('front.navbar.products')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('resources.main')}}"
                           class="nav-link {{request()->routeIs('resources.*') ? 'active' : ''}}">
                            {{__('front.navbar.resource')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('about')}}" class="nav-link {{request()->routeIs('about') ? 'active' : ''}}">
                            {{__('front.navbar.about')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('all-news')}}" class="nav-link {{request()->routeIs('all-news') ? 'active' : ''}}">
                            {{__('front.navbar.news')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}" class="nav-link {{request()->routeIs('contact') ? 'active' : ''}}">
                            {{__('front.navbar.contact-us')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('faq')}}" class="nav-link {{request()->routeIs('faq') ? 'active' : ''}}">
                            {{__('front.navbar.faq')}}
                        </a>
                    </li>
                </ul>
            </nav>

            @php
                $currentLocale = LaravelLocalization::getCurrentLocale();
                $supportedLocales = LaravelLocalization::getSupportedLocales();
            @endphp

            <div class="nav-actions">

                <div class="lang-dropdown">

                    <div class="current-lang">
                        @if($currentLocale === 'en')
                            <img src="{{ asset('front/assets/images/flags/usa.jpg') }}" alt="EN"> EN
                        @else
                            <img src="{{ asset('front/assets/images/flags/spain.svg') }}" alt="ESP"> ESP
                        @endif
                        <i class="fas fa-chevron-down ml-1" style="font-size: 0.7rem;"></i>
                    </div>

                    <div class="lang-options">
                        @foreach($supportedLocales as $localeCode => $properties)
                            @if($localeCode !== $currentLocale)

                                @php
                                    // Default olarak mevcut URL'i diğer dile çevir
                                    $url = LaravelLocalization::getLocalizedURL($localeCode, null, [], true);

                                    // Eğer resources sayfasındaysak özel çeviri yap
                                    if (request()->routeIs('resources.*')) {
                                        $resBase = __('routes.resources.main', [], $localeCode); // 'recursos' veya 'resources'
                                        $routeNamePart = \Illuminate\Support\Str::after(request()->route()->getName(), 'resources.');

                                        if ($routeNamePart === 'main') {
                                            $url = url($localeCode . '/' . $resBase);
                                        } else {
                                            $key = str_replace('-', '_', $routeNamePart);
                                            $slug = __('routes.resources.' . $key, [], $localeCode);
                                            $url = url($localeCode . '/' . $resBase . '/' . $slug);
                                        }
                                    }
                                @endphp

                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $url }}">
                                    @if($localeCode === 'en')
                                        <img src="{{ asset('front/assets/images/flags/usa.jpg') }}" alt="EN"> EN
                                    @else
                                        <img src="{{ asset('front/assets/images/flags/spain.svg') }}" alt="ESP"> ESP
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>

                </div>

            </div>


            <button class="mobile-toggle" aria-label="Menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </div>
</header>

<div class="mobile-menu-overlay"></div>

<nav class="mobile-sidebar">
    <div class="mobile-header">
        <span class="mobile-title">MENU</span>
        <button class="mobile-close"><i class="fas fa-times"></i></button>
    </div>

    <ul class="mobile-nav-links">
        <li><a href="{{route('home')}}#products">{{__('front.navbar.products')}}</a></li>
        <li><a href="{{route('resources.main')}}">{{__('front.navbar.resource')}}</a></li>
        <li><a href="{{route('about')}}">{{__('front.navbar.about')}}</a></li>
        <li><a href="{{route('contact')}}">{{__('front.navbar.contact-us')}}</a></li>
        <li><a href="{{route('faq')}}">{{__('front.navbar.faq')}}</a></li>
    </ul>

    <div class="mobile-contact-info">
        <a href="tel:{{config('settings.phone_number')}}"><i
                class="fas fa-phone-alt"></i> {{config('settings.phone_number')}}</a>
        <a href="mailto:{{config('settings.email')}}"><i class="fas fa-envelope"></i> {{config('settings.email')}}</a>
    </div>
</nav>
