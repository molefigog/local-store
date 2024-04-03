<?php $__env->startSection('content'); ?>

<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('music');

$__html = app('livewire')->mount($__name, $__params, 'lw-1502944268-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
<title><?php echo e($metaTags['title']); ?></title>
<meta name="description" content="<?php echo e($metaTags['description']); ?>">
<meta property="og:title" content="<?php echo e($metaTags['title']); ?>">
<meta property="og:image" content="<?php echo e($metaTags['image']); ?>">
<meta property="og:description" content="<?php echo e($metaTags['description']); ?>">
<meta property="og:url" content="<?php echo e($metaTags['url']); ?>" />
<meta name="keywords" content="<?php echo e($metaTags['keywords']); ?>">
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo e($metaTags['title']); ?>" />
<meta name="twitter:description" content="<?php echo e($metaTags['description']); ?>" />
<meta name="twitter:image" content="<?php echo e($metaTags['image']); ?>" />
<meta property="fb:app_id" content="337031642040584" />
<?php $__env->stopSection(); ?>

<?php $__env->startPush('ghead'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('gbody'); ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MT3JSPQW" height="0" width="0"
        style="display:none;visibility:hidden">
    </iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php $__env->stopPush(); ?>

<?php $__env->startPush('player'); ?>
<script src="<?php echo e(asset('frontend/js/mediaelement-and-player.js')); ?>"></script>

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
                    url: '<?php echo e(route('liveSearch')); ?>',
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

<?php $__env->stopPush(); ?>

<?php $__env->startPush('aplayer'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/mediaelementplayer.css')); ?>">
<?php $__env->stopPush(); ?>
<br>
<?php $__env->startSection('audio'); ?>
<div class="toggle--player">
<audio id="audio-player" preload="none" class="mejs__player" controls
    data-mejsoptions='{"defaultAudioHeight": "50", "alwaysShowControls": "true"}' style="max-width:100%;">
    <source src="" type="audio/mp3">
</audio>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/music.blade.php ENDPATH**/ ?>