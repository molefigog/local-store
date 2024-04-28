<div>

    <div id="music-list" class="articles">
        @forelse($allMusic as $music)
            <div wire:key="{{ $music->id }}" class="article-card">
                <div class="cover">
                    <img src="{{ asset("storage/$music->image") }}" alt="Article 1 Cover Image">
                    @if ($music->amount == 0)
                        <div class="overlay">
                            <a href="#" class="play-button track-list"
                                data-track="{{ asset("storage/$music->file") }}"
                                data-poster="{{ asset("storage/$music->image") }}"
                                data-title="{{ $music->title ?? '-' }}" data-singer="{{ $music->artist ?? '-' }}">
                                <i class="icon-play"></i>
                            </a>
                        </div>
                    @else

                        <div class="overlay">
                            <div class="play-button track-list"
                                role="button"
                                tabindex="0"
                                data-track="{{ asset('storage/demos/'.$music->demo) }}"
                                data-poster="{{ asset('storage/'.$music->image) }}"
                                data-title="{{ $music->title ?? '-' }}"
                                data-singer="{{ $music->artist ?? '-' }}"
                                onclick="playTrack(this);">
                                <i class="icon-play"></i>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="details">
                    <h6 class="artist" id="artistName">{{ $music->artist ?? '-' }}</h6>

                    <p class="card-text" id="product1Description">
                        {{ $music->title ?? '-' }}
                    </p>

                    @if ($music->amount == 0)
                        <a href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"
                            style="margin-right: 4px;" class="btn buy-button">Download</a>
                    @else
                        <a href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"
                            style="margin-right: 4px;" class="btn buy-button">Buy R{{ $music->amount }}</a>
                    @endif
                    <button style="font-size: 9px; margin-right: 4px;"
                        class="btn btn-transparent btn-sm"
                        wire:click="incrementLikes({{ $music->id }})">
                        <span style="color: #007bff;">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> {{ $music->likes }}</span>
                    </button>

                    <a style="font-size: 9px; " class="btn btn-transparent btn-sm texts"
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

                            <a class="dropdown-item"
                                href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"><span
                                    class="icon-eye"></span> Views {{ $music->views }}</a>
                            <a class="dropdown-item"
                                href="{{ route('msingle.slug', ['slug' => urlencode($music->slug)]) }}"><span
                                    class="icon-download"></span>
                                Downloads {{ $music->downloads }}
                            </a>

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
    <div class="pagination">{{ $allMusic->links() }}</div>

    @php
        $setting = App\Models\Setting::firstOrFail();
        $appName = config('app.name');
        $url = config('app.url');

        $title = $setting ? $setting->site : $appName;
        $image = asset("storage/$setting->image");
        $keywords = "GW ENT, genius Works ent, KS, K Fire, K-Fire, Elliotgog, GOG";
@endphp
@section('head')
<title>{{ $title}}</title>
<meta name="description" content="{{ $setting->description }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:image" content="{{  $image}}">
<meta property="og:description" content="{{ $setting->description }}">
<meta property="og:url" content="{{ $url }}" />
<meta name="keywords" content="{{$keywords }}">
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ $title}}" />
<meta name="twitter:description" content="{{ $setting->description}}" />
<meta name="twitter:image" content="{{ $image}}" />
<meta property="fb:app_id" content="337031642040584" />
@endsection




@push('player')
<script src="{{ asset('frontend/js/mediaelement-and-player.js') }}"></script>

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
        const divToHide = document.querySelector('.toggle--player');

        if (!audioPlayer || !divToHide) {
            console.error('Audio player or div to hide not found.');
            return;
        }

        function hideDivIfNoAudio() {
            if (!audioPlayer.paused || audioPlayer.currentTime > 0) {
                divToHide.style.display = 'block';
            } else {
                divToHide.style.display = 'none';
            }
        }

        function handleAudioEvents() {
            hideDivIfNoAudio();
        }

        audioPlayer.addEventListener('loadeddata', handleAudioEvents);
        audioPlayer.addEventListener('play', handleAudioEvents);
        audioPlayer.addEventListener('pause', handleAudioEvents);
        audioPlayer.addEventListener('ended', handleAudioEvents);
        audioPlayer.addEventListener('timeupdate', handleAudioEvents);

        // Initial check after DOM loaded
        hideDivIfNoAudio();
    });
</script>
<script>
    $(document).ready(function() {
            $('#search').on('input', function() {
                var query = $(this).val().trim();

                if (query.length === 0) {
                    $('#results').empty();
                    return;
                }
                $.ajax({
                    url: '{{ route('liveSearch') }}',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        var results = $('#results');
                        results.empty();
                        $.each(data, function(index, item) {
                            // Adjust the HTML structure based on your needs
                            var imageUrl =
                                `storage/${item.image ? item.image.replace('public/', '') : ''}`;
                            var resultHtml = `<li class="list-group-item">
                                <img src="${imageUrl}" alt="${item.artist}" style="width: 30px; height: 30px;">
                                <span>${item.artist}</span>
                                <a href="/msingle/${encodeURIComponent(item.slug)}" class="btn buy-button">
                                    ${item.amount == 0 ? 'Download' : 'Buy R' + item.amount}
                                </a>
                            </li>`;

                            results.append(resultHtml);
                        });
                        // Open the modal when results are available
                        // $('#searchModal').modal('show');
                    }
                });
            });
            $('#searchIcon').on('click', function () {
            $('#searchModal').modal('show');
        });
        });
</script>

@endpush

@push('aplayer')
<link rel="stylesheet" href="{{ asset('frontend/css/mediaelementplayer.css') }}">
@endpush
<br>
@section('audio')
<div class="toggle--player">
<audio id="audio-player" preload="none" class="mejs__player" controls
    data-mejsoptions='{"defaultAudioHeight": "50", "alwaysShowControls": "true"}' style="max-width:100%;">
    <source src="" type="audio/mp3">
</audio>
</div>
@endsection

</div>

