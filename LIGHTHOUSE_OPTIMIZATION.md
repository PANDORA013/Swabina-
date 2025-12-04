# Lighthouse Optimization Strategy

## Overview
Strategi komprehensif untuk meningkatkan skor Lighthouse PT Swabina Gatra dari default ~50-60 ke target 90-100 pada semua kategori (Performance, Accessibility, Best Practices, SEO).

## Phase 1: Frontend Architecture Cleanup ✅

### 1.1 Separasi Admin vs Public Assets
- **Status**: DONE - Layout terpisah sudah ada
- **File**: `resources/views/layouts/app-professional.blade.php`
- **Verifikasi**: Tidak memuat aset admin (`/admin/`, `sidebarmenu.js`, etc)
- **Checklist**:
  - ✅ Bootstrap hanya di level public
  - ✅ No jQuery di public layout
  - ✅ Service Worker aktif untuk caching

### 1.2 JavaScript Optimization
- **Priority**: CRITICAL
- **Target**: Hapus jQuery dependency, defer non-critical scripts
- **Action Items**:
  - ✅ Bootstrap 5 sudah digunakan (no jQuery needed)
  - ✅ Scripts menggunakan `defer` attribute
  - ⏳ Audit: Periksa `assets/js/swabina-main.js` untuk jQuery references
  - ⏳ Minify: Ensure all JS files are minified in production

## Phase 2: Image Optimization (LCP Priority)

### 2.1 WebP Conversion Automation
- **File**: `app/Services/ImageOptimizationService.php` (sudah ada)
- **Action**: Verify semua upload routes menggunakan service ini
- **Routes to audit**:
  - `NewsController@store` ✅
  - `SertifikatController@store` ✅
  - `WhyChooseUsController@store` ✅
  - `JejakLangkahController@store` ✅
  - `LayananController@store` - Perlu cek

### 2.2 Lazy Loading & Image Sizing
- **Target**: Semua `<img>` tags di view harus memiliki:
  - ✅ `loading="lazy"` untuk below-the-fold images
  - ✅ `loading="eager"` atau `fetchpriority="high"` untuk hero
  - ⏳ Explicit `width` dan `height` attributes untuk mencegah CLS
  - ⏳ `alt` text yang deskriptif
- **Views affected**: 
  - `news/index.blade.php`
  - `news/show.blade.php`
  - `public/sertifikat.blade.php`
  - `public/tentang-kami.blade.php`
  - `public/jejak-langkah.blade.php`

## Phase 3: CSS & Bundling (Vite)

### 3.1 Critical CSS Inlining
- **Target**: Inline CSS untuk above-the-fold content
- **Current**: Basic inlining sudah ada di `app-professional.blade.php`
- **Action**: Expand untuk header, nav, hero section

### 3.2 Tree Shaking Unused CSS
- **File**: `vite.config.js`
- **Tool**: PostCSS + PurgeCSS/Tailwind
- **Expected savings**: 30-50% CSS reduction
- **Action**: Configure PostCSS purge rules untuk Bootstrap

### 3.3 Font Loading Strategy
- **Current**: Menggunakan system fonts (good for performance)
- **Add**: `font-display: swap` directive
- **Action**: If custom fonts needed, use `font-display: swap` to show text immediately

## Phase 4: HTML Semantics (SEO & Accessibility)

### 4.1 Heading Hierarchy
- **Rule**: One `<h1>` per page, proper `h2`-`h3` hierarchy
- **Check Views**:
  - `/tentang-kami` - Verify H1 structure
  - `/jejak-langkah` - Verify H1 structure
  - `/berita` - List page should have proper hierarchy
  - `/berita/{id}` - Article page structure

### 4.2 Semantic HTML Tags
- **Replace div soup with**:
  - `<header>` for navbar
  - `<nav>` for navigation
  - `<main>` for content
  - `<article>` for news/blog items
  - `<footer>` for footer
  - `<section>` for logical sections
- **Progress**: Layout sudah menggunakan `<main>`

### 4.3 Color Contrast (WCAG AA)
- **Standard**: 4.5:1 for body text, 3:1 for large text
- **Check**:
  - Navbar text vs background
  - CTA buttons vs background
  - Footer text vs background
- **Tool**: WebAIM Contrast Checker

## Phase 5: Server-Side Caching

