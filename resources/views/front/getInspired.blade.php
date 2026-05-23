@extends('front.layouts.master')

@section('title', __('getInspired.page_title'))

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/gallery.css')}}"/>
@endpush

@section('content')

    <section class="gallery-hero">
        <div class="gallery-hero-content">
            <h1>{{__('getInspired.hero_title')}}</h1>
            <p>
                {{__('getInspired.hero_text')}}
            </p>
        </div>
    </section>

    <section
        class="section-padding"
        style="background-color: #f4f6f7; padding: 60px 0"
    >
        <div class="container">
            <div class="gallery-container" id="galleryGrid">
                @foreach($galleryItems as $item)
                    <div class="gallery-item">
                        <img src="{{asset('storage/' . $item->path)}}"
                             alt="Project Inspiration"
                             loading="lazy"
                             onerror="this.parentElement.style.display='none';">
                        <div class="gallery-overlay"></div>
                    </div>
                @endforeach
            </div>

            <div class="load-more-container">
                <button id="loadMoreBtn" class="btn-load-more">
                    {{__('getInspired.load_more')}}
                </button>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let loadMoreBtn = document.querySelector('#loadMoreBtn');
            const galleryGrid = document.querySelector("#galleryGrid");

            loadMoreBtn.addEventListener('click', function () {

                let url = "{{route('get-inspireds', 'count')}}";
                let count = document.querySelectorAll('.gallery-item').length
                url = url.replace('count', count);

                fetch(url, {
                    method : "GET",
                })
                    .then(response => response.json())
                    .then((json) => {
                        if(json.length > 0)
                        {
                            createElement(json);
                        }
                        else
                        {
                            loadMoreBtn.remove();
                            alert("There isn't any images.");  //TODO: dil desteği eklenecek.
                        }
                    });

            });

            function createElement(images)
            {
                images.forEach((image) => {
                    const itemDiv = document.createElement("div");
                    itemDiv.className = "gallery-item";
                    itemDiv.innerHTML = `
                      <img src="/storage/${image.path}"
                           alt="Project Inspiration"
                           loading="lazy"
                           onerror="this.parentElement.style.display='none';">
                      <div class="gallery-overlay"></div>
                    `;
                    galleryGrid.appendChild(itemDiv);
                })
            }
        });

    </script>
@endpush
