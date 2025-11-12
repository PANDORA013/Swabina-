# 🧪 TESTING CONTINUATION - TEST 2 TO 10

**Date:** November 12, 2025  
**Tester:** User Manual Testing  
**Status:** IN PROGRESS  

---

## ✅ TEST 1 COMPLETED: BERITA & ARTIKEL

**Summary:**
- ✅ Add berita - SUCCESS
- ✅ Edit berita - SUCCESS  
- ✅ Delete berita - SUCCESS
- ✅ Public sync - SUCCESS
- ✅ Image upload - SUCCESS
- ✅ Multilingual - SUCCESS

---

## 🧪 TEST 2: FAQ

### Test 2.1: Add FAQ
**Admin Steps:**
```
1. Login: admin@swabinagatra.com / admin123
2. Navigate: Sidebar → FAQ
3. Click: "Tambah FAQ"
4. Fill Form:
   - Pertanyaan (ID): "Apa layanan utama PT Swabina Gatra?"
   - Jawaban (ID): "PT Swabina Gatra menyediakan layanan facility management, 
     digital solution, dan academy training."
   - Pertanyaan (EN): "What are the main services of PT Swabina Gatra?"
   - Jawaban (EN): "PT Swabina Gatra provides facility management, 
     digital solution, and academy training services."
5. Click: "Simpan"
```

**Expected Results:**
- [ ] Notifikasi "FAQ berhasil ditambahkan" muncul
- [ ] Modal tertutup otomatis
- [ ] FAQ muncul di tabel admin
- [ ] FAQ count di dashboard bertambah

**Public Verification:**
```
1. Open: http://localhost:8000/faq
2. Check:
   - [ ] FAQ muncul di halaman
   - [ ] Pertanyaan sesuai dengan input
   - [ ] Jawaban sesuai dengan input
   - [ ] Multilingual support bekerja
```

**Status:** ⏳ PENDING

---

### Test 2.2: Edit FAQ
**Admin Steps:**
```
1. Click: "FAQ" di sidebar
2. Click: "Edit" pada FAQ yang baru ditambahkan
3. Update:
   - Jawaban (ID): Tambahkan "Kami juga menyediakan konsultasi gratis."
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Notifikasi sukses muncul
- [ ] FAQ terupdate di tabel

**Public Verification:**
```
1. Refresh: http://localhost:8000/faq
2. Check:
   - [ ] Perubahan jawaban muncul
   - [ ] Semua data tetap konsisten
```

**Status:** ⏳ PENDING

---

### Test 2.3: Delete FAQ
**Admin Steps:**
```
1. Click: "FAQ" di sidebar
2. Click: "Hapus" pada FAQ
3. Confirm: "Ya, Hapus!"
```

**Expected Results:**
- [ ] Notifikasi "FAQ berhasil dihapus" muncul
- [ ] FAQ hilang dari tabel
- [ ] FAQ count berkurang

**Public Verification:**
```
1. Refresh: http://localhost:8000/faq
2. Check:
   - [ ] FAQ tidak muncul di halaman
```

**Status:** ⏳ PENDING

---

## 🧪 TEST 3: KEBIJAKAN & PEDOMAN

### Test 3.1: Add Pedoman
**Admin Steps:**
```
1. Click: "Kebijakan & Pedoman" di sidebar
2. Click: "Tambah Pedoman"
3. Fill Form:
   - Judul: "Kebijakan Privasi"
   - File: Upload file PDF (create test PDF)
   - Gambar: Upload gambar cover
   - Deskripsi: "Kebijakan privasi PT Swabina Gatra menjelaskan bagaimana 
     kami melindungi data pelanggan."
   - Text Align: "left"
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Notifikasi sukses muncul
- [ ] Pedoman muncul di tabel dengan thumbnail
- [ ] File tersimpan di storage

**Public Verification:**
```
1. Open: http://localhost:8000/kebijakan-pedoman
2. Check:
   - [ ] Pedoman muncul di halaman
   - [ ] Gambar tampil dengan benar
   - [ ] Deskripsi sesuai
   - [ ] Link download file tersedia
3. Click: Download link
   - [ ] File berhasil didownload
   - [ ] File format benar (PDF)
```

