-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Des 2017 pada 04.43
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nis` int(8) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nis`, `gambar`, `nama`, `email`) VALUES
(1, 11605686, 'team-3.jpg', 'Salman Saputra', 'salmansaputra76@gmail.com'),
(2, 11605687, 'team-2.jpg', 'Amanda Jepson', 'amandajepson12@gmail.com'),
(10, 11605770, '5a34dc8ae7479.jpg', 'Alexa William', 'alexa.me@gmail.com'),
(12, 11605688, '5a34e4f444fa7.jpg', 'Eric Gordon walker', 'ericgamer@yahoo.com'),
(13, 11605690, '5a34e5f2b0d64.jpg', 'Natasha Jhonson', 'johnsonnatasha@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `jumlah`) VALUES
(1, 'NEGERI 5 MENARA', 'Ahmad Fuadi', 'Gramedia', 2015, 100),
(2, 'RANAH 3 WARNA', 'Ahmad Fuadi', 'Gramedia', 2016, 150),
(3, 'RANTAU 1 MUARA', 'Ahmad Fuadi', 'Gramedia', 2017, 95),
(4, 'YOUR NEXT STEP', 'Aster Sisi', 'Gramedia', 2017, 248),
(6, 'HARUS BISA jilid 1', 'Dr. Dino Patti Djalal', 'Gramedia', 2009, 120);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kembali`
--

CREATE TABLE `tb_kembali` (
  `id_kembali` int(11) NOT NULL,
  `nama_pengembali` varchar(100) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kembali`
--

INSERT INTO `tb_kembali` (`id_kembali`, `nama_pengembali`, `judul_buku`, `pengarang`, `penerbit`, `tgl_kembali`, `jumlah`) VALUES
(2, 'salman', 'NEGERI 5 MENARA', 'Ahmad Fuadi', 'Gramedia', '2017-12-18 10:30:00', 3);

--
-- Trigger `tb_kembali`
--
DELIMITER $$
CREATE TRIGGER `batal_kembalikan` AFTER DELETE ON `tb_kembali` FOR EACH ROW BEGIN
UPDATE tb_buku SET jumlah = jumlah - OLD.jumlah
WHERE judul_buku = OLD.judul_buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kembalikan_buku` AFTER INSERT ON `tb_kembali` FOR EACH ROW BEGIN
UPDATE tb_buku SET jumlah = jumlah + NEW.jumlah
WHERE judul_buku = NEW.judul_buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_jumlah_buku2` AFTER UPDATE ON `tb_kembali` FOR EACH ROW BEGIN
UPDATE tb_buku SET jumlah = NEW.jumlah
WHERE judul_buku = NEW.judul_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id_peminjam` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `tgl_pinjam` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id_peminjam`, `nama_peminjam`, `judul_buku`, `pengarang`, `penerbit`, `jumlah`, `tgl_pinjam`) VALUES
(2, 'salman', 'NEGERI 5 MENARA', 'Ahmad Fuadi', 'Gramedia', 3, '2017-12-17 10:09:10'),
(4, 'Amanda', 'YOUR NEXT STEP', 'Aster Sisi', 'Gramedia', 2, '2017-12-17 10:09:11');

--
-- Trigger `tb_pinjam`
--
DELIMITER $$
CREATE TRIGGER `batal_pinjam` AFTER DELETE ON `tb_pinjam` FOR EACH ROW BEGIN
UPDATE tb_buku SET jumlah = jumlah + OLD.jumlah
WHERE judul_buku = OLD.judul_buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pinjam_buku` AFTER INSERT ON `tb_pinjam` FOR EACH ROW BEGIN
UPDATE tb_buku SET jumlah = jumlah - NEW.jumlah
WHERE judul_buku = NEW.judul_buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_jumlah_buku` AFTER UPDATE ON `tb_pinjam` FOR EACH ROW BEGIN
UPDATE tb_buku SET jumlah = NEW.jumlah
WHERE judul_buku = NEW.judul_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `email`, `username`, `password`) VALUES
(10, 'salmansaputra76@gmail.com', 'salman', '$2y$10$homXKQp6GsJZFYrZRVjGiOeHuKsmFz/LhFU8BDruToGtnaf8DkvzG'),
(12, 'admin@superadmin.com', 'admin', '$2y$10$7p/NNumNPykmRX7lFX5taOjE9TdcAO9cZSh4Fx4CqNDqmAYQWRP3K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_kembali`
--
ALTER TABLE `tb_kembali`
  ADD PRIMARY KEY (`id_kembali`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_kembali`
--
ALTER TABLE `tb_kembali`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
