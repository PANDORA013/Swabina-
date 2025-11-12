# 🎯 CMS IMPLEMENTATION STRATEGY - FULL CONTENT MANAGEMENT

**Objective**: Convert website menjadi sistem CMS penuh di mana semua konten dikelola oleh admin

---

## 📊 CURRENT STATE ANALYSIS

### Konten yang Sudah Termanaged (Database-driven) ✅
1. **Berita** - Model: `Berita` (Title, Description, Image)
2. **Sertifikat & Penghargaan** - Model: `SertifikatPenghargaan` 
3. **FAQ** - Model: `Faq`
4. **Pedoman & Kebijakan** - Model: `Pedoman`
5. **Visi, Misi, Budaya** - Model: `VisiMisiBudaya`
6. **Jejak Langkah (Timeline)** - Model: `JejakLangkah`
7. **Company Info** - Model: `CompanyInfo`

### Konten yang MASIH Hardcoded ❌
1. **"Mengapa Memilih Kami" (MPK) Section**
   - File: `beranda/partial-beranda/mpk.blade.php`
   - Konten: Competence, Integrity, Excellent, Innovative, Profesional
   - Status: Hardcoded images & text

2. **Sekilas Perusahaan**
   - File: `tentangkami/partial-tentangkami/isi-sekilas.blade.php`
   - Status: Mostly hardcoded content

3. **Footer Information**
   - Alamat, Email, Telepon, Social Links
   - Partially in database

4. **Navigation Menu**
   - Some hardcoded routes & text

5. **Kontak Information**
   - Address, contact details

6. **FAQ Page**
   - Questions & answers (partially in database)

7. **Landing Page Services Section**
   - Service cards dengan hardcoded text

---

## 🛠️ IMPLEMENTATION PLAN

### Phase 1: Core Content Models (Priority 1)
Buat models dan migration untuk konten yang paling sering diubah:

#### 1. **WhyChooseUs Model** (untuk MPK section)
```
- id
- title (string)
- description (text)
- icon (string) - nama class icon Bootstrap
- image (string) - path ke storage
- order (integer) - untuk sorting
- timestamps
```

#### 2. **ServiceCard Model** (untuk layanan di homepage)
```
- id
- title (string multilingual)
- description (text multilingual)
- icon (string) - Bootstrap icon class
- link (string) - route name
- image (string)
- order (integer)
- status (active/inactive)
- timestamps
```

#### 3. **ContactInfo Model** (untuk kontak & footer)
```
- id
- address_main (text)
- address_branch (text)
- email (string)
- phone (array JSON) - untuk multiple nomor
- social_links (JSON)
- office_hours (text)
- timestamps
```

#### 4. **PageContent Model** (untuk konten generic pages)
```
- id
- slug (string) - unique identifier
- title (string multilingual)
- content (text multilingual)
- meta_description (text)
- meta_keywords (text)
- featured_image (string)
- status (published/draft)
- timestamps
```

#### 5. **FAQCategory Model** (untuk mengorganisir FAQ)
```
- id
- name (string)
- description (text)
- order (integer)
- timestamps
```

---

### Phase 2: Update Existing Models
Tambahkan field yang kurang:

#### **Pedoman Model**
```php
// Tambahkan:
- content (text/JSON) - konten detail
- status (active/inactive)
```

#### **Faq Model**
```php
// Update:
- category_id (foreign key ke FAQCategory)
- order (untuk custom sorting)
```

---

### Phase 3: Admin Panel Management

#### Controllers yang perlu dibuat:
1. `Admin/WhyChooseUsController` - CRUD untuk MPK
2. `Admin/ServiceCardController` - CRUD untuk service cards
3. `Admin/ContactInfoController` - CRUD untuk kontak
4. `Admin/PageContentController` - CRUD untuk generic pages
5. `Admin/FAQCategoryController` - CRUD untuk FAQ categories

#### Views yang perlu dibuat:
- Admin dashboard untuk setiap content type
- Form untuk create/edit content
- Media manager/image upload

---

