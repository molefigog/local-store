<?php $__env->startSection('content'); ?>
    <h1 class="mt-4 mb-3 text-center">Genre</h1>
    <div class="row row-cols-md-3 row-cols-sm-2">
        <?php $__empty_1 = true; $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col mb-4">
                <div class="card">

                    <div class="card-img-wrapper">
                        <img src="<?php echo e($genre->image ? \Storage::url($genre->image) : ''); ?>" style="height: 96px; width:96px;"
                            class="card-img-top" alt="<?php echo e($genre->title); ?>" class="genre-image">
                    </div>

                    <div class="ribbon-2"><?php echo e($genre->music_count ?? 0); ?> Songs</div>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 12px; font-weight: 600;">
                            <span style="padding: 0px 10px;">
                                <?php echo e($genre->title ?? '-'); ?></span>
                        </h5>
                        <div class="card-text text-center">
                            <a class="btn buy-button"
                                href="<?php echo e(route('songs-by-genre', urlencode($genre->title))); ?>">View</a>
                        </div>
                        <div class="card-hide">
                            <p class="text-dark card-text" style="font-size: 12px; font-weight: 600;">
                                <?php echo e($genre->music_count ?? 0); ?> Songs</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            ..
        <?php endif; ?>
    </div>
    <div class="text-center"><?php echo e($music->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
    <title><?php echo e($metaTags['title']); ?></title>
    <meta name="description" content="<?php echo e($metaTags['description']); ?>">
    <meta property="og:title" content="<?php echo e($metaTags['title']); ?>">
    <meta property="og:image" content="<?php echo e($metaTags['image']); ?>">
    <meta property="og:description" content="<?php echo e($metaTags['description']); ?>">
    <!-- Additional meta tags as needed -->
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/songs.blade.php ENDPATH**/ ?>