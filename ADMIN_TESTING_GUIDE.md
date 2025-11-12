# 🧪 ADMIN TESTING GUIDE - MANUAL TESTING

**Status:** ✅ READY FOR TESTING  
**Date:** November 12, 2025  
**Version:** 1.0

---

## 📋 DAFTAR ISI

1. [Setup Testing](#setup-testing)
2. [Berita & Artikel](#berita--artikel)
3. [FAQ](#faq)
4. [Kebijakan & Pedoman](#kebijakan--pedoman)
5. [Jejak Langkah](#jejak-langkah)
6. [Mengapa Memilih Kami](#mengapa-memilih-kami)
7. [Sertifikat & Penghargaan](#sertifikat--penghargaan)
8. [Sekilas Perusahaan](#sekilas-perusahaan)
9. [Informasi Perusahaan](#informasi-perusahaan)
10. [Media Sosial](#media-sosial)

---

## 🔐 SETUP TESTING

### Step 1: Login Admin
```
URL: http://localhost:8000/login
Email: admin@swabinagatra.com
Password: admin123
```

### Step 2: Akses Dashboard
```
URL: http://localhost:8000/admin/dashboard
Expected: Dashboard dengan statistik cards
```

### Step 3: Buka DevTools
```
F12 → Network tab (untuk monitor requests)
F12 → Console (untuk check errors)
```

---

## 📰 BERITA & ARTIKEL

### TEST 1: Tambah Berita
**Admin Side:**
```
1. Login admin
2. Klik "Berita & Artikel" di sidebar
3. Klik "Tambah Berita"
4. Isi form:
   - Gambar: Upload gambar (JPG/PNG)
   - Judul (ID): "Peluncuran Produk Terbaru 2025"
   - Deskripsi (ID): "Kami dengan bangga mempersembahkan produk inovatif..."
   - Judul (EN): "New Product Launch 2025"
   - Deskripsi (EN): "We are proud to present our innovative product..."
5. Klik "Simpan Berita"
6. Tunggu notifikasi sukses
```

**Verification:**
- [ ] Notifikasi "Berita berhasil ditambahkan" muncul
- [ ] Halaman refresh otomatis
- [ ] Berita muncul di tabel

**Public Side:**
```
1. Buka http://localhost:8000/berita
2. Cek apakah berita muncul di halaman public
3. Klik berita untuk melihat detail
```

**Verification:**
- [ ] Berita muncul di halaman public
- [ ] Gambar tampil dengan benar
- [ ] Judul sesuai dengan input admin
- [ ] Deskripsi sesuai dengan input admin
- [ ] Tanggal publish benar

---

### TEST 2: Edit Berita
**Admin Side:**
```
1. Klik "Berita & Artikel" di sidebar
2. Klik tombol "Edit" pada berita yang dibuat
3. Update data:
   - Judul (ID): "Peluncuran Produk Terbaru 2025 - Update"
   - Deskripsi: Tambahkan teks tambahan
4. Klik "Simpan Berita"
```

**Verification:**
- [ ] Notifikasi sukses muncul
- [ ] Data terupdate di tabel

**Public Side:**
```
1. Refresh halaman http://localhost:8000/berita
2. Cek apakah perubahan muncul
```

**Verification:**
- [ ] Judul terupdate di halaman public
- [ ] Deskripsi terupdate

---

### TEST 3: Hapus Berita
**Admin Side:**
```
1. Klik "Berita & Artikel" di sidebar
2. Klik tombol "Hapus" pada berita
3. Konfirmasi di SweetAlert
```

**Verification:**
- [ ] Notifikasi "Berita berhasil dihapus" muncul
- [ ] Berita hilang dari tabel

**Public Side:**
```
1. Refresh halaman http://localhost:8000/berita
2. Cek apakah berita sudah hilang
```

**Verification:**
- [ ] Berita tidak muncul di halaman public

---

## ❓ FAQ

### TEST 1: Tambah FAQ
**Admin Side:**
```
1. Klik "FAQ" di sidebar
2. Klik "Tambah FAQ"
3. Isi form:
   - Pertanyaan (ID): "Apa itu PT Swabina Gatra?"
   - Jawaban (ID): "PT Swabina Gatra adalah perusahaan yang..."
   - Pertanyaan (EN): "What is PT Swabina Gatra?"
   - Jawaban (EN): "PT Swabina Gatra is a company that..."
4. Klik "Simpan"
```

**Verification:**
- [ ] Notifikasi sukses muncul
- [ ] FAQ muncul di tabel

**Public Side:**
```
1. Buka http://localhost:8000/faq
2. Cek apakah FAQ muncul
```

**Verification:**
- [ ] FAQ muncul di halaman public
- [ ] Pertanyaan dan jawaban sesuai

---

### TEST 2: Edit FAQ
**Admin Side:**
```
1. Klik "FAQ" di sidebar
2. Klik "Edit" pada FAQ
3. Update jawaban
4. Klik "Simpan"
```

**Verification:**
- [ ] FAQ terupdate

**Public Side:**
```
1. Refresh http://localhost:8000/faq
2. Cek perubahan
```

**Verification:**
- [ ] Perubahan muncul di halaman public

---

### TEST 3: Hapus FAQ
**Admin Side:**
```
1. Klik "FAQ" di sidebar
2. Klik "Hapus" pada FAQ
3. Konfirmasi
```

**Verification:**
- [ ] FAQ dihapus dari tabel

**Public Side:**
```
1. Refresh http://localhost:8000/faq
2. Cek FAQ sudah hilang
```

**Verification:**
- [ ] FAQ tidak muncul di halaman public

---

## 📚 KEBIJAKAN & PEDOMAN

### TEST 1: Tambah Pedoman
**Admin Side:**
```
1. Klik "Kebijakan & Pedoman" di sidebar
2. Klik "Tambah Pedoman"
3. Isi form:
   - Judul: "Kebijakan Privasi"
   - File: Upload file PDF
   - Gambar: Upload gambar cover
   - Deskripsi: "Kebijakan privasi perusahaan..."
   - Text Align: "left"
4. Klik "Simpan"
```

**Verification:**
- [ ] Notifikasi sukses
- [ ] Pedoman muncul di tabel dengan thumbnail

**Public Side:**
```
1. Buka http://localhost:8000/kebijakan-pedoman
2. Cek apakah pedoman muncul
3. Klik link untuk download file
```

**Verification:**
- [ ] Pedoman muncul di halaman public
- [ ] Gambar tampil
- [ ] File bisa didownload
- [ ] Deskripsi sesuai

---

### TEST 2: Edit Pedoman
**Admin Side:**
```
1. Klik "Kebijakan & Pedoman"
2. Klik "Edit"
3. Update deskripsi
4. Klik "Simpan"
```

**Verification:**
- [ ] Pedoman terupdate

**Public Side:**
```
1. Refresh http://localhost:8000/kebijakan-pedoman
2. Cek perubahan
```

**Verification:**
- [ ] Perubahan muncul

---

### TEST 3: Hapus Pedoman
**Admin Side:**
```
1. Klik "Kebijakan & Pedoman"
2. Klik "Hapus"
3. Konfirmasi
```

**Verification:**
- [ ] Pedoman dihapus

**Public Side:**
```
1. Refresh http://localhost:8000/kebijakan-pedoman
2. Cek pedoman hilang
```

**Verification:**
- [ ] Pedoman tidak muncul

---

## 📅 JEJAK LANGKAH

### TEST 1: Tambah Jejak Langkah
**Admin Side:**
```
1. Klik "Jejak Langkah" di sidebar
2. Klik "Tambah Jejak Langkah"
3. Isi form:
   - Tahun: 2020
   - Deskripsi: "Pendirian PT Swabina Gatra"
   - Gambar: Upload gambar (optional)
4. Klik "Simpan"
```

**Verification:**
- [ ] Notifikasi sukses
- [ ] Jejak muncul di timeline

**Public Side:**
```
1. Buka http://localhost:8000/jejak-langkah
2. Cek timeline
```

**Verification:**
- [ ] Jejak muncul di timeline
- [ ] Tahun dan deskripsi sesuai
- [ ] Timeline terurut dengan benar

---

### TEST 2: Edit Jejak Langkah
**Admin Side:**
```
1. Klik "Jejak Langkah"
2. Klik "Edit"
3. Update deskripsi
4. Klik "Simpan"
```

**Verification:**
- [ ] Jejak terupdate

**Public Side:**
```
1. Refresh http://localhost:8000/jejak-langkah
2. Cek perubahan
```

**Verification:**
- [ ] Perubahan muncul di timeline

---

### TEST 3: Hapus Jejak Langkah
**Admin Side:**
```
1. Klik "Jejak Langkah"
2. Klik "Hapus"
3. Konfirmasi
```

**Verification:**
- [ ] Jejak dihapus

**Public Side:**
```
1. Refresh http://localhost:8000/jejak-langkah
2. Cek jejak hilang
```

**Verification:**
- [ ] Jejak tidak muncul di timeline

---

## ⭐ MENGAPA MEMILIH KAMI

### TEST 1: Tambah Alasan
**Admin Side:**
```
1. Klik "Mengapa Memilih Kami" di sidebar
2. Klik "Tambah"
3. Isi form:
   - Icon: Pilih icon
   - Judul: "Berpengalaman"
   - Deskripsi: "Lebih dari 10 tahun..."
4. Klik "Simpan"
```

**Verification:**
- [ ] Alasan muncul di list

**Public Side:**
```
1. Buka http://localhost:8000/mengapa-memilih-kami
2. Cek apakah alasan muncul
```

**Verification:**
- [ ] Alasan muncul di halaman public
- [ ] Icon tampil
- [ ] Judul dan deskripsi sesuai

---

### TEST 2: Edit Alasan
**Admin Side:**
```
1. Klik "Mengapa Memilih Kami"
2. Klik "Edit"
3. Update deskripsi
4. Klik "Simpan"
```

**Verification:**
- [ ] Alasan terupdate

**Public Side:**
```
1. Refresh http://localhost:8000/mengapa-memilih-kami
2. Cek perubahan
```

**Verification:**
- [ ] Perubahan muncul

---

### TEST 3: Hapus Alasan
**Admin Side:**
```
1. Klik "Mengapa Memilih Kami"
2. Klik "Hapus"
3. Konfirmasi
```

**Verification:**
- [ ] Alasan dihapus

**Public Side:**
```
1. Refresh http://localhost:8000/mengapa-memilih-kami
2. Cek alasan hilang
```

**Verification:**
- [ ] Alasan tidak muncul

---

## 🏆 SERTIFIKAT & PENGHARGAAN

### TEST 1: Tambah Sertifikat
**Admin Side:**
```
1. Klik "Sertifikat & Penghargaan" di sidebar
2. Klik "Tambah Sertifikat"
3. Isi form:
   - Nama: "ISO 9001:2015"
   - Deskripsi: "Sertifikasi kualitas internasional"
   - Gambar: Upload gambar sertifikat
4. Klik "Simpan"
```

**Verification:**
- [ ] Notifikasi sukses
- [ ] Sertifikat muncul di grid card

**Public Side:**
```
1. Buka http://localhost:8000/admin/dashboard
2. Cek carousel "Sertifikat Terkini"
```

**Verification:**
- [ ] Sertifikat muncul di carousel
- [ ] Gambar tampil
- [ ] Nama sesuai

---

### TEST 2: Edit Sertifikat
**Admin Side:**
```
1. Klik "Sertifikat & Penghargaan"
2. Klik "Edit"
3. Update nama/deskripsi
4. Klik "Simpan"
```

**Verification:**
- [ ] Sertifikat terupdate

**Public Side:**
```
1. Refresh dashboard
2. Cek carousel
```

**Verification:**
- [ ] Perubahan muncul di carousel

---

### TEST 3: Hapus Sertifikat
**Admin Side:**
```
1. Klik "Sertifikat & Penghargaan"
2. Klik "Hapus"
3. Konfirmasi
```

**Verification:**
- [ ] Sertifikat dihapus

**Public Side:**
```
1. Refresh dashboard
2. Cek carousel
```

**Verification:**
- [ ] Sertifikat tidak muncul di carousel

---

## 🏢 SEKILAS PERUSAHAAN

### TEST 1: Edit Sekilas Perusahaan
**Admin Side:**
```
1. Klik "Sekilas Perusahaan" di sidebar
2. Klik "Edit Sekilas"
3. Isi form:
   - Judul: "Tentang PT Swabina Gatra"
   - Deskripsi: "Kami adalah perusahaan yang..."
   - Tahun Berdiri: 2010
   - Jumlah Karyawan: 150
   - Gambar: Upload gambar
4. Klik "Simpan"
```

**Verification:**
- [ ] Notifikasi sukses
- [ ] Data muncul di card

**Public Side:**
```
1. Buka http://localhost:8000/tentang-kami
2. Cek apakah data sekilas muncul
```

**Verification:**
- [ ] Judul sesuai
- [ ] Deskripsi sesuai
- [ ] Gambar tampil
- [ ] Tahun berdiri muncul
- [ ] Jumlah karyawan muncul

---

### TEST 2: Update Sekilas Perusahaan
**Admin Side:**
```
1. Klik "Sekilas Perusahaan"
2. Klik "Edit Sekilas"
3. Update deskripsi
4. Klik "Simpan"
```

**Verification:**
- [ ] Data terupdate

**Public Side:**
```
1. Refresh http://localhost:8000/tentang-kami
2. Cek perubahan
```

**Verification:**
- [ ] Perubahan muncul di halaman public

---

## 🏢 INFORMASI PERUSAHAAN

### TEST 1: Edit Company Info
**Admin Side:**
```
1. Klik "Informasi Perusahaan" di sidebar
2. Klik "Edit"
3. Update data:
   - Nama: "PT Swabina Gatra"
   - Email: "info@swabinagatra.com"
   - Telepon: "+62-123-456-789"
   - Alamat: "Jl. Contoh No. 123"
   - Jam Operasional: "09:00 - 17:00"
4. Klik "Simpan"
```

**Verification:**
- [ ] Notifikasi sukses
- [ ] Data terupdate di form

**Public Side:**
```
1. Buka http://localhost:8000/kontak
2. Cek apakah informasi muncul
```

**Verification:**
- [ ] Nama perusahaan sesuai
- [ ] Email sesuai
- [ ] Telepon sesuai
- [ ] Alamat sesuai
- [ ] Jam operasional sesuai

---

### TEST 2: Upload Logo
**Admin Side:**
```
1. Klik "Informasi Perusahaan"
2. Upload logo perusahaan
3. Klik "Upload"
```

**Verification:**
- [ ] Logo berhasil diupload
- [ ] Preview logo muncul

**Public Side:**
```
1. Buka halaman public
2. Cek apakah logo muncul di navbar/footer
```

**Verification:**
- [ ] Logo tampil di halaman public

---

## 📱 MEDIA SOSIAL

### TEST 1: Tambah Social Media Link
**Admin Side:**
```
1. Klik "Media Sosial" di sidebar
2. Klik "Tambah Social Media"
3. Isi form:
   - Tipe: "Facebook"
   - URL: "https://facebook.com/swabinagatra"
4. Klik "Simpan"
```

**Verification:**
- [ ] Notifikasi sukses
- [ ] Link muncul di tabel

**Public Side:**
```
1. Buka halaman public
2. Cek apakah link social media muncul di footer
```

**Verification:**
- [ ] Facebook link muncul
- [ ] Link bisa diklik
- [ ] Link mengarah ke URL yang benar

---

### TEST 2: Edit Social Media Link
**Admin Side:**
```
1. Klik "Media Sosial"
2. Klik "Edit"
3. Update URL
4. Klik "Simpan"
```

**Verification:**
- [ ] Link terupdate

**Public Side:**
```
1. Refresh halaman public
2. Cek link terupdate
```

**Verification:**
- [ ] Link terupdate di halaman public

---

### TEST 3: Hapus Social Media Link
**Admin Side:**
```
1. Klik "Media Sosial"
2. Klik "Hapus"
3. Konfirmasi
```

**Verification:**
- [ ] Link dihapus dari tabel

**Public Side:**
```
1. Refresh halaman public
2. Cek link hilang
```

**Verification:**
- [ ] Link tidak muncul di halaman public

---

## 📊 DASHBOARD STATISTICS

### TEST: Cek Statistik Dashboard
**Admin Side:**
```
1. Buka http://localhost:8000/admin/dashboard
2. Cek statistics cards
```

**Verification:**
- [ ] Berita count sesuai dengan jumlah berita yang ditambahkan
- [ ] FAQ count sesuai
- [ ] Pedoman count sesuai
- [ ] Sertifikat count sesuai
- [ ] Chart menampilkan data dengan benar
- [ ] Carousel berita menampilkan berita terbaru
- [ ] Carousel sertifikat menampilkan sertifikat

---

## 🎯 TESTING CHECKLIST

### Berita & Artikel
- [ ] Tambah berita
- [ ] Edit berita
- [ ] Hapus berita
- [ ] Gambar upload & compress
- [ ] Multilingual support (ID & EN)
- [ ] Data muncul di public page
- [ ] Perubahan muncul di public page
- [ ] Deleted data hilang dari public page

### FAQ
- [ ] Tambah FAQ
- [ ] Edit FAQ
- [ ] Hapus FAQ
- [ ] Multilingual support
- [ ] Data muncul di public page
- [ ] Perubahan muncul di public page
- [ ] Deleted data hilang dari public page

### Kebijakan & Pedoman
- [ ] Tambah pedoman
- [ ] Edit pedoman
- [ ] Hapus pedoman
- [ ] File upload & download
- [ ] Gambar upload & display
- [ ] Data muncul di public page
- [ ] File bisa didownload dari public page

### Jejak Langkah
- [ ] Tambah jejak
- [ ] Edit jejak
- [ ] Hapus jejak
- [ ] Timeline terurut dengan benar
- [ ] Data muncul di public page

### Mengapa Memilih Kami
- [ ] Tambah alasan
- [ ] Edit alasan
- [ ] Hapus alasan
- [ ] Icon tampil
- [ ] Data muncul di public page

### Sertifikat & Penghargaan
- [ ] Tambah sertifikat
- [ ] Edit sertifikat
- [ ] Hapus sertifikat
- [ ] Gambar upload & display
- [ ] Data muncul di dashboard carousel
- [ ] Data muncul di public page

### Sekilas Perusahaan
- [ ] Edit sekilas
- [ ] Gambar upload & display
- [ ] Data muncul di public page
- [ ] Tahun berdiri muncul
- [ ] Jumlah karyawan muncul

### Informasi Perusahaan
- [ ] Edit company info
- [ ] Upload logo
- [ ] Data muncul di public page
- [ ] Logo muncul di public page

### Media Sosial
- [ ] Tambah social link
- [ ] Edit social link
- [ ] Hapus social link
- [ ] Link muncul di public page
- [ ] Link bisa diklik

---

## 📝 NOTES

### Common Issues & Solutions

**Issue:** Gambar tidak muncul di public page
```
Solution:
1. Cek apakah storage link sudah dibuat: php artisan storage:link
2. Cek permission folder storage/app/public/
3. Clear browser cache
4. Refresh halaman
```

**Issue:** Data tidak terupdate di public page
```
Solution:
1. Refresh halaman public (Ctrl+F5)
2. Clear browser cache
3. Cek database apakah data tersimpan
4. Cek Laravel logs untuk error
```

**Issue:** File tidak bisa didownload
```
Solution:
1. Cek apakah file tersimpan di storage/app/public/
2. Cek permission file
3. Cek apakah path file benar di database
```

---

## ✅ FINAL VERIFICATION

Setelah semua test selesai, verifikasi:

- [ ] Semua fitur admin berfungsi
- [ ] Semua data muncul di public page
- [ ] Perubahan data muncul di public page
- [ ] Deleted data hilang dari public page
- [ ] Gambar upload & display dengan benar
- [ ] File upload & download dengan benar
- [ ] Multilingual support bekerja
- [ ] Dashboard statistics akurat
- [ ] Tidak ada error di console
- [ ] Tidak ada error di Laravel logs

---

**Status:** ✅ READY FOR MANUAL TESTING

**Last Updated:** November 12, 2025  
**Version:** 1.0 - Complete Testing Guide  
**Quality:** ⭐⭐⭐⭐⭐ (5/5 - Comprehensive)
