<?php $__env->startSection('content'); ?>
<div class="container">
    <br>
    <div class="search-container"><?php echo $__env->make('flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
    
    <div class="card">
            <h5 class="card-header text-center">user list</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th>Name</th>
                <th>number</th>
                <th>Balance</th>
                <th>Credits</th>
                <th>Delete</th>
                
            </tr>
        </thead>
        <tbody  class="table-border-bottom-0">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->mobile_number); ?></td>
                    <td><?php echo e($user->balance); ?></td>
                    <?php if(Auth::user()->role == 1): ?>
                    <td>
                        <form action="<?php echo e(route('creditup', ['id' => $user->id])); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                     <div class="input-group">
                        <input type="number" name="amount"  class="form-control" style="width: 40px;" placeholder="amount" aria-label="amount" aria-describedby="button-addon2"step="0.01" required>
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                        </form>

                    </td>
                    <td>
                        <form action="<?php echo e(route('users.delete', ['id' => $user->id])); ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Delete User</button>
                        </form>
                        
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/users/index.blade.php ENDPATH**/ ?>