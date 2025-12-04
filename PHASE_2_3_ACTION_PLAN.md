# PHASE 2-3: Image & CSS Optimization Action Plan

## Status: IN PROGRESS

### Verified ✅
1. **No jQuery in production** - bootstrap.bundle.min.js only (Bootstrap 5 native)
2. **Lazy loader implemented** - `public/assets/js/lazy-loader.js` uses Intersection Observer API
3. **Layout is clean** - `app-professional.blade.php` only loads production assets
4. **Service Worker registered** - for offline support and caching
5. **CSS is inlined for critical content** - header/footer styles in `<style>` tag

### Immediate Actions (Week 1)

#### 1. Add Image Sizing to All Views
**Priority**: CRITICAL (prevents CLS - Cumulative Layout Shift)

Files to update:
- [ ] `resources/views/news/index.blade.php` - Add width/height to article cards
- [ ] `resources/views/news/show.blade.php` - Add width/height to featured image
- [ ] `resources/views/public/sertifikat.blade.php` - Certificate grid images
- [ ] `resources/views/public/tentang-kami.blade.php` - About page images
- [ ] `resources/views/public/jejak-langkah.blade.php` - Timeline images
- [ ] `resources/views/public/mengapa-memilih-kami.blade.php` - Feature images
- [ ] `resources/views/layouts/app-professional.blade.php` - Logo sizing

**Pattern to follow**:
```blade
<img src="{{ asset('storage/' . $item->image) }}" 
     alt="{{ $item->title }}"
     width="400" 
     height="300"
     loading="lazy"
     class="img-fluid">
```

#### 2. Verify WebP Conversion in All Upload Routes
**Priority**: HIGH (saves 30-40% bandwidth)

Routes to audit:
- [ ] `NewsController@store` - Verify using ImageOptimizationService
- [ ] `SertifikatController@store` - Verify image processing
- [ ] `JejakLangkahController@store` - Verify image storage
- [ ] `WhyChooseUsController@store` - Verify icon storage
- [ ] `LayananController@store` - Check file upload handling
- [ ] `CompanyInfoController@uploadLogo` - Logo WebP conversion
- [ ] `CompanyInfoController@uploadISOLogo` - ISO logo WebP conversion

**Expected output**: All images should be converted to `.webp` with fallback `.jpg`

#### 3. Add Loading Attributes to Hero Images
**Priority**: CRITICAL (improves LCP)

- Hero images on homepage: Add `fetchpriority="high"` or `loading="eager"`
- All other images below fold: Add `loading="lazy"`

#### 4. Test with Google PageSpeed
**Tool**: https://pagespeed.web.dev/

- Run audit on: https://yourdomain.com
- Screenshot current score
- Goal: 80+ Performance after Phase 1-2

---

### Phase 2 Follow-up Actions (Week 2)

#### 5. Implement CSS Tree-Shaking in Vite
**File**: `vite.config.js`

**Current state**: Check if PostCSS configured
**Action**: Add PurgeCSS/UnCSS rules to remove unused Bootstrap classes

Expected savings: 30-50% CSS file size

#### 6. Fix Heading Hierarchy in Public Views
**Priority**: SEO & Accessibility

Check each view:
- [ ] Home page (`LandingPageController@index`) - One H1 only
- [ ] About page (`LandingPageController@tentangkami`) - Proper H1-H3
- [ ] News list (`NewsController@publicIndex`) - H1 for page title, H2 for articles
- [ ] News detail (`NewsController@show`) - H1 for article title
- [ ] Services (`LandingPageController@layanan*`) - H1 per page
- [ ] Contact (`ContactController@index`) - H1 for contact form

**Pattern**: 
```blade
<main>
    <h1>Page Title</h1>
    <section>
        <h2>Section 1</h2>
        <h3>Subsection</h3>
    </section>
</main>
```

#### 7. Verify Color Contrast (WCAG AA)
**Tool**: WebAIM Contrast Checker

