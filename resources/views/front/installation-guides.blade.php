@extends('front.layouts.master')

@section('title', __("installationGuides.title"))

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/installationGuides.css')}}"/>
@endpush

@section('content')

    <section class="warranty-hero">
        <div class="warranty-hero-content">
            <span class="hero-badge">{{__("installationGuides.hero.badge")}}</span>
            <h1>{{__("installationGuides.hero.title")}}</h1>
        </div>
    </section>

    <div class="policy-container">

        <div class="section-header">
            <h2 class="main-heading">{{__("installationGuides.section.title")}}</h2>
            <p>
                {{__("installationGuides.section.desc")}}
            </p>
        </div>

        @php
            $videoCount = $videos->count();
            $layoutClass = 'layout-multi'; // Varsayılan (3 ve üzeri)

            if($videoCount === 1) {
                $layoutClass = 'layout-1';
            } elseif($videoCount === 2) {
                $layoutClass = 'layout-2';
            }
        @endphp

        <div class="video-grid {{ $layoutClass }}">
            @forelse($videos as $video)
                <div class="video-card">
                    <div class="video-wrapper">
                        {!! $video->video !!}
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">
                            {{ $video->title }}
                        </h3>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 50px; background: #f9f9f9; border-radius: 8px;">
                    <i class="fas fa-play-circle fa-3x mb-3" style="color: #ccc;"></i>
                    <p class="text-muted">{{__("installationGuides.section.no-video")}}</p>
                </div>
            @endforelse
        </div>

    </div>

@endsection

@push('js')
    <script src="{{asset('front/assets/js/resources.js')}}"></script>
@endpush
