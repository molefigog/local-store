<?php echo $__env->yieldContent('audio'); ?>
<?php
$artists = App\Models\User::orderBy('name')->get();
?>


<footer class="footer-07">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h2 class="footer-heading"><a href="/" class="logo">GW ENT</a></h2>

        <p class="">Select Songs By Artist</p>
        <ul class="nav">
          <?php $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="nav-item">
            <a class="nav-link text-secondary" href="<?php echo e(route('songs-by-artist', rawurlencode($artist->name))); ?>">
              <?php echo e($artist->name); ?>

            </a>
          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <ul class="nav justify-content-center">
          <li class="social"><a href="https://www.facebook.co.za/elliot.gog" target="_blank" class="nav-link"><span class="icon-facebook"></span></a></li>
          <li class="social"><a href="https://twitter.com/Molefi18186414" target="_blank" class="nav-link"><span class="icon-twitter"></span></a></li>
          <li class="social"><a href="mailto:molefigw@gmail.com" target="_blank" class="nav-link"><span class="icon-mail_outline"></span></a></li>
      </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-12 text-center">
        <p class="copyright">
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | GENIUS WORKS ENT <i class="ion-ios-heart" aria-hidden="true"></i> by <a
            href="mailto:molefigw@gmail.com" target="_blank">Elliot Molefi</a>
        </p>
      </div>
    </div>
  </div>
</footer><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/front/components/footer.blade.php ENDPATH**/ ?>