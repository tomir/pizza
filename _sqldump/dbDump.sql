-- --------------------------------------------------------
-- Host:                         localhost
-- Server Version:               5.5.35-0ubuntu0.12.04.2 - (Ubuntu)
-- Server Betriebssystem:        debian-linux-gnu
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Datenbank Struktur für romantica
DROP DATABASE IF EXISTS `romantica`;
CREATE DATABASE IF NOT EXISTS `romantica` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `romantica`;


-- Exportiere Struktur von Tabelle romantica.attr
DROP TABLE IF EXISTS `attr`;
CREATE TABLE IF NOT EXISTS `attr` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle romantica.attr: ~8 rows (ungefähr)
/*!40000 ALTER TABLE `attr` DISABLE KEYS */;
INSERT INTO `attr` (`id`, `name`) VALUES
	(1, 'Käse'),
	(2, 'Tomaten'),
	(3, 'Spinat'),
	(4, 'Salami'),
	(5, 'Knoblauch'),
	(6, 'Sardellen'),
	(7, 'Kapern'),
	(8, 'Oliven');
/*!40000 ALTER TABLE `attr` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle romantica.attr2pizza
DROP TABLE IF EXISTS `attr2pizza`;
CREATE TABLE IF NOT EXISTS `attr2pizza` (
  `pizza_id` int(11) DEFAULT NULL,
  `attr_id` int(11) DEFAULT NULL,
  UNIQUE KEY `pizza_id_attr_id` (`pizza_id`,`attr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle romantica.attr2pizza: ~17 rows (ungefähr)
/*!40000 ALTER TABLE `attr2pizza` DISABLE KEYS */;
INSERT INTO `attr2pizza` (`pizza_id`, `attr_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(2, 2),
	(2, 8),
	(3, 1),
	(3, 2),
	(3, 4),
	(4, 1),
	(4, 2),
	(4, 3),
	(4, 5),
	(5, 1),
	(5, 2),
	(5, 4),
	(5, 6),
	(5, 7);
/*!40000 ALTER TABLE `attr2pizza` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle romantica.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle romantica.categories: ~8 rows (ungefähr)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Pizza'),
	(2, 'Salat'),
	(3, 'Nudeln'),
	(4, 'Antipasti'),
	(5, 'Fleisch'),
	(6, 'Fisch'),
	(7, 'Desser'),
	(8, 'Getränke');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle romantica.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `cat_id` int(2) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cost` float(4,2) NOT NULL,
  `pos` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pos` (`pos`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle romantica.product: ~18 rows (ungefähr)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `cat_id`, `name`, `description`, `cost`, `pos`) VALUES
	(1, 1, 'Pizza Margerita', '', 3.00, 0),
	(2, 1, 'Pizza Napoli', '', 4.00, 1),
	(3, 1, 'Pizza Salami', '', 4.00, 2),
	(4, 1, 'Pizza Spinaci', '', 4.00, 3),
	(5, 1, 'Pizza Campagnola', '', 4.50, 4),
	(6, 7, 'Titamisu', 'Mascarpone, Löffelbiskuit, Espresso und Amaretto', 4.00, 0),
	(7, 6, 'Gamberoni alla Griglia', 'Garnelen vom Grill mit Kräutersauce', 15.00, 1),
	(8, 5, 'Bistecca alla Griglia', 'Rumpsteak mit Beilage', 11.50, 0),
	(9, 5, 'Bistecca Casa', 'Rumpsteack mit Champignons, Zwiebeln', 12.50, 1),
	(10, 8, 'Cola', '1,0L', 2.50, 0),
	(11, 8, 'Cola Light', '1,0L', 2.50, 1),
	(12, 8, 'Fanta', '1,0L', 2.50, 2),
	(13, 3, 'Spaghetti Bolognese', 'mit Hackfleisch und Bolognesesauce', 5.00, 0),
	(14, 2, 'Salat Ruloca', 'Rucolasalat mit Parmesan', 6.50, 0),
	(15, 4, 'Antipasto Casareccia', 'Gemüsevorspeise', 6.00, 0),
	(16, 7, 'Tartufo', 'eine italienische Eisspezialität, die den Trüffelpralinen nachempfunden ist.', 6.00, 1),
	(17, 6, 'Lotte alla Erbe', 'Seeteufel mit Kräutern', 16.50, 0),
	(18, 3, 'Spaghetti Napoli', 'mit Tomatensauce', 5.50, 1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
