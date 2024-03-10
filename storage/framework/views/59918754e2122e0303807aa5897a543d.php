<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="<?php echo e(__('search')); ?>"
                            value="<?php echo e($search ?? ''); ?>"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
               
                <a href="<?php echo e(route('genres.create')); ?>" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> <?php echo app('translator')->get('create'); ?>
                </a>
                
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title"><?php echo app('translator')->get('genres.index_title'); ?></h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                <?php echo app('translator')->get('genres.inputs.title'); ?>
                            </th>
                            <th class="text-left">
                                <?php echo app('translator')->get('genres.inputs.image'); ?>
                            </th>
                            <th class="text-center">
                                <?php echo app('translator')->get('actions'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($genre->title ?? '-'); ?></td>
                            <td>
                                <?php if (isset($component)) { $__componentOriginal5a3562fd61ac92a1149130b197ffcafd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a3562fd61ac92a1149130b197ffcafd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.partials.thumbnail','data' => ['src' => ''.e($genre->image ? \Storage::url($genre->image) : '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('partials.thumbnail'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => ''.e($genre->image ? \Storage::url($genre->image) : '').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a3562fd61ac92a1149130b197ffcafd)): ?>
<?php $attributes = $__attributesOriginal5a3562fd61ac92a1149130b197ffcafd; ?>
<?php unset($__attributesOriginal5a3562fd61ac92a1149130b197ffcafd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a3562fd61ac92a1149130b197ffcafd)): ?>
<?php $component = $__componentOriginal5a3562fd61ac92a1149130b197ffcafd; ?>
<?php unset($__componentOriginal5a3562fd61ac92a1149130b197ffcafd); ?>
<?php endif; ?>
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    
                                    <a
                                        href="<?php echo e(route('genres.edit', $genre)); ?>"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                        <i class="icon-edit"></i>
                                        </button>
                                    </a>
                                   
                                    <a
                                        href="<?php echo e(route('genres.show', $genre)); ?>"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >  
                                        <i class="icon-eye"></i>
                                        </button>
                                    </a>
                                   
                                    <form
                                        action="<?php echo e(route('genres.destroy', $genre)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('<?php echo e(__('are_you_sure')); ?>')"
                                    >
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >     
                                        <i class=" icon-trash-empty"></i>
                                        </button>
                                    </form>
                                  
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3">
                                <?php echo app('translator')->get('no_items_found'); ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"> <?php echo e($genres->links('custom-pagination')); ?></td>
                           
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/genres/index.blade.php ENDPATH**/ ?>