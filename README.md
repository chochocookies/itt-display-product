# 📦 ITT-Display-Product: Enterprise Product Management & Showcase System

Sistem manajemen informasi produk (*Product Information Management*) dan etalase digital (*Showcase System*) berbasis framework Laravel. Proyek ini mengintegrasikan pemrosesan data di sisi server (*server-side business logic*) dengan arsitektur front-end modern untuk menyajikan visualisasi katalog produk yang cepat, dinamis, aman, dan terstruktur.

Aplikasi ini dirancang untuk menyelesaikan masalah manajemen inventaris produk skala menengah, pembaruan stok berkala, serta penyajian informasi spesifikasi produk kepada pelanggan secara interaktif.

---

## 📌 Daftar Isi
1. [Fitur Utama Sistem](#-fitur-utama-sistem)
2. [Arsitektur & Spesifikasi Teknologi](#-arsitektur--spesifikasi-teknologi)
3. [Arsitektur Folder Proyek (Deep Dive)](#-arsitektur-folder-proyek-deep-dive)
4. [Skema & Blueprint Basis Data (SQL)](#-skema--blueprint-basis-data-sql)
5. [Alur Kerja Sistem (Data Flow - MVC)](#-alur-kerja-sistem-data-flow---mvc)
6. [Instalasi & Konfigurasi Lingkungan Lokal](#-instalasi--konfigurasi-lingkungan-lokal)
7. [Skrip Automasi Perintah Artisan](#-skrip-automasi-perintah-artisan)

---

## 🚀 Fitur Utama Sistem

* **🗂️ Dynamic Product Directory & CRUD Engine**: Manajemen penuh data produk (Tambah, Baca, Ubah, Hapus) yang dilengkapi dengan validasi input server-side yang ketat guna mencegah inkonsistensi data.
* **🔍 Multi-Criteria Search & Filter**: Fitur pencarian produk secara *real-time* berdasarkan nama, kategori, rentang harga, maupun status ketersediaan stok produk.
* **🖼️ Media & Image Asset Management**: Sistem penanganan unggahan foto produk otomatis yang terintegrasi dengan sistem penyimpanan Laravel (`storage/app/public`) dilengkapi penamaan file unik otomatis.
* **⚡ Modern Asset Bundling via Vite**: Kompilasi aset front-end (CSS & JavaScript) secara instan guna meminimalkan ukuran file produksi untuk pemuatan halaman yang lebih responsif.
* **🛡️ Enterprise-Grade Security Suite**: Perlindungan bawaan terhadap serangan web umum, termasuk *Cross-Site Request Forgery* (CSRF) pada form, penanganan *SQL Injection* otomatis via Eloquent, dan sanitasi XSS.

---

## 🛠️ Arsitektur & Spesifikasi Teknologi

Proyek ini memanfaatkan ekosistem pengembangan *Full-Stack* PHP modern dengan spesifikasi berikut:

* **PHP >= 8.1 / Laravel Framework**: Fondasi utama penanganan perutean (*routing*), arsitektur keamanan, pengontrol (*controllers*), dan model data objek.
* **Vite Bundler & JavaScript**: Mesin pengompilasi aset front-end berperforma tinggi untuk mengelola logika interaktivitas UI klien.
* **Blade Templating Engine**: Mesin pembuat komponen antarmuka web di sisi server yang mendukung pewarisan tata letak (*layout inheritance*) demi efisiensi kode UI.
* **Composer**: Manajer dependensi paket eksternal (seperti pustaka manipulasi gambar atau generator PDF jika diintegrasikan).
* **MySQL / MariaDB**: Sistem Manajemen Basis Data Relasional (RDBMS) utama untuk penyimpanan data produk yang persisten.

---

## 📂 Arsitektur Folder Proyek (Deep Dive)

Berikut adalah pemetaan berkas internal untuk mempermudah navigasi pengembangan komponen:

```text
itt-display-product/
│
├── app/                   # Logika Inti Aplikasi (Prinsip Kerja Backend)
│   ├── Http/              # Penanganan Request & Response HTTP
│   │   ├── Controllers/   # Pengendali Alur Data (ProductController, dsb)
│   │   └── Requests/      # Kelas Validasi Formulir Input Produk kustom
│   └── Models/            # Representasi Tabel Database (Product.php, Category.php)
│
├── config/                # Berkas Konfigurasi Global (App, Database, Filesystems)
│
├── database/              # Modul Migrasi & Struktur Basis Data
│   ├── migrations/        # Blueprint Tabel SQL (Membuat & Mengubah Struktur Tabel)
│   └── seeders/           # Skrip Pengisi Data Uji Otomatis (Dummy Data Products)
│
├── public/                # Gerbang Masuk Utama Web (index.php, CSS & JS Terkompilasi)
│
├── resources/             # Sumber Daya Front-End (Source Code Mentah)
│   ├── views/             # File Template *.blade.php (Layout, Halaman Produk)
│   ├── css/               # File Gaya Visual Mentah
│   └── js/                # Logika Script Interaktivitas Klien
│
├── routes/                # Definisi Jalur Navigasi URL
│   ├── web.php            # Rute Antarmuka Web untuk Pengguna & Admin
│   └── api.php            # Rute Endpoint API (Untuk Integrasi Mobile/Aplikasi Lain)
│
└── storage/               # Penyimpanan Internal (Berkas Foto Produk yang Diunggah)
```

---

## 🗃️ Skema & Blueprint Basis Data (SQL)

Aplikasi ini menggunakan relasi database terstruktur. Berikut adalah representasi logika tabel utama (`products`):

```sql
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id INT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image_path VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
```

---

## 🧠 Alur Kerja Sistem (Data Flow - MVC)

Proyek ini mengimplementasikan pola arsitektur **Model-View-Controller (MVC)** yang berjalan asinkronus:

1. **Request**: Pengguna mengakses halaman produk via Browser ➔ Diterima oleh file `routes/web.php`.
2. **Controller**: Rute meneruskan instruksi ke `ProductController`. Pengendali ini meminta data spesifik ke komponen Model.
3. **Model**: `Product.php` melakukan kueri SQL aman ke basis data MySQL, mengambil data katalog, dan mengembalikannya ke Controller.
4. **View**: Controller menerima data mentah, melakukan pemrosesan logika, lalu mengirimkannya ke file `index.blade.php` di dalam folder `resources/views/`.
5. **Response**: Blade merender data produk menjadi HTML statis, digabungkan dengan aset CSS/JS oleh Vite, lalu dikirimkan kembali ke Browser pengguna sebagai halaman web utuh.

---

## 💻 Instalasi & Konfigurasi Lingkungan Lokal

Ikuti langkah-langkah teknis berikut untuk menjalankan salinan lingkungan proyek ini di komputer lokal Anda:

### 1. Persiapan Kloning & Dependensi
```bash
# Kloning repositori ini
git clone https://github.com

# Masuk ke folder proyek
cd itt-display-product

# Instal paket pustaka backend PHP via Composer
composer install

# Instal paket dependensi pustaka front-end via npm
npm install
```

### 2. Pengondisian Variabel Lingkungan (.env)
Salin file konfigurasi contoh dan buat file `.env` baru:
```bash
cp .env.example .env
```
Buka file `.env` tersebut menggunakan teks editor Anda (seperti VS Code), lalu sesuaikan konfigurasi koneksi database lokal Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_lokal_anda
DB_USERNAME=root
DB_PASSWORD=skrip_password_anda_jika_ada
```

### 3. Migrasi & Pembuatan Kunci Keamanan
```bash
# Membuat kode kunci enkripsi aplikasi unik
php artisan key:generate

# Menjalankan migrasi struktur tabel ke database MySQL Anda
php artisan migrate

# Mengisi database dengan data produk contoh (Jika skrip seeder tersedia)
php artisan db:seed

# Membuat simbolis link untuk folder unggahan gambar agar bisa diakses publik
php artisan storage:link
```

### 4. Menjalankan Server Aplikasi
Anda perlu menjalankan **dua terminal** secara bersamaan untuk proses pengembangan:
* **Terminal 1 (Server Backend PHP):**
  ```bash
  php artisan serve
  ```
  *(Aplikasi Anda akan berjalan di alamat `http://127.0.0.1:8000`)*
* **Terminal 2 (Compiler Kompilasi Visual Vite):**
  ```bash
  npm run dev
  ```

---

## 🚀 Skrip Automasi Perintah Artisan

Selama tahap pengembangan, Anda dapat memanfaatkan beberapa perintah CLI Artisan bawaan Laravel berikut:
* `php artisan make:controller ProductController --resource`: Membuat file Controller produk lengkap dengan fungsi standar (index, create, store, edit, update, destroy).
* `php artisan make:model Product -m`: Membuat file Model baru sekaligus otomatis membuat berkas skema migrasi tabelnya.
* `npm run build`: Mengompilasi, meminifikasi, dan mengoptimasi seluruh aset CSS/JS front-end ke dalam folder publik agar siap digunakan dalam tahap produksi (*production-ready*).

---
Dikembangkan dengan penuh dedikasi oleh [chochocookies](https://github.com).
