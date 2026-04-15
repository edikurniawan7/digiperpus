# Digiperpus — Sistem Peminjaman Buku Digital

## Deskripsi

**Digiperpus** adalah sistem informasi perpustakaan berbasis web yang dirancang untuk memudahkan proses peminjaman, pengembalian, dan pengelolaan buku secara digital. Sistem ini membantu admin dan anggota dalam mengelola aktivitas perpustakaan secara lebih efisien, cepat, dan terstruktur.

---

## Tujuan

* Mempermudah proses peminjaman dan pengembalian buku
* Mengelola data buku dan anggota secara terpusat
* Menyediakan riwayat transaksi yang jelas dan terorganisir
* Meningkatkan efisiensi kerja admin perpustakaan

---

## Aktor Sistem

### Admin

* Mengelola data buku
* Mengelola data anggota
* Mengelola transaksi peminjaman
* Melakukan konfirmasi peminjaman dan pengembalian

### User / Anggota

* Melihat daftar buku
* Melakukan peminjaman buku
* Melihat status dan riwayat peminjaman

---

## Fitur Utama

### Autentikasi

* Login dan logout
* Hak akses berbeda antara admin dan user

### Manajemen Buku

* Tambah, edit, dan hapus buku
* Stok buku otomatis berkurang saat dipinjam

### Manajemen Anggota

* Registrasi anggota
* Mengelola CRUD anggota

### Transaksi Peminjaman

* Pengajuan peminjaman buku
* Status transaksi:

  * Menunggu konfirmasi
  * Dipinjam
  * Dikembalikan
* Tanggal pinjam dan tanggal kembali otomatis

### Riwayat dan Notifikasi

* Riwayat peminjaman user
* Aktivitas terbaru
* Notifikasi status peminjaman

### Dashboard

* Ringkasan data (jumlah buku, anggota, transaksi)
* Aktivitas terbaru

---

## Struktur Database (Gambaran Umum)

### Tabel Utama

* `user` — menyimpan data pengguna
* `buku` — menyimpan data buku
* `transaksi` — menyimpan data peminjaman

---

## Teknologi yang Digunakan

* Frontend: HTML, Tailwind CSS, JavaScript
* Backend: PHP Native
* Database: MySQL
* Server: Apache (XAMPP)

---

## Struktur Folder

```
Digiperpus/
│
├── admin/
├── user/
├── aksi/
├── config/
├── assets/
├── partials/
└── index.php
```

---

## Cara Menjalankan Project

1. Clone repository:

   ```
   git clone https://github.com/username/digiperpus.git
   ```

2. Pindahkan ke folder server:

   * `htdocs` (XAMPP)

3. Import database:

   * Buka phpMyAdmin
   * Import file `.sql`

4. Jalankan di browser:

   ```
   http://localhost/digiperpus
   ```

---

## Akun Demo

Admin

* Username: admin
* Password: admin123

User

* Registrasi terlebih dahulu

---

## Catatan

Sistem masih dapat dikembangkan lebih lanjut, seperti penambahan fitur denda keterlambatan, pencarian buku, atau filter kategori.

---

## Developer

Dikembangkan oleh:
EDI KURNIAWAN

---

## Lisensi

Project ini dibuat untuk keperluan uji kompetensi keahlian.

---