**Status:** ⏳ PENDING

---

### Test 3.2: Edit Pedoman
**Admin Steps:**
```
1. Click: "Kebijakan & Pedoman"
2. Click: "Edit"
3. Update:
   - Deskripsi: Tambahkan informasi tambahan
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Pedoman terupdate

**Public Verification:**
```
1. Refresh: http://localhost:8000/kebijakan-pedoman
2. Check:
   - [ ] Perubahan muncul
```

**Status:** ⏳ PENDING

---

### Test 3.3: Delete Pedoman
**Admin Steps:**
```
1. Click: "Kebijakan & Pedoman"
2. Click: "Hapus"
3. Confirm
```

**Expected Results:**
- [ ] Pedoman dihapus dari tabel
- [ ] File dihapus dari storage

**Public Verification:**
```
1. Refresh: http://localhost:8000/kebijakan-pedoman
2. Check:
   - [ ] Pedoman tidak muncul
```

**Status:** ⏳ PENDING

---

## 🧪 TEST 4: JEJAK LANGKAH

### Test 4.1: Add Jejak Langkah
**Admin Steps:**
```
1. Click: "Jejak Langkah" di sidebar
2. Click: "Tambah Jejak Langkah"
3. Fill Form:
   - Tahun: 2020
   - Deskripsi: "Pendirian PT Swabina Gatra dengan fokus pada facility management"
   - Gambar: Upload gambar (optional)
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Notifikasi sukses
- [ ] Jejak muncul di timeline

**Public Verification:**
```
1. Open: http://localhost:8000/jejak-langkah
2. Check:
   - [ ] Jejak muncul di timeline
   - [ ] Tahun 2020 tampil
   - [ ] Deskripsi sesuai
   - [ ] Timeline terurut dengan benar
```

**Status:** ⏳ PENDING

---

### Test 4.2: Add Multiple Jejak
**Admin Steps:**
```
1. Add Jejak 2:
   - Tahun: 2022
   - Deskripsi: "Ekspansi ke layanan digital solution"
2. Add Jejak 3:
   - Tahun: 2024
   - Deskripsi: "Peluncuran academy training program"
```

**Expected Results:**
- [ ] Semua jejak muncul
- [ ] Timeline terurut: 2024 → 2022 → 2020 (terbaru di atas)

**Public Verification:**
```
1. Open: http://localhost:8000/jejak-langkah
2. Check:
   - [ ] Semua 3 jejak muncul
   - [ ] Urutan timeline benar
```

**Status:** ⏳ PENDING

---

### Test 4.3: Edit & Delete Jejak
**Admin Steps:**
```
1. Edit Jejak 2022:
   - Update deskripsi
2. Delete Jejak 2020
```

**Expected Results:**
- [ ] Edit berhasil
- [ ] Delete berhasil
- [ ] Timeline update

**Public Verification:**
```
1. Refresh: http://localhost:8000/jejak-langkah
2. Check:
   - [ ] Perubahan muncul
   - [ ] Jejak 2020 hilang
```

**Status:** ⏳ PENDING

---

## 🧪 TEST 5: MENGAPA MEMILIH KAMI

### Test 5.1: Add Alasan
**Admin Steps:**
```
1. Click: "Mengapa Memilih Kami" di sidebar
2. Click: "Tambah"
3. Fill Form:
   - Icon: Pilih icon (misal: star)
   - Judul: "Berpengalaman"
   - Deskripsi: "Lebih dari 10 tahun melayani klien dengan dedikasi penuh"
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Alasan muncul di list

**Public Verification:**
```
1. Open: http://localhost:8000/mengapa-memilih-kami
2. Check:
   - [ ] Alasan muncul
   - [ ] Icon tampil
   - [ ] Judul & deskripsi sesuai
