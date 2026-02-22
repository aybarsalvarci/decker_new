@extends('front.layouts.master')

@section('title', __("news.title"))
@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/news-all.css')}}"/>
@endpush

<section class="news-hero">
    <div class="news-hero-content">
        <h1>{{__("news.hero.title")}}</h1>
        <p>{{__("news.hero.subtitle")}}</p>
    </div>
</section>

<section class="news-section">
    <div class="container">

        <div class="vertical-grid" id="newsGrid">
            @include('front.news-list', compact('news'))
        </div>

        <div class="load-more-container">
            <button id="loadMoreBtn" class="btn-load-more">{{__("news.load-more")}}</button>
        </div>

    </div>
</section>

@push("js")
    <!-- jQuery -->
    <script src="{{asset('back/plugins/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            const loadMoreBtn = $('.btn-load-more');
            const grid = $('#newsGrid')

            loadMoreBtn.click(function (e) {
                e.preventDefault();

                let itemCount = $(".news-item").length;

                $.ajax({
                    url: "{{route('getNews')}}",
                    method: "GET",
                    data: {
                        count: itemCount
                    },
                    success: function (resp) {
                        let html = resp.view;
                        grid.append(html);

                        if(resp.view == "")
                        {
                            loadMoreBtn.remove();
                        }
                    },
                    error: function (resp) {
                        toastr.error("An error occured!");
                    }
                });
            })
        });
    </script>
@endpush
