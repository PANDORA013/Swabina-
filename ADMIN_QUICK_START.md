# 🚀 ADMIN QUICK START GUIDE

**Panduan Cepat untuk Admin Mengakses dan Mengelola Website**

---

## 🔑 STEP 1: LOGIN

### URL Login
```
http://localhost:8000/login
```

### Credentials
```
Email: admin@swabinagatra.com
Password: admin123
```

### Setelah Login
```
Redirect otomatis ke: http://localhost:8000/admin/dashboard
```

---

## 📊 STEP 2: DASHBOARD

### Halaman Dashboard Menampilkan:
- 📰 Total Berita
- ❓ Total FAQ
- 📋 Total Pedoman
- 🏆 Total Sertifikat

### Akses Menu Admin:
```
Sidebar atau Menu Bar di Dashboard
```

---

## 📰 STEP 3: KELOLA BERITA

### Akses
```
Admin Dashboard → Berita
atau
http://localhost:8000/admin/berita
```

### Operasi
```
✅ Lihat Semua Berita
✅ Tambah Berita Baru
✅ Edit Berita
✅ Hapus Berita
```

### Form Input
```
- Judul (Title)
- Deskripsi (Description)
- Gambar (Image)
- Status (Active/Inactive)
```

### Hasil
```
Berita muncul di halaman public: /berita
```

---

## ❓ STEP 4: KELOLA FAQ

### Akses
```
Admin Dashboard → FAQ
atau
http://localhost:8000/admin/faq
```

### Operasi
```
✅ Lihat Semua FAQ
✅ Tambah FAQ Baru
✅ Edit FAQ
✅ Hapus FAQ
```

### Form Input
```
- Pertanyaan (Question)
- Jawaban (Answer)
```

### Hasil
```
FAQ muncul di halaman public: /faq
```

---

## 🏢 STEP 5: KELOLA COMPANY INFO

### Akses
```
Admin Dashboard → Company Info
atau
http://localhost:8000/company-info
```

### Operasi
```
✅ Edit Informasi Perusahaan
✅ Upload Logo Perusahaan
✅ Upload ISO Logo
✅ Hapus ISO Logo
```

### Data yang Bisa Diubah
```
- Nama Perusahaan
- Tagline
- Deskripsi
- Alamat Kantor Pusat
- Alamat Cabang
- Email
- Telepon
- Jam Operasional
```

### Hasil
```
Informasi update di seluruh website:
- Header
- Footer
- Halaman Kontak
- Halaman Tentang Kami
```

---

## 📱 STEP 6: KELOLA SOCIAL MEDIA

### Akses
```
Admin Dashboard → Social Media
atau
http://localhost:8000/admin/social-media
```

### Operasi
```
✅ Lihat Semua Link
✅ Tambah Link Baru
✅ Edit Link
✅ Hapus Link
```

### Platform yang Tersedia
```
- Facebook
- Instagram
- LinkedIn
- YouTube
- WhatsApp
- Twitter
```

### Hasil
```
Link muncul di Footer dan Social Media Section
```

---

## 📋 STEP 7: KELOLA PEDOMAN

### Akses
```
Admin Dashboard → Pedoman
atau
http://localhost:8000/admin/pedoman
```

### Operasi
```
✅ Lihat Semua Pedoman
✅ Tambah Pedoman Baru
✅ Hapus Pedoman
```

### Form Input
```
- Judul (Title)
- Deskripsi (Description)
- File (PDF/Document)
- Gambar (Image)
```

### Hasil
```
Pedoman muncul di halaman: /kebijakan-pedoman
```

---

## 🎯 STEP 8: KELOLA JEJAK LANGKAH (Timeline)

### Akses
```
Admin Dashboard → Jejak Langkah
atau
http://localhost:8000/admin/jejak-langkah
```

### Operasi
```
✅ Lihat Timeline
✅ Tambah Milestone Baru
✅ Edit Milestone
✅ Hapus Milestone
```

