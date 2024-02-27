<?php $__env->startSection('content'); ?>
    <div class="container">

        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-6 text-right">

                    <a href="<?php echo e(route('all-music.create')); ?>" class="btn rounded-pill btn-outline-primary"
                        title="add new song">
                        <i class=" icon-plus"></i> Create
                    </a>

                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">All music</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th>ARTIST</th>
                            <th>TITLE</th>
                            <th>PRICE</th>
                            <th>COVER</th>
                            
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $__empty_1 = true; $__currentLoopData = Auth::user()->role == 1 ? $allMusic : $userMusic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $music): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($music->artist ?? '-'); ?></td>
                                <td><?php echo e($music->title ?? '-'); ?></td>
                                <td><?php echo e($music->amount ?? '-'); ?></td>

                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="" title=""
                                            data-bs-original-title="Lilian Fuller">
                                            <img src="<?php echo e($music->image ? \Storage::url($music->image) : ''); ?>"
                                                alt="Avatar" class="" style="width:40px; height:40;">
                                        </li>
                                    </ul>
                                </td> 
                               

                                <td >
                                   
                                            <a class="" href="<?php echo e(route('all-music.edit', $music)); ?>">
                                                <button type="button" class="btn rounded-pill btn-icon btn-sm btn-outline-secondary">
                                                    <i class="icon-edit"></i>
                                                </button>
                                            </a>

                                            

                                            <form class="" action="<?php echo e(route('all-music.destroy', $music)); ?>"
                                                method="POST" onsubmit="return confirm('<?php echo e(__('are_you_sure')); ?>')">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn rounded-pill btn-icon btn-sm btn-outline-secondary text-danger">
                                                    <i class=" icon-trash-empty"></i>
                                                </button>
                                            </form>
                                        
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9">
                                    <?php echo app('translator')->get('no_items_found'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination">
            <?php if(Auth::user()->role == 1): ?>
                <?php echo e($allMusic->links('custom-pagination')); ?>

            <?php else: ?>
                <?php echo e($userMusic->links('custom-pagination')); ?>

            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/all_music/index.blade.php ENDPATH**/ ?>