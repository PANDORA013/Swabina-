{{-- SEO Meta Component --}}
{{-- Usage: <x-seo-meta title="Page Title" description="Page Description" :keywords="['keyword1', 'keyword2']" /> --}}

@props([
    'title' => 'PT Swabina Gatra - Solusi Profesional Terpercaya',
    'description' => 'PT Swabina Gatra menyediakan solusi profesional untuk Facility Management, Digital Solution, SWA Academy, SWA Tour, dan Swasegar AMDK.',
    'keywords' => ['Swabina Gatra', 'Facility Management', 'Digital Solution', 'Training', 'AMDK', 'Tour Organizer'],
    'image' => null,
    'url' => null,
    'type' => 'website',
    'author' => 'PT Swabina Gatra',
    'canonical' => null
])

@php
    $fullTitle = $title . ' | PT Swabina Gatra';
    $currentUrl = $url ?? url()->current();
    $ogImage = $image ?? asset('images/og-default.jpg');
    $keywordsString = is_array($keywords) ? implode(', ', $keywords) : $keywords;
    $canonicalUrl = $canonical ?? $currentUrl;
@endphp

{{-- Basic Meta Tags --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

{{-- SEO Meta Tags --}}
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywordsString }}">
<meta name="author" content="{{ $author }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph Meta Tags (Facebook, LinkedIn) --}}
<meta property="og:locale" content="{{ app()->getLocale() === 'en' ? 'en_US' : 'id_ID' }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $currentUrl }}">
<meta property="og:site_name" content="PT Swabina Gatra">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $title }}">

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:image:alt" content="{{ $title }}">

{{-- Additional Meta Tags --}}
<meta name="theme-color" content="#0056b3">
<meta name="msapplication-TileColor" content="#0056b3">

{{-- Favicon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">

{{-- Preconnect for Performance --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

{{-- Alternate Languages --}}
@if(isset($alternateLanguages))
    @foreach($alternateLanguages as $lang => $langUrl)
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $langUrl }}">
    @endforeach
@endif
<link rel="alternate" hreflang="x-default" href="{{ url('/') }}">
