# 📊 INFORMASI DATABASE PROJECT MAGANG

**Date:** November 12, 2025  
**Project:** PT Swabina Gatra - Project Magang

---

## ✅ JENIS DATABASE YANG DIGUNAKAN

### **MYSQL** ✅ (Primary Database)

Sistem database yang digunakan di project ini adalah **MySQL**, bukan SQLite.

---

## 📋 KONFIGURASI DATABASE

### File Konfigurasi
- **File:** `config/database.php`
- **Baris 18:** `'default' => env('DB_CONNECTION', 'mysql'),`

### Konfigurasi MySQL
```php
'mysql' => [
    'driver' => 'mysql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
]
```

---

## 🔧 DETAIL KONFIGURASI MYSQL

| Parameter | Nilai Default | Keterangan |
|-----------|---------------|-----------|
| **Driver** | mysql | Menggunakan MySQL |
| **Host** | 127.0.0.1 | Localhost |
| **Port** | 3306 | Port standar MySQL |
| **Database** | forge | Nama database default |
| **Username** | forge | User default |
| **Password** | (kosong) | Password default |
| **Charset** | utf8mb4 | Karakter set UTF-8 |
| **Collation** | utf8mb4_unicode_ci | Collation Unicode |

---

## 📦 DATABASE AKTUAL YANG DIGUNAKAN

### Database Name
```
swabina01
```

### Host
```
localhost (127.0.0.1)
```

### Port
```
3306 (standar MySQL)
```

### User
```
root
```

### Password
```
(kosong/empty)
```

---

## 🗄️ TABEL-TABEL YANG ADA

Total: **11 Active Tables**

```
1. users                    - User authentication
2. company_info             - Company information
3. beritas                  - News/Articles
4. faqs                     - FAQ content
5. jejak_langkahs           - Company timeline
6. pedomans                 - Guidelines/Policies
7. visi_misi_budayas        - Vision/Mission/Culture
8. social_links             - Social media links
9. password_reset_tokens    - Password reset
10. personal_access_tokens  - API tokens
11. failed_jobs             - Failed job queue
```

---

## 🔄 ALTERNATIF DATABASE YANG TERSEDIA

Konfigurasi Laravel mendukung beberapa database:

| Database | Status | Konfigurasi |
|----------|--------|-------------|
| **MySQL** | ✅ AKTIF | Digunakan saat ini |
| **SQLite** | ⚠️ Tersedia | Bisa diubah di .env |
| **PostgreSQL** | ⚠️ Tersedia | Bisa diubah di .env |
| **SQL Server** | ⚠️ Tersedia | Bisa diubah di .env |

---

## 🔀 CARA MENGUBAH DATABASE (Jika Diperlukan)

### Untuk Mengubah ke SQLite

1. **Edit file `.env`:**
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=/path/to/database.sqlite
   ```

2. **Jalankan migrations:**
   ```bash
   php artisan migrate
   ```

### Untuk Mengubah ke PostgreSQL

1. **Edit file `.env`:**
   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=password
   ```

2. **Jalankan migrations:**
   ```bash
   php artisan migrate
   ```

---

## ✅ VERIFIKASI DATABASE

### Cek Koneksi Database
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

### Lihat Tabel yang Ada
```bash
php artisan tinker
>>> DB::select('SHOW TABLES');
```

### Cek Jumlah Records
```bash
php artisan tinker
>>> DB::table('users')->count();
>>> DB::table('beritas')->count();
>>> DB::table('company_info')->count();
```

---

## 📊 INFORMASI TEKNIS

### MySQL Version
- Minimal: 5.7
- Recommended: 8.0+

### Laravel Version
- Version: 12.1.1
- Database Driver: PDO MySQL

### PHP Version
- Version: 8.4.11
- PDO MySQL Extension: Required

---

## 🎯 KESIMPULAN

**Database yang digunakan: MYSQL ✅**

- ✅ MySQL adalah database utama
- ✅ 11 tabel aktif
- ✅ Database: swabina01
- ✅ Host: localhost:3306
- ✅ User: root
- ✅ Charset: utf8mb4

**Sistem database sudah siap untuk production!**

---

**Last Updated:** November 12, 2025  
**Status:** ✅ Production Ready
