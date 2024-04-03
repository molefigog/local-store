<?php echo $__env->make('front.components.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.components.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="container">
    <?php echo $__env->make('slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <hr>
    <?php echo $__env->yieldContent('content'); ?>

    <br>


<div class="card">
            <h5 class="card-header text-center">Most Downloaded Songs</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th>Art</th>
                            <th>Title</th>
                            <th>Artist</th>
                            <th><i class="icon-download"></i></th>
                            
                            <th>Buy</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $__currentLoopData = $downloads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                            <tr>
                                <td><img src="<?php echo e($song->image ? \Storage::url($song->image) : ''); ?>"
                                    alt="Avatar" width="40" height="40"></td>
                                <td style="font-size: 10px"><?php echo e($song->title ?? '-'); ?></td>
                                <td style="font-size: 10px"><?php echo e($song->artist ?? '-'); ?></td>
                                <td style="font-size: 10px"><?php echo e($song->downloads ?? '-'); ?></td>
                                <td>

                                    <a href="<?php echo e(route('msingle.slug', ['slug' => urlencode($song->slug)])); ?>"
                                        class="btn buy-button btn-sm">Buy R<?php echo e($song->amount ?? '-'); ?></a>

                                </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>



    <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php echo $__env->make('front.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<!--Main js file Style-->
<?php echo $__env->make('front.components.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const songElements = document.querySelectorAll(".ms_weekly_box");

        songElements.forEach(song => {
            song.addEventListener("click", function() {
                const title = this.getAttribute("data-title");
                const artist = this.getAttribute("data-artist");
                const image = this.getAttribute("data-image");
                const url = this.getAttribute("data-url");

                updateOGMetaTags(title, artist, image, url);
            });
        });

        function updateOGMetaTags(title, artist, image, url) {
            document.querySelector('meta[property="og:title"]').setAttribute("content", title);
            document.querySelector('meta[property="og:description"]').setAttribute("content", artist);
            document.querySelector('meta[property="og:image"]').setAttribute("content", image);
            document.querySelector('meta[property="og:url"]').setAttribute("content", url);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    var artistName = document.getElementById('artistName');
    if (artistName.textContent.length === 16) {
        artistName.classList.add('long-artist');
    }
});
</script>
</body>

</html>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/welcome.blade.php ENDPATH**/ ?>