### Form Input
```
- Tahun (Year)
- Judul (Title)
- Deskripsi (Description)
- Gambar (Image)
```

### Hasil
```
Timeline muncul di halaman: /jejak-langkah
```

---

## ⭐ STEP 9: KELOLA WHY CHOOSE US

### Akses
```
Admin Dashboard → Why Choose Us
atau
http://localhost:8000/admin/why-choose-us
```

### Operasi
```
✅ Lihat Semua Alasan
✅ Tambah Alasan Baru
✅ Edit Alasan
✅ Hapus Alasan
✅ Atur Urutan (Drag-Drop)
```

### Form Input
```
- Judul (Title)
- Deskripsi (Description)
- Icon (Icon Class)
- Gambar (Image)
- Urutan (Order)
```

### Hasil
```
Alasan muncul di halaman: /mengapa-memilih-kami
```

---

## 🔄 REAL-TIME UPDATES

### Bagaimana Data Update?

```
1. Admin Input Data di Admin Panel
   ↓
2. Data Disimpan ke MySQL Database
   ↓
3. Website Public Otomatis Update
   ↓
4. Pengunjung Melihat Data Terbaru
```

### Tidak Perlu:
```
❌ Restart Server
❌ Clear Cache Manual
❌ Publish Manual
```

### Semuanya Otomatis!
```
✅ Real-time sync
✅ Instant update
✅ No downtime
```

---

## 📱 AKSES DARI BERBAGAI PERANGKAT

### Desktop
```
http://localhost:8000/admin/dashboard
```

### Mobile
```
http://[IP-ADDRESS]:8000/admin/dashboard
```

### Contoh IP Address
```
192.168.1.100:8000/admin/dashboard
```

---

## 🔐 LOGOUT

### Cara Logout
```
Klik "Logout" di Dashboard
atau
POST /logout
```

### Redirect
```
Kembali ke halaman login: /login
```

---

## ⚠️ TIPS & TRIK

### 1. Backup Data
```
Selalu backup database secara berkala
```

### 2. Upload File
```
Pastikan file size tidak terlalu besar
Format gambar: JPG, PNG, WebP
Format dokumen: PDF, DOC, DOCX
```

### 3. SEO
```
Isi semua field dengan data yang relevan
Gunakan keyword yang tepat di judul dan deskripsi
```

### 4. Performance
```
Kompres gambar sebelum upload
Gunakan deskripsi yang singkat dan jelas
```

---

## 🆘 TROUBLESHOOTING

### Login Gagal
```
✓ Pastikan email dan password benar
✓ Cek koneksi database
✓ Clear browser cache
```

### Data Tidak Muncul di Public
```
✓ Pastikan data sudah disimpan
✓ Refresh halaman public
✓ Cek koneksi database
```

### Upload Gagal
```
✓ Cek ukuran file
✓ Cek format file
✓ Cek permission folder
```

### Database Error
```
✓ Pastikan MySQL running
✓ Cek koneksi database di .env
✓ Jalankan: php artisan migrate
```

---

## 📞 SUPPORT

### Jika Ada Masalah
```
1. Cek error message di browser
2. Cek Laravel logs: storage/logs/
3. Hubungi developer
```

---

## ✅ CHECKLIST SEBELUM GO LIVE

- [ ] Semua data sudah diinput
- [ ] Logo dan gambar sudah diupload
- [ ] Social media links sudah diset
- [ ] Company info sudah lengkap
- [ ] FAQ sudah ditambahkan
- [ ] Berita sudah dipublikasi
- [ ] Timeline sudah dibuat
- [ ] Why Choose Us sudah diatur
- [ ] Database sudah di-backup
- [ ] Testing di berbagai browser

---

**Status:** ✅ READY TO USE  
**Last Updated:** November 12, 2025  
**Support:** Available 24/7