```

**Status:** ⏳ PENDING

---

### Test 5.2: Add Multiple Alasan
**Admin Steps:**
```
1. Add Alasan 2:
   - Icon: trophy
   - Judul: "Profesional"
   - Deskripsi: "Tim profesional dengan sertifikasi internasional"
2. Add Alasan 3:
   - Icon: shield
   - Judul: "Terpercaya"
   - Deskripsi: "Dipercaya oleh ratusan perusahaan di Indonesia"
```

**Expected Results:**
- [ ] Semua alasan muncul

**Public Verification:**
```
1. Open: http://localhost:8000/mengapa-memilih-kami
2. Check:
   - [ ] Semua 3 alasan muncul
   - [ ] Icons tampil dengan benar
```

**Status:** ⏳ PENDING

---

### Test 5.3: Edit & Delete Alasan
**Admin Steps:**
```
1. Edit Alasan 2:
   - Update deskripsi
2. Delete Alasan 3
```

**Expected Results:**
- [ ] Edit & delete berhasil

**Public Verification:**
```
1. Refresh: http://localhost:8000/mengapa-memilih-kami
2. Check:
   - [ ] Perubahan muncul
   - [ ] Alasan 3 hilang
```

**Status:** ⏳ PENDING

---

## 🧪 TEST 6: SERTIFIKAT & PENGHARGAAN

### Test 6.1: Add Sertifikat
**Admin Steps:**
```
1. Click: "Sertifikat & Penghargaan" di sidebar
2. Click: "Tambah Sertifikat"
3. Fill Form:
   - Nama: "ISO 9001:2015"
   - Deskripsi: "Sertifikasi Sistem Manajemen Mutu Internasional"
   - Gambar: Upload gambar sertifikat
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Notifikasi sukses
- [ ] Sertifikat muncul di grid card

**Dashboard Verification:**
```
1. Open: http://localhost:8000/admin/dashboard
2. Check:
   - [ ] Sertifikat count bertambah
   - [ ] Sertifikat muncul di carousel "Sertifikat Terkini"
   - [ ] Gambar tampil dengan benar
```

**Status:** ⏳ PENDING

---

### Test 6.2: Add Multiple Sertifikat
**Admin Steps:**
```
1. Add Sertifikat 2:
   - Nama: "ISO 14001:2015"
   - Deskripsi: "Sertifikasi Sistem Manajemen Lingkungan"
   - Gambar: Upload
2. Add Sertifikat 3:
   - Nama: "ISO 45001:2018"
   - Deskripsi: "Sertifikasi Sistem Manajemen Keselamatan"
   - Gambar: Upload
```

**Expected Results:**
- [ ] Semua sertifikat muncul di grid

**Dashboard Verification:**
```
1. Open: http://localhost:8000/admin/dashboard
2. Check:
   - [ ] Sertifikat count = 3
   - [ ] Carousel menampilkan 3 sertifikat
   - [ ] Bisa navigate carousel dengan buttons
```

**Status:** ⏳ PENDING

---

### Test 6.3: Edit & Delete Sertifikat
**Admin Steps:**
```
1. Edit Sertifikat 2:
   - Update deskripsi
2. Delete Sertifikat 3
```

**Expected Results:**
- [ ] Edit & delete berhasil

**Dashboard Verification:**
```
1. Refresh: http://localhost:8000/admin/dashboard
2. Check:
   - [ ] Sertifikat count = 2
   - [ ] Carousel update
```

**Status:** ⏳ PENDING

---

## 🧪 TEST 7: SEKILAS PERUSAHAAN

