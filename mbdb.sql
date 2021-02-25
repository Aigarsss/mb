-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for mbdb
CREATE DATABASE IF NOT EXISTS `mbdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mbdb`;

-- Dumping structure for table mbdb.subscribers
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL DEFAULT '0',
  `provider` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table mbdb.subscribers: ~6 rows (approximately)
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` (`id`, `date`, `email`, `provider`) VALUES
	(34, '2021-02-25 16:27:16', 'test1@test.com', 'test'),
	(35, '2021-02-25 16:27:22', 'test2@test.com', 'test'),
	(36, '2021-02-25 16:27:34', 'test1@gmail.com', 'gmail'),
	(37, '2021-02-25 16:27:41', 'test2@gmail.com', 'gmail'),
	(38, '2021-02-25 16:27:51', 'test1@yahoo.com', 'yahoo'),
	(39, '2021-02-25 16:27:57', 'test2@yahoo.com', 'yahoo');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
