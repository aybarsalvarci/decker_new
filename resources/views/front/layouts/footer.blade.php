<footer>
    <div class="footer-newsletter">
        <div class="container">
            <div class="newsletter-wrapper">
                <div class="newsletter-text">
                    <h3>{{__("front.email-subscribe.title")}}</h3>
                    <p>
                        {{__("front.email-subscribe.text")}}
                    </p>
                </div>
                <form class="newsletter-form" action="{{route('subscribe-email')}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" placeholder="{{__("front.email-subscribe.placeholder")}}" required/>
                        @if($errors->has('email'))
                            <span style="color: red;">{{$error}}</span>
                        @endif
                        <button type="submit">{{__("front.email-subscribe.button")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="footer-top">
            <div class="footer-brand-col">
                <a href="{{route('home')}}" class="footer-logo">
                    <img src="{{asset('storage/' . config('settings.footer_logo'))}}" alt="DECKER" class="img-fluid"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"/>
                    <span class="text-logo-fallback" style="display: none">DECKER</span>
                </a>
                <p>
                    {{config("settings.footer_desc_" . app()->getLocale())}}
                </p>
                <div class="social-links">
                    <a href="{{config('settings.facebook')}}" aria-label="Facebook"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="{{config('settings.instagram')}}" aria-label="Instagram"><i
                            class="fab fa-instagram"></i></a>
                    <a href="{{config('settings.twitter')}}" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
                <div class="footer-extra-logo" style="margin-top: 20px;">
                    <img src="{{asset('front/assets/images/logos/nadra.jpg')}}" class="img-fluid"
                         alt="NADRA Certified"/>
                </div>
            </div>

            <div class="footer-col">
                <h4>{{__("front.footer.products")}}</h4>
                <ul>
                    @foreach($footerData as $data)

                        <li><a href="{{route("category", $data->slug)}}">{{$data->name}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-col">
                <h4>{{__("front.footer.resources.title")}}</h4>
                <ul>
                    <li><a href="{{route('resources.installation-guides')}}">{{__("front.footer.resources.installation-guide")}}</a></li>
                    <li><a href="{{route('resources.warranties')}}">{{__("front.footer.resources.warranty")}}</a></li>
                    <li><a href="{{route('resources.catalog')}}">{{__("front.footer.resources.catalog")}}</a></li>
                    <li><a href="{{route('resources.care-and-maintenance')}}">{{__("front.footer.resources.maintenance")}}</a></li>
                    <li><a href="{{route('resources.technical-certificates')}}">{{__("front.footer.resources.technical")}}</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>{{__("front.footer.company.title")}}</h4>
                <ul>
                    <li><a href="{{route('about')}}">{{__("front.footer.company.about")}}</a></li>
                    <li><a href="{{route('contact')}}">{{__("front.footer.company.contact-us")}}</a></li>
                    <li><a href="{{route('faq')}}">{{__("front.footer.company.faq")}}</a></li>
                    <li><a href="{{route('estimate-cost')}}">{{__("front.footer.company.quote")}}</a></li>
                    <li><a href="{{route('free-samples')}}">{{__("front.footer.company.samples")}}</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{date("Y")}} {{__("front.footer.copyright")}}</p>
            <div class="footer-legal">
                <span>{{config("settings.footer_address")}}</span>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="{{asset('back/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('front/assets/js/main.js')}}"></script>

@if(session()->has('success'))
    <script>
        Swal.fire({
            title: @json(__('front.subscribe-success.title')),
            text: @json(session('success')),
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

@stack('js')
</body>

</html>
