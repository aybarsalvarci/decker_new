@extends('front.layouts.master')

@section('title', __("warranties.title"))
@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/warranties.css')}}"/>
@endpush

@section('content')

<section class="warranty-hero">
    <div class="warranty-hero-content">
        <span class="hero-badge">{{__("warranties.hero.badge")}}</span>
        <h1>{{__("warranties.hero.title")}}</h1>
    </div>
</section>

<div class="policy-container">

    <h2 class="main-heading">{{$page->title}}</h2>


    {!! $page->content !!}

</div>


@endsection
@push('js')
    <script src="{{asset('front/assets/js/resources.js')}}"></script>
@endpush
