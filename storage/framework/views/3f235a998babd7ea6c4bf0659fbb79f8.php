<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'src',
    'size' => 50,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'src',
    'size' => 50,
]); ?>
<?php foreach (array_filter(([
    'src',
    'size' => 50,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if($src): ?>
<img src="<?php echo e($src); ?>" class="border rounded" style="width: <?php echo e($size); ?>px; height: <?php echo e($size); ?>px; object-fit: cover;">
<?php else: ?>
<div class="border rounded bg-light" style="width: <?php echo e($size); ?>px; height: <?php echo e($size); ?>px;"></div>
<?php endif; ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/components/partials/thumbnail.blade.php ENDPATH**/ ?>