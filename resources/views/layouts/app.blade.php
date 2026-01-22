<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $settings = \App\Models\Setting::getSettings();
        $metaTitle = isset($metaTitle) ? $metaTitle : ($settings->meta_title ?? $settings->site_title ?? config('app.name', 'INTRA studio'));
        $metaDescription = isset($metaDescription) ? $metaDescription : ($settings->meta_description ?? $settings->site_description ?? '');
        $metaKeywords = isset($metaKeywords) ? $metaKeywords : ($settings->meta_keywords ?? '');
        $ogTitle = isset($ogTitle) ? $ogTitle : ($settings->og_title ?? $metaTitle);
        $ogDescription = isset($ogDescription) ? $ogDescription : ($settings->og_description ?? $metaDescription);
        $ogImage = isset($ogImage) ? $ogImage : ($settings->og_image ? asset('storage/' . $settings->og_image) : ($settings->logo ? asset('storage/' . $settings->logo) : ''));
        $twitterCardTitle = isset($twitterCardTitle) ? $twitterCardTitle : ($settings->twitter_card_title ?? $metaTitle);
        $twitterCardDescription = isset($twitterCardDescription) ? $twitterCardDescription : ($settings->twitter_card_description ?? $metaDescription);
        $twitterCardImage = isset($twitterCardImage) ? $twitterCardImage : ($settings->twitter_card_image ? asset('storage/' . $settings->twitter_card_image) : ($settings->logo ? asset('storage/' . $settings->logo) : ''));
    @endphp

    <title>{{ $metaTitle }}</title>
    
    @if($metaDescription)
    <meta name="description" content="{{ $metaDescription }}">
    @endif
    
    @if($metaKeywords)
    <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    @if($ogDescription)
    <meta property="og:description" content="{{ $ogDescription }}">
    @endif
    @if($ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
    @endif
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $twitterCardTitle }}">
    @if($twitterCardDescription)
    <meta name="twitter:description" content="{{ $twitterCardDescription }}">
    @endif
    @if($twitterCardImage)
    <meta name="twitter:image" content="{{ $twitterCardImage }}">
    @endif
    
    @if($settings->favicon)
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings->favicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=ubuntu:300,400,500,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">
    @livewireScripts
    <main class="flex-1">
        @yield('content')
    </main>
</body>
</html>


