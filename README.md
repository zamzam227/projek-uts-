# JB GARAGE — PHP + MySQL (XAMPP)

Versi ini mempertahankan tampilan, CSS, gambar, dan halaman asli, tetapi penyimpanan data sudah dipindahkan dari `localStorage` ke MySQL melalui PHP API.

## Instalasi
1. Ekstrak folder `jb_garage` ke `C:\xampp\htdocs\jb_garage`.
2. Jalankan **Apache** dan **MySQL** dari XAMPP.
3. Buka `http://localhost/phpmyadmin`.
4. Pilih menu **Import**, pilih file `database.sql` dari folder project, lalu klik **Import/Go**.
5. Pastikan file `config/database.php` sesuai konfigurasi MySQL lokal. Default XAMPP: user `root`, password kosong.
6. Buka `http://localhost/jb_garage/` (atau `http://localhost/jb_garage/index.php`).

## Akun demo
- Penjual: `penjual@jbgarage.test`
- Pembeli: `pembeli@jbgarage.test`
- Password demo: `Demo1234`

Jika akun demo tidak dapat login setelah import, gunakan registrasi untuk membuat akun baru. Untuk penggunaan lokal/produksi yang aman, ganti password akun demo.

## Fitur yang sudah memakai MySQL
- Registrasi dengan `password_hash()` dan validasi email unik.
- Login dengan `password_verify()` dan PHP session.
- Logout dan pemeriksaan sesi server.
- Menampilkan listing aktif dari database, pencarian, filter, pengurutan, pagination.
- Detail listing dan penghitung views.
- Pasang iklan oleh penjual; foto disimpan ke folder `uploads/` dan path disimpan di `listing_images`.
- Daftar iklan saya, tandai terjual/aktif, dan hapus iklan.
- Form kontak menyimpan pesan ke `contact_messages`.

## Catatan
- Akses website melalui `localhost`, jangan membuka file HTML langsung (`file://`).
- Pastikan folder `uploads` dapat ditulisi oleh Apache/PHP.
- CDN Bootstrap dan Google Fonts membutuhkan koneksi internet.
- Ini proyek praktikum/lokal. Sebelum dipasang online, tambahkan CSRF protection, pembatasan percobaan login, validasi keamanan tambahan, dan konfigurasi HTTPS.
