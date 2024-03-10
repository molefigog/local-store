<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'name',
    'label',
    'value',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'name',
    'label',
    'value',
]); ?>
<?php foreach (array_filter(([
    'name',
    'label',
    'value',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if (isset($component)) { $__componentOriginal8e06585108a8c5ef2dc1b85196ed9052 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8e06585108a8c5ef2dc1b85196ed9052 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.inputs.basic','data' => ['type' => 'text','name' => $name,'label' => ''.e($label ?? '').'','value' => $value ?? '','attributes' => $attributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('inputs.basic'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'label' => ''.e($label ?? '').'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value ?? ''),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8e06585108a8c5ef2dc1b85196ed9052)): ?>
<?php $attributes = $__attributesOriginal8e06585108a8c5ef2dc1b85196ed9052; ?>
<?php unset($__attributesOriginal8e06585108a8c5ef2dc1b85196ed9052); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e06585108a8c5ef2dc1b85196ed9052)): ?>
<?php $component = $__componentOriginal8e06585108a8c5ef2dc1b85196ed9052; ?>
<?php unset($__componentOriginal8e06585108a8c5ef2dc1b85196ed9052); ?>
<?php endif; ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/components/inputs/text.blade.php ENDPATH**/ ?>