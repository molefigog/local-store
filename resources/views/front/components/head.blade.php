<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="author" content="gog">
    <meta name="MobileOptimized" content="320">
    <meta property="og:site_name" content="gw-ent" />
    @yield('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <livewire:styles />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/font/icomoon/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" id="cssTheme" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    @php
    $setting = App\Models\Setting::orderBy('created_at', 'desc')
    ->select('site', 'image', 'logo', 'favicon', 'description')
    ->first();
    @endphp
    @if ($setting && $setting->favicon)
    <link rel="icon" type="image/png" href="{{ \Storage::url($setting->favicon) }}">
    @endif
    @if ($setting && $setting->favicon)
    <link rel="apple-touch-icon" href="{{ \Storage::url($setting->favicon) }}">
    @endif
    @if ($setting && $setting->favicon)
    <meta name="msapplication-TileImage" content="{{ \Storage::url($setting->favicon) }}">
    @endif
    @if ($setting && $setting->favicon)
    <link rel="shortcut icon" href="{{ \Storage::url($setting->favicon) }}">
    @endif
    @stack('tellcss')
    @stack('aplayer')
    @stack('pondcss')
    <link rel="stylesheet" href="{{ asset('frontend/css/frontend.css') }}">
<script type="application/ld+json">
    {
    "@context" : "http://schema.org",
    "@type" : "WebSite",
    "name" : "GW ENT",
    "alternateName" : "Genius Works Ent",
    "url" : "https://www.gw-ent.co.za"
    }
</script>


</head>

<body>

