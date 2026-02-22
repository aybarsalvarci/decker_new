<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">

    @foreach($staticUrls as $urlData)
        <url>
            <loc>{{ $urlData['loc'] }}</loc>
            <lastmod>{{ $urlData['lastmod'] }}</lastmod>
            @foreach($urlData['alternates'] as $locale => $altUrl)
                <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $altUrl }}" />
            @endforeach
            <xhtml:link rel="alternate" hreflang="x-default" href="{{ $urlData['alternates']['en'] ?? $urlData['loc'] }}" />
            <priority>{{ $urlData['priority'] }}</priority>
        </url>
    @endforeach

    @foreach($categories as $category)
        @foreach($locales as $locale)
            @php
                $currentSlug = $category->{"slug_$locale"} ?? $category->slug_en;
            @endphp
            <url>
                <loc>{{ LaravelLocalization::getLocalizedURL($locale, url($currentSlug)) }}</loc>
                <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
                @foreach($locales as $altLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}"
                                href="{{ LaravelLocalization::getLocalizedURL($altLocale, url($category->{"slug_$altLocale"} ?? $category->slug_en)) }}" />
                @endforeach
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('en', url($category->slug_en)) }}" />
                <priority>0.7</priority>
            </url>
        @endforeach
    @endforeach

    @foreach($news as $item)
        @foreach($locales as $locale)
            @php
                $slug = $item->{"slug_$locale"} ?? $item->slug_en;
                $path = "news/" . $slug . "/" . $item->id;
            @endphp
            <url>
                <loc>{{ LaravelLocalization::getLocalizedURL($locale, url($path)) }}</loc>
                <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
                @foreach($locales as $altLocale)
                    @php
                        $altSlug = $item->{"slug_$altLocale"} ?? $item->slug_en;
                    @endphp
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}"
                                href="{{ LaravelLocalization::getLocalizedURL($altLocale, url('news/'.$altSlug.'/'.$item->id)) }}" />
                @endforeach
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('en', url('news/'.$item->slug_en.'/'.$item->id)) }}" />
                <priority>0.9</priority>
            </url>
        @endforeach
    @endforeach

</urlset>
