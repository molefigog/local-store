<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <?php if($about): ?>
                <?php echo $about->detail; ?>

            <?php else: ?>
                <p>No about About found.</p>
            <?php endif; ?>
        </div>
    </div>





    <div class="map-responsive">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3484.9238275474254!2d27.74945607455037!3d-29.137437089810287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjnCsDA4JzE0LjgiUyAyN8KwNDUnMDcuMyJF!5e0!3m2!1sen!2sls!4v1706100668232!5m2!1sen!2sls"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/about.blade.php ENDPATH**/ ?>