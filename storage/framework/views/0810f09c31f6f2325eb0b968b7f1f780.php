<?php echo $__env->make('front.components.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.components.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---Recently Played Music--->

<!---Weekly Top 15--->

<div class="container-xxl">

    <?php echo $__env->yieldContent('content'); ?>
</div>


<hr>
</div>
</div>
</div>
<!----Footer Start---->
<?php echo $__env->make('front.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<!----Language Selection Modal---->


<!--Main js file Style-->
<?php echo $__env->make('front.components.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/layouts/app.blade.php ENDPATH**/ ?>