--
-- Database: `code-restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street`, `phone`, `name`) VALUES
(1, 'Michalowskiego 41', '506088156', 'Michal'),
(2, 'Opata Rybickiego 1', '502145785', 'Opata Rybickiego 1'),
(3, 'Horacego 23', '504212369', 'Piotr'),
(4, 'Jan Pawła 67', '605458547', 'Albert');