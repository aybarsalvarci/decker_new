@extends('front.layouts.master')

@section('title', "Resources")
@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/resources.css')}}"/>
@endpush

@section('content')

    <section class="resources-hero">
        <div class="container">
            <span class="hero-subtitle">{{__("resourcesMain.hero.badge")}}</span>
            <h1>{{__("resourcesMain.hero.title")}}</h1>
            <p>
                {{__("resourcesMain.hero.description")}}
            </p>
        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="container">
            <div class="resource-grid">
                <div class="resource-card reveal">
                    <div class="card-image">
                        <img
                            src="/front/assets/images/resources/online_catalog.png"
                            alt="Decker Catalog"
                        />
                        <div class="icon-overlay"><i class="fas fa-book-open"></i></div>
                    </div>
                    <div class="card-content">
                        <h3>{{__("resourcesMain.catalog.title")}}</h3>
                        <p>
                            {{__("resourcesMain.catalog.description")}}
                        </p>
                        <a href="{{route('resources.catalog')}}" class="btn-text-link">
                            {{__("resourcesMain.catalog.link-text")}} <i class="fas fa-book-open"></i>
                        </a>
                    </div>
                </div>

                <div class="resource-card reveal">
                    <div class="card-image">
                        <img
                            src="/front/assets/images/resources/installation_guides.jpg"
                            alt="Installation Guide"
                        />
                        <div class="icon-overlay"><i class="fas fa-tools"></i></div>
                    </div>
                    <div class="card-content">
                        <h3>{{__("resourcesMain.installation-guide.title")}}</h3>
                        <p>
                            {{__("resourcesMain.installation-guide.description")}}
                        </p>
                        <a href="{{route('resources.installation-guides')}}" class="btn-text-link">
                            {{__("resourcesMain.installation-guide.link-text")}} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="resource-card reveal">
                    <div class="card-image">
                        <img src="/front/assets/images/resources/warranties.png" alt="Warranty"/>
                        <div class="icon-overlay"><i class="fas fa-shield-alt"></i></div>
                    </div>
                    <div class="card-content">
                        <h3>{{__("resourcesMain.warranties.title")}}</h3>
                        <p>
                            {{__("resourcesMain.warranties.description")}}
                        </p>
                        <a
                            href="{{route('resources.warranties')}}"
                            class="btn-text-link"
                        >
                            {{__("resourcesMain.warranties.link-text")}} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="resource-card reveal">
                    <div class="card-image">
                        <img
                            src="/front/assets/images/resources/gallery.png"
                            alt="Project Gallery"
                        />
                        <div class="icon-overlay"><i class="fas fa-images"></i></div>
                    </div>
                    <div class="card-content">
                        <h3>{{__("resourcesMain.inspiration-gallery.title")}}</h3>
                        <p>
                            {{__("resourcesMain.inspiration-gallery.description")}}
                        </p>
                        <a href="{{route('resources.get-inspired-page')}}" class="btn-text-link">
                            {{__("resourcesMain.inspiration-gallery.link-text")}} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="resource-card reveal">
                    <div class="card-image">
                        <img
                            src="{{asset('front/assets/images/resources/care_and_maintenance.jpg')}}"
                            alt="Care and Maintenance"
                        />
                        <div class="icon-overlay"><i class="fas fa-broom"></i></div>
                    </div>
                    <div class="card-content">
                        <h3>{{__("resourcesMain.care-maintenance.title")}}</h3>
                        <p>
                            {{__("resourcesMain.care-maintenance.description")}}
                        </p>
                        <a
                            href="{{route('resources.care-and-maintenance')}}"
                            class="btn-text-link"
                        >
                            {{__("resourcesMain.care-maintenance.link-text")}} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="resource-card reveal">
                    <div class="card-image">
                        <img
                            src="/front/assets/images/resources/technicals.png"
                            alt="Technical Resources"
                        />
                        <div class="icon-overlay">
                            <i class="fas fa-file-contract"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3>{{__("resourcesMain.technical-certificates.title")}}</h3>
                        <p>
                            {{__("resourcesMain.technical-certificates.description")}}
                        </p>
                        <a
                            href="{{route('resources.technical-certificates')}}"
                            class="btn-text-link"
                        >
                            {{__("resourcesMain.technical-certificates.link-text")}} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="resource-info-section">
        <div class="container">
            <div class="info-content-wrapper">
                <div class="info-text">
                    <h2>{{__("resourcesMain.support.title")}}</h2>
                    {!!__("resourcesMain.support.text")!!}
                </div>
                <div class="info-stat">
                    <i class="fas fa-headset"></i>
                    <span>{{__("resourcesMain.support.logo-text")}}</span>
                </div>
            </div>
        </div>
    </section>

    <section class="resource-cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>{{__("resourcesMain.contact.title")}}</h2>
                <p>
                    {{__("resourcesMain.contact.subtitle")}}
                </p>
                <div class="cta-buttons">
                    <a href="contact.html" class="btn-light">{{__("resourcesMain.contact.contact-btn")}}</a>
                    <a href="faq.html" class="btn-outline">{{__("resourcesMain.contact.faq-btn")}}</a>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    <script src="{{asset('front/assets/js/resources.js')}}"></script>
@endpush
