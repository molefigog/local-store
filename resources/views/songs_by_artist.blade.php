@extends('layouts.master')

@section('content')
    <div class="text-center"> <h3 class="text-uppercase footer-heading">{{ $artist['name'] }}</h3><div>
        <h5><i class="icon-share2"></i></h5>
        {!! $shareButtons !!}
    </div></div>
    <hr>
    <div class="articles">
        @forelse($musicCollection as $music)
        <div class="article-card">
            <div class="cover">
                <img src="{{ asset("storage/$music->image") }}" alt="Article 1 Cover Image">
                <div class="overlay">
                    <a href="#" class="play-button track-list" data-track="{{ asset("storage/demos/$music->demo") }}"
                        data-poster="{{ asset("storage/$music->image") }}" data-title="{{ $music->title ?? '-' }}" data-singer="{{ $music->artist ?? '-' }}">
                        <i class="icon-play"></i>
                    </a>
                </div>
            </div>

            <div class="details">
                <h6 class="artist" id="artistName">{{ $music->artist ?? '-' }}</h6>

                <p class="card-text" id="product1Description">
                    {{ $music->title ?? '-' }}
                </p>

                @if ($music->amount == 0)
                    <a href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"
                      style="margin-right: 4px;"  class="btn buy-button">Download</a>
                @else
                    <a href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"
                      style="margin-right: 4px;"  class="btn buy-button">Buy R{{ $music->amount }}</a>
                @endif
                <button style="font-size: 9px; margin-right: 4px;" class="btn btn-transparent btn-outline-danger btn-sm" wire:click="incrementLikes({{ $music->id }})">
                    <span class="icon-heart"></span>  {{ $music->likes }}
                </button>

                <a style="font-size: 9px;" class="btn btn-transparent btn-outline-primary btn-sm"
                            href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"><span
                                class="icon-eye"></span> {{ $music->views }}</a>
            </div>
            <?php
            $baseUrl = config('app.url');
            $url = "{$baseUrl}/msingle/{$music->slug}";
            $shareButtons = \Share::page($url, 'Check out this music: ' . $music->title)
                ->facebook()
                ->twitter()
                ->whatsapp();
            ?>
            <div class="songs-button"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="icon-ellipsis-v"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        {{-- <a class="dropdown-item" href="#"><span class="icon-line-plus"></span> Add to
                            Queue</a> --}}
                        <a class="dropdown-item"
                            href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"><span
                                class="icon-eye"></span> Views {{ $music->views }}</a>
                        <a class="dropdown-item"
                            href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"><span
                                class="icon-download"></span>
                            Downloads {{ $music->downloads }}
                        </a>
                        {{-- <a class="dropdown-item" href="{{action(SiteController@likes)}}"><span class="icon-line-heart"></span> {{$music->likes}}</a> --}}

                        <!-- Button to increment likes -->
                        <button class="dropdown-item" wire:click="incrementLikes({{ $music->id }})">
                            <span class="icon-heart"></span> React {{ $music->likes }}
                        </button>
                        <div class="dropdown-divider"></div>

                        {!! $shareButtons !!}
                    </li>
                </ul>
            </div>
            <div class="details-left">

                <p class="texts"><i class="icon-download"></i>&nbsp;{{ $music->downloads }}</p>
                <p class="texts"><i class="icon-clock-o"></i>&nbsp;{{ $music->duration }}</p>
            </div>
        </div>
        @empty

        @lang('no_items_found')
        @endforelse

    </div>
    <div class="pagination">{{ $musicCollection->links() }}</div>
@endsection
@section('head')
    <title>{{ $metaTags['title'] }}</title>
    <meta name="description" content="{{ $metaTags['description'] }}">
    <meta property="og:title" content="{{ $metaTags['title'] }}">
    <meta property="og:image" content="{{ $metaTags['image'] }}">
    <meta property="og:description" content="{{ $metaTags['description'] }}">
    <meta property="og:url" content="{{ $metaTags['url'] }}" />
    <meta name="keywords" content="{{ $metaTags['keywords'] }}">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $metaTags['title'] }}" />
    <meta name="twitter:description" content="{{ $metaTags['description'] }}" />
    <meta name="twitter:image" content="{{ $metaTags['image'] }}" />
    <meta property="fb:app_id" content="337031642040584" />
