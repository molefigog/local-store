<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'method' => 'POST',
    'action',
    'hasFiles' => false,
    'model'
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'method' => 'POST',
    'action',
    'hasFiles' => false,
    'model'
]); ?>
<?php foreach (array_filter(([
    'method' => 'POST',
    'action',
    'hasFiles' => false,
    'model'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $method = strtoupper($method);
?>

<form method="<?php echo e($method !== 'GET' ? 'POST' : $method); ?>" action="<?php echo e($action); ?>" <?php echo $hasFiles ? 'enctype="multipart/form-data"' : ''; ?> <?php echo e($attributes); ?>>
    <?php echo csrf_field(); ?>
    <?php if(!in_array($method, ['POST', 'GET'])): ?>
        <?php echo method_field($method); ?>
    <?php endif; ?>
    <?php echo e($slot); ?>

</form><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/components/form.blade.php ENDPATH**/ ?>