# 🚀 LIGHTHOUSE OPTIMIZATION PLAN

**Current Score:** 85 Performance  
**Target Score:** 90+  
**Estimated Savings:** 417 KiB (Cache) + 78 KiB (Images) + 224 KiB (CSS) + 65 KiB (JS)  
**Total Potential Savings:** ~784 KiB

---

## 📊 CURRENT METRICS

| Metric | Current | Target | Status |
|--------|---------|--------|--------|
| First Contentful Paint (FCP) | 2.6s | <1.8s | ⚠️ Needs improvement |
| Largest Contentful Paint (LCP) | 3.5s | <2.5s | ⚠️ Needs improvement |
| Total Blocking Time (TBT) | 0ms | 0ms | ✅ Good |
| Cumulative Layout Shift (CLS) | 0.088 | <0.1 | ✅ Good |
| Speed Index | 2.6s | <2.0s | ⚠️ Needs improvement |

---

## 🎯 OPTIMIZATION PRIORITIES

### Priority 1: Cache Control (Est. Savings: 417 KiB)
**Status:** ✅ Already configured in `.htaccess`  
**Verification:** Check if headers are being sent correctly

```bash
# Verify cache headers
curl -I http://localhost:8000/css/bootstrap.min.css
```

**Expected Output:**
```
Cache-Control: max-age=31536000, public, immutable
```

---

### Priority 2: Image Optimization (Est. Savings: 78 KiB)
**Issue:** Images are oversized for display dimensions

**Affected Images:**
- `logo_iso1.png` - 37.6 KiB → 0.5 KiB (37.1 KiB savings)
- `logo_smk3.png` - 20.4 KiB → 0.5 KiB (19.9 KiB savings)
- `logo_iso3.png` - 7.1 KiB → 0.1 KiB (7.0 KiB savings)
- `logo_swabina.png` - 8.2 KiB → 1.3 KiB (6.9 KiB savings)
- `logo_iso2.png` - 7.0 KiB → 0.2 KiB (6.8 KiB savings)

**Solution:** Implement responsive images with srcset

---

### Priority 3: Reduce Unused CSS (Est. Savings: 224 KiB)
**Issue:** Bootstrap.min.css has 212.4 KiB unused CSS

**Solution:** Use PurgeCSS or Tailwind CSS

---

### Priority 4: Reduce Unused JavaScript (Est. Savings: 65 KiB)
**Issue:** Bootstrap.bundle.min.js has 65.1 KiB unused code

**Solution:** Load only required Bootstrap components

---

### Priority 5: Font Display Optimization (Est. Savings: 210 ms)
**Issue:** Bootstrap icons font blocking render

**Solution:** Add font-display: swap

---

## 🔧 IMPLEMENTATION STEPS

### STEP 1: Verify Cache Headers (5 minutes)

**Action:** Test if cache headers are working

```bash
# Test cache headers
curl -I http://localhost:8000/
curl -I http://localhost:8000/css/bootstrap.min.css
curl -I http://localhost:8000/js/bootstrap.bundle.min.js
```

**Expected Results:**
- CSS/JS: `Cache-Control: max-age=2592000, public`
- Images: `Cache-Control: max-age=31536000, public, immutable`
- HTML: `Cache-Control: no-cache, no-store, must-revalidate`

---

### STEP 2: Optimize Images (15 minutes)

**Action:** Create responsive image versions

**Location:** `public/gambar_landingpage/`

**Images to Optimize:**
1. `logo_iso1.png` (37.6 KiB)
2. `logo_smk3.png` (20.4 KiB)
3. `logo_iso3.png` (7.1 KiB)
4. `logo_swabina.png` (8.2 KiB)
5. `logo_iso2.png` (7.0 KiB)

**Tools:**
- ImageMagick: `convert input.png -quality 85 -resize 200x200 output.png`
- Online: TinyPNG.com or Compressor.io

**Process:**
1. Download images from `public/gambar_landingpage/`
2. Compress using TinyPNG or ImageMagick
3. Upload back with same names
4. Verify file sizes reduced

---

### STEP 3: Add Font Display Swap (5 minutes)

**Action:** Update Bootstrap Icons CSS loading

**File:** `resources/views/layouts/app.blade.php`

**Current:**
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

**Change to:**
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
```

---

### STEP 4: Defer Non-Critical JavaScript (10 minutes)

**Action:** Defer Bootstrap JS loading

**File:** `resources/views/layouts/app.blade.php`

**Current:**
```html
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

