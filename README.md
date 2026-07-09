# SPK SMART Marketing

Sistem Pendukung Keputusan (SPK) berbasis web untuk menentukan dan merekomendasikan strategi pemasaran terbaik menggunakan metode **SMART** (*Simple Multi Attribute Rating Technique*). 

Sistem ini membantu perusahaan secara objektif mengevaluasi berbagai alternatif pemasaran berdasarkan multi-kriteria yang telah ditentukan beserta bobotnya.

## 🚀 Fitur Utama

- **Otentikasi & Keamanan (RBAC)**
  - Fitur Login dan Register (Pendaftaran akun baru otomatis menjadi `user`).
  - Pembagian Hak Akses (Role-Based Access Control) antara `admin` dan `user`.
- **Manajemen Pengguna (Admin Only)**
  - CRUD (Create, Read, Update, Delete) akun pengguna.
  - Penentuan peran akun (Admin atau User).
- **Manajemen Kriteria (Admin Only)**
  - Pengelolaan data kriteria penilaian beserta bobotnya.
  - Dukungan tipe kriteria: *Benefit* (Semakin besar semakin baik) dan *Cost* (Semakin kecil semakin baik).
- **Manajemen Alternatif (Admin Only)**
  - Pengelolaan daftar alternatif (strategi pemasaran) yang akan dievaluasi.
- **Penilaian & Matriks Keputusan (Admin Only)**
  - Input nilai evaluasi untuk masing-masing alternatif terhadap seluruh kriteria yang ada.
- **Kalkulasi SMART Otomatis (Semua Pengguna)**
  - Normalisasi bobot secara otomatis.
  - Perhitungan nilai *Utility* (menggunakan nilai min/max).
  - Perhitungan nilai akhir dan pemeringkatan (Ranking) alternatif terbaik.
- **Tampilan Modern & Responsif**
  - Antarmuka elegan menggunakan efek desain *Glassmorphism*.
  - Dasbor informatif dengan statistik ringkas.

## 🛠️ Tech Stack

- **Framework Backend:** [Laravel](https://laravel.com/) (PHP)
- **Frontend:** HTML5, CSS3, Blade Templating Engine
- **UI Framework:** [Bootstrap 5](https://getbootstrap.com/) & Custom CSS (Glassmorphism)
- **Database:** MySQL / MariaDB (Dapat disesuaikan menggunakan SQLite/PostgreSQL bawaan Laravel)

## 🗺️ Roadmap Pembuatan Program

1. **Fase 1: Perencanaan & Setup Awal**
   - Instalasi kerangka kerja (Laravel).
   - Penyiapan repositori dan struktur direktori MVC.
2. **Fase 2: Desain Basis Data**
   - Pembuatan *Migration* untuk tabel `criteria`, `alternatives`, dan `scores`.
   - Konfigurasi relasi antar tabel (Model Eloquent).
3. **Fase 3: Implementasi Logika Inti (Metode SMART)**
   - Algoritma dinamis untuk mencari nilai minimum dan maksimum dari setiap kriteria.
   - Algoritma perhitungan nilai *Utility* untuk kriteria jenis *Cost* dan *Benefit*.
   - Kalkulasi nilai akhir (*Weighted Value*).
4. **Fase 4: Antarmuka Pengguna Dasar (Views)**
   - Pembuatan CRUD antarmuka untuk data Kriteria dan Alternatif.
   - Pembuatan antarmuka tabel Input Penilaian.
   - Halaman hasil (Ranking & Utility Matrix).
5. **Fase 5: Sistem Keamanan & Multi-Role (RBAC)**
   - Implementasi Login dan Registrasi kustom.
   - Penambahan kolom `role` pada tabel `users`.
   - Pembuatan Middleware `IsAdmin` untuk membatasi akses pada rute sensitif.
   - Pembuatan modul Manajemen Pengguna.
6. **Fase 6: Peningkatan UI / UX (Finishing)**
   - Perombakan tata letak (Layout) dengan tema modern (Light theme & Dark theme).
   - Penambahan elemen *Glassmorphism* dan *Ambient blobs* pada halaman otentikasi.
   - Pembatasan visibilitas tombol/menu aksi berdasarkan *Role* pengguna secara dinamis.

## 💻 Cara Instalasi dan Menjalankan (Di Perangkat Lain)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di komputer/perangkat lokal Anda:

### Prasyarat:
- **PHP** (Versi 8.1 atau lebih baru)
- **Composer**
- **Database Server** (MySQL/MariaDB, contoh: XAMPP, Laragon, dsb.)
- **Git** (Opsional, untuk *cloning* repositori)

### Langkah-langkah:

1. **Clone Repositori**
   Buka terminal atau *command prompt*, jalankan perintah berikut:
   ```bash
   git clone https://github.com/akmalrivaldi/spk-smart-marketing.git
   cd spk-smart-marketing
   ```

2. **Instal Dependensi (Vendor)**
   Jalankan Composer untuk mengunduh pustaka yang dibutuhkan Laravel:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   Salin file konfigurasi bawaan dan sesuaikan namanya menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   > Pada Windows (Command Prompt), Anda bisa menggunakan perintah `copy .env.example .env`

4. **Generate Application Key**
   Buat kunci aplikasi unik agar *session* dan enkripsi dapat berjalan:
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi Database**
   Buka file `.env` di teks editor (seperti VS Code), lalu cari bagian konfigurasi database dan ubah sesuai dengan pengaturan *database* di komputer Anda. Misalnya (jika menggunakan MySQL bawaan XAMPP):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_spk_marketing
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *Catatan: Pastikan Anda telah membuat database kosong bernama `db_spk_marketing` (atau nama lain yang Anda pilih) melalui phpMyAdmin / aplikasi database lainnya.*

6. **Jalankan Migrasi Database**
   Perintah ini akan membuat struktur tabel-tabel yang diperlukan di dalam database Anda:
   ```bash
   php artisan migrate
   ```

7. **Jalankan Development Server**
   Terakhir, jalankan server bawaan Laravel:
   ```bash
   php artisan serve
   ```

8. **Akses Aplikasi**
   Buka *web browser* (Chrome, Firefox, dsb.) dan kunjungi alamat:
   ```text
   http://127.0.0.1:8000
   ```

### 💡 Catatan Setelah Instalasi
Karena awalnya database kosong, Anda perlu membuat akun Admin untuk bisa mengakses menu Manajemen Kriteria, Alternatif, dan Penilaian:
1. Akses halaman `http://127.0.0.1:8000/register` dan daftarkan akun baru Anda. Secara default, akun ini akan berstatus **User**.
2. Masuk ke aplikasi *database manager* Anda (seperti phpMyAdmin).
3. Buka tabel `users`, cari baris akun yang baru Anda buat, lalu ubah kolom `role` dari `user` menjadi `admin`.
4. Muat ulang halaman (Refresh) aplikasi, dan fitur-fitur khusus admin kini akan terbuka!
