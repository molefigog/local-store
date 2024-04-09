<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include Tailwind CSS -->
    <livewire:styles />
    <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filament/forms/forms.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html, body {
            height: 100%;
        }
    </style>
</head>
<body class="flex justify-center items-center">
    <div class="container mx-auto">
        @yield('content')
    </div>
    @livewireScripts
    <script src="{{ asset('js/filament//support/support.js') }}"></script>
    <script src="{{ asset('js/filament/filament/app.js') }}"></script>
    <script src="{{ asset('js/filament/filament/echo.js') }}"></script>
    <script type="module" src="{{ asset('js/filament/forms/components/file-upload.js') }}"></script>
</body>
</html>

