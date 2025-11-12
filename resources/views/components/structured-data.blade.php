{{-- Structured Data (JSON-LD) Component --}}
{{-- Usage: <x-structured-data type="organization" /> or <x-structured-data type="article" :data="$article" /> --}}

@props([
    'type' => 'organization',
    'data' => []
])

@if($type === 'organization')
@php
    // Get company info from database if available
    $companyData = isset($companyInfo) ? $companyInfo : null;
    $alamat = $companyData ? ($companyData->alamat ?? $companyData->address ?? 'Gresik') : 'Gresik';
    $telp = $companyData ? ($companyData->no_telp ?? $companyData->phone ?? '+62-31-3985311') : '+62-31-3985311';
    $email = $companyData ? ($companyData->email ?? 'info@swabinagatra.co.id') : 'info@swabinagatra.co.id';
@endphp
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "PT Swabina Gatra",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/logo.png') }}",
  "description": "PT Swabina Gatra menyediakan solusi profesional untuk Facility Management, Digital Solution, Training, Tour Organizer, dan AMDK.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ $alamat }}",
    "addressLocality": "Gresik",
    "addressRegion": "Jawa Timur",
    "postalCode": "61122",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "{{ $telp }}",
    "contactType": "Customer Service",
    "email": "{{ $email }}",
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
@endif

@if($type === 'breadcrumb' && isset($data['items']))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    @foreach($data['items'] as $index => $item)
    {
      "@type": "ListItem",
      "position": {{ $index + 1 }},
      "name": "{{ $item['name'] }}",
      "item": "{{ $item['url'] }}"
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endif

@if($type === 'article' && isset($data['title']))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $data['title'] }}",
  "description": "{{ $data['description'] ?? '' }}",
  "image": "{{ $data['image'] ?? asset('images/default-article.jpg') }}",
  "datePublished": "{{ $data['published_at'] ?? now()->toIso8601String() }}",
  "dateModified": "{{ $data['updated_at'] ?? now()->toIso8601String() }}",
  "author": {
    "@type": "Organization",
    "name": "PT Swabina Gatra"
  },
  "publisher": {
    "@type": "Organization",
    "name": "PT Swabina Gatra",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  }
}
</script>
@endif

@if($type === 'service' && isset($data['name']))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "{{ $data['name'] }}",
  "description": "{{ $data['description'] ?? '' }}",
  "provider": {
    "@type": "Organization",
    "name": "PT Swabina Gatra",
    "url": "{{ url('/') }}"
  },
  "areaServed": {
    "@type": "Country",
    "name": "Indonesia"
  },
  "serviceType": "{{ $data['type'] ?? 'Business Service' }}",
  "image": "{{ $data['image'] ?? asset('images/default-service.jpg') }}"
}
</script>
@endif

@if($type === 'faq' && isset($data['items']))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($data['items'] as $item)
    {
      "@type": "Question",
      "name": "{{ $item['question'] }}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{ $item['answer'] }}"
      }
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endif

@if($type === 'website')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "PT Swabina Gatra",
  "url": "{{ url('/') }}",
  "description": "PT Swabina Gatra menyediakan solusi profesional untuk Facility Management, Digital Solution, Training, Tour Organizer, dan AMDK.",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "{{ url('/search') }}?q={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>
@endif
