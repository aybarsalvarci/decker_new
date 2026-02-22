<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />
    <title>{{$catalog->title}} | {{config("settings.title")}}</title>
    
    <link rel="canonical" content="{{url()->current()}}">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@300;400;600&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <link rel="stylesheet" href="{{asset('front/assets/css/catalog.css')}}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
    </script>
    <script src="https://unpkg.com/page-flip/dist/js/page-flip.browser.js"></script>
</head>
<body>
<main class="fullscreen-viewer">
    <div class="top-bar-controls">
        <a href="{{route('home')}}" class="btn-exit">
            <i class="fas fa-arrow-left"></i>
            <span class="hide-mobile">{{__("catalog.back-home")}}</span>
        </a>

        <div class="title-area">{{$catalog->title}}</div>

        <a
            href="{{asset('storage/' . $catalog->file)}}"
            download
            class="btn-download-icon"
        >
            <i class="fas fa-download"></i>
        </a>
    </div>

    <div id="loadingState">
        <div class="spinner"></div>
        <p>{{__("catalog.loading")}}</p>
    </div>

    <div class="book-stage">
        <div id="book"></div>
    </div>

    <button id="btnPrev" class="nav-arrow left">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button id="btnNext" class="nav-arrow right">
        <i class="fas fa-chevron-right"></i>
    </button>

    <div class="bottom-bar-controls">
        <div class="page-counter" id="pageCounter">{{__("catalog.loading")}}</div>

        <div class="zoom-tools">
            <button id="btnZoomOut"><i class="fas fa-minus"></i></button>
            <button id="btnZoomIn"><i class="fas fa-plus"></i></button>
        </div>
    </div>
</main>

<script src="{{asset('front/assets/js/catalog.js')}}"></script>
</body>
</html>
