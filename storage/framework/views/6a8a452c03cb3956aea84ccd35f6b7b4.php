<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
    <div class="card">
        
        <?php if($status): ?>
        
    
        <h5 class="card-header text-success text-center">Payment is Success</h5>
        <div class="card-body">
            <h4></h4>
            <h5 class="card-title text-center">Payment Information</h5>
            <p class="card-text"><b>Reference Number:</b> <?php echo e($status); ?></p>
        
      <?php endif; ?>

      <?php if($message): ?>
        
    
        <h5 class="card-header text-success text-center">Payment is Success</h5>
        <div class="card-body">
            <h4></h4>
            <h5 class="card-title text-center">Payment Information</h5>
            <p class="card-text"><b>Reference Number:</b> <?php echo e($message); ?></p>
        
      <?php endif; ?>

      <a href="<?php echo e(url('purchased-musics')); ?>" class="btn buy-button">Downloads</a>
    </div>
    
  </div>
</div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/mpesa/success.blade.php ENDPATH**/ ?>