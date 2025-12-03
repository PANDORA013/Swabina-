


<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'organization',
    'data' => []
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
    'type' => 'organization',
    'data' => []
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php if($type === 'organization'): ?>
<?php
    // Get company info from database if available
    $companyData = isset($companyInfo) ? $companyInfo : null;
    $alamat = $companyData ? ($companyData->alamat ?? $companyData->address ?? 'Gresik') : 'Gresik';
    $telp = $companyData ? ($companyData->no_telp ?? $companyData->phone ?? '+62-31-3985311') : '+62-31-3985311';
    $email = $companyData ? ($companyData->email ?? 'info@swabinagatra.co.id') : 'info@swabinagatra.co.id';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "PT Swabina Gatra",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('images/logo.png')); ?>",
  "description": "PT Swabina Gatra menyediakan solusi profesional untuk Facility Management, Digital Solution, Training, Tour Organizer, dan AMDK.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?php echo e($alamat); ?>",
    "addressLocality": "Gresik",
    "addressRegion": "Jawa Timur",
    "postalCode": "61122",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "<?php echo e($telp); ?>",
    "contactType": "Customer Service",
    "email": "<?php echo e($email); ?>",
    "areaServed": "ID",
    "availableLanguage": ["Indonesian", "English"]
  },
  "sameAs": [
    "https://www.facebook.com/swabinagatra",
    "https://www.instagram.com/swabinagatra",
    "https://www.linkedin.com/company/swabinagatra",
    "https://twitter.com/swabinagatra"
  ],
  "foundingDate": "1990",
  "numberOfEmployees": {
    "@type": "QuantitativeValue",
    "value": "500"
  },
  "slogan": "Solusi Profesional Terpercaya"
}
</script>
<?php endif; ?>

<?php if($type === 'breadcrumb' && isset($data['items'])): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    <?php $__currentLoopData = $data['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    {
      "@type": "ListItem",
      "position": <?php echo e($index + 1); ?>,
      "name": "<?php echo e($item['name']); ?>",
      "item": "<?php echo e($item['url']); ?>"
    }<?php if(!$loop->last): ?>,<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ]
}
</script>
<?php endif; ?>

<?php if($type === 'article' && isset($data['title'])): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "<?php echo e($data['title']); ?>",
  "description": "<?php echo e($data['description'] ?? ''); ?>",
  "image": "<?php echo e($data['image'] ?? asset('images/default-article.jpg')); ?>",
  "datePublished": "<?php echo e($data['published_at'] ?? now()->toIso8601String()); ?>",
  "dateModified": "<?php echo e($data['updated_at'] ?? now()->toIso8601String()); ?>",
  "author": {
    "@type": "Organization",
    "name": "PT Swabina Gatra"
  },
  "publisher": {
    "@type": "Organization",
    "name": "PT Swabina Gatra",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo e(asset('images/logo.png')); ?>"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo e(url()->current()); ?>"
  }
}
</script>
<?php endif; ?>

<?php if($type === 'service' && isset($data['name'])): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "<?php echo e($data['name']); ?>",
  "description": "<?php echo e($data['description'] ?? ''); ?>",
  "provider": {
    "@type": "Organization",
    "name": "PT Swabina Gatra",
    "url": "<?php echo e(url('/')); ?>"
  },
  "areaServed": {
    "@type": "Country",
    "name": "Indonesia"
  },
  "serviceType": "<?php echo e($data['type'] ?? 'Business Service'); ?>",
  "image": "<?php echo e($data['image'] ?? asset('images/default-service.jpg')); ?>"
}
</script>
<?php endif; ?>

<?php if($type === 'faq' && isset($data['items'])): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php $__currentLoopData = $data['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    {
      "@type": "Question",
      "name": "<?php echo e($item['question']); ?>",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "<?php echo e($item['answer']); ?>"
      }
    }<?php if(!$loop->last): ?>,<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ]
}
</script>
<?php endif; ?>

<?php if($type === 'website'): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "PT Swabina Gatra",
  "url": "<?php echo e(url('/')); ?>",
  "description": "PT Swabina Gatra menyediakan solusi profesional untuk Facility Management, Digital Solution, Training, Tour Organizer, dan AMDK.",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "<?php echo e(url('/search')); ?>?q={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\project_magang\resources\views/components/structured-data.blade.php ENDPATH**/ ?>