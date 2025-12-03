<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'src' => '',
    'alt' => '',
    'title' => null,
    'loading' => 'lazy',
    'class' => '',
    'style' => '',
    'width' => null,
    'height' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'src' => '',
    'alt' => '',
    'title' => null,
    'loading' => 'lazy',
    'class' => '',
    'style' => '',
    'width' => null,
    'height' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    // Extract path and filename without extension
    $pathInfo = pathinfo($src);
    $webpSrc = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
?>

<picture>
    <source srcset="<?php echo e(asset($webpSrc)); ?>" type="image/webp">
    <img src="<?php echo e(asset($src)); ?>" 
         alt="<?php echo e($alt); ?>"
         <?php if($title): ?> title="<?php echo e($title); ?>" <?php endif; ?>
         <?php if($loading): ?> loading="<?php echo e($loading); ?>" <?php endif; ?>
         <?php if($class): ?> class="<?php echo e($class); ?>" <?php endif; ?>
         <?php if($style): ?> style="<?php echo e($style); ?>" <?php endif; ?>
         <?php if($width): ?> width="<?php echo e($width); ?>" <?php endif; ?>
         <?php if($height): ?> height="<?php echo e($height); ?>" <?php endif; ?>>
</picture>
<?php /**PATH C:\xampp\htdocs\project_magang\resources\views/components/webp-image.blade.php ENDPATH**/ ?>