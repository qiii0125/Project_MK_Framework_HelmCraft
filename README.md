# HelmCraft 🪖
**Laravel Web Application Security & Vulnerability Fix**

HelmCraft adalah aplikasi berbasis web yang dibangun menggunakan *framework* Laravel. Repositori ini merupakan hasil perbaikan dari versi sebelumnya, dengan fokus utama pada penanganan celah keamanan (*security vulnerabilities*), perbaikan *Query Exception* pada database, dan implementasi komponen keamanan bawaan Laravel.

## 🛠️ Tech Stack
- **Framework:** Laravel (PHP)
- **Database:** MySQL / MariaDB (via XAMPP)
- **Architecture:** MVC (Model-View-Controller)

## 🚀 Key Improvements & Features
- **Query Exception Handling:** Memperbaiki *bug* relasi tabel dan *query builder* yang menyebabkan aplikasi *crash* (Illuminate\Database\QueryException).
- **Security Enhancements:** Mengamankan akses *database* dan mencegah eksekusi *query* yang tidak valid pada tabel `pesanan_helm` dan tabel bawaan Laravel.
- **Data Integrity:** Menjaga struktur tabel bawaan sistem (`users`, `sessions`, `migrations`, dll) agar tetap tersinkronisasi dengan *custom table*.

## ⚙️ Cara Instalasi & Menjalankan Proyek Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di mesin lokal:

### 1. Clone Repository
```bash
git clone https://github.com/qiii0125/Project_MK_Framework_HelmCraft.git
cd Project_MK_Framework_HelmCraft
```

### 2. Install Dependencies
Pastikan Composer sudah ter-install di komputer Anda.
```bash
composer install
```

### 3. Setup Environment Variables
Copy file `.env.example` menjadi `.env`.
```bash
cp .env.example .env
```
Buka file `.env` dan pastikan konfigurasi database sudah sesuai:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_rhelm
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database (Import File .sql)
Karena proyek ini menggunakan tabel khusus beserta data relasionalnya, silakan import database secara manual:
1. Buka XAMPP, nyalakan modul **Apache** dan **MySQL**.
2. Buka browser dan masuk ke `http://localhost/phpmyadmin`.
3. Buat database baru dengan nama `db_rhelm`.
4. Pilih database tersebut, lalu masuk ke tab **Import**.
5. Upload file `db_rhelm.sql` yang ada di dalam folder `database-backup` (atau root folder).
6. Klik **Go** / **Import**.

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Jalankan Local Server
```bash
php artisan serve
```
Aplikasi dapat diakses melalui browser di `http://127.0.0.1:8000`.