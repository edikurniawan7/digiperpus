<?php
include 'config.php';

// TOTAL BUKU
$q_buku = mysqli_query($config, "SELECT COUNT(*) as total FROM buku");
$total_buku = mysqli_fetch_assoc($q_buku)['total'];

// TOTAL USER (SELain admin)
$q_user = mysqli_query($config, "SELECT COUNT(*) as total FROM users WHERE role != 'admin'");
$total_user = mysqli_fetch_assoc($q_user)['total'];

// TOTAL TRANSAKSI
$q_transaksi = mysqli_query($config, "SELECT COUNT(*) as total FROM transaksi");
$total_transaksi = mysqli_fetch_assoc($q_transaksi)['total'];

// TOTAL YANG SEDANG DIPINJAM
$q_pinjam = mysqli_query($config, "SELECT COUNT(*) as total FROM transaksi WHERE status = 'dipinjam'");
$total_pinjam = mysqli_fetch_assoc($q_pinjam)['total'];

// Ambil 4 buku terbaru
$q_buku_terbaru = mysqli_query($config, "
    SELECT * FROM buku 
    ORDER BY id_buku DESC 
    LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_title.png" type="image/png">
    <title>Digiperpus | Sistem Peminjaman Buku</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body class="bg-teal-50">

    <!-- NAVIGATION / NAVBAR -->
    <nav class="bg-white backdrop-blur-md shadow-sm border-b border-white/20 fixed w-full top-0 z-50 transition-all duration-500" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-18">
                <!-- LOGO -->
                <div class="flex items-center group">
                    <img src="assets/img/logo_digiperpus1.png" href="index.php" alt="Logo DigiPerpus" class="h-12 w-40 rounded-3xl object-cover">
                </div>

                <!-- MENU NAVIGASI DESKTOP -->
                <div class="hidden md:flex flex-2 justify-center">
                    <div class="flex items-center space-x-1">
                        <a href="#beranda" class="text-gray-800 font-medium nav-link relative px-4 py-2 text-sm transition-all duration-300 group">
                            <span class="relative z-10">Beranda</span>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-blue-500 group-hover:w-12 transition-all duration-300"></div>
                        </a>
                        <a href="#tentang" class="text-gray-800 font-medium nav-link relative px-4 py-2 text-sm transition-all duration-300 group">
                            <span class="relative z-10">Tentang</span>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-blue-500 group-hover:w-12 transition-all duration-300"></div>
                        </a>
                        <a href="#fitur" class="text-gray-800 font-medium nav-link relative px-4 py-2 text-sm transition-all duration-300 group">
                            <span class="relative z-10">Fitur</span>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-blue-500 group-hover:w-12 transition-all duration-300"></div>
                        </a>
                        <a href="#kontak" class="text-gray-800 font-medium nav-link relative px-4 py-2 text-sm transition-all duration-300 group">
                            <span class="relative z-10">Kontak</span>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-blue-500 group-hover:w-12 transition-all duration-300"></div>
                        </a>
                    </div>
                </div>

                <!-- TOMBOL LOGIN DESKTOP -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="auth/login.php" class="text-gray-800 font-medium nav-link relative px-4 py-2 text-sm transition-all duration-300 group">
                        <span class="relative z-10">Login→</span>
                    </a>
                </div>

                <!-- TOMBOL MENU MOBILE -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-700 hover:text-blue-primary transition-colors p-2 rounded-lg hover:bg-blue-50">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION / BERANDA -->
    <section id="beranda" class="pt-24 min-h-screen flex items-center relative">
        <!-- Background Image -->
        <img src="assets/img/Bg-Utama.jpg" class="absolute inset-0 w-full h-full object-cover brightness-50">

        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-secondary/70 to-teal-primary/60"></div>

        <!-- Hero Content -->
        <div class="relative max-w-5xl mx-auto px-6 text-center text-white">
            <h1 class="text-3xl md:text-5xl font-semibold leading-tight">
                Sistem Perpustakaan Digital
                <br>
                <span class="font-bold">Efisien dan Terintegrasi</span>
            </h1>

            <p class="mt-4 text-sm md:text-base text-gray-200 max-w-2xl mx-auto leading-relaxed">
                Kelola koleksi buku, peminjaman, dan anggota dalam satu sistem digital 
                yang mudah digunakan dan dapat diakses secara real-time.
            </p>

            <!-- CTA Button -->
            <div class="mt-6 flex justify-center gap-3">
                <a href="auth/login.php" class="border-2 border-white text-white  font-bold py-3 px-6 rounded-lg text-sm transition-all duration-300 hover:scale-105">
                    Kelola Perpustakaan Anda→
                </a>
            </div>
        </div>
    </section>

    <!-- TENTANG SECTION -->
    <section id="tentang" class="fade-in py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Section Heading -->
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-semibold text-blue-secondary">Tentang Digiperpus</h2>
                <p class="text-sm text-gray-500 mt-2">Solusi digital untuk pengelolaan perpustakaan yang lebih efisien</p>
            </div>

            <!-- Content Grid -->
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <!-- Text Content -->
                <div class="text-sm text-gray-600 leading-relaxed space-y-4">
                    <p>Digiperpus adalah sistem perpustakaan digital yang dirancang untuk membantu pengelolaan buku, anggota, dan proses peminjaman secara lebih terstruktur dan efisien.</p>
                    <p>Dengan sistem yang terintegrasi, pengguna dapat dengan mudah mencari buku, melakukan peminjaman, serta memantau status transaksi secara real-time.</p>
                    <p>Digiperpus hadir untuk mendukung transformasi perpustakaan menjadi lebih modern, praktis, dan mudah diakses kapan saja.</p>
                </div>

                <!-- Highlight Box -->
                <div class="bg-teal-50 border border-teal-100 p-6 rounded-lg">
                    <h3 class="text-sm font-semibold text-blue-secondary mb-4">Keunggulan Sistem</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="w-2 h-2 bg-teal-500 rounded-full mt-2"></span>
                            Pengelolaan data buku dan anggota terpusat
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-2 h-2 bg-teal-500 rounded-full mt-2"></span>
                            Proses peminjaman lebih cepat dan terstruktur
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-2 h-2 bg-teal-500 rounded-full mt-2"></span>
                            Akses informasi secara real-time
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-2 h-2 bg-teal-500 rounded-full mt-2"></span>
                            Antarmuka sederhana dan mudah digunakan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- FITUR SECTION-->
    <section id="fitur" class="py-16 bg-teal-50">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Section Heading -->
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-semibold text-blue-secondary">Fitur Utama</h2>
                <p class="text-sm text-gray-500 mt-2">Sistem yang dirancang untuk mempermudah pengelolaan perpustakaan</p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1: Katalog Digital -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 hover:shadow-md transition">
                    <h3 class="text-sm font-semibold text-blue-secondary mb-2">Katalog Digital</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">Cari dan temukan buku dengan cepat berdasarkan judul, kategori, atau pengarang.</p>
                </div>

                <!-- Feature 2: Sistem Peminjaman -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 hover:shadow-md transition">
                    <h3 class="text-sm font-semibold text-blue-secondary mb-2">Sistem Peminjaman</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">Proses peminjaman dan pengembalian buku dilakukan secara terstruktur dan efisien.</p>
                </div>

                <!-- Feature 3: Manajemen Anggota -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 hover:shadow-md transition">
                    <h3 class="text-sm font-semibold text-blue-secondary mb-2">Manajemen Anggota</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">Kelola data anggota dan pantau aktivitas peminjaman dengan mudah.</p>
                </div>

                <!-- Feature 4: Laporan & Statistik -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 hover:shadow-md transition">
                    <h3 class="text-sm font-semibold text-blue-secondary mb-2">Laporan & Statistik</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">Lihat laporan peminjaman dan data buku secara real-time.</p>
                </div>

                <!-- Feature 5: Riwayat Peminjaman -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 hover:shadow-md transition">
                    <h3 class="text-sm font-semibold text-blue-secondary mb-2">Riwayat Peminjaman</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">Melihat data peminjaman yang sedang berlangsung dan yang telah selesai secara terstruktur.</p>
                </div>

                <!-- Feature 6: Detail Buku Lengkap -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 hover:shadow-md transition">
                    <h3 class="text-sm font-semibold text-blue-secondary mb-2">Detail Buku Lengkap</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">Menyediakan informasi buku secara lengkap seperti pengarang, penerbit, dan deskripsi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- STATISTIK SECTION -->
    <section class="py-16 bg-blue-secondary relative">
        <!-- Background Image -->
        <img src="assets/img/Bg-Utama.jpg" class="absolute inset-0 w-full h-full object-cover brightness-50">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-secondary/70 to-blue-primary/60"></div>

       <!-- Statistics Content -->
<div class="relative max-w-6xl mx-auto px-4">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

        <!-- Koleksi Buku -->
        <div>
            <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                <?= $total_buku; ?>
            </div>
            <p class="text-sm text-blue-100 mt-1">Koleksi Buku</p>
        </div>

        <!-- Total Pengguna -->
        <div>
            <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                <?= $total_user; ?>
            </div>
            <p class="text-sm text-blue-100 mt-1">Pengguna Terdaftar</p>
        </div>

        <!-- Total Peminjaman -->
        <div>
            <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                <?= $total_transaksi; ?>
            </div>
            <p class="text-sm text-blue-100 mt-1">Total Peminjaman</p>
        </div>

        <!-- Sedang Dipinjam -->
        <div>
            <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                <?= $total_pinjam; ?>
            </div>
            <p class="text-sm text-blue-100 mt-1">Sedang Dipinjam</p>
        </div>

    </div>
</div>
        </div>
    </section>

    <!-- BUKU TERBARU SECTION -->
<section class="py-16 bg-gray-light">
    <div class="max-w-6xl mx-auto px-4">

        <!-- Heading -->
        <div class="text-center mb-10">
            <h2 class="text-2xl font-semibold text-blue-secondary mb-2">
                Buku Terbaru
            </h2>
            <p class="text-sm text-gray-600">
                Koleksi terbaru yang siap untuk Anda pinjam
            </p>
        </div>

        <!-- GRID BUKU -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

        <?php if(mysqli_num_rows($q_buku_terbaru) > 0){ ?>
            <?php while ($buku = mysqli_fetch_array($q_buku_terbaru)): ?>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col hover:scale-105 transition duration-300">

                <!-- Cover -->
                <div class="h-40 w-full bg-blue-100 flex items-center justify-center overflow-hidden">
                    <img src="uploads/cover/<?= $buku['cover']; ?>"
                         class="max-h-full max-w-full object-contain"
                         onerror="this.src='assets/img/no-image.png'">
                </div>

                <!-- Info -->
                <div class="p-4 flex flex-col flex-grow">

                    <h3 class="text-base font-bold text-gray-700 mb-2 line-clamp-2">
                        <?= $buku['judul']; ?>
                    </h3>

                    <div class="text-sm text-gray-600 mb-2">
                        <?= $buku['pengarang']; ?>
                    </div>

                    <div class="text-sm text-gray-600 mb-4">
                        <span class="font-semibold">Stok:</span>
                        <?= $buku['stok']; ?>
                    </div>

                    <!-- Action -->
                    <div class="flex gap-2 mt-auto">

                        <a href="public/detail_buku.php?= $buku['id_buku']; ?>"
                           class="flex-1 bg-blue-600 text-white px-2 py-1 rounded-lg text-center text-sm hover:bg-blue-500 transition">
                            Detail
                        </a>

                    </div>

                </div>
            </div>

            <?php endwhile; ?>
        <?php } else { ?>
            <p class="col-span-5 text-center text-gray-500">
                Belum ada buku terbaru.
            </p>
        <?php } ?>

        </div>
    </div>
</section>

</div>

    <!-- TESTIMONIAL SECTION -->
    <section class="py-16 bg-teal-50">
        <div class="max-w-5xl mx-auto px-4">
            <!-- Section Heading -->
            <div class="text-center mb-10">
                <h2 class="text-2xl font-semibold text-blue-secondary mb-2">Apa Kata Pengguna</h2>
                <p class="text-sm text-gray-600">Pengalaman pengguna dalam menggunakan Digiperpus</p>
            </div>

            <!-- Testimonial Slider -->
            <div class="overflow-hidden relative">
                <div id="testimonialSlider" class="flex transition-transform duration-500">
                    <!-- Testimonial 1 -->
                    <div class="w-full flex-shrink-0 px-4">
                        <div class="bg-gray-light border border-gray-200 rounded-lg p-6 text-center">
                            <p class="text-sm text-gray-600 italic mb-4">"Sistemnya memudahkan pencarian buku dan proses peminjaman jadi lebih cepat."</p>
                            <h4 class="text-sm font-semibold text-gray-700">Sari Dewi</h4>
                            <span class="text-xs text-gray-500">Pustakawan Sekolah</span>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="w-full flex-shrink-0 px-4">
                        <div class="bg-gray-light border border-gray-200 rounded-lg p-6 text-center">
                            <p class="text-sm text-gray-600 italic mb-4">"Interface sederhana dan mudah digunakan, cocok untuk sistem perpustakaan digital."</p>
                            <h4 class="text-sm font-semibold text-gray-700">Ahmad Rahman</h4>
                            <span class="text-xs text-gray-500">Pengelola Perpustakaan</span>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="w-full flex-shrink-0 px-4">
                        <div class="bg-gray-light border border-gray-200 rounded-lg p-6 text-center">
                            <p class="text-sm text-gray-600 italic mb-4">"Fitur peminjaman dan pencatatan transaksi sangat membantu pengelolaan data."</p>
                            <h4 class="text-sm font-semibold text-gray-700">Rina Kartika</h4>
                            <span class="text-xs text-gray-500">Admin Perpustakaan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider Dots Navigation -->
            <div class="flex justify-center mt-6 gap-2">
                <button class="dot w-2.5 h-2.5 bg-blue-secondary rounded-full" data-slide="0"></button>
                <button class="dot w-2.5 h-2.5 bg-gray-300 rounded-full" data-slide="1"></button>
                <button class="dot w-2.5 h-2.5 bg-gray-300 rounded-full" data-slide="2"></button>
            </div>
        </div>
    </section>

    <!-- KONTAK SECTION -->
    <section id="kontak" class="py-16 bg-gray-light">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Section Heading -->
            <div class="text-center mb-10">
                <h2 class="text-2xl font-semibold text-blue-secondary mb-2">Hubungi Kami</h2>
                <p class="text-sm text-gray-600">Punya pertanyaan atau ingin menggunakan Digiperpus? Hubungi kami sekarang.</p>
            </div>

            <!-- Contact Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Contact Info -->
                <div class="space-y-5">
                    <!-- Email -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700">Email</h3>
                        <p class="text-sm text-gray-600">digiperpus@email.com</p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700">Telepon</h3>
                        <p class="text-sm text-gray-600">0812-3456-7890</p>
                    </div>

                    <!-- Address -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700">Alamat</h3>
                        <p class="text-sm text-gray-600">Indonesia</p>
                    </div>
                </div>

                <form id="contactForm" class="space-y-4">
                    <div>
                        <input type="text" name="nama" placeholder="Nama"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-secondary">
                    </div>

                    <div>
                        <input type="email" name="email" placeholder="Email"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-secondary">
                    </div>

                    <div>
                        <textarea name="pesan" rows="4" placeholder="Pesan"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-secondary"></textarea>
                    </div>

                    <button type="submit"
                    class="w-full bg-blue-secondary text-white text-sm py-2 rounded-md hover:bg-blue-primary transition">
                        Kirim Pesan
                    </button>

                    <!-- Feedback -->
                    <p id="formMessage" class="text-sm text-center mt-2"></p>
                </form>
            </div>

            <!-- Google Maps Embed Full Width -->
            <div class="mt-8">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4484.198878425387!2d107.84287690451383!3d-7.216201958943139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ba8e1722dc49%3A0xcad8aa88ea668a6!2sSMK%20Al%20Madani%20Garut!5e0!3m2!1sid!2sid!4v1774775455271!5m2!1sid!2sid" 
                    class="w-full h-64 rounded-lg border border-gray-200"
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="bg-blue-secondary text-white py-12">
        <div class="max-w-5xl mx-auto px-4">
            <!-- Footer Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Brand Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-3">Digiperpus</h3>
                    <p class="text-sm text-blue-100 leading-relaxed">
                        Sistem perpustakaan digital yang membantu pengelolaan buku, 
                        peminjaman, dan data anggota secara lebih efisien dan terstruktur.
                    </p>
                </div>

                <!-- Quick Contact -->
                <div>
                    <h4 class="text-sm font-semibold mb-3">Kontak</h4>
                    <ul class="space-y-2 text-sm text-blue-100">
                        <li>Email: digiperpus@email.com</li>
                        <li>Telp: 0812-3456-7890</li>
                        <li>Indonesia</li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-white mt-8 pt-4 text-center">
                <p class="text-xs text-blue-100">
                    &copy; 2026 Digiperpus. Semua hak dilindungi.
                </p>
            </div>
        </div>
    </footer>
     <!-- JavaScript -->
<script>
    // 1. SMOOTH SCROLL
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // 2. NAVBAR DINAMIS
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-lg', 'bg-white/95');
        } else {
            navbar.classList.remove('shadow-lg', 'bg-white/95');
        }
    });

    // 3. MOBILE MENU
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    let mobileMenuOpen = false;

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenuOpen = !mobileMenuOpen;
        // Toggle menu visibility
        const navMenu = navbar.querySelector('.hidden.md\\:flex');
        if (mobileMenuOpen) {
            const menu = document.createElement('div');
            menu.id = 'mobile-nav-menu';
            menu.className = 'md:hidden absolute top-18 left-0 right-0 bg-white shadow-lg';
            menu.innerHTML = `
                <div class="flex flex-col space-y-2 p-4">
                    <a href="#beranda" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Beranda</a>
                    <a href="#tentang" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Tentang</a>
                    <a href="#fitur" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Fitur</a>
                    <a href="#kontak" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Kontak</a>
                    <a href="auth/login.php" class="text-gray-800 px-4 py-2 hover:bg-teal-50 rounded">Login</a>
                </div>
            `;
            navbar.appendChild(menu);
        } else {
            const menu = document.getElementById('mobile-nav-menu');
            if (menu) menu.remove();
        }
    });

    // 4. ANIMASI MUNCUL SECTION (FADE IN)
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in, section').forEach(el => {
        observer.observe(el);
    });

    // 5. ANIMASI STATISTIK (COUNTER)
    function animateCounter(element, target, duration = 2000) {
        let current = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }

    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statsSection = entry.target;
                statsSection.querySelectorAll('.text-4xl').forEach(stat => {
                    const value = parseInt(stat.textContent);
                    animateCounter(stat, value);
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('[class*="bg-blue-secondary"]');
    if (statsSection) statsObserver.observe(statsSection);

    // 6. SLIDER OTOMATIS
    let currentSlide = 0;
    const slides = document.querySelectorAll('#testimonialSlider > div');
    const dots = document.querySelectorAll('.dot');

    function goToSlide(n) {
        currentSlide = (n + slides.length) % slides.length;
        const slider = document.getElementById('testimonialSlider');
        slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        dots.forEach(dot => dot.classList.remove('bg-blue-secondary'));
        dots.forEach(dot => dot.classList.add('bg-gray-300'));
        dots[currentSlide].classList.remove('bg-gray-300');
        dots[currentSlide].classList.add('bg-blue-secondary');
    }

    // Auto slide setiap 5 detik
    let sliderInterval = setInterval(() => {
        goToSlide(currentSlide + 1);
    }, 5000);

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            clearInterval(sliderInterval);
            goToSlide(index);
            sliderInterval = setInterval(() => {
                goToSlide(currentSlide + 1);
            }, 5000);
        });
    });

    // 7. FORM FEEDBACK
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);
    const messageBox = document.getElementById('formMessage');

    fetch('../aksi/aksi_kirim_pesan.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            messageBox.innerText = "Pesan berhasil dikirim!";
            messageBox.className = "text-green-600 text-sm text-center mt-2";
            form.reset();
        } else {
            messageBox.innerText = data.message;
            messageBox.className = "text-red-600 text-sm text-center mt-2";
        }
    })
    .catch(() => {
        messageBox.innerText = "Terjadi kesalahan.";
        messageBox.className = "text-red-600 text-sm text-center mt-2";
    });
});

    // CSS untuk animasi fade-in
    const style = document.createElement('style');
    style.textContent = `
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .fade-in-visible {
            opacity: 1;
            transform: translateY(0);
        }
        #testimonialSlider {
            display: flex;
            transition: transform 0.5s ease;
        }
    `;
    document.head.appendChild(style);
</script>

    

</body>
</html>
