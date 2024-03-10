<?php $editing = isset($genre) ?>

<div class="row">
    <?php if (isset($component)) { $__componentOriginalcd518abb053461cdf447c22dc90a5514 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd518abb053461cdf447c22dc90a5514 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.group','data' => ['class' => 'col-sm-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-sm-6']); ?>
        <?php if (isset($component)) { $__componentOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.text','data' => ['name' => 'title','label' => 'Title','value' => old('title', ($editing ? $genre->title : '')),'maxlength' => '255','placeholder' => 'Title','required' => !$editing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'title','label' => 'Title','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('title', ($editing ? $genre->title : ''))),'maxlength' => '255','placeholder' => 'Title','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(!$editing)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47)): ?>
<?php $attributes = $__attributesOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47; ?>
<?php unset($__attributesOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47)): ?>
<?php $component = $__componentOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47; ?>
<?php unset($__componentOriginalb2bc0c9fd3d831bfef9cc03a1d4ebe47); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd518abb053461cdf447c22dc90a5514)): ?>
<?php $attributes = $__attributesOriginalcd518abb053461cdf447c22dc90a5514; ?>
<?php unset($__attributesOriginalcd518abb053461cdf447c22dc90a5514); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd518abb053461cdf447c22dc90a5514)): ?>
<?php $component = $__componentOriginalcd518abb053461cdf447c22dc90a5514; ?>
<?php unset($__componentOriginalcd518abb053461cdf447c22dc90a5514); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalcd518abb053461cdf447c22dc90a5514 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd518abb053461cdf447c22dc90a5514 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.group','data' => ['class' => 'col-sm-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-sm-6']); ?>
        <div
            x-data="imageViewer('<?php echo e($editing && $genre->image ? \Storage::url($genre->image) : ''); ?>')"
        >
            <?php if (isset($component)) { $__componentOriginal5067e5c8c802875d7df4971082ac1d85 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5067e5c8c802875d7df4971082ac1d85 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.partials.label','data' => ['name' => 'image','label' => 'Image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.partials.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','label' => 'Image']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5067e5c8c802875d7df4971082ac1d85)): ?>
<?php $attributes = $__attributesOriginal5067e5c8c802875d7df4971082ac1d85; ?>
<?php unset($__attributesOriginal5067e5c8c802875d7df4971082ac1d85); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5067e5c8c802875d7df4971082ac1d85)): ?>
<?php $component = $__componentOriginal5067e5c8c802875d7df4971082ac1d85; ?>
<?php unset($__componentOriginal5067e5c8c802875d7df4971082ac1d85); ?>
<?php endif; ?><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo $__env->make('components.inputs.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd518abb053461cdf447c22dc90a5514)): ?>
<?php $attributes = $__attributesOriginalcd518abb053461cdf447c22dc90a5514; ?>
<?php unset($__attributesOriginalcd518abb053461cdf447c22dc90a5514); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd518abb053461cdf447c22dc90a5514)): ?>
<?php $component = $__componentOriginalcd518abb053461cdf447c22dc90a5514; ?>
<?php unset($__componentOriginalcd518abb053461cdf447c22dc90a5514); ?>
<?php endif; ?>
</div>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/genres/form-inputs.blade.php ENDPATH**/ ?>