@endsection

@push('ghead')
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MT3JSPQW');
    </script>
    <!-- End Google Tag Manager -->
@endpush

@push('gbody')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MT3JSPQW" height="0" width="0"
            style="display:none;visibility:hidden">
        </iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endpush


@push('player')

    <script src="{{ asset('frontend/js/mediaelement-and-player.js')}}"></script>

    <script>
        var trackPlaying = '',
            audioPlayer = document.getElementById('audio-player');

        audioPlayer.addEventListener("ended", function() {
            jQuery('.track-list').find('i').removeClass('icon-pause').addClass('icon-play');
        });

        audioPlayer.addEventListener("pause", function() {
            jQuery('.track-list').find('i').removeClass('icon-pause').addClass('icon-play');
        });

        function changeAudio(sourceUrl, posterUrl, trackTitle, trackSinger, playAudio = true) {
            var audio = $("#audio-player"),
                clickEl = jQuery('[data-track="' + sourceUrl + '"]'),
                playerId = audio.closest('.mejs__container').attr('id'),
                playerObject = mejs.players[playerId];

            jQuery('.track-list').find('i').removeClass('icon-pause').addClass('icon-play');

            if (sourceUrl == trackPlaying) {
                if (playerObject.paused) {
                    playerObject.play();
                    clickEl.find('i').removeClass('icon-play').addClass('icon-pause');
                } else {
                    playerObject.pause();
                    clickEl.find('i').removeClass('icon-pause').addClass('icon-play');
                }
                return true;
            }

            trackPlaying = sourceUrl;

            audio.attr('poster', posterUrl);
            audio.attr('title', trackTitle);

            jQuery('.mejs__layers').html('').html('<div class="mejs-track-artwork"><img src="' + posterUrl +
                '" alt="Track Poster" /></div><div class="mejs-track-details"><h3>' + trackTitle + '<br><span>' +
                trackSinger + '</span></h3></div>');

            if (sourceUrl != '') {
                playerObject.setSrc(sourceUrl);
            }
            playerObject.pause();
            playerObject.load();

            if (playAudio == true) {
                playerObject.play();
                jQuery(clickEl).find('i').removeClass('icon-play').addClass('icon-pause');
            }
        }

        jQuery('.track-list').on('click', function() {
            var audioTrack = jQuery(this).attr('data-track'), // Track url
                posterUrl = jQuery(this).attr('data-poster'), // Track Poster Image
                trackTitle = jQuery(this).attr('data-title'); // Track Title
            trackSinger = jQuery(this).attr('data-singer'); // Track Singer Name

            changeAudio(audioTrack, posterUrl, trackTitle, trackSinger);
            return false;
        });

        jQuery(window).on('load', function() {
            var trackOnload = jQuery('#track-onload');

            if (trackOnload.length > 0) {
                var audioTrack = trackOnload.attr('data-track'), // Track url
                    posterUrl = trackOnload.attr('data-poster'), // Track Poster Image
                    trackTitle = trackOnload.attr('data-title'); // Track Title
                trackSinger = trackOnload.attr('data-singer'); // Track Singer Name

                setTimeout(function() {
                    changeAudio(audioTrack, posterUrl, trackTitle, trackSinger, false);
                }, 500);
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const audioPlayer = document.getElementById('audio-player');

            function hideMediaPlayer() {
                if (!audioPlayer.paused || audioPlayer.src) {
                    audioPlayer.style.display = 'block';
                } else {
                    audioPlayer.style.display = 'none';
                }
            }

            audioPlayer.addEventListener('loadeddata', hideMediaPlayer);
            audioPlayer.addEventListener('pause', hideMediaPlayer);

            // Initial check after DOM loaded
            hideMediaPlayer();
        });
    </script>
@endpush

@push('aplayer')
<link rel="stylesheet" href="{{ asset('frontend/css/mediaelementplayer.css') }}">
@endpush

@section('audio')
<audio id="audio-player" preload="none" class="mejs__player" controls
            data-mejsoptions='{"defaultAudioHeight": "50", "alwaysShowControls": "true"}' style="max-width:100%;">
            <source src="" type="audio/mp3">
        </audio>
@endsection
