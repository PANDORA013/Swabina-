# 🎯 PANDUAN TESTING AKSESIBILITAS SISTEM

## Langkah 1: Mulai Development Server

```bash
# Terminal 1: Start Laravel Development Server
cd c:\xampp\htdocs\project_magang
php artisan serve
# Output: Laravel development server started on http://127.0.0.1:8000
```

## Langkah 2: Buka Aplikasi di Browser

1. Buka: **http://127.0.0.1:8000/admin/login**
2. Login dengan:
   - Email: `superadmin@swabinagatra.com`
   - Password: `12345678`

## Langkah 3: Test Keyboard Navigation

### 3.1 Skip Link Test
```
1. Berada di halaman admin (http://127.0.0.1:8000/admin/dashboard)
2. Tekan TAB sekali
3. Seharusnya "Skip to main content" link muncul (blue button)
4. Tekan ENTER
5. Fokus pindah ke main content area
✅ PASS jika link bekerja
```

### 3.2 Navbar Navigation
```
1. Tekan TAB untuk navigate ke navbar toggle (hamburger)
2. Tekan ENTER untuk buka/tutup mobile menu
3. Tekan TAB untuk tab ke setiap menu item
4. Tekan ENTER untuk navigate
✅ PASS jika semua menu accessible
```

### 3.3 Table & Form Navigation
```
1. Go to Berita page: http://127.0.0.1:8000/admin/berita
2. Tekan TAB untuk navigate ke buttons (Add, Edit, Delete)
3. Edit button: Tekan ENTER → Modal terbuka
4. Dalam modal, tekan TAB untuk navigate form fields
5. Tekan ESCAPE untuk tutup modal
✅ PASS jika fokus trapped & buttons accessible
```

## Langkah 4: Test Dengan Screen Reader (NVDA)

### 4.1 Install NVDA
1. Download: https://www.nvaccess.org/download/
2. Install (Windows portable version juga ada)

### 4.2 Test dengan NVDA
```
1. Buka Firefox/Chrome
2. Tekan CTRL+ALT+N untuk start NVDA
3. Navigate dengan arrow keys:
   - UP/DOWN → next/previous element
   - LEFT/RIGHT → expand/collapse menu
   - ENTER → activate button
   
4. NVDA akan baca:
   "navigation, main"
   "link, skip to main content"
   "heading, manajemen berita"
   "table, 5 rows, 5 columns"
   "button, tambah berita baru"
   
✅ PASS jika semua elemen dibaca dengan jelas
```

## Langkah 5: Test Contrast dengan DevTools

### 5.1 Buka Chrome DevTools
```
1. F12 atau Ctrl+Shift+I
2. Go to "Accessibility" tab
3. Click pada element
4. Check "Contrast" di panel
```

### 5.2 Check Contrast Ratio
```
✅ Good (WCAG AA): 4.5:1 or higher
⚠️  Caution (WCAG A): 3:1 to 4.5:1
❌ Poor (Below WCAG): Less than 3:1

Target kami: 4.5:1 minimum
```

### 5.3 Elements to Check
- Primary buttons (blue)
- Form labels (black on light gray)
- Table text
- Alert messages

## Langkah 6: Run Lighthouse Accessibility Audit

### 6.1 Open Lighthouse
```
1. F12 (DevTools)
2. Click "Lighthouse" tab (atau ⋮ → More tools → Lighthouse)
3. Select "Accessibility"
4. Click "Analyze page load"
```

### 6.2 Check Results
```
Target Score: 90+ (Grade A)
Issues akan ditampilkan:
- ERRORS (harus fix)
- WARNINGS (sebaiknya fix)
- MANUAL CHECKS (review manual)
```

### 6.3 Sample Test Pages
- Dashboard: http://127.0.0.1:8000/admin/dashboard
- Berita: http://127.0.0.1:8000/admin/berita
- Company Info: http://127.0.0.1:8000/admin/company-info
- Admin Management: http://127.0.0.1:8000/admin/admin-management

## Langkah 7: Test Responsive & Zoom

### 7.1 Browser Zoom
```
Ctrl + Plus (3x)    → 200% zoom
Ctrl + Minus (3x)   → 80% zoom
Ctrl + 0            → Reset to 100%

Check:
✅ Layout responsive
✅ No horizontal scroll
✅ Text readable
✅ Buttons clickable
```

### 7.2 Mobile View
```
F12 → Toggle device toolbar (Ctrl+Shift+M)
Select iPhone 12 (375px width)

Check:
✅ Hamburger menu works
✅ Content reflows
✅ Touch targets 44x44 px
```

## Langkah 8: Manual Accessibility Checks

### 8.1 Alt Text Validation
```
1. Go to Berita page
2. Right-click on image → View Image → Check address bar
3. Or use DevTools → Elements → <img alt="...">

Check:
✅ alt="Gambar untuk berita: [title]"
✅ Not empty
✅ Descriptive content
```