**Change to:**
```html
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
```

---

### STEP 5: Minify CSS & JS (10 minutes)

**Action:** Use Laravel Mix or Vite for minification

**File:** `webpack.mix.js` or `vite.config.js`

```javascript
// webpack.mix.js
mix.css('resources/css/app.css', 'public/css')
   .js('resources/js/app.js', 'public/js')
   .minify('public/css/app.css')
   .minify('public/js/app.js');
```

**Command:**
```bash
npm run production
```

---

### STEP 6: Implement Lazy Loading (15 minutes)

**Action:** Add lazy loading to offscreen images

**File:** Update image tags in views

**Current:**
```html
<img src="image.png" alt="description">
```

**Change to:**
```html
<img src="image.png" alt="description" loading="lazy">
```

---

### STEP 7: Add Preconnect Hints (5 minutes)

**Action:** Preconnect to CDN origins

**File:** `resources/views/layouts/app.blade.php`

**Add in `<head>`:**
```html
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
```

---

## 📋 IMPLEMENTATION CHECKLIST

### Phase 1: Quick Wins (30 minutes)
- [ ] Verify cache headers working
- [ ] Add font-display: swap
- [ ] Defer Bootstrap JS
- [ ] Add preconnect hints
- [ ] Test in Lighthouse

### Phase 2: Image Optimization (20 minutes)
- [ ] Compress all logo images
- [ ] Add responsive images (srcset)
- [ ] Test in Lighthouse

### Phase 3: Code Optimization (20 minutes)
- [ ] Minify CSS
- [ ] Minify JS
- [ ] Add lazy loading
- [ ] Test in Lighthouse

### Phase 4: Verification (10 minutes)
- [ ] Run full Lighthouse audit
- [ ] Compare before/after scores
- [ ] Document improvements

---

## 🎯 EXPECTED RESULTS AFTER OPTIMIZATION

| Metric | Before | After | Improvement |
|--------|--------|-------|-------------|
| Performance | 85 | 92+ | +7 points |
| FCP | 2.6s | 1.8s | -0.8s |
| LCP | 3.5s | 2.5s | -1.0s |
| Total Size | 577 KiB | ~350 KiB | -227 KiB |

---

## ⚠️ IMPORTANT NOTES

1. **Cache Headers Already Set:** The `.htaccess` file already has proper cache configuration
2. **No Breaking Changes:** All optimizations are non-breaking
3. **Backup First:** Keep backup of original images
4. **Test Locally:** Test all changes locally before deploying
5. **Monitor Performance:** Use Lighthouse regularly to track improvements

---

## 🔍 VERIFICATION COMMANDS

### Check Cache Headers
```bash
curl -I http://localhost:8000/css/bootstrap.min.css
```

### Check Image Sizes
```bash
ls -lh public/gambar_landingpage/
```

### Run Lighthouse
```
Chrome DevTools → Lighthouse → Generate Report
```

---

## 📊 OPTIMIZATION IMPACT

### Cache Control
- **Current:** No cache headers on localhost assets
- **After:** 1-year cache for images, 1-month for CSS/JS
- **Impact:** Faster repeat visits, reduced server load

### Image Optimization
- **Current:** 80.3 KiB total
- **After:** ~2 KiB total (using responsive images)
- **Impact:** 78 KiB savings, faster LCP

### Font Display
- **Current:** Blocks render
- **After:** Swaps to system font immediately
- **Impact:** 210 ms faster FCP

### Deferred JS
- **Current:** Blocks HTML parsing
- **After:** Loads after page render
- **Impact:** Faster initial render

---

## 🚀 QUICK START

**To begin optimization:**

1. **Start with Phase 1** (Quick Wins - 30 minutes)
2. **Then Phase 2** (Images - 20 minutes)
3. **Then Phase 3** (Code - 20 minutes)
4. **Finally Phase 4** (Verification - 10 minutes)

**Total Time:** ~80 minutes for full optimization

---

## 📝 NOTES

- All changes are reversible
- No database changes needed
- No breaking changes to functionality
- Can be done incrementally
- Test after each phase

---

**Status:** ✅ READY TO IMPLEMENT  
**Complexity:** LOW  
**Risk:** MINIMAL  
**Expected Improvement:** +7 points (85 → 92+)

