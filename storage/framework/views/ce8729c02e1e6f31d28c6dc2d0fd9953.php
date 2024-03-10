 
<?php $__env->startSection('content'); ?>
<div class="container">
<br>
    <div class="searchbar mt-0 mb-4">
        <div class="row">

            <div class="col-md-6 text-center">

                <a class="btn btn-primary btn-sm" href="<?php echo e(route('products.create')); ?>"><i class=" icon-plus"></i>  Create New Page</a>
            </div>
        </div>
    </div>
                
     
   
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <div class="card">
        <h5 class="card-header">All Pages</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-sm table-dark">
                <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(++$i); ?></td>
            <td><?php echo e($product->name); ?></td>
            <td><?php echo e($product->detail); ?></td>
            <td>
                <form action="<?php echo e(route('products.destroy',$product->id)); ?>" method="POST">
   
                    <a class="btn btn-info" href="<?php echo e(route('products.show',$product->id)); ?>">Show</a>
    
                    <a class="btn btn-primary" href="<?php echo e(route('products.edit',$product->id)); ?>">Edit</a>
   
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
</div>
</div>
    <?php echo $products->links(); ?>

</div>
</div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/products/index.blade.php ENDPATH**/ ?>