### 8.2 Form Label Association
```
1. DevTools → Elements
2. Find <input id="title">
3. Check if there's <label for="title">

Check:
✅ All inputs have labels
✅ for attribute matches id
✅ No orphaned inputs
```

### 8.3 ARIA Attributes
```
1. DevTools → Elements
2. Check buttons dengan aria-label
3. Check modals dengan aria-labelledby
4. Check icons dengan aria-hidden

Check:
✅ Buttons: aria-label deskriptif
✅ Modals: aria-labelledby points to title id
✅ Icons: aria-hidden="true" untuk dekoratif
```

## Langkah 9: Test Modal Accessibility

### 9.1 Modal Focus Management
```
1. Go to Berita page
2. Click "Tambah Berita" button → Modal opens
3. Tekan TAB untuk navigate form fields

Check:
✅ First focusable element gets focus (usually first input)
✅ Focus doesn't escape modal (trapped)
✅ Last element + TAB goes to first element
✅ ESCAPE closes modal
```

### 9.2 Modal Semantics
```
1. DevTools → Elements
2. Find <div class="modal">
3. Check attributes:
   - aria-labelledby="beritaModalLabel" ✅
   - aria-hidden="true" when closed ✅
   - <h5 id="beritaModalLabel"> exists ✅

Check:
✅ Modal properly labeled
✅ Hidden state correct
✅ Close button has aria-label
```

## Langkah 10: Generate Report

### 10.1 Screenshot Hasil Testing
```
1. Chrome DevTools → Lighthouse
2. Run "Accessibility" audit
3. Screenshot hasil score
4. Save sebagai LIGHTHOUSE_ACCESSIBILITY_REPORT.png
```

### 10.2 Document Findings
```
Buat file: ACCESSIBILITY_TEST_RESULTS.txt

Isi:
- Test date
- Browser & version
- Screen reader (jika ditest)
- Lighthouse score
- Issues found
- Fixes applied
- Remaining issues (jika ada)
```

## Checklist Final

```
[ ] 1. Keyboard navigation works (TAB, ENTER, ESCAPE)
[ ] 2. Skip link functional
[ ] 3. Screen reader reads content correctly (NVDA test)
[ ] 4. Contrast ratio ≥ 4.5:1 (DevTools)
[ ] 5. All images have descriptive alt text
[ ] 6. All form fields have associated labels
[ ] 7. All buttons have aria-label or visible text
[ ] 8. Modal focus trapped & properly labeled
[ ] 9. Lighthouse score ≥ 90 (Accessibility)
[ ] 10. Responsive at 200% zoom without horizontal scroll
[ ] 11. Mobile navigation works (hamburger menu)
[ ] 12. Color contrast sufficient (no color-only info)
```

## Expected Results

```
✅ WCAG 2.1 Level AA Compliance
✅ 90+ Lighthouse Accessibility Score
✅ Zero critical accessibility issues
✅ Keyboard-only navigation fully functional
✅ Screen reader compatible
✅ Mobile accessible
```

## Troubleshooting

### Issue: Skip link tidak muncul
```
Solution:
1. Inspect dengan DevTools
2. Check if style top: -40px is applied
3. Try: Click element → Shift+Space (to scroll into view)
```

### Issue: Focus indicator tidak jelas
```
Solution:
1. F12 → Elements
2. Find element dengan outline:none
3. Add: .element:focus { outline: 2px solid blue; }
```

### Issue: NVDA not reading button text
```
Solution:
1. Check if button has aria-label
2. Check if button has visible text
3. Check if aria-hidden="true" on parent
4. Try: aria-label="Explicit text"
```

### Issue: Modal tidak focus trapped
```
Solution:
1. Check Bootstrap JS loaded
2. Check data-bs-backdrop="static" on modal
3. Check Tab event not propagating out
```

---

## Resources

**Accessibility Testing Tools:**
- NVDA: https://www.nvaccess.org/
- WAVE: https://wave.webaim.org/
- Axe DevTools: https://www.deque.com/axe/devtools/
- Contrast Checker: https://webaim.org/resources/contrastchecker/

**WCAG Guidelines:**
- Official: https://www.w3.org/WAI/WCAG21/quickref/
- WebAIM: https://webaim.org/
- MDN: https://developer.mozilla.org/en-US/docs/Web/Accessibility

**Video Tutorials:**
- A11ycasts: https://www.youtube.com/playlist?list=PLNYkxOF6rcICWx0C9Xc-RgEzwLvePng7V
- Accessible HTML: https://www.youtube.com/watch?v=qdB8SHVVJZo

---

**Dibuat:** 19 November 2025  
**Status:** ✅ Ready for Comprehensive Testing
