<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      ©
      <script>
        document.write(new Date().getFullYear());
      </script>
      
      <a href="" target="_blank" class="footer-link fw-bolder"></a>
    </div>
    <div>
      
    </div>
  </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->



<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="<?php echo e(asset('assets/vendor/libs/popper/popper.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
<script>
let currentPopover;

document.querySelectorAll('.example-popover').forEach(function(element) {
  element.addEventListener('click', function() {
    if (currentPopover) {
      currentPopover.popover('hide');
    }
    var popoverId = element.getAttribute('id');
    var popoverContent = document.querySelector(`#popover-${popoverId}`);

    var popover = new bootstrap.Popover(element, {
      container: 'body',
      html: true,
      content: popoverContent.innerHTML,
    });

    currentPopover = $(element);
    currentPopover.on('hidden.bs.popover', function() {
      currentPopover = null;
    });
  });
});
</script>


<?php echo $__env->yieldPushContent('tinymce'); ?>

<script type="text/javascript" src="<?php echo e(asset('assets/js/script.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendor/js/menu.js')); ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?php echo e(asset('assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>

<!-- Main JS -->
<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

<!-- Page JS -->
<script src="<?php echo e(asset('assets/js/dashboards-analytics.js')); ?>"></script>

<!-- Place this tag in your head or just before your close body tag. -->


<script>
  const toggleButton = document.getElementById('toggle-dark-mode');
  const body = document.body;
  const container = document.querySelector('.content-wrapper');
  const cards = document.querySelectorAll('.card');

  toggleButton.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    container.classList.toggle('dark-mode');
    
    // Loop through each card and apply dark mode to card and card-body
    cards.forEach(card => {
      card.classList.toggle('dark-mode');
      const cardBody = card.querySelector('.card-body');
      if (cardBody) {
        cardBody.classList.toggle('dark-mode');
      }
    });
  });

  // Detect user's preferred color scheme and set the theme accordingly
  const userPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  if (userPrefersDark) {
    body.classList.add('dark-mode');
    container.classList.add('dark-mode');
    
    // Loop through each card and apply dark mode to card and card-body
    cards.forEach(card => {
      card.classList.add('dark-mode');
      const cardBody = card.querySelector('.card-body');
      if (cardBody) {
        cardBody.classList.add('dark-mode');
      }
    });
  }
</script>
<script>
  function runCacheOptimization() {
      document.getElementById('cache-optimization-form').submit();
  }
</script>
</body>
</html>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/admin/components/footer.blade.php ENDPATH**/ ?>