### 5.1 Route Caching
- **Action**: Add production deployment commands
- **Commands**:
  ```bash
  php artisan route:cache
  php artisan view:cache
  php artisan config:cache
  ```
- **File**: `.env.production` or deployment script

### 5.2 HTTP Caching Headers
- **Implement**: Cache-Control headers in middleware
- **Rules**:
  - Static assets: `Cache-Control: public, max-age=31536000, immutable`
  - Dynamic content: `Cache-Control: public, max-age=3600`
  - No-cache: `Cache-Control: no-cache, no-store, must-revalidate`

### 5.3 Response Caching (Optional)
- **Package**: `spatie/laravel-responsecache`
- **Use case**: Cache full HTML responses for static pages
- **Pages**: Home, About, Services (if not updated frequently)

## Phase 6: Gzip/Brotli Compression

### 6.1 Nginx Configuration (if using Nginx)
- **Enable gzip for**:
  - text/html
  - text/css
  - text/javascript
  - application/json
  - application/javascript
- **Brotli**: Use if supported by server (better compression than gzip)

### 6.2 Verification
- **Tool**: GTmetrix, PageSpeed Insights
- **Check**: Response headers have `Content-Encoding: gzip` or `br`

## Phase 7: Professional UI/UX Checklist

### 7.1 Navbar
- ✅ Sticky on scroll
- ✅ Logo visible
- ✅ Max 7 menu items
- ✅ Mobile hamburger menu
- ✅ High contrast text

### 7.2 Hero Section
- ✅ Strong H1 headline
- ✅ Subheading (concise)
- ✅ Single CTA button (high contrast)
- ✅ Hero image optimized (WebP, lazy-loaded if below fold)

### 7.3 Whitespace
- ✅ Generous padding between sections (at least 3-4rem)
- ✅ Not cramped or dense
- ✅ Breathing room around text

### 7.4 Typography
- ✅ Max 2 font families (heading + body)
- ✅ Font sizes: 16px min for body, 28-48px for headings
- ✅ `font-display: swap` if custom fonts

### 7.5 Footer
- ✅ Company address
- ✅ Social media links
- ✅ Quick links/Sitemap
- ✅ Copyright notice
- ✅ Contact email or form

## Implementation Priority

### Week 1 (CRITICAL)
1. Audit `assets/js/swabina-main.js` for jQuery
2. Add `width/height` to all `<img>` tags
3. Ensure WebP conversion in upload routes
4. Test with Google PageSpeed Insights

### Week 2 (HIGH)
1. Implement tree-shaking CSS in Vite
2. Fix heading hierarchy in public views
3. Verify color contrast (WCAG AA)
4. Enable route/view caching in production

### Week 3 (MEDIUM)
1. Implement semantic HTML across all views
2. Configure Gzip/Brotli on server
3. Add service worker precaching
4. Set up HTTP caching headers

### Week 4+ (NICE-TO-HAVE)
1. Implement response caching for static pages
2. Consider custom font optimization
3. Add critical CSS inlining
4. Performance monitoring dashboard

## Expected Results

- **Performance**: 50-60 → 90+ (mainly LCP improvement)
- **Accessibility**: Current → 95+ (semantic HTML + contrast)
- **Best Practices**: Current → 95+ (no console errors, https)
- **SEO**: Current → 100 (proper H1, semantic markup, meta tags already good)

## Monitoring

- **Tools**: 
  - Google PageSpeed Insights (free)
  - GTmetrix (free tier)
  - WebPageTest (free tier)
  - Lighthouse CI (GitHub Actions)
  
- **Track metrics**:
  - LCP (Largest Contentful Paint) < 2.5s
  - FID (First Input Delay) < 100ms
  - CLS (Cumulative Layout Shift) < 0.1
  - FCP (First Contentful Paint) < 1.8s

## Files to Modify (Execution Order)

1. ✅ `resources/views/layouts/app-professional.blade.php` - Review structure
2. ⏳ `public/assets/js/swabina-main.js` - Audit jQuery
3. ⏳ `vite.config.js` - Add CSS purging
4. ⏳ All public view files - Add img sizing & lazy loading
5. ⏳ Controllers - Verify WebP conversion
6. ⏳ `.env.production` - Add cache commands
7. ⏳ Nginx config (if applicable) - Add compression

---

**Last Updated**: 2024-12-04
**Target Lighthouse Score**: 90+ across all categories
**Status**: Phase 1 Review Complete, Starting Phase 2