### Test 7.1: Edit Sekilas Perusahaan
**Admin Steps:**
```
1. Click: "Sekilas Perusahaan" di sidebar
2. Click: "Edit Sekilas"
3. Fill Form:
   - Judul: "Tentang PT Swabina Gatra"
   - Deskripsi: "PT Swabina Gatra adalah perusahaan yang berdedikasi dalam 
     memberikan solusi terbaik untuk kebutuhan bisnis Anda. Dengan pengalaman 
     lebih dari 10 tahun, kami telah melayani ribuan klien di seluruh Indonesia."
   - Tahun Berdiri: 2010
   - Jumlah Karyawan: 150
   - Gambar: Upload gambar perusahaan
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Notifikasi sukses
- [ ] Data muncul di card

**Public Verification:**
```
1. Open: http://localhost:8000/tentang-kami
2. Check:
   - [ ] Judul sesuai
   - [ ] Deskripsi sesuai
   - [ ] Gambar tampil
   - [ ] Tahun berdiri: 2010
   - [ ] Jumlah karyawan: 150
```

**Status:** ⏳ PENDING

---

### Test 7.2: Update Sekilas
**Admin Steps:**
```
1. Click: "Sekilas Perusahaan"
2. Click: "Edit Sekilas"
3. Update:
   - Jumlah Karyawan: 200
4. Click: "Simpan"
```

**Expected Results:**
- [ ] Data terupdate

**Public Verification:**
```
1. Refresh: http://localhost:8000/tentang-kami
2. Check:
   - [ ] Jumlah karyawan: 200
```

**Status:** ⏳ PENDING

---

## 🧪 TEST 8: INFORMASI PERUSAHAAN & MEDIA SOSIAL

### Test 8.1: Edit Company Info
**Admin Steps:**
```
1. Click: "Informasi Perusahaan" di sidebar
2. Fill Form:
   - Nama: "PT Swabina Gatra"
   - Email: "info@swabinagatra.com"
   - Telepon: "+62-21-1234-5678"
   - Alamat: "Jl. Contoh No. 123, Jakarta, Indonesia"
   - Jam Operasional: "09:00 - 17:00 (Senin - Jumat)"
3. Click: "Simpan"
```

**Expected Results:**
- [ ] Notifikasi sukses

**Public Verification:**
```
1. Open: http://localhost:8000/kontak
2. Check:
   - [ ] Nama perusahaan sesuai
   - [ ] Email sesuai
   - [ ] Telepon sesuai
   - [ ] Alamat sesuai
   - [ ] Jam operasional sesuai
```

**Status:** ⏳ PENDING

---

### Test 8.2: Upload Logo
**Admin Steps:**
```
1. Click: "Informasi Perusahaan"
2. Upload logo perusahaan
3. Click: "Upload"
```

**Expected Results:**
- [ ] Logo berhasil diupload
- [ ] Preview logo muncul

**Public Verification:**
```
1. Open halaman public
2. Check:
   - [ ] Logo muncul di navbar
   - [ ] Logo muncul di footer
```

**Status:** ⏳ PENDING

---

### Test 8.3: Add Social Media Links
**Admin Steps:**
```
1. Click: "Media Sosial" di sidebar
2. Click: "Tambah Social Media"
3. Add Links:
   - Facebook: https://facebook.com/swabinagatra
   - Instagram: https://instagram.com/swabinagatra
   - LinkedIn: https://linkedin.com/company/swabinagatra
   - YouTube: https://youtube.com/@swabinagatra
```

**Expected Results:**
- [ ] Semua links muncul di tabel

**Public Verification:**
```
1. Open halaman public (footer)
2. Check:
   - [ ] Semua social media links muncul
   - [ ] Icons tampil dengan benar
   - [ ] Links bisa diklik
   - [ ] Links mengarah ke URL yang benar
```

**Status:** ⏳ PENDING

---

### Test 8.4: Edit & Delete Social Links
**Admin Steps:**
```
1. Edit Facebook link:
   - Update URL
2. Delete YouTube link
```

**Expected Results:**
- [ ] Edit & delete berhasil

**Public Verification:**
```
1. Refresh halaman public
2. Check:
   - [ ] Facebook link terupdate
   - [ ] YouTube link hilang
```

**Status:** ⏳ PENDING

---

## 🧪 TEST 9: DASHBOARD STATISTICS & CAROUSELS

### Test 9.1: Verify Statistics Cards
**Admin Steps:**
```
1. Open: http://localhost:8000/admin/dashboard
2. Check statistics cards:
   - Berita count
   - Sertifikat count
   - FAQ count
   - Pedoman count
