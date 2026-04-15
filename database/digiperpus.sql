-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Apr 2026 pada 07.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digiperpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `judul` varchar(150) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_buku` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `stok`, `cover`, `deskripsi`, `file_buku`) VALUES
(2, 3, 'Pulang', 'Tere Liye', 'Republika', '2015', 63, 'cover_1770254237_ddddd.jpg', 'Pulang Tere Liye tentang Bujang, anak pedalaman yang menjadi bos shadow economy dan berjuang demi keluarga, sedangkan Pulang Leila S. Chudori mengisahkan Dimas Suryo, eksil politik 1965 yang terdampar di Paris dan kisahnya terhubung dengan tragedi 1998.', NULL),
(9, 4, 'Atomic Habits', 'James Clear', 'PT Gramedia Pustaka Utama', '2019', 45, 'cover_1770253252_atomic habits.jpg', 'Atomic Habits karya James Clear membahas bagaimana perubahan kecil yang konsisten (kebiasaan atomik) dapat menghasilkan dampak besar dalam hidup, dengan fokus pada sistem daripada tujuan, membangun kebiasaan baik, dan menghilangkan kebiasaan buruk melalui pendekatan ilmiah yang praktis dan mudah diterapkan sehari-hari.', NULL),
(11, 1, 'RPL Kelas XI', 'Yudi Subekti, dkk.', 'Grafindo', '2025', 42, 'cover_1771984294_rpll.jpg', 'Buku Rekayasa Perangkat Lunak untuk SMK/MAK Kelas XI hadir untuk menunjang kegiatan pembelajaran. Buku ini merupakan buku Teks Pendamping dengan kedudukan sebagai variasi penyajian dari Buku Teks Utama yang disediakan pemerintah. Buku ini hadir untuk membantu Anda memahami materi-materi rekayasa perangkat lunak untuk kemudian dapat diterapkan dalam memecahkan permasalahan sehari-hari melalui solusi yang melibatkan mater tersebut.', NULL),
(12, 3, 'Hujan', 'Tere Liye', 'PT Gramedia Pustaka Utama', '2016', 40, 'cover_1771984387_hjn.jpg', 'Kisah tentang melupakan. Tentang Hujan.Novel ini adalah naskah awal (asli) dari penulis; tanpa sentuhan editing, layout serta cover dari penerbit, dengan demikian, naskah ini berbeda dengan versi cetak, pun memiliki kelebihan dan kelemahan masing-masing.', 'hujan.pdf'),
(13, 1, 'Filsafat Ilmu', 'Liza Husnita', '-', '2024', 55, 'cover_1771984403_111.jpg', '\"Filsafat Ilmu\" adalah sebuah panduan komprehensif yang menguraikan landasan filsafat yang mendasari pengetahuan ilmiah. Buku ini membahas secara mendalam peran dan kontribusi filsafat terhadap pengembangan ilmu pengetahuan.', NULL),
(14, 4, 'Filosofi Teras', 'Henry Manampiring ', 'Kompas', '2018', 428, 'cover_1771984417_teras.jpg', 'Filosofi Teras adalah sebuah buku pengantar filsafat Stoa yang dibuat khusus sebagai panduan moral anak muda. Buku ini ditulis untuk menjawab masalah tentang tingkat kekhawatiran yang cukup tinggi dalam skala nasional, terutama yang dialami oleh anak muda. Filosofi Teras dibuat dengan kolaborasi beberapa pihak, seperti ilustrator, Levina Lesmana yang cukup berjasa dalam pembuatan sampul buku, dan si penulis, Henry Manampiring, yang terinspirasi dari buku How to be a Stoic karya Massimo Piggliuci, seorang penulis kenamaan Italia yang juga penganut Stoisisme. Buku ini dilengkapi dengan beberapa data seperti survei kekhawatiran nasional dan juga wawancara dari beberapa tokoh yang dianggap ahli dalam hal psikologi.', NULL),
(15, 4, 'Aku', 'Chairil Anwar', '-', '1943', 230, 'aku.jpg', 'Aku adalah sebuah puisi berbahasa Indonesia tahun 1943 karya Chairil Anwar, karya ini mungkin adalah karyanya yang paling terkenal dan juga salah satu puisi paling terkemuka dari Angkatan 45. Puisi ini menggambarkan alam individualistis dan vitalitasnya sebagai seorang penyair.', NULL),
(16, 3, 'Jokowi Si Tukang Kayu', 'Gatotkoco Suroso', '-', '2006', 65, 'cover_1774851484_download (12).jpg', '\"Jokowi Si Tukang Kayu\" adalah sebuah novel inspiratif karya Gatotkoco Suroso yang menceritakan perjalanan hidup Joko Widodo, mulai dari masa kecil di bantaran kali, bekerja sebagai tukang kayu, hingga menjadi Walikota Solo. Buku ini menonjolkan nilai-nilai karakter, kerja keras, kemandirian, dan kisah romansa masa muda Jokowi. ', NULL),
(21, 3, 'Dompet Ayah Sepatu Ibu', 'JS Khairen', 'Gramedia Widiasarana Indonesia', '2023', 31, '1775618320_sepatu.avif', 'Zenna lahir urutan keenam dari sebelas saudara. Ia bersama keluarganya tinggal di punggung gunung Singgalang. Saat kecil, Zenna sudah bekerja keras untuk hidup. Ia pergi ke sekolah dengan sepatu rombeng naik-turun gunung sambil membawa jagung rebus untuk dijual. “Besok Abak belikan sepatu baru kalau sudah dapat uang,” janji Abaknya pada Zenna sebelum berangkat ke sekolah. Namun tak sempat Abak tunaikan janji itu. Abak meninggalkan Zenna untuk selamanya, juga meninggalkan janjinya pada Zenna untuk membelikan sepatu. Sebagai anak tengah-tengah, Zenna jarang mendapat perhatian. Ia menumpahkan kesedihannya pada dirinya sendiri. Ia bekerja keras dengan mandiri. Ia ingin melanjutkan janji Abaknya untuk membelikan sepatu. Ia membeli sepatu untuk dirinya sendiri. Di punggung gunung yang lain, gunung Marapi, Asrul dan adiknya Irsal harus membantu Umi untuk menghidupi diri. Bapaknya menikah lagi dan tinggal di rumah bersama istri keduanya, sehingga Umi, Asrul, dan Irsal pindah ke rumah peninggalan orang tua Umi. Berpisah dari Bapak. Meski Bapak kadang memberi mereka uang, itu tidaklah cukup. Setiap kali Asrul diberi uang oleh Bapak, Asrul selalu mengintip dompetnya, ada kayu manis yang diselipkan Bapak di sana. Asrul tak punya dompet karena ia tak pernah memegang uang. Bila pun dia punya, akan ia berikan pada Umi. Asrul ingin membuatkan rumah untuk Umi suatu saat kelak. Asrul dan Zenna akhirnya bertemu. Mereka berdua bertekad mengangkat derajat dirinya dan keluarganya ke kehidupan yang lebih baik. Mereka bertemu di kampus. Koran Harian Semangat turut merekatkan hubungan mereka. Hingga kelak mereka menikah dan memiliki rumah. Umi dan Umak mereka bawa tinggal bersama. Kehidupan mereka walau sudah lebih baik, tidak juga mudah. Musibah datang berkali-kali. “Kita pernah melewati yang lebih buruk dari ini,” kata mereka saling menguatkan.', ''),
(24, 2, 'Anotasi KUHP Nasional', ' Eddy O.S. Hiariej & Topo Santoso', 'Raja Grafindo Persada', '2025', 44, 'kuhp.avif', 'Pada 2 Januari 2026, Kitab Undang-Undang Hukum Pidana Nasional (KUHP Nasional) berlaku secara efektif, atau tiga tahun tahun sejak disahkan pada 2 Januari 2023 yang lalu. KUHP Nasional ini menggantikan KUHP Lama yang merupakan salinan dari Wetboek van Strafrecht (WvS) yang telah berlaku di negeri kita sejak 1918. Dengan berlakunya KUHP Nasional itu secara resmi KUHP berbahasa Indonesia digunakan, setelah sebelumnya kita hanya menggunakan KUHP terjemahan dari WvS. KUHP Nasional ini juga dilengkapi dengan penjelasan, baik penjelasan umum maupun penjelasan pasal per pasal.\r\n\r\nNamun, meskipun KUHP Nasional sudah dilengkapi dengan penjelasan umum dan penjelasan pasal per pasal, ternyata tidak semua hal dapat dituangkan ke dalam penjelasan KUHP Nasional tersebut. Berbagai informasi dan penjelasan/ keterangan masih diperlukan untuk makin memahami KUHP Nasional baik untuk asas-asas/prinsip-prinsip dan ajaran/doktrin yang telah dituangkan menjadi norma di Buku I KUHP Nasional, maupun ketentuan-ketentuan di Buku II KUHP Nasional yang sudah jauh berkembang dan berbeda dari KUHP Lama.\r\n\r\nOleh karena itu, buku Anotasi KUHP Nasional dihadirkan untuk dapat lebih memberikan konteks dan pemahaman lebih akurat pada berbagai pasal KUHP Nasional. Buku ini diharapkan dapat dipergunakan dan dimanfaatkan oleh akademisi hukum, mahasiswa hukum, praktisi hukum serta penegak hukum di seluruh Indonesia. Dalam buku ini, pasal demi pasal KUHP Nasional, penjelasan dari pasal demi pasal tersebut, disusun dan disusul dengan anotasi pasal demi pasalnya.\r\n\r\nBuku ini dapat menjadi bahan penting dalam pendidikan hukum pidana di kampus-kampus hukum ataupun lembaga pendidikan dari institusi penegak hukum (misalnya kepolisian, kejaksaan, KPK, kehakiman, advokat) serta bahan penting bagi sosialisasi KUHP Nasional di seluruh Indonesia.\r\n\r\n\r\nTahun Terbit : Cetakan Pertama, Februari 2025\r\n\r\nPernahkah Anda terpikir betapa menariknya dunia yang terbuka lebar lewat lembaran buku? Membaca bukan hanya kegiatan rutin, tetapi juga petualangan tak terbatas ke dalam imajinasi dan pengetahuan.\r\n\r\nMembaca mengasah pikiran, membuka wawasan, dan memperkaya kosakata. Ini adalah pintu menuju dunia di luar kita yang tak terbatas.\r\n\r\nTetapkan waktu khusus untuk membaca setiap hari. Dari membaca sebelum tidur hingga menyempatkan waktu di pagi hari, kebiasaan membaca dapat dibentuk dengan konsistensi.\r\n\r\nPilih buku sesuai minat dan level literasi. Mulailah dengan buku yang sesuai dengan keinginan dan kemampuan membaca.\r\n\r\nTemukan tempat yang tenang dan nyaman untuk membaca. Lampu yang cukup, kursi yang nyaman, dan sedikit musik pelataran bisa menciptakan pengalaman membaca yang lebih baik.\r\n\r\nBuat catatan atau jurnal tentang buku yang telah Anda baca. Tuliskan pemikiran, kesan, dan pelajaran yang Anda dapatkan.', NULL),
(25, 4, 'The Dip', 'Seth Godin', 'Bhuana Ilmu Populer', '2022', 51, 'dip.avif', 'Kita menghabiskan sebagian besar waktu untuk menangani hambatan dengan kegigihan. Terkadang, kita menjadi patah semangat dan berpaling pada tulisan-tulisan inspiratif, contohnya milik Vince Lombardi yang berbunyi, \"Orang yang mudah berhenti tidak pernah berhenti\". Itu saran yang buruk. Mereka yang menang juga berhenti. Namun, mereka hanya berhenti di waktu yang tepat.\r\n\r\nKebanyakan orang berhenti, hanya saja dengan cara yang salah. Faktanya, banyak profesi dan pasar mendapatkan keuntungan dari orang-orang yang mudah mengalah ketika mereka beranggapan bahwa orang-orang itu ingin berhenti. Justru banyak bisnis dan organisasi berpegang pada prinsip itu.\r\n\r\nSINOPSIS\r\nKapan kita harus menyerah? Dan kapan kita harus berjuang? Ketika kita memulai sesuatu, baik itu hobi, pekerjaan, atau membangun perusahaan baru, awalnya pasti merasa menyenangkan, tetapi lama-kelamaan kondisinya menjadi semakin sulit dan tidak menyenangkan lagi. The Dip dalam buku ini adalah lembah yang harus dilalui ketika kita ingin mengejar sesuatu, yaitu masa-masa sulit ketika semua progres terasa nyaris tidak ada dan kita meragukan banyak hal. Di antara keraguan yang muncul, selalu ada pertanyaan: “Ini layak untuk dilanjutkan atau tidak?” Buku ini membahas soal kapan harus berhenti atau terus berusaha untuk mengejar apa yang kamu inginkan. Apakah harus menyerah? Atau harus terus berjuang agar bisa melewati the dip dan meraih kesuksesan? Temukan cara-caranya disini agar kamu bisa tetap bisa bertahan dan melewati fase the dip, dan meraih kesuksesan.', NULL),
(26, 1, 'Belajar Tajwid', 'Sofa Azizah', 'Anak Hebat Indonesia', '2026', 99, 'tajwid.avif', 'Buku Belajar Tajwid ini hadir sebagai panduan awal bagi Anda yang ingin memperbaiki bacaan Al-Qur’an, tetapi belum mampu mengakses kitab-kitab klasik atau belajar langsung dari para ulama. Disusun dari berbagai rujukan otoritatif dan pengalaman langsung penulis dalam mengajar serta talaqqi, buku ini menjadi jembatan yang memudahkan pembaca memahami dasar-dasar tajwid secara praktis dan aplikatif.\r\n', NULL),
(27, 3, 'Musim yang Tak Sempat Kita Miliki', 'Rintik Sedu', 'Gramedia Pustaka Utama', '2025', 55, 'ss.avif', 'Rani bekerja sebagai editor di sebuah kantor penerbitan. Dia suka dengan kehidupan dan dunia kecilnya yang tenang di pengujung usia 20-annya, meski terkadang rekan kerjanya suka mengusiknya.\r\n\r\nSuatu hari, proyek besar datang dari perusahaan parfum lokal yang berniat merilis produk baru lewat buku. Rani yang sudah lama bermimpi menerbitkan buku pertamanya, akhirnya mendapatkan kesempatan. Tetapi, proses pengerjaan naskah itu membawa Rani kembali pada seseorang dari masa lalunya. Seseorang yang menjadi alasan pertama Rani ingin menulis.\r\n\r\nApakah Rani berhasil merampungkan naskahnya? Atau dia justru semakin terjerat masa lalunya?', NULL),
(28, 4, 'Majapahit', 'Herald Van Der Linde', 'Kepustakaan Populer gramedia', '2025', 84, 'majapahit.avif', 'Majapahit adalah kerajaan besar di Nusantara yang kekayaan dan kekuasaannya dibangun dari perpaduan muslihat politik, panen raya padi, dan angkatan laut yang sedemikian perkasa sampai-sampai bahkan orang Portugis, pelaut hebat Eropa, pun terkesan. Namun, tidak banyak bukti fisik yang tersisa dari Majapahit. Sumber sejarah juga terbatas dan akurasinya meragukan.\r\n\r\nDitulis berdasarkan sumber-sumber primer dan naskah-naskah kuno, cerita dalam buku ini mengangkat kisah raja-raja sangat eksentrik, perseteruan berdarah keluarga kerajaan, dan kisah tentang juru tulis istana pemabuk, tetapi memiliki kesadaran jernih untuk menuliskan segala yang dilihatnya.', NULL),
(30, 3, 'Pergi', 'Tere Liye', 'Republika', '2018', 22, 'pergis.jpg', 'Sebuah kisah tentang menemukan tujuan, ke mana hendak pergi, melalui kenangan demi kenangan masa lalu, pertarungan hidup-mati, untuk memutuskan ke mana langkah kaki akan dibawa. \r\n\r\nPergi', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Pendidikan'),
(2, 'Referensi'),
(3, 'Fiksi'),
(4, 'Non Fiksi'),
(5, 'Buku Anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum','dibaca') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `nama`, `email`, `pesan`, `created_at`, `status`) VALUES
(1, 'Edi Kurniawan', 'edikrn577@gmail.com', 'Saya ingin membuat akun perpustakaan', '2026-04-08 02:58:45', 'belum'),
(2, 'Edi Kurniawan', 'edikrn577@gmail.com', 'Saya ingin membuat akun perpustakaan', '2026-04-08 02:59:11', 'belum'),
(3, 'Edi', 'edikrn577@gmail.com', 'Etdah busett', '2026-04-08 03:00:18', 'belum'),
(4, 'Siti Rohmah', 'edikrn577@gmail.com', 'as', '2026-04-08 03:02:25', 'belum'),
(5, 'Pradika Putra Gunawan', 'dick577@gmail.com', 'Assalamualaikum', '2026-04-08 03:05:49', 'belum'),
(6, 'Siti Rohmah', 'edikrn577@gmail.com', 'aw', '2026-04-08 03:12:56', 'belum'),
(7, 'Abdul Aziz', 'edikrn577@gmail.com', 'aw', '2026-04-08 03:13:30', 'belum'),
(8, 'Syahril Gani Akbar', 'syahril77@gmail.com', 'Fitur peminjaman dan pencatatan transaksi sangat membantu pengelolaan data.', '2026-04-11 03:24:09', 'dibaca'),
(9, 'Pradika Putra', 'dika25@gmail.com', 'Sistemnya memudahkan pencarian buku dan proses peminjaman jadi lebih cepat.', '2026-04-11 03:25:16', 'dibaca'),
(10, 'Lutfi Jayadi', 'jayadi09@gmail.com', 'Interface sederhana dan mudah digunakan, cocok untuk sistem perpustakaan.', '2026-04-11 03:26:20', 'dibaca'),
(11, 'Siti Rohmah', 'edikrn577@gmail.com', 'as', '2026-04-15 02:47:51', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','menunggu konfirmasi','dikembalikan') NOT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_buku`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `is_read`) VALUES
(34, 2, 15, 5, '2026-03-31', '2026-04-01', 'dikembalikan', 0),
(44, 2, 14, 3, '2026-04-06', '2026-04-09', 'dikembalikan', 1),
(45, 2, 13, 4, '2026-04-06', '2026-04-15', 'dikembalikan', 1),
(48, 6, 16, 1, '2026-04-07', '2026-04-16', 'dikembalikan', 0),
(59, 9, 25, 1, '2026-04-10', '2026-04-17', 'dikembalikan', 1),
(60, 6, 2, 1, '2026-04-10', '2026-04-16', 'dipinjam', 1),
(64, 9, 13, 1, '2026-04-11', '2026-04-13', 'dipinjam', 1),
(65, 9, 28, 1, '2026-04-11', '2026-04-14', 'dipinjam', 1),
(66, 9, 9, 1, '2026-04-11', '2026-04-14', 'menunggu konfirmasi', 1),
(68, 6, 26, 1, '2026-04-11', '2026-04-21', 'dikembalikan', 0),
(69, 12, 26, 1, '2026-04-11', '2026-04-21', 'dikembalikan', 0),
(70, 12, 26, 2, '2026-04-11', '2026-04-21', 'dipinjam', 1),
(71, 15, 26, 1, '2026-04-11', '2026-04-13', 'dikembalikan', 1),
(72, 11, 12, 1, '2026-04-11', '2026-04-13', 'dipinjam', 1),
(73, 15, 28, 2, '2026-04-15', '2026-04-18', 'dikembalikan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Edi Kurniawan', 'admin', 'admin123', 'admin'),
(2, 'Syahril Gani Akbar', 'syahril', 'syahril123', 'user'),
(6, 'Pradika Putra Gunawan', 'dika', 'dika123', 'user'),
(9, 'Natael', 'nata', 'nata123', 'user'),
(11, 'Lutfi Jayadi', 'lutfi', 'lutfi123', 'user'),
(12, 'Muhammad Rifaldi', 'rifaldi', 'rifaldi123', 'user'),
(13, 'Muhammad Rival', 'rival', 'rival123', 'user'),
(14, 'Hafidz Ahmad Dwi', 'hafidz', 'hafidz123', 'user'),
(15, 'Malki Baehaqi', 'malki', 'malki123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
