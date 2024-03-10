<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
    $setting = App\Models\Setting::orderBy('created_at', 'desc')
    ->select('site', 'image', 'logo', 'favicon', 'description')
    ->first();
    @endphp

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="author" content="gog">
    <meta name="MobileOptimized" content="320">
    <meta property="og:site_name" content="gw-ent" />
    @yield('head')
    
    <script type="application/ld+json">
        {
        "@context" : "http://schema.org",
        "@type" : "WebSite",
        "name" : "GW ENT",
        "alternateName" : "Genius Works Ent",
        "url" : "https://www.gw-ent.co.za"
        }
        </script>
    {{-- @stack('recipe')

    @stack('ghead') --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">



    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/fontello.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/font/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" id="cssTheme" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    @stack('tellcss')
    @stack('aplayer')

    @if ($setting && $setting->favicon)
    <link rel="icon" type="image/png" href="{{ \Storage::url($setting->favicon) }}">
    @endif

    <style>
        @media (max-width: 767.98px) {
            .card {
                width: 100%;
                margin-bottom: 15px;
            }

            .card-img-top {
                max-height: 150px;
                object-fit: cover;
            }

            .card-img-top:hover {
                transform: scale(1.1);
            }

            .row-cols-2>* {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        .card-img-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50%;
            overflow: hidden;
        }

        .card-img-wrapper img {
            transition: 1.5s ease;
        }

        .card:hover .card-img-wrapper img {
            transform: scale(1.15);
        }

        .card-details {
            display: flex;
            position: absolute;
            top: 211px;
            left: 0px;
            width: 100%;
            /* height: 100%; */
            /* background-color: rgb(255 255 255 / 1%); */
            transition: opacity 1.5s ease;
            overflow: hidden;
            flex-wrap: wrap;
            align-content: flex-start;
            justify-content: space-evenly;
            align-items: center;
        }

        .card:hover .card-details {
            transition: 1.5s ease;
            transform: scale(1.15);
            /* Show and fade in the card details */
        }

        .card-hide {
            display: flex;
            opacity: 1;
            position: absolute;
            top: 130px;
            left: 0px;
            width: 100%;
            transition: opacity 1.5s ease;
            overflow: hidden;
            flex-wrap: wrap;
            align-content: flex-start;
            justify-content: space-evenly;
            align-items: center;
        }

        .card:hover .card-hide {
            opacity: 0;
            background-color: rgb(255, 255, 255, 0);
        }

        .social-button {
            display: inline-flex;
            flex-wrap: wrap;
            align-content: stretch;
            justify-content: space-around;
            align-items: flex-start;
            padding: inherit;
            gap: 0px 4px;
            font-size: x-large;
            color: #199945;
        }

        .map-responsive {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-responsive iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }

       
    </style>
    <!-- Favicon Link -->



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Include SweetAlert2 JS -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var downloadLink = '{{ session('
                                downloadLink ') }}';

            if (downloadLink) {
                var downloadButton = document.createElement('a');
                downloadButton.href = downloadLink;
                downloadButton.textContent = 'Download Music';

                var container = document.getElementById('download-container');
                container.appendChild(downloadButton);

                // Clear the session variable after using it


                // Automatically remove the download link after 15 seconds
                setTimeout(function() {
                    container.removeChild(downloadButton);
                }, 15000); // 15000 milliseconds = 15 seconds
            }
        });
    </script>

</head>

<body>
    @stack('gbody')