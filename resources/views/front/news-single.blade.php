@extends('front.layouts.master')

@section('title', $news->title)

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/news.css')}}"/>
@endpush

@section('content')
    <section class="news-header"
             style="background-image: url('{{ asset('storage/' . $news->image) }}');">
        <div class="container">
            <span class="news-meta">
                {{ strtoupper($news->type) }} • {{ $news->created_at->format("M d, Y") }}
            </span>
            <h1>{{$news->title }}</h1>
        </div>
    </section>

    <section class="section-padding bg-white">
        <div class="container">
            <div class="news-content-text">

                <div class="main-content mb-5">
                    {!! $news->content !!}
                </div>

                @if($news->images && $news->images->count() > 0)
                    <div class="dual-slider-wrapper">
                        <div class="dual-slider-track">
                            @foreach($news->images as $sliderImage)
                                <div class="dual-slide">
                                    <img src="{{ asset('storage/' . $sliderImage->path) }}"
                                         alt="{{ $news->title_en }}">
                                </div>
                            @endforeach
                        </div>

                        @if($news->images->count() > 1)
                            <button class="slider-arrow arrow-prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="slider-arrow arrow-next"><i class="fas fa-chevron-right"></i></button>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{asset('front/assets/js/news-slider.js')}}"></script>
@endpush
