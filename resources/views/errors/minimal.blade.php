@include('front.layouts.header')

<style>
    .error-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        background: radial-gradient(circle at center, #ffffff 0%, #f8f9fa 100%);
        padding: 80px 0;
    }

    .error-card {
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
    }

    .error-number {
        font-family: 'Montserrat', sans-serif;
        font-size: 120px;
        font-weight: 800;
        line-height: 1;
        background: linear-gradient(135deg, #333 0%, #777 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
        opacity: 0.15;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    .error-content-box {
        position: relative;
        z-index: 1;
    }

    .error-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        color: #222;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .error-divider {
        width: 50px;
        height: 3px;
        background-color: #333;
        margin: 20px auto;
    }

    .btn-return {
        background-color: #333;
        color: #fff;
        padding: 12px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        margin-top: 25px;
        border: 2px solid #333;
    }

    .btn-return:hover {
        background-color: transparent;
        color: #333;
    }
</style>

<main class="error-section">
    <div class="container">
        <div class="error-card">
            <div class="position-relative py-5">
                <div class="error-number">@yield('code')</div>

                <div class="error-content-box">
                    <h1 class="error-title h2">@yield('message')</h1>
                    <div class="error-divider"></div>
                    <p class="text-muted mb-4">
                        @yield('text')
                    </p>
                    <a href="{{ route('home') }}" class="btn-return">
                        <i class="fas fa-arrow-left me-2"></i> {{ __('errorPages.back-to-home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

@include('front.layouts.footer')