- [ ] Navbar text (white) vs background (#0454a3) - Ratio should be 4.5:1+
- [ ] CTA buttons text vs background - Check all button colors
- [ ] Footer text vs background - Light text on dark

If contrast < 4.5:1, adjust colors or add background overlay

#### 8. Add Semantic HTML Tags
**Pattern** - Replace generic divs:
```blade
<!-- Before -->
<div class="header">...</div>
<div class="nav">...</div>
<div class="content">...</div>
<div class="article">...</div>
<div class="footer">...</div>

<!-- After -->
<header>...</header>
<nav>...</nav>
<main>...</main>
<article>...</article>
<footer>...</footer>
```

---

### Phase 3 Actions (Week 3)

#### 9. Enable Production Cache Commands
**File**: Deployment script or `.env.production`

Add these commands to production deployment:
```bash
php artisan route:cache
php artisan view:cache  
php artisan config:cache
php artisan event:cache  # if using events
```

Verify Cache headers in response:
- Static assets should have `Cache-Control: public, max-age=31536000, immutable`
- HTML should have `Cache-Control: public, max-age=3600`

#### 10. Configure Gzip/Brotli on Server
**For Nginx** (in nginx.conf):
```nginx
gzip on;
gzip_types text/plain text/css text/javascript application/json application/javascript application/xml+rss;
gzip_min_length 1000;
gzip_vary on;
```

**For Apache** (in .htaccess):
```apache
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

#### 11. Set HTTP Caching Headers
**File**: Middleware (create new or edit existing)

```php
// app/Http/Middleware/CacheHeaders.php
public function handle($request, Closure $next)
{
    $response = $next($request);
    
    if ($request->path() starts with /public || /assets/) {
        $response->header('Cache-Control', 'public, max-age=31536000, immutable');
    } else if ($request->method() === 'GET') {
        $response->header('Cache-Control', 'public, max-age=3600');
    }
    
    return $response;
}
```

#### 12. Add Service Worker Precaching
**File**: `public/sw.js`

Extend to precache critical resources:
```javascript
const CACHE_NAME = 'swabina-v1';
const urlsToCache = [
  '/',
  '/css/bootstrap.min.css',
  '/js/bootstrap.bundle.min.js',
  '/js/lazy-loader.js',
  '/offline.html'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});
```

---

### Monitoring & Verification

#### Lighthouse Metrics to Track
After each phase, check:
- **LCP** (Largest Contentful Paint) - Target: < 2.5s
- **FID** (First Input Delay) - Target: < 100ms  
- **CLS** (Cumulative Layout Shift) - Target: < 0.1
- **FCP** (First Contentful Paint) - Target: < 1.8s

#### Tools
1. **Google PageSpeed Insights** - https://pagespeed.web.dev/ (free)
2. **GTmetrix** - https://gtmetrix.com/ (free tier)
3. **WebPageTest** - https://www.webpagetest.org/ (free)
4. **Chrome DevTools** - Built-in Lighthouse (free)

#### Baseline Testing
Before implementation:
- Screenshot current Lighthouse score
- Note current metrics (LCP, FID, CLS)
- Take WebPageTest waterfall screenshot

After each phase:
- Re-run tests
- Compare metrics
- Document improvements

---

### Expected Score Improvement

| Category | Before | After Phase 2 | After Phase 3 | Target |
|----------|--------|---------------|---------------|--------|
| Performance | ~55 | ~75 | ~90 | 90+ |
| Accessibility | ~80 | ~85 | ~95 | 95+ |
| Best Practices | ~85 | ~88 | ~95 | 95+ |
| SEO | ~95 | ~98 | ~100 | 100 |

---

### Quick Reference: Image Sizing Pattern

```blade
<!-- Common image sizes -->
<img src="{{ asset('storage/' . $item->image) }}"
     alt="Article: {{ $item->title }}"
     width="800"
     height="600"
     loading="lazy"
     class="img-fluid w-100 h-auto">

<!-- Hero image (above fold) -->
<img src="{{ asset('storage/' . $item->hero_image) }}"
     alt="{{ $item->title }}"
     width="1920"
     height="1080"
     loading="eager"
     fetchpriority="high"
     class="img-fluid">

<!-- Thumbnail images -->
<img src="{{ asset('storage/' . $item->thumbnail) }}"
     alt="Thumbnail: {{ $item->title }}"
     width="300"
     height="200"
     loading="lazy"
     class="img-thumbnail">
```

---

**Last Updated**: 2024-12-04  
**Phase Status**: Documented, Ready to Execute  
**Next Step**: Begin Week 1 Actions (Image sizing)
