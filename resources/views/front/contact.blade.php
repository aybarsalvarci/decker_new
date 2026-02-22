@extends('front.layouts.master')

@section('title', __("contact.title"))

@push('css')
    <link rel="stylesheet" href="{{asset('front/assets/css/contact.css')}}"/>
@endpush

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@@type' => 'ContactPage',
            'name' => __("contact.title"),
            'description' => __("contact.hero.subtitle"),
            'url' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
            'inLanguage' => (app()->getLocale() === 'esp' ? 'es' : app()->getLocale()),

            'alternateName' => (app()->getLocale() === 'en')
                ?   __('contact.title', [], 'esp')
                :   __('contact.title', [], 'en'),

            'mainEntity' => [
                '@@type' => 'LocalBusiness',
                'name' => 'Deck-er',
                'image' => asset('storage/' . config('settings.header_logo')),
                'telephone' => $info->phone,
                'email' => $info->email,
                'address' => [
                    '@@type' => 'PostalAddress',
                    'streetAddress' => $info->location,
                    'addressLocality' => 'Miami',
                    'addressRegion' => 'FL',
                    'postalCode' => '33101',
                    'addressCountry' => 'US'
                ],
                'openingHours' => $info->working_hours,
            ],

            'breadcrumb' => [
                '@@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@@type' => 'ListItem',
                        'position' => 1,
                        'name' => __("homePage.page-name"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true),
                    ],
                    [
                        '@@type' => 'ListItem',
                        'position' => 2,
                        'name' => __("contact.title"),
                        'item' => LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true),
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>{{__("contact.hero.title")}}</h1>
            <p>{{__("contact.hero.subtitle")}}</p>
        </div>
    </section>

    <section class="section-padding" style="background-color: #f9f9f9;">
        <div class="container">
            <div class="contact-wrapper">

                <div class="contact-info-col">
                    <h3>{{__("contact.contact-infos.title")}}</h3>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="info-text">
                            <h5>{{__("contact.contact-infos.location")}}</h5>
                            <p>{{$info->location}}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="info-text">
                            <h5>{{__("contact.contact-infos.phone")}}</h5>
                            <a href="tel:{{$info->phone}}">{{$info->phone}}</a>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="info-text">
                            <h5>{{__("contact.contact-infos.email")}}</h5>
                            <a href="mailto:{{$info->email}}">{{$info->email}}</a>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-clock"></i></div>
                        <div class="info-text">
                            <h5>{{__("contact.contact-infos.working-hours")}}</h5>
                            <p>{{$info->working_hours}}</p>
                        </div>
                    </div>

                    <div class="map-container">
                        {!! $info->map !!}
                    </div>
                </div>

                <div class="contact-form-col">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif
                    <h3 style="color: var(--primary-color); margin-bottom: 20px;">{{__("contact.form.title")}}</h3>

                    @if(session('success'))
                        <div class="alert alert-success mb-3" style="padding: 10px; background-color: #d4edda; color: #155724; border-radius: 4px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="contactForm" action="{{route('contact')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">{{__("contact.form.labels.name")}} *</label>
                            <input type="text"
                                   class="form-control @error('full_name') is-invalid @enderror"
                                   required
                                   placeholder="{{__("contact.form.placeholders.name")}}"
                                   name="full_name"
                                   value="{{ old('full_name') }}">

                            @error('full_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{__("contact.form.labels.email")}} *</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required
                                   placeholder="your@email.com"
                                   name="email"
                                   value="{{ old('email') }}">

                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{__("contact.form.labels.phone")}}</label>
                            <input type="tel"
                                   class="form-control @error('phone_number') is-invalid @enderror"
                                   placeholder="+1 (555) 000-0000"
                                   name="phone_number"
                                   value="{{ old('phone_number') }}">

                            @error('phone_number')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{__("contact.form.labels.role")}} *</label>
                            <select class="form-control @error('role') is-invalid @enderror" required name="role">
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>{{__("contact.form.placeholders.select-role")}}</option>
                                <option value="Home Owner" {{ old('role') == 'Home Owner' ? 'selected' : '' }}>{{__("contact.form.roles.home-owner")}}</option>
                                <option value="Builder" {{ old('role') == 'Builder' ? 'selected' : '' }}>{{__("contact.form.roles.builder")}}</option>
                                <option value="Architect" {{ old('role') == 'Architect' ? 'selected' : '' }}>{{__("contact.form.roles.architect")}}</option>
                                <option value="Interior/Exterior Designer" {{ old('role') == 'Interior/Exterior Designer' ? 'selected' : '' }}>{{__("contact.form.roles.designer")}}</option>
                                <option value="Distributor/Retailer" {{ old('role') == 'Distributor/Retailer' ? 'selected' : '' }}>{{__("contact.form.roles.distributor")}}</option>
                                <option value="Other" {{ old('role') == 'Other' ? 'selected' : '' }}>{{__("contact.form.roles.other")}}</option>
                            </select>

                            @error('role')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Message *</label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                      required
                                      placeholder="{{__("contact.form.placeholders.message")}}"
                                      name="message">{{ old('message') }}</textarea>

                            @error('message')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">
                            Send Message <i class="fas fa-paper-plane" style="margin-left:8px;"></i>
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
