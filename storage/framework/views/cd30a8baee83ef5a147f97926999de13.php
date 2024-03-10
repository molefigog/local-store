<?php
    $totalMusic = 0;
    if ($user) {
        $totalMusic = App\Models\Items::where('user_id', $user->id)->count();
    }

    $totalBeats = 0;
    if ($user) {
        $totalBeats = App\Models\Beatz::where('user_id', $user->id)->count();
    }

    $user = Auth::user();

    // Retrieve purchased beats
    $purchasedbeats = $user
        ->purchasedBeat()
        ->orderByDesc('created_at')
        ->paginate(10);
?>



<?php $__env->startSection('content'); ?>
    <style>
        #text {
            font-weight: bold;
            font-size: 12px;
            animation-name: blink;
            animation-duration: 3s;
            animation-iteration-count: infinite;
        }

        @keyframes blink {
            0% {
                color: pink
            }

            50% {
                color: black;
            }

            100% {
                color: pink;
            }
        }
    </style>
    <div class="justify-content-center">

        
        <p class="text-center" id="text">download links will expire in 10days!!</p>
    </div>
    <nav class="text-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab"
                aria-controls="nav-home" aria-selected="true">Music</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab"
                aria-controls="nav-profile" aria-selected="false">Beats</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

            <div class="justify-content-center">
                <h5 class="text-center"><span><?php echo e(Auth::user()->name); ?></span> you have <?php echo e($totalMusic); ?> Music links
                </h5>
            </div>
            <div class="articles">

                <?php $__empty_1 = true; $__currentLoopData = $purchasedMusics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $music): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="article-card">
                        <div class="cover">
                            <img src="<?php echo e($music->image ? \Storage::url($music->image) : ''); ?>" alt="Article 1 Cover Image">
                            <div class="overlay">
                                <a href="#" class="play-button track-list"
                                    data-track="<?php echo e(\Storage::url($music->demo)); ?>"
                                    data-poster="<?php echo e($music->image ? \Storage::url($music->image) : ''); ?>"
                                    data-title="<?php echo e($music->title ?? '-'); ?>" data-singer="<?php echo e($music->artist ?? '-'); ?>">
                                    <i class="icon-play"></i>
                                </a>
                            </div>
                        </div>

                        <div class="details">
                            <h6 class="artist"><?php echo e($music->artist ?? '-'); ?></h6>
                            <p class="card-text" id="product1Description">
                                <?php echo e($music->title ?? '-'); ?>

                            </p>

                            <a href="<?php echo e(route('download-music', ['music_id' => $music->id])); ?>" class="btn buy-button">
                                <i class="icon-cloud-download"></i> DOWNLOAD
                            </a>

                        </div>

                        <div class="details-left">

                            <p class="texts"><?php echo e($music->size ?? '-'); ?>&nbsp;MB</p>
                            <p class="texts"><i class="icon-clock-o"></i>&nbsp;<?php echo e($music->duration); ?></p>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center">No Downloads Found</p>
                <?php endif; ?>

            </div>
            <div class="pagination"><?php echo e($purchasedMusics->links('custom-pagination')); ?></div>


        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="justify-content-center">
                <h5 class="text-center"><span><?php echo e(Auth::user()->name); ?></span> you have <?php echo e($totalBeats); ?> Beats links
                </h5>
            </div>
            <div class="articles">

                <?php if(count($purchasedbeats) > 0): ?>
                    <?php $__currentLoopData = $purchasedbeats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $beat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="article-card">
                            <div class="cover">
                                <img src="<?php echo e($beat->image ? \Storage::url($beat->image) : ''); ?>" alt="Beat Cover Image">
                                <div class="overlay">
                                    <a href="#" class="play-button track-list"
                                        data-track="<?php echo e(\Storage::url($beat->demo)); ?>"
                                        data-poster="<?php echo e($beat->image ? \Storage::url($beat->image) : ''); ?>"
                                        data-title="<?php echo e($beat->title ?? '-'); ?>" data-singer="<?php echo e($beat->artist ?? '-'); ?>">
                                        <i class="icon-play"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="details">
                                <h6 class="artist"><?php echo e($beat->artist ?? '-'); ?></h6>
                                <p class="card-text" id="product1Description">
                                    <?php echo e($beat->title ?? '-'); ?>

                                </p>

                                <a href="<?php echo e(route('download-beat', ['beat_id' => $beat->id])); ?>" class="btn buy-button">
                                    <i class="icon-cloud-download"></i> DOWNLOAD
                                </a>

                            </div>

                            <div class="details-left">
                                <p class="texts"><?php echo e($beat->size ?? '-'); ?> MB</p>
                                <p class="texts"><i class="icon-clock-o"></i>&nbsp;<?php echo e($beat->duration); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-center">No Downloads Found</p>
                <?php endif; ?>

                <div class="pagination"><?php echo e($purchasedbeats->links('custom-pagination')); ?></div>
            </div>
        </div>

    </div>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('aplayer'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/mediaelementplayer.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('audio'); ?>
    <audio id="audio-player" preload="none" class="mejs__player" controls
        data-mejsoptions='{"defaultAudioHeight": "50", "alwaysShowControls": "true"}' style="max-width:100%;">
        <source src="" type="audio/mp3">
    </audio>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/purchased-musics.blade.php ENDPATH**/ ?>