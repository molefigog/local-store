    <?php
           $genres = App\Models\Genre::withCount('music')
            ->latest()
            ->paginate(10) // You might want to adjust the pagination as needed
            ->withQueryString();
    ?>

    <div class="owl-carousel owl-theme">
        <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item">
            <img style="height: 300px; width:300px;" src="<?php echo e(asset("storage/$genre->image")); ?>"
                alt="<?php echo e($genre->title); ?>">
            <div class="carousel-caption">
                <h5>
                    <a class="btn btn-primary w-100" href="<?php echo e(route('songs-by-genre', urlencode($genre->title))); ?>"><?php echo e($genre->title ?? '-'); ?></a>
                </h5>
                <h3 >=>
                    <span class="btn btn-success btn-sm btn-outline"><?php echo e($genre->music_count ?? 0); ?> Songs</span>
                    <=
                </h3>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/slider.blade.php ENDPATH**/ ?>