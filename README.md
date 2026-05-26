# 🏘️ Website Desa Lombang

Website resmi Desa Lombang — sistem informasi desa berbasis web yang menyediakan informasi publik seperti berita desa, profil desa (visi & misi), struktur organisasi, dan peta lokasi desa.

Dikembangkan oleh **Tim KKN UNWIR 2025**.

---

## 📋 Fitur

- **Halaman Publik**
  - Beranda dengan hero section dan navigasi
  - Daftar berita desa dengan pagination
  - Detail berita lengkap dengan fitur bagikan ke WhatsApp, Facebook & Instagram
  - Profil desa (visi, misi, struktur organisasi)
  - Peta lokasi desa (Google Maps embed)

- **Panel Admin (Dashboard)**
  - Login admin dengan autentikasi aman (password hashed)
  - Manajemen berita (tambah, edit, hapus) dengan upload gambar
  - Manajemen profil desa (visi, misi, struktur organisasi, peta)
  - Statistik jumlah berita & preview berita terbaru

---

## 🛠️ Tech Stack

| Komponen       | Teknologi                                      |
|----------------|-------------------------------------------------|
| Backend        | PHP (Native)                                    |
| Database       | MySQL                                           |
| Frontend       | HTML, CSS, JavaScript                           |
| CSS Framework  | Bootstrap 4.6 + SB Admin 2                      |
| Icons          | Font Awesome 5                                  |
| Rich Editor    | CKEditor 4                                      |
| Data Table     | DataTables                                      |
| Font           | Google Fonts (Nunito)                            |
| Web Server     | Apache (Laragon / XAMPP / sejenisnya)            |

---

## 📁 Struktur Project

```
lombang/
├── config.php.example     # Template konfigurasi database
├── index.php              # Halaman utama (publik)
├── detail_berita.php      # Halaman detail berita
├── login.php              # Halaman login admin
├── dashboard.php          # Dashboard admin
├── berita.php             # Manajemen berita (admin)
├── profil.php             # Manajemen profil desa (admin)
├── logout.php             # Proses logout
├── lombang.sql            # File dump database
├── css/                   # File CSS (SB Admin 2)
├── js/                    # File JavaScript
├── img/                   # Aset gambar statis
│   ├── uploads/           # Gambar berita (user-uploaded)
│   └── struktur/          # Gambar struktur organisasi
├── vendor/                # Library pihak ketiga (Bootstrap, jQuery, dll)
├── scss/                  # Source SCSS (SB Admin 2)
└── README.md
```

---

## ⚙️ Instalasi & Setup

### Prasyarat

- PHP >= 7.4
- MySQL >= 5.7
- Web server (Apache/Nginx) — disarankan menggunakan [Laragon](https://laragon.org/) atau XAMPP

### Langkah-langkah

1. **Clone repository**
   ```bash
   git clone https://github.com/USERNAME/lombang.git
   ```

2. **Pindahkan ke direktori web server**
   ```
   # Laragon: C:\laragon\www\lombang
   # XAMPP:   C:\xampp\htdocs\lombang
   ```

3. **Buat database**
   - Buka phpMyAdmin
   - Buat database baru dengan nama `lombang`
   - Import file `lombang.sql`

4. **Konfigurasi database**
   ```bash
   cp config.php.example config.php
   ```
   Buka `config.php` dan sesuaikan kredensial database:
   ```php
   $host     = "localhost";
   $username = "root";
   $password = "";           // sesuaikan password MySQL Anda
   $database = "lombang";
   ```

5. **Akses website**
   - Publik: `http://localhost/lombang/`
   - Admin: `http://localhost/lombang/login.php`

### Login Admin Default

| Username | Password |
|----------|----------|
| `admin`  | `admin`  |

> ⚠️ **Penting:** Segera ubah password admin setelah instalasi pertama!

---

## 📸 Screenshot

### Halaman Publik
> _Halaman utama menampilkan hero section, berita terbaru, profil desa, dan peta lokasi._

### Dashboard Admin
> _Panel admin untuk mengelola berita dan profil desa._

---

## 🔒 Keamanan

- ✅ Password admin di-hash menggunakan `password_hash()` (bcrypt)
- ✅ Login menggunakan prepared statement (mencegah SQL Injection)
- ✅ File `config.php` tidak di-push ke GitHub (tercantum di `.gitignore`)
- ✅ File upload gambar pengguna tidak di-push ke repository

---

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b fitur/fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur/fitur-baru`)
5. Buat Pull Request

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👥 Tim Pengembang

**KKN UNWIR 2025** — Universitas Wiralodra, Indramayu

---

<p align="center">
  <strong>© 2025 Desa Lombang. All rights reserved.</strong>
</p>
