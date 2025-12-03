


<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'PT Swabina Gatra - Solusi Profesional Terpercaya',
    'description' => 'PT Swabina Gatra menyediakan solusi profesional untuk Facility Management, Digital Solution, SWA Academy, SWA Tour, dan Swasegar AMDK.',
    'keywords' => ['Swabina Gatra', 'Facility Management', 'Digital Solution', 'Training', 'AMDK', 'Tour Organizer'],
    'image' => null,
    'url' => null,
    'type' => 'website',
    'author' => 'PT Swabina Gatra',
    'canonical' => null
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
    'title' => 'PT Swabina Gatra - Solusi Profesional Terpercaya',
    'description' => 'PT Swabina Gatra menyediakan solusi profesional untuk Facility Management, Digital Solution, SWA Academy, SWA Tour, dan Swasegar AMDK.',
    'keywords' => ['Swabina Gatra', 'Facility Management', 'Digital Solution', 'Training', 'AMDK', 'Tour Organizer'],
    'image' => null,
    'url' => null,
    'type' => 'website',
    'author' => 'PT Swabina Gatra',
    'canonical' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $fullTitle = $title . ' | PT Swabina Gatra';
    $currentUrl = $url ?? url()->current();
    $ogImage = $image ?? asset('images/og-default.jpg');
    $keywordsString = is_array($keywords) ? implode(', ', $keywords) : $keywords;
    $canonicalUrl = $canonical ?? $currentUrl;
?>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">


<title><?php echo e($fullTitle); ?></title>
<meta name="description" content="<?php echo e($description); ?>">
<meta name="keywords" content="<?php echo e($keywordsString); ?>">
<meta name="author" content="<?php echo e($author); ?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="<?php echo e($canonicalUrl); ?>">


<meta property="og:locale" content="<?php echo e(app()->getLocale() === 'en' ? 'en_US' : 'id_ID'); ?>">
<meta property="og:type" content="<?php echo e($type); ?>">
<meta property="og:title" content="<?php echo e($title); ?>">
<meta property="og:description" content="<?php echo e($description); ?>">
<meta property="og:url" content="<?php echo e($currentUrl); ?>">
<meta property="og:site_name" content="PT Swabina Gatra">
<meta property="og:image" content="<?php echo e($ogImage); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo e($title); ?>">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($title); ?>">
<meta name="twitter:description" content="<?php echo e($description); ?>">
<meta name="twitter:image" content="<?php echo e($ogImage); ?>">
<meta name="twitter:image:alt" content="<?php echo e($title); ?>">


<meta name="theme-color" content="#0056b3">
<meta name="msapplication-TileColor" content="#0056b3">


<link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('images/apple-touch-icon.png')); ?>">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">


<?php if(isset($alternateLanguages)): ?>
    <?php $__currentLoopData = $alternateLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $langUrl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <link rel="alternate" hreflang="<?php echo e($lang); ?>" href="<?php echo e($langUrl); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<link rel="alternate" hreflang="x-default" href="<?php echo e(url('/')); ?>">
<?php /**PATH C:\xampp\htdocs\project_magang\resources\views/components/seo-meta.blade.php ENDPATH**/ ?>