```

**Expected Results:**
- [ ] Berita count = jumlah berita yang ditambahkan
- [ ] Sertifikat count = jumlah sertifikat yang ditambahkan
- [ ] FAQ count = jumlah FAQ yang ditambahkan
- [ ] Pedoman count = jumlah pedoman yang ditambahkan

**Status:** ⏳ PENDING

---

### Test 9.2: Verify Chart
**Admin Steps:**
```
1. Dashboard → Chart section
2. Check bar chart
```

**Expected Results:**
- [ ] Chart menampilkan 4 bars (Berita, Sertifikat, FAQ, Pedoman)
- [ ] Heights sesuai dengan counts
- [ ] Colors berbeda untuk setiap bar
- [ ] Legend muncul

**Status:** ⏳ PENDING

---

### Test 9.3: Verify Carousels
**Admin Steps:**
```
1. Dashboard → Berita Carousel
   - Check: Berita terbaru muncul
   - Click: Navigation buttons
   - Check: Carousel berfungsi
2. Dashboard → Sertifikat Carousel
   - Check: Sertifikat muncul
   - Click: Navigation buttons
   - Check: Carousel berfungsi
```

**Expected Results:**
- [ ] Berita carousel berfungsi
- [ ] Sertifikat carousel berfungsi
- [ ] Navigation buttons bekerja
- [ ] Images tampil dengan benar

**Status:** ⏳ PENDING

---

## 🧪 TEST 10: FINAL VERIFICATION

### Test 10.1: Cross-Feature Verification
**Checks:**
```
1. Add new berita
   - [ ] Dashboard berita count bertambah
   - [ ] Berita muncul di carousel
   - [ ] Berita muncul di public page
2. Add new sertifikat
   - [ ] Dashboard sertifikat count bertambah
   - [ ] Sertifikat muncul di carousel
3. Add new FAQ
   - [ ] Dashboard FAQ count bertambah
   - [ ] FAQ muncul di public page
4. Add new pedoman
   - [ ] Dashboard pedoman count bertambah
   - [ ] Pedoman muncul di public page
```

**Status:** ⏳ PENDING

---

### Test 10.2: Error Handling
**Checks:**
```
1. Try add berita tanpa gambar
   - [ ] Error message muncul
2. Try add FAQ dengan field kosong
   - [ ] Validation error muncul
3. Try upload file terlalu besar
   - [ ] Error message muncul
4. Try delete dengan cancel
   - [ ] Data tidak dihapus
```

**Status:** ⏳ PENDING

---

### Test 10.3: Performance Check
**Checks:**
```
1. Dashboard load time
   - [ ] < 2 seconds
2. Add/Edit/Delete operations
   - [ ] < 1 second
3. Image upload & compression
   - [ ] < 3 seconds
4. Public page load time
   - [ ] < 2 seconds
```

**Status:** ⏳ PENDING

---

## 📊 TESTING SUMMARY

| Test | Status | Notes |
|------|--------|-------|
| Test 1: Berita | ✅ COMPLETE | All CRUD operations working |
| Test 2: FAQ | ⏳ IN PROGRESS | Ready to test |
| Test 3: Pedoman | ⏳ PENDING | Ready to test |
| Test 4: Jejak Langkah | ⏳ PENDING | Ready to test |
| Test 5: Mengapa Memilih Kami | ⏳ PENDING | Ready to test |
| Test 6: Sertifikat | ⏳ PENDING | Ready to test |
| Test 7: Sekilas Perusahaan | ⏳ PENDING | Ready to test |
| Test 8: Company Info & Social | ⏳ PENDING | Ready to test |
| Test 9: Dashboard | ⏳ PENDING | Ready to test |
| Test 10: Final Verification | ⏳ PENDING | Ready to test |

---

**Status:** IN PROGRESS  
**Last Updated:** November 12, 2025  
**Next:** Continue with Test 2 - FAQ
