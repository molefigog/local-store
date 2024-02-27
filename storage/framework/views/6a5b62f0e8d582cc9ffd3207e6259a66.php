<?php if($message = Session::get('success')): ?>
    <?php
        $alertType = 'success';
        $title = 'Success!';
    ?>
<?php elseif($message = Session::get('error')): ?>
    <?php
        $alertType = 'error';
        $title = 'Error!';
    ?>
<?php elseif($message = Session::get('warning')): ?>
    <?php
        $alertType = 'warning';
        $title = 'Warning!';
    ?>
<?php elseif($message = Session::get('info')): ?>
    <?php
        $alertType = 'info';
        $title = 'Info!';
    ?>
<?php endif; ?>

<?php if(isset($alertType)): ?>
    <script>
        Swal.fire({
            title: '<?php echo e($title); ?>',
            text: '<?php echo e($message); ?>',
            icon: '<?php echo e($alertType); ?>',
            showProgressSteps: true,
            timer: 36000,
            customClass: {
                popup: 'small-popup',
            },
        });
    </script>
<?php endif; ?>

<?php if($errors->has('login')): ?>
    <script>
        let errorMessage = "<?php echo e($errors->first('login')); ?>";
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: errorMessage,
        });
    </script>
<?php endif; ?>

<?php if($errors->has('password')): ?>
    <script>
        let errorMessage = "<?php echo e($errors->first('password')); ?>";
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: errorMessage,
        });
    </script>
<?php endif; ?>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/flash-message.blade.php ENDPATH**/ ?>