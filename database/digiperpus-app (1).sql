-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Apr 2026 pada 05.08
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
-- Database: `digiperpus-app`
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
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `stok`, `cover`, `deskripsi`) VALUES
(2, 3, 'Pulang', 'Tere Liye', 'Republika', '2015', 63, 'cover_1770254237_ddddd.jpg', 'Pulang Tere Liye tentang Bujang, anak pedalaman yang menjadi bos shadow economy dan berjuang demi keluarga, sedangkan Pulang Leila S. Chudori mengisahkan Dimas Suryo, eksil politik 1965 yang terdampar di Paris dan kisahnya terhubung dengan tragedi 1998.'),
(9, 4, 'Atomic Habits', 'James Clear', 'PT Gramedia Pustaka Utama', '2019', 48, 'cover_1770253252_atomic habits.jpg', 'Atomic Habits karya James Clear membahas bagaimana perubahan kecil yang konsisten (kebiasaan atomik) dapat menghasilkan dampak besar dalam hidup, dengan fokus pada sistem daripada tujuan, membangun kebiasaan baik, dan menghilangkan kebiasaan buruk melalui pendekatan ilmiah yang praktis dan mudah diterapkan sehari-hari.'),
(11, 1, 'RPL Kelas XI', 'Yudi Subekti, dkk.', 'Grafindo', '2025', 43, 'cover_1771984294_rpll.jpg', 'Buku Rekayasa Perangkat Lunak untuk SMK/MAK Kelas XI hadir untuk menunjang kegiatan pembelajaran. Buku ini merupakan buku Teks Pendamping dengan kedudukan sebagai variasi penyajian dari Buku Teks Utama yang disediakan pemerintah. Buku ini hadir untuk membantu Anda memahami materi-materi rekayasa perangkat lunak untuk kemudian dapat diterapkan dalam memecahkan permasalahan sehari-hari melalui solusi yang melibatkan mater tersebut.'),
(12, 3, 'Hujan', 'Tere Liye', 'PT Gramedia Pustaka Utama', '2016', 43, 'cover_1771984387_hjn.jpg', 'Kisah tentang melupakan. Tentang Hujan.Novel ini adalah naskah awal (asli) dari penulis; tanpa sentuhan editing, layout serta cover dari penerbit, dengan demikian, naskah ini berbeda dengan versi cetak, pun memiliki kelebihan dan kelemahan masing-masing.'),
(13, 1, 'Filsafat Ilmu', 'Liza Husnita', '-', '2024', 55, 'cover_1771984403_111.jpg', '\"Filsafat Ilmu\" adalah sebuah panduan komprehensif yang menguraikan landasan filsafat yang mendasari pengetahuan ilmiah. Buku ini membahas secara mendalam peran dan kontribusi filsafat terhadap pengembangan ilmu pengetahuan.'),
(14, 4, 'Filosofi Teras', 'Henry Manampiring ', 'Kompas', '2018', 431, 'cover_1771984417_teras.jpg', 'Filosofi Teras adalah sebuah buku pengantar filsafat Stoa yang dibuat khusus sebagai panduan moral anak muda. Buku ini ditulis untuk menjawab masalah tentang tingkat kekhawatiran yang cukup tinggi dalam skala nasional, terutama yang dialami oleh anak muda. Filosofi Teras dibuat dengan kolaborasi beberapa pihak, seperti ilustrator, Levina Lesmana yang cukup berjasa dalam pembuatan sampul buku, dan si penulis, Henry Manampiring, yang terinspirasi dari buku How to be a Stoic karya Massimo Piggliuci, seorang penulis kenamaan Italia yang juga penganut Stoisisme. Buku ini dilengkapi dengan beberapa data seperti survei kekhawatiran nasional dan juga wawancara dari beberapa tokoh yang dianggap ahli dalam hal psikologi.'),
(15, 4, 'Aku', 'Chairil Anwar', '-', '1943', 23, 'aku.jpg', 'Aku adalah sebuah puisi berbahasa Indonesia tahun 1943 karya Chairil Anwar, karya ini mungkin adalah karyanya yang paling terkenal dan juga salah satu puisi paling terkemuka dari Angkatan 45. Puisi ini menggambarkan alam individualistis dan vitalitasnya sebagai seorang penyair.'),
(16, 3, 'Jokowi Si Tukang Kayu', 'Gatotkoco Suroso', '-', '2006', 67, 'cover_1774851484_download (12).jpg', '\"Jokowi Si Tukang Kayu\" adalah sebuah novel inspiratif karya Gatotkoco Suroso yang menceritakan perjalanan hidup Joko Widodo, mulai dari masa kecil di bantaran kali, bekerja sebagai tukang kayu, hingga menjadi Walikota Solo. Buku ini menonjolkan nilai-nilai karakter, kerja keras, kemandirian, dan kisah romansa masa muda Jokowi. '),
(19, 3, 'Petuangan Jokowi', 'Pria Solo', 'PDI', '2014', 45, 'download (12).jpg', 'Hidup Jokowi!!!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `jumlah_per_hari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ebook`
--

CREATE TABLE `ebook` (
  `id_ebook` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `file_ebook` varchar(255) NOT NULL,
  `ukuran_file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Struktur dari tabel `respon_ulasan`
--

CREATE TABLE `respon_ulasan` (
  `id_respon` int(11) NOT NULL,
  `id_ulasan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `respon` text NOT NULL,
  `tanggal_respon` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `total_denda` int(11) DEFAULT 0,
  `status` enum('dipinjam','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_buku`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `total_denda`, `status`) VALUES
(34, 2, 15, 5, '2026-03-31', '2026-04-01', 0, 'dipinjam'),
(42, 3, 16, 1, '2026-04-01', '2026-04-03', 0, 'dikembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `komentar` text DEFAULT NULL,
  `tanggal_ulasan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'Rifaldi', 'rifaldi', 'rifaldi123', 'user'),
(4, 'Hamdi Hakiki', 'hamdi', 'hamdi123', 'user');

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
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`id_ebook`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `respon_ulasan`
--
ALTER TABLE `respon_ulasan`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `id_ulasan` (`id_ulasan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
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
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ebook`
--
ALTER TABLE `ebook`
  MODIFY `id_ebook` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `respon_ulasan`
--
ALTER TABLE `respon_ulasan`
  MODIFY `id_respon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ebook`
--
ALTER TABLE `ebook`
  ADD CONSTRAINT `ebook_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `respon_ulasan`
--
ALTER TABLE `respon_ulasan`
  ADD CONSTRAINT `respon_ulasan_ibfk_1` FOREIGN KEY (`id_ulasan`) REFERENCES `ulasan` (`id_ulasan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respon_ulasan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
