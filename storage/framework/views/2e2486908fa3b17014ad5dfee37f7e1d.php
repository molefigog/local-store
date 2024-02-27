<?php echo $__env->make('admin.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Layout wrapper -->  
<div class="progress ajax-progress-bar">
                <div class="progress-bar"></div>
            </div>
    <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php echo $__env->make('flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->


            <?php echo $__env->make('admin.components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- / Navbar -->
          
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <?php echo $__env->yieldContent('content'); ?>
                <!-- / Content -->

                <!-- Footer -->
<?php echo $__env->make('admin.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/admin/master.blade.php ENDPATH**/ ?>