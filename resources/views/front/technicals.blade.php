@extends('front.layouts.master')

@section('title', __("technicals.title"))

@push('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/technicals.css') }}"/>
@endpush

@section('content')

    <section class="tech-hero">
        <div class="tech-hero-overlay"></div>
        <div class="tech-hero-content">
            <h1>{{__("technicals.hero.title")}}</h1>
            <p>{{__("technicals.hero.subtitle")}}</p> </div>
    </section>

    <section class="tech-section">
        <div class="container">

            <div class="section-header text-center">
                <span class="sub-heading">{{__("technicals.section.badge")}}</span>
                <h2>{{__("technicals.section.title")}}</h2>
                <p class="section-desc">
                    {{__("technicals.section.text")}}
                </p>
            </div>

            <div class="tech-grid">

                @foreach($certificates as $certificate)
                    <div class="resource-card">
                        <div class="card-image-top">
                            <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $certificate->title }}</h3>
                            <p class="card-desc">
                                {{ str($certificate->description)->limit(120) }}
                            </p>
                            <a href="{{ asset('storage/' . $certificate->file) }}" target="_blank" class="card-btn">
                                {{ __("technicals.certificates.go-to-file") }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
    </section>

@endsection

@push('js')
@endpush