### Phase 4: Update Frontend Views

#### Halaman yang perlu di-update:
1. `beranda/landingpage-professional.blade.php`
   - Loop data dari `WhyChooseUs` untuk MPK
   - Loop data dari `ServiceCard` untuk services

2. `tentangkami/sekilas-professional.blade.php`
   - Render dari `PageContent` dengan slug='tentang-kami'

3. `kontakkami/faq-professional.blade.php`
   - Render dari `ContactInfo`
   - Loop dari `Faq` dengan `FAQCategory`

4. Footer/Navigation
   - Render dari `ContactInfo` & `ServiceCard`

---

## 📋 IMPLEMENTATION CHECKLIST

### Step 1: Database & Models
- [ ] Create migration for WhyChooseUs
- [ ] Create migration for ServiceCard
- [ ] Create migration for ContactInfo
- [ ] Create migration for PageContent
- [ ] Create migration for FAQCategory (if needed)
- [ ] Create all Model files
- [ ] Run migrations

### Step 2: Admin Controllers & Views
- [ ] Create Admin controllers for each content type
- [ ] Create admin views (CRUD forms)
- [ ] Add routes in admin panel
- [ ] Setup validation & authorization

### Step 3: Frontend Integration
- [ ] Update LandingPageController
- [ ] Update all view files to use database content
- [ ] Remove hardcoded content from views
- [ ] Test all pages

### Step 4: Seed Data
- [ ] Create seeders for initial data
- [ ] Test with sample data

---

## 💾 DATA STRUCTURE EXAMPLE

### WhyChooseUs (MPK)
```json
{
  "id": 1,
  "title": "Competence",
  "description": "Tenaga profesional berpengalaman...",
  "icon": "bi-brain",
  "image": "competence.png",
  "order": 1,
  "created_at": "2024-11-11T10:00:00Z"
}
```

### ServiceCard
```json
{
  "id": 1,
  "title": {
    "id": "Facility Management",
    "en": "Facility Management"
  },
  "description": {
    "id": "Layanan pengelolaan fasilitas profesional...",
    "en": "Professional facility management services..."
  },
  "icon": "bi-building",
  "link": "facility-management",
  "image": "fm.png",
  "order": 1,
  "status": "active"
}
```

### ContactInfo
```json
{
  "id": 1,
  "address_main": "Jl. R.A. Kartini No.21 A Gresik, Jawa Timur 61122",
  "address_branch": "Desa Sumberarum, Kecamatan Kerek, Tuban",
  "email": "marketing@swabina.id",
  "phone": ["+62-31-1234567", "+62-812-1234567"],
  "social_links": {
    "facebook": "https://facebook.com/swabina",
    "instagram": "https://instagram.com/swabina",
    "youtube": "https://youtube.com/swabina",
    "whatsapp": "+628123456789"
  }
}
```

---

## 🎯 EXPECTED OUTCOME

### Before (Current)
```
Halaman Website → Hardcoded Views
                → Database (berita, FAQ, pedoman)
                → Mixed content sources
```

### After (Goal)
```
Halaman Website → Admin Panel → All Content in Database
                ↓
              View Controller → Gets ALL data from models
                ↓
              Blade Templates → Render database content only
```

### Benefits
✅ 100% content managed by admin
✅ Easy updates without developer
✅ Consistent data structure
✅ SEO metadata management
✅ Multi-language support ready
✅ Scalable architecture

---

## ⏱️ ESTIMATED TIMELINE

- Phase 1 (Models): 1-2 hours
- Phase 2 (Admin Controllers & Views): 3-4 hours  
- Phase 3 (Frontend Integration): 2-3 hours
- Phase 4 (Testing & Seeding): 1-2 hours

**Total: 7-11 hours of development**

---

## 🔧 NEXT STEPS

**Option 1**: Start with high-priority content (MPK, ServiceCard, ContactInfo)
**Option 2**: Start with footer/contact info (easier, fewer dependencies)
**Option 3**: Implement complete solution now

**Which would you prefer?**
