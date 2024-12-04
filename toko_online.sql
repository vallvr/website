-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for toko_online
CREATE DATABASE IF NOT EXISTS `toko_online` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `toko_online`;

-- Dumping structure for table toko_online.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_online.kategori: ~3 rows (approximately)
INSERT INTO `kategori` (`id`, `nama`) VALUES
	(8, 'Bunga Papan Pernikahan'),
	(12, 'Bunga Meja'),
	(13, 'Hand Bouquet');

-- Dumping structure for table toko_online.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_online.pengguna: ~2 rows (approximately)
INSERT INTO `pengguna` (`id`, `username`, `password`) VALUES
	(6, 'vales', '$2y$10$Qa5BagUIVMP7p2ZLvwoy8e.OoSooM1bSPL.LpSey50mI4Zc3PhRrC'),
	(16, 'eriko pratama', '$2y$10$N0tilPs6OsWyXqv0g826ZeZSyjCu4Hm.KCF7gIEonFdQ8cadU0BKa');

-- Dumping structure for table toko_online.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori_id` int DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia',
  PRIMARY KEY (`id`),
  KEY `nama` (`nama`),
  KEY `kategori_produk` (`kategori_id`),
  CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_online.produk: ~14 rows (approximately)
INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
	(9, 8, 'Paket Classic ', 500000, 'uploads/SEWA PAPAN UCAPAN AKRILIK KOTA BENGKULU.jpg', '(Ukuran 120x200 cm). Kombinasi bunga segar dengan ucapan elegan.', 'tersedia'),
	(10, 8, 'Paket Elegant', 750000, 'uploads/download.jpg', '(Ukuran 150x250 cm). Bunga premium dengan detail warna menyesuaikan tema.', 'tersedia'),
	(11, 8, 'Paket Grand', 1000000, 'uploads/download (3).jpg', '(Ukuran 200x300 cm). Rangkaian mewah dengan material terbaik untuk kesan tak terlupakan.', 'tersedia'),
	(12, 8, 'Paket Simple Love', 450000, 'uploads/Papan Ucapan Akrilik.jpg', 'Ukuran: 120x200 cm. Desain minimalis, cocok untuk segala tema.', 'tersedia'),
	(13, 8, 'Paket Romantic Bloom', 7000000, 'uploads/PAPAN UCAPAN AKRILIK BENGKULU.jpg', 'Ukuran: 150x250 cm. Sentuhan bunga segar dengan warna yang romantis.', 'tersedia'),
	(14, 8, 'Paket Luxury Grace', 1300000, 'uploads/download (2).jpg', 'Ukuran: 200x300 cm. Full rangkaian bunga premium dengan desain elegan.', 'tersedia'),
	(15, 12, 'Paket Elegant Wishes', 500000, 'uploads/Bunga Vas_ Bunga Meja _ Rangkaian Bunga _ Pink Rose.jpg', 'Kombinasi bunga berwarna cerah dengan kartu ucapan eksklusif.', 'tersedia'),
	(16, 12, 'Paket Grand Celebration', 750000, 'uploads/BUNGA MEJA HAPPY WEDDING_PERNIKAHAN.jpg', 'Rangkaian bunga besar dengan vas cantik dan elemen dekoratif.', 'tersedia'),
	(17, 12, 'Paket Wedding Love', 350000, 'uploads/Bunga Vas Kado Ulang Tahun _ Buket Bunga.jpg', 'Rangkaian bunga simpel dengan warna pastel. Cocok untuk meja tamu atau pelaminan.', 'tersedia'),
	(18, 12, 'Paket Romantic Elegance', 600000, 'uploads/✅Ready Angelina F Diskon.jpg', 'Bunga premium dengan vas eksklusif. Cocok untuk dekorasi utama atau VIP table.', 'tersedia'),
	(19, 13, 'Paket Bridal Simple', 300000, 'uploads/Buket bunga mawar _hadiah ulang tahun _ valentine_ wisuda_ bunga segar.jpg', 'Kombinasi mawar putih dan baby breath. Cocok untuk tema klasik dan minimalis.', 'tersedia'),
	(20, 13, 'Paket Cheerful Blooms', 250000, 'uploads/Handbouquet Artificial-Bunga Wisuda- Honey Olive.jpg', 'Kombinasi bunga warna-warni cerah. Cocok untuk ucapan selamat wisuda atau promosi.', 'tersedia'),
	(21, 13, 'Paket Romantic Elegance', 500000, 'uploads/(SALE) BUKET BUNGA _ BUCKET BUNGA _ BUKET ULANG TAHUN _ BUKET WISUDA _ LB-07.jpg', 'Kombinasi bunga pastel seperti mawar pink dan peony. ', 'tersedia'),
	(22, 13, 'Paket Luxury Bridal', 800000, 'uploads/Buket Bunga Asli Fresh - Bunga Casablanka - Size L.jpg', 'Bunga premium dengan elemen tambahan pita satin dan aksesoris.', 'tersedia');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
