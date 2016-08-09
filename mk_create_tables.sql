-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 09 Août 2016 à 21:57
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mk`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user_key` varchar(1024) NOT NULL,
  `admin_user_pwd` varchar(512) NOT NULL,
  `admin_user_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user_key`, `admin_user_pwd`, `admin_user_id`) VALUES
(1, 'Wqtp72Kjs8BNhq0j1MCOthPaucmECRssMa+hbrGYhFfZSr1g8r4AnQfnUEF4dHB3s7en7gpCoHq0S6tg2vmMLWa95frY68PEwkO3kmxP0pUAtJ9kxD4eoDRjXI9V/d09|1eKDbYFmTKTW/kZ+qG3sjZfIoniPbt/FCl2M+fBDVsU=', '5Boe1sIs1nt7uz6D6KULL8d7ha2mRUxdYLWq0hN1KaQ=', 67);

-- --------------------------------------------------------

--
-- Structure de la table `alert`
--

CREATE TABLE IF NOT EXISTS `alert` (
  `alert_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`alert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ban`
--

CREATE TABLE IF NOT EXISTS `ban` (
  `ban_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ban_user_id` int(11) NOT NULL,
  `ban_reason` varchar(512) NOT NULL,
  `ban_time` int(11) NOT NULL,
  `ban_end_time` int(11) NOT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `building_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `building_name` varchar(128) NOT NULL,
  `building_cost` int(12) NOT NULL,
  `building_id_need` int(12) NOT NULL,
  `building_gold_income` int(12) NOT NULL,
  `building_petrol_income` int(12) NOT NULL,
  `building_description` varchar(512) NOT NULL,
  `building_img` varchar(128) NOT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `building`
--

INSERT INTO `building` (`building_id`, `building_name`, `building_cost`, `building_id_need`, `building_gold_income`, `building_petrol_income`, `building_description`, `building_img`) VALUES
(1, 'fortress', 5, 0, 0, 0, 'fortress_description', 'glyphicon glyphicon-tower'),
(2, 'training_camp', 4, 0, 0, 0, 'training_camp_description', 'glyphicon glyphicon-tent'),
(3, 'gold_mine', 8, 1, 3, 0, 'gold_mine_description', 'gold.png'),
(4, 'silver_mine', 5, 2, 2, 0, 'silver_mine_description', 'silver.png'),
(5, 'iron_mine', 3, 3, 1, 0, 'iron_mine_description', 'iron.png'),
(6, 'government', 0, -1, 1, 0, 'government_description', 'fa fa-star');

-- --------------------------------------------------------

--
-- Structure de la table `buy`
--

CREATE TABLE IF NOT EXISTS `buy` (
  `buy_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `buy_user_id` int(11) NOT NULL,
  `buy_turn_id` int(11) NOT NULL,
  `buy_game_id` int(11) NOT NULL,
  `buy_land_id` int(12) NOT NULL,
  `buy_units_nb` int(11) NOT NULL,
  `buy_build_id` int(11) NOT NULL,
  `buy_time` int(12) NOT NULL,
  PRIMARY KEY (`buy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=302 ;

--
-- Contenu de la table `buy`
--

INSERT INTO `buy` (`buy_id`, `buy_user_id`, `buy_turn_id`, `buy_game_id`, `buy_land_id`, `buy_units_nb`, `buy_build_id`, `buy_time`) VALUES
(1, 269, 69, 20, 6, 2, 0, 1469647796),
(2, 269, 69, 20, 8, 0, 1, 1469647835),
(3, 268, 70, 20, 16, 0, 2, 1469647996),
(4, 268, 70, 20, 16, 4, 0, 1469648005),
(5, 268, 70, 20, 16, 12, 0, 1469650290),
(6, 270, 72, 20, 14, 26, 0, 1469651023),
(7, 269, 73, 20, 3, 5, 0, 1469651047),
(8, 269, 73, 20, 9, 4, 0, 1469651054),
(9, 269, 73, 20, 8, 0, 2, 1469651071),
(10, 269, 73, 20, 1, 5, 0, 1469651091),
(11, 268, 78, 20, 16, 4, 0, 1469734920),
(12, 268, 94, 20, 16, 8, 0, 1469740647),
(13, 269, 105, 20, 3, 14, 0, 1469821430),
(14, 269, 105, 20, 8, 6, 0, 1469822637),
(15, 269, 105, 20, 9, 0, 1, 1469822648),
(16, 64, 106, 23, 40, 2, 0, 1469825038),
(17, 268, 112, 20, 16, 6, 0, 1469838603),
(18, 268, 112, 20, 40, 6, 0, 1469838752),
(19, 268, 112, 20, 40, 5, 0, 1469838779),
(20, 268, 112, 20, 41, 9, 0, 1469838932),
(21, 269, 113, 24, 40, 2, 0, 1469871482),
(22, 64, 114, 24, 16, 2, 0, 1469871591),
(23, 64, 116, 24, 16, 2, 0, 1469871656),
(24, 269, 117, 24, 40, 5, 0, 1469871711),
(25, 64, 118, 24, 16, 3, 0, 1469871748),
(26, 269, 119, 24, 40, 4, 0, 1469871807),
(27, 64, 120, 24, 9, 4, 0, 1469871880),
(28, 269, 121, 24, 40, 4, 0, 1469871995),
(29, 64, 122, 24, 10, 4, 0, 1469872029),
(30, 269, 123, 24, 42, 5, 0, 1469872129),
(31, 64, 124, 24, 10, 4, 0, 1469872176),
(32, 269, 125, 24, 42, 5, 0, 1469872362),
(33, 64, 126, 24, 14, 5, 0, 1469872381),
(34, 269, 127, 24, 43, 6, 0, 1469872519),
(35, 64, 128, 24, 37, 7, 0, 1469872546),
(36, 269, 129, 24, 45, 8, 0, 1469872669),
(37, 64, 130, 24, 38, 10, 0, 1469872706),
(38, 269, 131, 24, 29, 11, 0, 1469872825),
(39, 64, 132, 24, 5, 12, 0, 1469872872),
(40, 269, 133, 24, 32, 14, 0, 1469872939),
(41, 64, 134, 24, 4, 16, 0, 1469873000),
(42, 269, 135, 24, 25, 20, 0, 1469873063),
(43, 64, 136, 24, 18, 19, 0, 1469873137),
(44, 269, 137, 24, 26, 25, 0, 1469873186),
(45, 269, 139, 25, 30, 2, 0, 1469873352),
(46, 64, 140, 25, 42, 2, 0, 1469873369),
(47, 269, 141, 25, 32, 3, 0, 1469873441),
(48, 64, 142, 25, 42, 2, 0, 1469873462),
(49, 269, 143, 25, 31, 4, 0, 1469873493),
(50, 64, 144, 25, 39, 3, 0, 1469873511),
(51, 269, 145, 25, 29, 5, 0, 1469873575),
(52, 64, 146, 25, 40, 5, 0, 1469873597),
(53, 269, 147, 25, 46, 7, 0, 1469873643),
(54, 64, 148, 25, 9, 7, 0, 1469873676),
(55, 269, 149, 25, 44, 9, 0, 1469873717),
(56, 64, 150, 25, 8, 7, 0, 1469873750),
(57, 269, 151, 25, 45, 11, 0, 1469873793),
(58, 64, 152, 25, 8, 9, 0, 1469873831),
(59, 269, 153, 25, 34, 14, 0, 1469873877),
(60, 64, 154, 25, 18, 10, 0, 1469873915),
(61, 269, 155, 25, 45, 0, 1, 1469873993),
(62, 269, 155, 25, 45, 6, 0, 1469873999),
(63, 64, 156, 25, 38, 17, 0, 1469874027),
(64, 269, 157, 25, 45, 11, 0, 1469874079),
(65, 64, 158, 25, 7, 19, 0, 1469874109),
(66, 269, 159, 25, 32, 0, 1, 1469874185),
(67, 269, 159, 25, 32, 6, 0, 1469874193),
(68, 269, 159, 25, 38, 1, 0, 1469874212),
(69, 64, 160, 25, 23, 24, 0, 1469874243),
(70, 269, 161, 25, 38, 6, 0, 1469874316),
(71, 269, 161, 25, 42, 7, 0, 1469874322),
(72, 269, 164, 26, 73, 2, 0, 1469875132),
(73, 64, 165, 26, 94, 4, 0, 1469875168),
(74, 269, 166, 26, 66, 3, 0, 1469875217),
(75, 64, 167, 26, 91, 4, 0, 1469875235),
(76, 269, 168, 26, 66, 4, 0, 1469875318),
(77, 64, 169, 26, 91, 4, 0, 1469875338),
(78, 269, 170, 26, 66, 4, 0, 1469875397),
(79, 64, 171, 26, 91, 4, 0, 1469875434),
(80, 269, 172, 26, 62, 6, 0, 1469875487),
(81, 64, 173, 26, 92, 5, 0, 1469875519),
(82, 269, 174, 26, 56, 8, 0, 1469875599),
(83, 64, 175, 26, 91, 6, 0, 1469875625),
(84, 269, 176, 26, 52, 9, 0, 1469875823),
(85, 64, 177, 26, 89, 7, 0, 1469875853),
(86, 269, 178, 26, 73, 11, 0, 1469875934),
(87, 64, 179, 26, 86, 10, 0, 1469875972),
(88, 269, 180, 26, 76, 7, 0, 1469876012),
(89, 269, 180, 26, 77, 7, 0, 1469876018),
(90, 64, 181, 26, 81, 13, 0, 1469876032),
(91, 269, 182, 26, 73, 7, 0, 1469876224),
(92, 269, 182, 26, 77, 2, 0, 1469876234),
(93, 269, 182, 26, 76, 2, 0, 1469876239),
(94, 269, 182, 26, 73, 3, 0, 1469876248),
(95, 64, 183, 26, 84, 15, 0, 1469876259),
(96, 269, 184, 26, 71, 10, 0, 1469876400),
(97, 269, 184, 26, 73, 4, 0, 1469876408),
(98, 64, 185, 26, 79, 19, 0, 1469876433),
(99, 269, 186, 26, 77, 13, 0, 1469876583),
(100, 268, 188, 27, 9, 2, 0, 1469880579),
(101, 268, 190, 27, 9, 4, 0, 1469880589),
(102, 268, 192, 27, 10, 3, 0, 1469881614),
(103, 268, 192, 27, 9, 3, 0, 1469881619),
(104, 268, 194, 27, 35, 3, 0, 1469882247),
(105, 268, 194, 27, 35, 2, 0, 1469882266),
(106, 268, 194, 27, 10, 0, 5, 1469962557),
(107, 268, 194, 27, 8, 2, 0, 1469962818),
(108, 268, 198, 27, 8, 27, 0, 1469963001),
(109, 268, 199, 27, 18, 0, 5, 1469963032),
(110, 268, 201, 29, 42, 2, 0, 1469980840),
(111, 268, 203, 29, 42, 3, 0, 1469981246),
(112, 268, 205, 29, 42, 3, 0, 1469981261),
(113, 268, 209, 29, 43, 10, 0, 1469981322),
(114, 269, 210, 29, 32, 13, 0, 1469981596),
(115, 268, 211, 29, 41, 6, 0, 1469982411),
(116, 268, 213, 29, 40, 8, 0, 1469982453),
(117, 268, 215, 29, 16, 9, 0, 1469982572),
(118, 268, 217, 29, 10, 11, 0, 1469982606),
(119, 268, 219, 29, 15, 13, 0, 1469982791),
(120, 268, 221, 29, 11, 5, 0, 1469982854),
(121, 268, 221, 29, 35, 10, 0, 1469983072),
(122, 268, 223, 29, 37, 17, 0, 1469983461),
(123, 268, 227, 29, 14, 41, 0, 1469983823),
(124, 268, 229, 29, 17, 23, 0, 1469984089),
(125, 268, 231, 29, 37, 24, 0, 1469984299),
(126, 268, 233, 29, 18, 12, 0, 1469984490),
(127, 268, 237, 29, 46, 76, 0, 1470082979),
(128, 268, 241, 29, 24, 66, 0, 1470083323),
(129, 268, 256, 30, 41, 4, 0, 1470250863),
(130, 269, 257, 30, 42, 4, 0, 1470250990),
(131, 268, 258, 30, 40, 3, 0, 1470258729),
(132, 275, 259, 31, 20, 2, 0, 1470493950),
(133, 268, 260, 31, 35, 2, 0, 1470494031),
(134, 275, 261, 31, 25, 3, 0, 1470494059),
(135, 268, 262, 31, 35, 2, 0, 1470494111),
(136, 275, 263, 31, 25, 3, 0, 1470494121),
(137, 268, 264, 31, 35, 2, 0, 1470494155),
(138, 275, 265, 31, 21, 4, 0, 1470494174),
(139, 268, 266, 31, 37, 3, 0, 1470494202),
(140, 275, 267, 31, 21, 0, 4, 1470494242),
(141, 268, 268, 31, 7, 4, 0, 1470494259),
(142, 275, 269, 31, 28, 0, 5, 1470494290),
(143, 275, 269, 31, 28, 4, 0, 1470494300),
(144, 275, 271, 31, 20, 0, 3, 1470494340),
(145, 275, 271, 31, 22, 1, 0, 1470494350),
(146, 268, 272, 31, 37, 0, 4, 1470494360),
(147, 268, 272, 31, 7, 3, 0, 1470494367),
(148, 275, 273, 31, 22, 12, 0, 1470494380),
(149, 268, 274, 31, 7, 6, 0, 1470494402),
(150, 275, 275, 31, 32, 5, 0, 1470494443),
(151, 275, 275, 31, 31, 0, 3, 1470494468),
(152, 268, 276, 31, 37, 0, 1, 1470494508),
(153, 268, 276, 31, 37, 2, 0, 1470494514),
(154, 275, 277, 31, 32, 0, 5, 1470494637),
(155, 275, 277, 31, 32, 2, 0, 1470494660),
(156, 275, 277, 31, 20, 2, 0, 1470494698),
(157, 275, 277, 31, 30, 5, 0, 1470494725),
(158, 275, 277, 31, 30, 0, 1, 1470494732),
(159, 275, 277, 31, 30, 1, 0, 1470494739),
(160, 268, 278, 31, 37, 6, 0, 1470494844),
(161, 275, 279, 31, 29, 9, 0, 1470494864),
(162, 275, 279, 31, 25, 11, 0, 1470494871),
(163, 268, 280, 31, 3, 0, 3, 1470494903),
(164, 275, 281, 31, 27, 0, 4, 1470494947),
(165, 275, 281, 31, 24, 8, 0, 1470494959),
(166, 275, 281, 31, 30, 9, 0, 1470494974),
(167, 268, 282, 31, 3, 10, 0, 1470494988),
(168, 275, 283, 31, 1, 0, 1, 1470495040),
(169, 275, 283, 31, 1, 9, 0, 1470495050),
(170, 275, 283, 31, 2, 13, 0, 1470495074),
(171, 268, 284, 31, 3, 10, 0, 1470495606),
(172, 275, 285, 31, 4, 0, 2, 1470495641),
(173, 275, 285, 31, 4, 27, 0, 1470495648),
(174, 268, 286, 31, 37, 5, 0, 1470495722),
(175, 275, 287, 31, 4, 0, 4, 1470495754),
(176, 275, 287, 31, 45, 0, 5, 1470495764),
(177, 268, 287, 31, 37, 28, 0, 1470496060),
(178, 268, 291, 31, 32, 16, 0, 1470496119),
(179, 268, 295, 31, 37, 25, 0, 1470496159),
(180, 268, 299, 31, 7, 27, 0, 1470496182),
(181, 268, 301, 31, 37, 14, 0, 1470496239),
(182, 268, 303, 31, 33, 17, 0, 1470496259),
(183, 268, 307, 31, 32, 0, 2, 1470496407),
(184, 268, 307, 31, 28, 0, 2, 1470496422),
(185, 268, 309, 31, 28, 0, 2, 1470497906),
(186, 268, 309, 31, 28, 0, 1, 1470498409),
(187, 268, 309, 31, 28, 36, 0, 1470498827),
(188, 268, 311, 31, 31, 19, 0, 1470498894),
(189, 268, 313, 31, 31, 19, 0, 1470499030),
(190, 64, 3, 33, 7, 2, 0, 1470561356),
(191, 268, 4, 33, 40, 2, 0, 1470561426),
(192, 275, 5, 33, 39, 2, 0, 1470561455),
(193, 64, 6, 33, 7, 2, 0, 1470561548),
(194, 268, 7, 33, 40, 2, 0, 1470561561),
(195, 275, 8, 33, 39, 2, 0, 1470561589),
(196, 64, 9, 33, 7, 3, 0, 1470561602),
(197, 275, 11, 33, 39, 2, 0, 1470561712),
(198, 64, 12, 33, 3, 5, 0, 1470561735),
(199, 268, 13, 33, 40, 4, 0, 1470561807),
(200, 275, 14, 33, 39, 2, 0, 1470561834),
(201, 64, 15, 33, 7, 6, 0, 1470561918),
(202, 268, 16, 33, 16, 3, 0, 1470561945),
(203, 275, 17, 33, 42, 3, 0, 1470561974),
(204, 64, 18, 33, 3, 6, 0, 1470562031),
(205, 268, 19, 33, 16, 3, 0, 1470562070),
(206, 275, 20, 33, 42, 2, 0, 1470562086),
(207, 64, 21, 33, 4, 7, 0, 1470562110),
(208, 268, 22, 33, 16, 3, 0, 1470562145),
(209, 275, 23, 33, 42, 0, 2, 1470562182),
(210, 64, 24, 33, 6, 5, 0, 1470562212),
(211, 64, 24, 33, 14, 4, 0, 1470562218),
(212, 268, 25, 33, 16, 3, 0, 1470562261),
(213, 275, 26, 33, 42, 3, 0, 1470562290),
(214, 64, 27, 33, 14, 10, 0, 1470562338),
(215, 268, 28, 33, 10, 0, 2, 1470562374),
(216, 275, 29, 33, 43, 0, 5, 1470562430),
(217, 275, 29, 33, 44, 2, 0, 1470562438),
(218, 64, 30, 33, 14, 0, 1, 1470562461),
(219, 64, 30, 33, 14, 0, 2, 1470562466),
(220, 64, 30, 33, 14, 1, 0, 1470562484),
(221, 268, 31, 33, 10, 4, 0, 1470562504),
(222, 275, 32, 33, 44, 0, 5, 1470562516),
(223, 275, 32, 33, 44, 4, 0, 1470562526),
(224, 64, 33, 33, 14, 10, 0, 1470562547),
(225, 268, 34, 33, 10, 3, 0, 1470562623),
(226, 275, 35, 33, 46, 0, 4, 1470562656),
(227, 275, 35, 33, 38, 4, 0, 1470562666),
(228, 64, 36, 33, 18, 10, 0, 1470562681),
(229, 268, 37, 33, 10, 5, 0, 1470562722),
(230, 275, 38, 33, 46, 3, 0, 1470562757),
(231, 275, 38, 33, 38, 8, 0, 1470562790),
(232, 275, 38, 33, 47, 2, 0, 1470562805),
(233, 64, 39, 33, 7, 0, 5, 1470562854),
(234, 64, 39, 33, 2, 8, 0, 1470562877),
(235, 268, 40, 33, 9, 5, 0, 1470562901),
(236, 275, 41, 33, 47, 4, 0, 1470562933),
(237, 275, 41, 33, 29, 0, 5, 1470562950),
(238, 275, 41, 33, 33, 9, 0, 1470563017),
(239, 64, 42, 33, 24, 0, 4, 1470563095),
(240, 64, 42, 33, 18, 0, 5, 1470563104),
(241, 64, 42, 33, 7, 6, 0, 1470563118),
(242, 268, 43, 33, 15, 6, 0, 1470563139),
(243, 275, 44, 33, 42, 4, 0, 1470563176),
(244, 275, 44, 33, 41, 4, 0, 1470563186),
(245, 275, 44, 33, 29, 5, 0, 1470563196),
(246, 275, 44, 33, 30, 0, 5, 1470563227),
(247, 275, 44, 33, 31, 0, 5, 1470563235),
(248, 64, 45, 33, 7, 0, 2, 1470563263),
(249, 64, 45, 33, 24, 0, 1, 1470563278),
(250, 64, 45, 33, 7, 5, 0, 1470563299),
(251, 64, 45, 33, 19, 3, 0, 1470563319),
(252, 268, 46, 33, 40, 7, 0, 1470563355),
(253, 275, 47, 33, 30, 10, 0, 1470563392),
(254, 275, 47, 33, 42, 2, 0, 1470563433),
(255, 275, 47, 33, 41, 2, 0, 1470563442),
(256, 275, 47, 33, 33, 9, 0, 1470563448),
(257, 64, 48, 33, 19, 17, 0, 1470563475),
(258, 268, 49, 33, 20, 8, 0, 1470563560),
(259, 275, 50, 33, 22, 10, 0, 1470563601),
(260, 275, 50, 33, 33, 6, 0, 1470563615),
(261, 275, 50, 33, 37, 8, 0, 1470563636),
(262, 64, 51, 33, 7, 5, 0, 1470563659),
(263, 64, 51, 33, 18, 5, 0, 1470563698),
(264, 64, 51, 33, 18, 8, 0, 1470563731),
(265, 268, 52, 33, 21, 0, 5, 1470563778),
(266, 268, 52, 33, 21, 6, 0, 1470563786),
(267, 275, 53, 33, 23, 0, 3, 1470563820),
(268, 275, 53, 33, 23, 0, 1, 1470563831),
(269, 275, 53, 33, 22, 10, 0, 1470563842),
(270, 275, 53, 33, 34, 3, 0, 1470563849),
(271, 64, 54, 33, 35, 0, 1, 1470563895),
(272, 64, 54, 33, 3, 5, 0, 1470563913),
(273, 64, 54, 33, 14, 9, 0, 1470563922),
(274, 268, 55, 33, 26, 5, 0, 1470563956),
(275, 268, 55, 33, 21, 7, 0, 1470563966),
(276, 275, 56, 33, 23, 3, 0, 1470564023),
(277, 275, 56, 33, 22, 9, 0, 1470564042),
(278, 275, 56, 33, 22, 0, 1, 1470564049),
(279, 275, 56, 33, 37, 0, 1, 1470564056),
(280, 275, 56, 33, 34, 0, 1, 1470564063),
(281, 275, 56, 33, 42, 3, 0, 1470564069),
(282, 64, 57, 33, 35, 5, 0, 1470564098),
(283, 64, 57, 33, 24, 5, 0, 1470564130),
(284, 64, 57, 33, 2, 10, 0, 1470564139),
(285, 268, 58, 33, 27, 0, 2, 1470564153),
(286, 268, 58, 33, 27, 10, 0, 1470564161),
(287, 275, 59, 33, 37, 0, 2, 1470564215),
(288, 275, 59, 33, 37, 14, 0, 1470564230),
(289, 275, 59, 33, 37, 12, 0, 1470564246),
(290, 269, 61, 35, 41, 2, 0, 1470688333),
(291, 268, 62, 35, 40, 2, 0, 1470688354),
(292, 269, 63, 35, 39, 3, 0, 1470688372),
(293, 269, 65, 35, 42, 4, 0, 1470690999),
(294, 268, 66, 35, 40, 4, 0, 1470692266),
(295, 269, 68, 37, 3, 2, 0, 1470762091),
(296, 268, 69, 37, 5, 2, 0, 1470762116),
(297, 269, 70, 37, 4, 3, 0, 1470762135),
(298, 268, 71, 37, 7, 3, 0, 1470767958),
(299, 269, 72, 37, 6, 4, 0, 1470767977),
(300, 268, 73, 37, 1, 4, 0, 1470768187),
(301, 269, 74, 37, 18, 5, 0, 1470768206);

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `chat_game_id` int(12) NOT NULL,
  `chat_user_id` int(12) NOT NULL,
  `chat_message` varchar(256) NOT NULL,
  `chat_time` int(12) NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`chat_id`, `chat_game_id`, `chat_user_id`, `chat_message`, `chat_time`) VALUES
(1, 29, 269, 'Test 1', 1470086492),
(2, 29, 268, 'Test 2 ', 1470086400),
(3, 29, 268, 'Test 2 ', 1470086455),
(4, 29, 268, 'Test 3', 1470086800),
(5, 29, 268, 'Test 2 ', 1470086900),
(6, 29, 268, 'Test 2 ', 1470086950),
(7, 29, 268, 'Test 2 ', 1470088000),
(8, 29, 268, 'test45', 1470089400),
(9, 29, 268, 'testAjax', 1470091240),
(10, 29, 268, 'testAjax', 1470091249),
(11, 29, 268, 'testAjax', 1470091252),
(12, 29, 268, 'essai', 1470091334),
(13, 29, 268, 'essai2', 1470091392),
(14, 29, 268, 'zaeaze', 1470091418),
(15, 29, 268, 'azeazezaezaeazezaeaz', 1470091461),
(16, 29, 268, 'az', 1470091527),
(17, 29, 269, 'azezfdscdzczeafezaf', 1470091527),
(18, 29, 268, 'alpha', 1470091641),
(19, 29, 268, 'zaeaze', 1470091677),
(20, 29, 268, 'essaiazdf', 1470091708),
(21, 29, 268, 'test', 1470154184),
(22, 29, 268, 'test2', 1470154210),
(23, 29, 268, '1234', 1470154962),
(24, 29, 268, '5678', 1470155000),
(25, 29, 268, 'test46', 1470155233),
(26, 29, 268, 'je fais des tests', 1470155488),
(27, 29, 200, '5678', 1470155000),
(28, 29, 268, 'je fais des tests 2', 1470249614),
(29, 29, 268, 'je fais des tests 3', 1470249626),
(30, 31, 268, 'fesse', 1470494062),
(31, 31, 268, 'nullard', 1470494929),
(32, 31, 268, 'Gros !!!', 1470494941),
(33, 31, 275, 'coucou', 1470495950),
(34, 32, 268, 'test', 1470504436),
(35, 33, 64, 'wesh', 1470561405),
(36, 33, 268, 'fesse', 1470561501),
(37, 33, 275, 'gros lard', 1470561517),
(38, 33, 64, 'tu pues', 1470561574),
(39, 33, 268, 'Tut gros ', 1470561621),
(40, 33, 64, 'gros', 1470561673);

-- --------------------------------------------------------

--
-- Structure de la table `chat_read`
--

CREATE TABLE IF NOT EXISTS `chat_read` (
  `chat_read_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `chat_read_game_id` int(12) NOT NULL,
  `chat_read_user_id` int(12) NOT NULL,
  `chat_read_time` int(12) NOT NULL,
  PRIMARY KEY (`chat_read_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `chat_read`
--

INSERT INTO `chat_read` (`chat_read_id`, `chat_read_game_id`, `chat_read_user_id`, `chat_read_time`) VALUES
(1, 29, 268, 1470086803),
(2, 29, 268, 1470089229),
(3, 29, 268, 1470089231),
(4, 29, 268, 1470089238),
(5, 29, 268, 1470089241),
(6, 29, 268, 1470089241),
(7, 29, 268, 1470089244),
(8, 29, 268, 1470089388),
(9, 29, 268, 1470089391),
(10, 29, 268, 1470089394),
(11, 29, 268, 1470089431),
(12, 29, 268, 1470091259),
(13, 29, 268, 1470091632),
(14, 29, 268, 1470163301),
(15, 31, 275, 1470494072),
(16, 31, 275, 1470495121),
(17, 31, 268, 1470495958),
(18, 33, 268, 1470561455),
(19, 33, 275, 1470561501),
(20, 33, 275, 1470561505),
(21, 33, 64, 1470561552),
(22, 33, 268, 1470561563),
(23, 33, 275, 1470561575),
(24, 33, 268, 1470561605),
(25, 33, 64, 1470561657),
(26, 33, 268, 1470561719),
(27, 33, 275, 1470562874);

-- --------------------------------------------------------

--
-- Structure de la table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `color_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `color_name` varchar(64) NOT NULL,
  `color_codeHex` varchar(128) NOT NULL,
  `color_code` varchar(128) NOT NULL,
  `color_css` varchar(128) NOT NULL,
  `color_font_chat` varchar(128) NOT NULL,
  `color_font_news` varchar(128) NOT NULL,
  `color_font_other` varchar(128) NOT NULL,
  `color_hide` int(11) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `color`
--

INSERT INTO `color` (`color_id`, `color_name`, `color_codeHex`, `color_code`, `color_css`, `color_font_chat`, `color_font_news`, `color_font_other`, `color_hide`) VALUES
(1, 'grey', '0x80;0x80;0x80;', '201;201;201;', 'C6C3C5', 'black', 'grey', 'grey', 1),
(2, 'red', '0xFF;0;0;', '255;0;0;', 'FF7373', 'white', 'red', 'red', 0),
(3, 'blue', '0;0;0xFF;', '0;0;255;', '2676FF', 'black', 'blue', 'blue', 0),
(4, 'green', '0;0xFF;0;', '0;255;0;', '26FF4E', 'black', 'green', '#00FF40', 0),
(5, 'yellow', '0xFF;0xFF;0x00;', '214;255;0;', 'E9FF51', 'black', '#D5D200', 'yellow', 0),
(6, 'black', '0x00;0x00;0x00;', '0;0;0;', '3C3C3C', 'white', 'black', 'black', 0),
(7, 'orange', '0xFF;0x99;0x00;', '255;165;0;', 'FF9A40', 'black', 'orange', 'orange', 0),
(8, 'purple', '0x80;0x00;0x80;', '255;0;219;', 'FF40D3', 'black', 'purple', '#FF63E3', 0),
(9, 'white', '', '252;255;249;', 'FFFAFA', 'black', 'white', 'white', 0),
(10, 'turquoise', '', '0;255;230;', '00FFE6', 'black', '#00FFE6', '#00FFE6', 0),
(11, 'pink', '', '239;0;255;', '00FFE6', 'white', '#EF00FF', '#EF00FF', 0);

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

CREATE TABLE IF NOT EXISTS `continent` (
  `continent_id` int(16) NOT NULL AUTO_INCREMENT,
  `continent_name` varchar(126) NOT NULL,
  `continent_bonus` int(16) NOT NULL,
  `continent_land_id_begin` int(16) NOT NULL,
  `continent_land_id_end` int(16) NOT NULL,
  `continent_hide` int(11) NOT NULL,
  `continent_map_id` int(11) NOT NULL,
  PRIMARY KEY (`continent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `continent`
--

INSERT INTO `continent` (`continent_id`, `continent_name`, `continent_bonus`, `continent_land_id_begin`, `continent_land_id_end`, `continent_hide`, `continent_map_id`) VALUES
(1, 'Europe', 5, 1, 7, 0, 1),
(2, 'Asia', 7, 8, 19, 0, 1),
(3, 'North_America', 5, 20, 28, 0, 1),
(4, 'South_America', 2, 29, 32, 0, 1),
(5, 'Africa', 3, 33, 38, 0, 1),
(6, 'Oceania', 2, 39, 42, 0, 1),
(7, 'Antarctica', 2, 43, 47, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `difficulty`
--

CREATE TABLE IF NOT EXISTS `difficulty` (
  `difficulty_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `difficulty_name` varchar(256) NOT NULL,
  `difficulty_rate_bot_units` int(12) NOT NULL,
  `difficulty_rate_resources` int(12) NOT NULL,
  `difficulty_rate_oper` varchar(64) NOT NULL,
  `difficulty_rate_units_atk` int(12) NOT NULL,
  `difficulty_rate_units_def` int(12) NOT NULL,
  `difficulty_rate_atk_frt` int(12) NOT NULL,
  `difficulty_rate_def_pc` int(12) NOT NULL,
  `difficulty_rate_exec_atk` int(12) NOT NULL,
  `difficulty_rate_exec_def` int(12) NOT NULL,
  `difficulty_rate_exec_build` int(12) NOT NULL,
  `difficulty_marge_frt` int(12) NOT NULL,
  `difficulty_marge_pc` int(12) NOT NULL,
  `difficulty_build_mine` int(12) NOT NULL,
  PRIMARY KEY (`difficulty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `difficulty`
--

INSERT INTO `difficulty` (`difficulty_id`, `difficulty_name`, `difficulty_rate_bot_units`, `difficulty_rate_resources`, `difficulty_rate_oper`, `difficulty_rate_units_atk`, `difficulty_rate_units_def`, `difficulty_rate_atk_frt`, `difficulty_rate_def_pc`, `difficulty_rate_exec_atk`, `difficulty_rate_exec_def`, `difficulty_rate_exec_build`, `difficulty_marge_frt`, `difficulty_marge_pc`, `difficulty_build_mine`) VALUES
(1, 'Very_easy', 50, 50, '+', 100, 80, 70, 70, 60, 60, 70, 30, 30, 70),
(2, 'Easy', 30, 30, '+', 90, 70, 60, 60, 70, 70, 80, 35, 35, 75),
(3, 'Normal', 0, 0, '+', 80, 60, 60, 60, 80, 80, 90, 40, 40, 80),
(4, 'Hard', 2, 30, '-', 70, 50, 50, 50, 90, 90, 95, 50, 50, 90),
(5, 'Very_hard', 4, 50, '-', 60, 40, 40, 40, 100, 100, 100, 60, 60, 100);

-- --------------------------------------------------------

--
-- Structure de la table `fight`
--

CREATE TABLE IF NOT EXISTS `fight` (
  `fight_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `fight_game_id` int(12) NOT NULL,
  `fight_atk_user_id` int(12) NOT NULL,
  `fight_def_user_id` int(12) NOT NULL,
  `fight_atk_land_id` int(12) NOT NULL,
  `fight_def_land_id` int(12) NOT NULL,
  `fight_atk_nb_units` int(11) NOT NULL,
  `fight_def_nb_units` int(11) NOT NULL,
  `fight_atk_lost_unit` int(12) NOT NULL,
  `fight_def_lost_unit` int(12) NOT NULL,
  `fight_atk_units` varchar(2048) NOT NULL,
  `fight_def_units` varchar(2048) NOT NULL,
  `fight_thimble_atk` varchar(2048) NOT NULL,
  `fight_thimble_def` varchar(2048) NOT NULL,
  `fight_time` int(12) NOT NULL,
  `fight_turn_id` int(12) NOT NULL,
  `fight_conquest` int(12) NOT NULL,
  PRIMARY KEY (`fight_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `fight`
--

INSERT INTO `fight` (`fight_id`, `fight_game_id`, `fight_atk_user_id`, `fight_def_user_id`, `fight_atk_land_id`, `fight_def_land_id`, `fight_atk_nb_units`, `fight_def_nb_units`, `fight_atk_lost_unit`, `fight_def_lost_unit`, `fight_atk_units`, `fight_def_units`, `fight_thimble_atk`, `fight_thimble_def`, `fight_time`, `fight_turn_id`, `fight_conquest`) VALUES
(1, 37, 268, 0, 1, 2, 7, 3, 4, 3, '/7/5/4/3/3', '/3/3/2/1/0', '/1;1;1;/6;2;2;/6;1;1;/6;6;6;', '/6;2;/4;3;/2;1;/4;', 1470768196, 73, 1),
(2, 37, 269, 0, 18, 17, 9, 4, 3, 4, '/9/9/8/7/6/6', '/4/2/1/1/1/0', '/6;5;2;/3;3;2;/4;3;3;/5;3;1;/5;2;2;', '/4;2;/4;1;/4;/6;/2;', 1470768217, 74, 1);

-- --------------------------------------------------------

--
-- Structure de la table `frontier`
--

CREATE TABLE IF NOT EXISTS `frontier` (
  `frontier_id` int(16) NOT NULL AUTO_INCREMENT,
  `frontier_land_id_one` int(16) NOT NULL,
  `frontier_land_id_two` int(16) NOT NULL,
  `frontier_map_id` int(11) NOT NULL,
  PRIMARY KEY (`frontier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=384 ;

--
-- Contenu de la table `frontier`
--

INSERT INTO `frontier` (`frontier_id`, `frontier_land_id_one`, `frontier_land_id_two`, `frontier_map_id`) VALUES
(1, 1, 2, 1),
(2, 1, 7, 1),
(3, 1, 4, 1),
(4, 1, 3, 1),
(5, 2, 1, 1),
(6, 2, 4, 1),
(7, 2, 24, 1),
(8, 7, 1, 1),
(9, 7, 3, 1),
(10, 7, 5, 1),
(11, 4, 2, 1),
(12, 4, 1, 1),
(13, 4, 3, 1),
(14, 4, 6, 1),
(15, 3, 1, 1),
(16, 3, 4, 1),
(17, 3, 7, 1),
(18, 3, 5, 1),
(19, 3, 6, 1),
(20, 5, 3, 1),
(21, 5, 7, 1),
(22, 5, 6, 1),
(23, 5, 35, 1),
(24, 6, 4, 1),
(25, 6, 5, 1),
(26, 6, 14, 1),
(27, 6, 8, 1),
(28, 6, 18, 1),
(29, 7, 37, 1),
(30, 6, 3, 1),
(31, 8, 6, 1),
(32, 8, 18, 1),
(33, 8, 9, 1),
(34, 8, 10, 1),
(35, 8, 14, 1),
(36, 9, 8, 1),
(37, 9, 10, 1),
(38, 9, 16, 1),
(39, 9, 15, 1),
(40, 9, 17, 1),
(41, 9, 18, 1),
(42, 10, 16, 1),
(43, 10, 9, 1),
(44, 10, 8, 1),
(45, 10, 14, 1),
(46, 11, 13, 1),
(47, 11, 19, 1),
(48, 11, 17, 1),
(49, 11, 15, 1),
(50, 12, 13, 1),
(51, 12, 15, 1),
(52, 13, 12, 1),
(53, 13, 19, 1),
(54, 13, 11, 1),
(55, 13, 15, 1),
(56, 14, 10, 1),
(57, 14, 8, 1),
(58, 14, 6, 1),
(59, 14, 5, 1),
(60, 14, 35, 1),
(61, 14, 34, 1),
(62, 15, 12, 1),
(63, 15, 13, 1),
(64, 15, 11, 1),
(65, 15, 17, 1),
(66, 15, 9, 1),
(67, 16, 9, 1),
(68, 16, 10, 1),
(69, 16, 40, 1),
(70, 17, 19, 1),
(71, 17, 11, 1),
(72, 17, 15, 1),
(73, 17, 9, 1),
(74, 17, 18, 1),
(75, 18, 17, 1),
(76, 18, 8, 1),
(77, 18, 6, 1),
(78, 18, 9, 1),
(79, 19, 17, 1),
(80, 19, 11, 1),
(81, 19, 13, 1),
(82, 5, 14, 1),
(83, 13, 20, 1),
(84, 20, 13, 1),
(85, 20, 25, 1),
(86, 20, 21, 1),
(87, 21, 20, 1),
(88, 21, 25, 1),
(89, 21, 26, 1),
(90, 21, 28, 1),
(91, 22, 32, 1),
(92, 22, 28, 1),
(93, 22, 23, 1),
(94, 23, 22, 1),
(95, 23, 28, 1),
(96, 23, 26, 1),
(97, 23, 27, 1),
(98, 24, 2, 1),
(99, 24, 27, 1),
(100, 24, 26, 1),
(101, 24, 25, 1),
(103, 25, 26, 1),
(104, 25, 21, 1),
(105, 25, 20, 1),
(106, 26, 24, 1),
(107, 26, 27, 1),
(108, 26, 23, 1),
(109, 26, 28, 1),
(110, 26, 21, 1),
(111, 26, 25, 1),
(112, 27, 24, 1),
(113, 27, 26, 1),
(114, 27, 23, 1),
(115, 28, 23, 1),
(116, 28, 22, 1),
(117, 28, 21, 1),
(118, 28, 26, 1),
(119, 25, 24, 1),
(120, 29, 30, 1),
(121, 29, 31, 1),
(122, 30, 29, 1),
(123, 30, 31, 1),
(124, 30, 32, 1),
(125, 31, 29, 1),
(126, 31, 30, 1),
(127, 31, 32, 1),
(128, 32, 30, 1),
(129, 32, 31, 1),
(130, 32, 22, 1),
(131, 33, 38, 1),
(132, 33, 34, 1),
(133, 33, 37, 1),
(134, 34, 38, 1),
(135, 34, 33, 1),
(136, 34, 37, 1),
(137, 34, 35, 1),
(138, 34, 14, 1),
(139, 35, 14, 1),
(140, 35, 5, 1),
(141, 35, 37, 1),
(142, 35, 34, 1),
(143, 36, 34, 1),
(144, 36, 38, 1),
(145, 37, 7, 1),
(146, 37, 35, 1),
(147, 37, 34, 1),
(148, 37, 33, 1),
(149, 38, 36, 1),
(150, 38, 34, 1),
(151, 38, 33, 1),
(152, 34, 36, 1),
(153, 39, 41, 1),
(154, 39, 42, 1),
(155, 40, 16, 1),
(156, 40, 41, 1),
(157, 40, 42, 1),
(158, 41, 39, 1),
(159, 41, 40, 1),
(160, 41, 42, 1),
(161, 42, 39, 1),
(162, 42, 41, 1),
(163, 42, 40, 1),
(164, 37, 30, 1),
(165, 30, 37, 1),
(166, 43, 44, 1),
(167, 43, 42, 1),
(168, 42, 43, 1),
(169, 44, 43, 1),
(170, 44, 45, 1),
(171, 45, 44, 1),
(172, 45, 38, 1),
(173, 38, 45, 1),
(174, 45, 46, 1),
(175, 46, 45, 1),
(176, 46, 47, 1),
(177, 47, 46, 1),
(178, 47, 29, 1),
(179, 29, 47, 1),
(180, 48, 49, 2),
(181, 48, 52, 2),
(182, 49, 48, 2),
(183, 49, 50, 2),
(184, 49, 51, 2),
(185, 49, 52, 2),
(186, 50, 51, 2),
(187, 50, 49, 2),
(188, 50, 54, 2),
(189, 51, 49, 2),
(190, 51, 50, 2),
(191, 51, 52, 2),
(192, 51, 53, 2),
(193, 51, 54, 2),
(194, 52, 49, 2),
(195, 52, 48, 2),
(196, 52, 51, 2),
(197, 52, 53, 2),
(198, 52, 55, 2),
(199, 52, 56, 2),
(200, 53, 52, 2),
(201, 53, 55, 2),
(202, 53, 63, 2),
(203, 53, 61, 2),
(204, 53, 54, 2),
(205, 53, 51, 2),
(206, 54, 51, 2),
(207, 54, 53, 2),
(208, 54, 50, 2),
(209, 54, 61, 2),
(210, 54, 63, 2),
(211, 55, 52, 2),
(212, 55, 56, 2),
(213, 55, 53, 2),
(214, 55, 63, 2),
(215, 55, 62, 2),
(216, 55, 60, 2),
(217, 56, 52, 2),
(218, 56, 55, 2),
(219, 56, 59, 2),
(220, 56, 60, 2),
(221, 58, 61, 2),
(222, 58, 65, 2),
(223, 58, 69, 2),
(224, 58, 70, 2),
(225, 59, 66, 2),
(226, 59, 56, 2),
(227, 59, 60, 2),
(228, 60, 59, 2),
(229, 60, 66, 2),
(230, 60, 62, 2),
(231, 60, 67, 2),
(232, 60, 55, 2),
(233, 60, 56, 2),
(234, 61, 58, 2),
(235, 61, 65, 2),
(236, 61, 63, 2),
(237, 61, 53, 2),
(238, 61, 54, 2),
(239, 62, 55, 2),
(240, 62, 60, 2),
(241, 62, 63, 2),
(242, 62, 64, 2),
(243, 62, 68, 2),
(244, 62, 67, 2),
(245, 63, 55, 2),
(246, 63, 53, 2),
(247, 63, 54, 2),
(248, 63, 61, 2),
(249, 63, 65, 2),
(250, 63, 64, 2),
(251, 63, 62, 2),
(252, 64, 62, 2),
(253, 64, 63, 2),
(254, 64, 65, 2),
(255, 64, 68, 2),
(256, 65, 64, 2),
(257, 65, 63, 2),
(258, 65, 61, 2),
(259, 65, 58, 2),
(260, 65, 69, 2),
(261, 65, 68, 2),
(262, 66, 59, 2),
(263, 66, 60, 2),
(264, 66, 67, 2),
(265, 66, 72, 2),
(266, 67, 60, 2),
(267, 67, 62, 2),
(268, 67, 68, 2),
(269, 67, 73, 2),
(270, 67, 72, 2),
(271, 67, 66, 2),
(272, 68, 67, 2),
(273, 68, 62, 2),
(274, 68, 64, 2),
(275, 68, 65, 2),
(276, 68, 69, 2),
(277, 68, 77, 2),
(278, 68, 76, 2),
(279, 68, 73, 2),
(280, 69, 68, 2),
(281, 69, 65, 2),
(282, 69, 58, 2),
(283, 69, 77, 2),
(284, 69, 70, 2),
(285, 69, 71, 2),
(286, 70, 58, 2),
(287, 70, 69, 2),
(288, 70, 71, 2),
(289, 71, 70, 2),
(290, 71, 77, 2),
(291, 71, 69, 2),
(292, 71, 78, 2),
(293, 72, 66, 2),
(294, 72, 67, 2),
(295, 72, 73, 2),
(296, 73, 68, 2),
(297, 73, 76, 2),
(298, 73, 75, 2),
(299, 73, 72, 2),
(300, 73, 67, 2),
(301, 74, 75, 2),
(302, 74, 81, 2),
(303, 75, 74, 2),
(304, 75, 73, 2),
(305, 75, 76, 2),
(306, 75, 81, 2),
(307, 76, 81, 2),
(308, 76, 75, 2),
(309, 76, 73, 2),
(310, 76, 68, 2),
(311, 76, 77, 2),
(312, 76, 84, 2),
(313, 76, 85, 2),
(314, 77, 76, 2),
(315, 77, 68, 2),
(316, 77, 69, 2),
(317, 77, 71, 2),
(318, 77, 78, 2),
(319, 77, 80, 2),
(320, 77, 83, 2),
(321, 77, 84, 2),
(322, 78, 71, 2),
(323, 78, 77, 2),
(324, 78, 80, 2),
(325, 78, 79, 2),
(326, 79, 80, 2),
(327, 79, 78, 2),
(328, 80, 79, 2),
(329, 80, 78, 2),
(330, 80, 77, 2),
(331, 80, 83, 2),
(332, 80, 82, 2),
(333, 81, 74, 2),
(334, 81, 75, 2),
(335, 81, 76, 2),
(336, 81, 85, 2),
(337, 81, 87, 2),
(338, 82, 83, 2),
(339, 82, 80, 2),
(340, 83, 82, 2),
(341, 83, 80, 2),
(342, 83, 77, 2),
(343, 83, 84, 2),
(344, 84, 83, 2),
(345, 84, 77, 2),
(346, 84, 76, 2),
(347, 84, 85, 2),
(348, 84, 86, 2),
(349, 85, 84, 2),
(350, 85, 76, 2),
(351, 85, 81, 2),
(352, 85, 87, 2),
(353, 85, 86, 2),
(354, 86, 85, 2),
(355, 86, 84, 2),
(356, 86, 87, 2),
(357, 87, 86, 2),
(358, 87, 85, 2),
(359, 87, 81, 2),
(360, 87, 89, 2),
(361, 87, 88, 2),
(362, 88, 87, 2),
(363, 88, 89, 2),
(364, 89, 88, 2),
(365, 89, 87, 2),
(366, 89, 91, 2),
(367, 89, 93, 2),
(368, 89, 94, 2),
(369, 90, 92, 2),
(370, 91, 92, 2),
(371, 91, 89, 2),
(372, 91, 93, 2),
(373, 92, 91, 2),
(374, 92, 90, 2),
(375, 92, 93, 2),
(376, 93, 92, 2),
(377, 93, 91, 2),
(378, 93, 89, 2),
(379, 93, 94, 2),
(380, 94, 93, 2),
(381, 94, 89, 2),
(382, 79, 95, 2),
(383, 95, 79, 2);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `game_name` varchar(256) NOT NULL,
  `game_owner_id` int(12) NOT NULL,
  `game_max_player` int(12) NOT NULL,
  `game_create_time` int(12) NOT NULL,
  `game_statut` int(12) NOT NULL,
  `game_map_id` int(11) NOT NULL,
  `game_map_cont` int(11) NOT NULL,
  `game_mod_id` int(12) NOT NULL,
  `game_turn_time` int(11) NOT NULL,
  `game_difficulty_id` int(12) NOT NULL,
  `game_won_user_id` int(12) NOT NULL,
  `game_won_time` int(12) NOT NULL,
  `game_pwd` varchar(512) NOT NULL,
  `game_key` varchar(256) NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`game_id`, `game_name`, `game_owner_id`, `game_max_player`, `game_create_time`, `game_statut`, `game_map_id`, `game_map_cont`, `game_mod_id`, `game_turn_time`, `game_difficulty_id`, `game_won_user_id`, `game_won_time`, `game_pwd`, `game_key`) VALUES
(20, 'KKF2uStg23GuOLtyMwH3efQHRYUXr8Q4uq+n35zLIO4=', 269, 4, 1467756950, 50, 1, 0, 0, 0, 0, 0, 0, 'Qz+MxwBUa9xEX5dZMx7/vECgaxwnpEsOPzJsAfGk2A5yHVbevbx5tEQGVqXo2/F4UJgooz1Z4olWlUWYMRrug1LWIW1eyp2CrPbmF4n5AR/RqcwTpL5M7Fb3f2ce8eJi|xVpfQsJ2kPkyROIFoXZOWXUG5F7YcgwcB1hcmY+ANEA=', '0'),
(21, 'rXSa8cf6Xo4p7wAI/cWmdL2yvhPpHC32uLfIV0kMD7s=', 268, 2, 1467788633, 0, 1, 0, 0, 0, 0, 0, 0, 'nWLuWM8Bs1N9MK2bSFJzy99FC/zmbgSJER6xSc13jENlsMUMDzWO/FWG+1tnBMfNEYIlaN7HPj6PYhCma6Z4RuCx+kwobYCxGFDM2TVAPLc4rLlZLIwZvYhX2M+p1iLY|Pkw+SlB7zZCBEvI4PxNtEo20AbR13jD/cpJuMw4pJ2U=', '0'),
(22, 'SBuFfByaORCOFC9I3qGdIig8+lcquJFW4GFK6KFWxjk=', 268, 3, 1467814714, 0, 1, 0, 0, 0, 0, 0, 0, 'VYugfxfuTTDtV/GkgHB7WbsjLjvjYtK+Uth2GTXNoPYfw0Kn+wtilOe+4xZZyq1PFpyoxBTkDxvMvA0sm8L+60+pgm9guQaNkuZNPCJzS6DZqLqy3fJTI7ezBtNEGNBC|6mKCzP2s4b266LDpYIyTzQJ7i18jVNZlgO4UdBdUyko=', '0'),
(23, 'rRG88GHUbmIJ1kweiLp8MOu+B/ZGmh2gSr390PmMFWo=', 64, 10, 1469824684, 50, 1, 0, 0, 0, 0, 0, 0, 'ayXWcBYC2ElkBFv8aXkoGRslwQLh4kgd0erQGwp5+4PYKOvutEvaL53t//bg73k974IpJ93uKHygrO1h7aIpVNG72OFkn2hShvCttTeAf3zIb8b51vhbwMVfKS4ZxatL|mkNBkQvEwJKxEN0AWuufoJAP2XRgYUupoQYNHzdtJ+M=', '0'),
(24, 'aWKmeQ6+ZCRk9BS5OfpQZymbfTmF1B8a1EP/G/XPTN8=', 269, 2, 1469870437, 50, 1, 0, 0, 0, 0, 0, 0, 'x5BnDpvX4nS8h6dV3r3S6OaNhqqbbyAaFo3gKmG6tdILUisMd93C2EX1OgCFhwXxFyhti0ueJoAkSwEX/XUwtKllce9aqEIhYu14K8/0QBOqL1dltB+lHNREi8hzBRG9|4OxKTRwMSwn0z9r5EpyWd45TCxo2afxziSGgzqtIJP0=', '0'),
(25, 'zxv4eqFFkQk64fRAJUycg+Cb7z0+XHHFPS+PFqNjzec=', 64, 2, 1469873273, 50, 1, 0, 0, 0, 0, 0, 0, 'uTta22hVyEvOUL1BOg6ic9EvIwmXoJpRCx1cBvBo9HpAL7ghtppRHkgTZg53TeFO9MGsUrLIbOArjkUCKFcQQRBHKfj65HWL7I8MY/QcTcAhk3CxQTpnY1YhlzPgBGNZ|NjnYsa+dywaUU/O9fS5nJLtAsm7PI5abAJlHoJ63NF4=', '0'),
(26, 'QskEgIt3Ae5zDVjMaB5E9ypLG5UaUnZ6xmgiq2AH/Uo=', 64, 2, 1469874419, 50, 2, 0, 0, 0, 0, 0, 0, 'C2Dqlr7E2DXnuZzmli491Lov3KqqwHqskSpNWunYgN7qCaexZNd+i3FxsI8k9J79Uft4czPG6+l8cHnfN9pQOxv6OHBDNuiDQqW53lNxhjiD7ucEppnrnHE9Q4dRESjX|yzL0GXkk5GCrPyvzGpzMC3mneFgFi6JBeDZxcZazUUI=', '0'),
(27, '+c7XD2iURN/n6pDezBkrrsgmP+W5Fum0b7duPLXEY/8=', 268, 5, 1469880059, 50, 1, 0, 0, 0, 0, 0, 0, 'OLPrRwBg2nD0BaEOqrv3YlhFiGZdsYt+hltZ7BGsfGkysNYimj1bzO7z8EKTi2Hel+Xh8TGTFfLariVCtyGyqbvwR/wF7kK2LxlWpqelU2WYYzQwXMibMp0iARlhIdjv|edoMixGIUbZaVTBda6yJXk+dlNNd+9nIVcZaGMjDkQE=', '0'),
(28, '6MlxQzAwmdYk6WmN1W5TGq9/lebJ7Yg2BO/Lf+ROF5k=', 270, 4, 1469882658, 50, 1, 0, 0, 0, 0, 0, 0, 'CHH8REOvpvmRVHRJHZIOnxf7Ici9XKK1Achj7GkmnVxkzU5a+HjRw/6cCp0sAb0j6BnbaIntmwhD1DXfDzMH6mKQmigNs0JNSN2bqxp5LPMy/5hD2iWu25SKtWlCHHev|+gYPvHdFAy87Sf7kKo85JgtCRmoaTbrsWdq8BnXaWoU=', '0'),
(29, 'zXyrn5MSXAqXAOsKeimSwlEjjCwvHWVMCdtKcdon/tQ=', 268, 3, 1469978757, 50, 1, 0, 0, 0, 0, 0, 0, 'nzNfWHuynxGpkq87QSlzgSFYFpufuUfcMDrRW1Ju7g95FasZaQkP8kOAnxY+nnpa8zkn08NRDS4fj/vpn140no3UMQm9GKbncwjBa06Zm62Dp30yf7n7fUaVZgbB9ZUE|jeelXstrgg8ppEH7y7QtR8Ef7EQTadWwoypTn18GT44=', '0'),
(30, 'eO/tOBe7vpobVYzUR9LE6XaR/7pQBR6T6lyScXV7n8E=', 268, 5, 1470250448, 50, 1, 0, 0, 0, 0, 0, 0, '1tW2cclVbSfRyPLegk1CUd3a7jDLg7OMcnuP7qDVAGuTIczQCbzNJXeMKN2JEiEKuGPezp30KuyVsnFN8Iexi292HpjLi0RBk8sqhX4K5FL88/KASCIxKx3meP26y4fg|Kz7PdJwH4H1M0x0oUP8nOM3qsgxXfNTuO4jnUlu20Ow=', '0'),
(31, 'Vd5LSunmxAHL2zFL4kJFVWG2Vay0i5OMTgbvnq2tTM4=', 275, 4, 1470493827, 50, 1, 0, 0, 0, 0, 0, 0, '/QXnhplioleb6s7up/7X7NLCRLaarGzA3Drp/b0KsQhKIBJqeZhvAKTGGl6V+4I+E16HLP9mEg3gy+vQXHteniifj8/DupKEPWkOoexhKp/wrxt/uIMqb5yksNwSp2wF|fmaoBHq/9vDo+xGa1IZPfzYwYAt9eOX5l5/JUfx5yqM=', '0'),
(32, 'bWOTfbD1r2AUfFx/yXewGC11cfT6D/kDaZAlx40CTl8=', 268, 5, 1470503834, 50, 1, 0, 0, 0, 0, 0, 0, 'vnW9gVJFFOA0VtF0TWcNZHAMEn9pGtQ14NicQ2SE/Aw9mZj47uEGRH5Pf2eYxLay/Ge8JDQDg6R7zlTFvVSC6RtcypDt0gOFnAo6YqhFSBpProqyubVA2L8aDlXeCCHW|hUfBFOEFhizN5h35Xr45LnM39/IY2OFV9EtkJ64ZYiI=', '0'),
(33, 'Vd5LSunmxAHL2zFL4kJFVWG2Vay0i5OMTgbvnq2tTM4=', 275, 5, 1470561187, 50, 1, 0, 0, 0, 0, 0, 0, 'l0qmpWWdNIma9aJf4eWtfP7W5tL764QfVLChx6H2a0tpaYQeaqhsoiFevd+LghvC0mWIYAXA8LBIxIETOaOigvUEegluCHg5moFL4flmdMIWvW1yIJW++6F67rdrC3nb|zKqajtLXa4TOfxmxP9ZSVne8P/TRdLjnEXpGV6kpFfA=', '0'),
(34, '0VeUPD3aA0f+JRdz8UYkrVtNBpRL7rNJTfXs67qGAUM=', 268, 5, 1470687416, 50, 1, 0, 0, 0, 0, 0, 0, 'Pvdw5PXWHTcECchhjwITfd5L7HvtdfujScGKI3RhZvZoduSxz4mhEjYN/f2FlGFWlFC/cN/5krVLuwKTGs6cAJHImtmzk4wi9117DBuVhZoeuUbOACR6NC0hDk5aL3F9|MbEgokyDiQ1p8X3tIuAfEpOStO+1MBdlbuF1DChU8Vw=', '0'),
(35, 'WLQ/DogiJLlaRBjlq3xbdpqIGxrWUAXE5v90xLLGLDk=', 268, 2, 1470688094, 50, 1, 0, 0, 0, 0, 0, 0, 'YSLWuGRNSriLLHptpcw60vqzlbrqL57FVD+FkAIUgqWnDs3MVEGqu8AUIMEU9eC3v8TycaY37JypPzSc6E1HodnuzrLjqO6le9fOj6PVcUppdTDdBvqiAIod4c7cJqHn|mqDFPGRwGap1hujr08FaHXkSkh928prunrR7jToQGt8=', '0'),
(36, 'ng1epnQ///jLGGcoOdpM/RyPrNJbBPS2htfcY2CpL90=', 269, 2, 1470761875, 50, 1, 0, 0, 0, 0, 0, 0, 'oAF/aaEEAcb6RumVYOvZ3zni1bZVIBCkz9jkw8lVpI87Vds8TgCr25O9ogVhs0+9WVUlDGysLLmn5O2lxuoc/UdqqJoxbwM3/ieXx4vd//wpGMebe8N78sW1UDHVjv7L|Idnn6OnQ7XcZmlQ+Fz3bAp8xzsALGGjRQdJD1Oq//Fw=', '0'),
(37, 'DGBFz+j/6nfZtu5+qXOMOkdYSk+98uUKNNZu92iFD8k=', 268, 5, 1470761986, 50, 1, 0, 0, 0, 0, 0, 0, 'XzEEOVo4JBjc6jgV2gy0/37508GvHuq0gvClL5YVuQpro2T/Dk8UUYQIiQlwmLSEU0qpUFF97SBuY+9d56UiohpqG3baL3zPB/Wj1NsJK+xjAvKpltgMnTX67OqH6KDH|dnWpVEb6OG6XLBP2zCAdlL3I1jhMX5RRlJ04EOy//PA=', '0');

-- --------------------------------------------------------

--
-- Structure de la table `game_data`
--

CREATE TABLE IF NOT EXISTS `game_data` (
  `game_data_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `game_data_game_id` int(12) NOT NULL,
  `game_data_user_id` int(12) NOT NULL,
  `game_data_user_id_base` int(12) NOT NULL,
  `game_data_land_id` int(12) NOT NULL,
  `game_data_units` int(12) NOT NULL,
  `game_data_capital` int(12) NOT NULL,
  `game_data_resource_id` int(12) NOT NULL,
  `game_data_buildings` varchar(128) NOT NULL,
  PRIMARY KEY (`game_data_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=283 ;

--
-- Contenu de la table `game_data`
--

INSERT INTO `game_data` (`game_data_id`, `game_data_game_id`, `game_data_user_id`, `game_data_user_id_base`, `game_data_land_id`, `game_data_units`, `game_data_capital`, `game_data_resource_id`, `game_data_buildings`) VALUES
(1, 32, 0, 0, 1, 3, 0, 3, ''),
(2, 32, 268, 268, 2, 4, 268, 3, '6;1;'),
(3, 32, 0, 0, 3, 4, 0, 3, ''),
(4, 32, 0, 0, 4, 3, 0, 2, ''),
(5, 32, 0, 0, 5, 4, 0, 0, ''),
(6, 32, 0, 0, 6, 4, 0, 0, ''),
(7, 32, 0, 0, 7, 3, 0, 0, ''),
(8, 32, 0, 0, 8, 4, 0, 0, ''),
(9, 32, 0, 0, 9, 3, 0, 0, ''),
(10, 32, 0, 0, 10, 3, 0, 0, ''),
(11, 32, 0, 0, 11, 4, 0, 0, ''),
(12, 32, 0, 0, 12, 3, 0, 0, ''),
(13, 32, 0, 0, 13, 3, 0, 0, ''),
(14, 32, 0, 0, 14, 3, 0, 0, ''),
(15, 32, 0, 0, 15, 4, 0, 0, ''),
(16, 32, -1, -1, 16, 4, -1, 0, '6;1;'),
(17, 32, 0, 0, 17, 4, 0, 0, ''),
(18, 32, 0, 0, 18, 4, 0, 0, ''),
(19, 32, 0, 0, 19, 4, 0, 1, ''),
(20, 32, 0, 0, 20, 3, 0, 0, ''),
(21, 32, 0, 0, 21, 3, 0, 0, ''),
(22, 32, 0, 0, 22, 3, 0, 0, ''),
(23, 32, 0, 0, 23, 3, 0, 0, ''),
(24, 32, 0, 0, 24, 3, 0, 2, ''),
(25, 32, 0, 0, 25, 3, 0, 0, ''),
(26, 32, 0, 0, 26, 4, 0, 0, ''),
(27, 32, 0, 0, 27, 3, 0, 0, ''),
(28, 32, 0, 0, 28, 4, 0, 0, ''),
(29, 32, 0, 0, 29, 3, 0, 0, ''),
(30, 32, 0, 0, 30, 3, 0, 0, ''),
(31, 32, 0, 0, 31, 3, 0, 2, ''),
(32, 32, -2, -2, 32, 4, -2, 0, '6;1;'),
(33, 32, 0, 0, 33, 4, 0, 0, ''),
(34, 32, 0, 0, 34, 3, 0, 0, ''),
(35, 32, 0, 0, 35, 3, 0, 0, ''),
(36, 32, 0, 0, 36, 3, 0, 0, ''),
(37, 32, 0, 0, 37, 3, 0, 0, ''),
(38, 32, 0, 0, 38, 3, 0, 0, ''),
(39, 32, 0, 0, 39, 3, 0, 0, ''),
(40, 32, 0, 0, 40, 3, 0, 0, ''),
(41, 32, 0, 0, 41, 3, 0, 0, ''),
(42, 32, 0, 0, 42, 3, 0, 0, ''),
(43, 32, 0, 0, 43, 3, 0, 0, ''),
(44, 32, 0, 0, 44, 3, 0, 2, ''),
(45, 32, 0, 0, 45, 3, 0, 3, ''),
(46, 32, 0, 0, 46, 3, 0, 0, ''),
(47, 32, 0, 0, 47, 3, 0, 3, ''),
(48, 33, 64, 0, 1, 1, 0, 0, ''),
(49, 33, 64, 0, 2, 11, 0, 0, ''),
(50, 33, 64, 0, 3, 6, 0, 0, ''),
(51, 33, 64, 0, 4, 1, 0, 0, ''),
(52, 33, 64, 0, 5, 1, 0, 0, ''),
(53, 33, 64, 0, 6, 1, 0, 0, ''),
(54, 33, 275, 64, 7, 21, 64, 3, '6;1;;5;2'),
(55, 33, 64, 0, 8, 6, 0, 0, ''),
(56, 33, 268, 0, 9, 1, 0, 0, ''),
(57, 33, 268, 0, 10, 1, 0, 0, '2'),
(58, 33, 64, 0, 11, 12, 0, 0, ''),
(59, 33, 0, 0, 12, 3, 0, 0, ''),
(60, 33, 268, 0, 13, 1, 0, 0, ''),
(61, 33, 64, 0, 14, 10, 0, 0, '1;2'),
(62, 33, 268, 0, 15, 1, 0, 0, ''),
(63, 33, 268, 0, 16, 1, 0, 0, ''),
(64, 33, 64, 0, 17, 1, 0, 0, ''),
(65, 33, 64, 0, 18, 1, 0, 3, '5'),
(66, 33, 64, 0, 19, 6, 0, 0, ''),
(67, 33, 268, 0, 20, 1, 0, 0, ''),
(68, 33, 268, 0, 21, 1, 0, 3, '5'),
(69, 33, 275, 0, 22, 20, 0, 0, '1'),
(70, 33, 275, 0, 23, 1, 0, 1, '3;1'),
(71, 33, 268, 0, 24, 12, 0, 2, '4;1'),
(72, 33, 268, 0, 25, 1, 0, 0, ''),
(73, 33, 268, 0, 26, 1, 0, 0, ''),
(74, 33, 268, 0, 27, 1, 0, 0, '2'),
(75, 33, 275, 0, 28, 12, 0, 3, ''),
(76, 33, 275, 0, 29, 1, 0, 3, '5'),
(77, 33, 275, 0, 30, 1, 0, 3, '5'),
(78, 33, 275, 0, 31, 1, 0, 3, '5'),
(79, 33, 275, 0, 32, 1, 0, 0, ''),
(80, 33, 275, 0, 33, 1, 0, 0, ''),
(81, 33, 275, 0, 34, 18, 0, 0, '1'),
(82, 33, 64, 0, 35, 20, 0, 0, '1'),
(83, 33, 275, 0, 36, 1, 0, 0, ''),
(84, 33, 275, 0, 37, 13, 0, 0, '1;2'),
(85, 33, 275, 0, 38, 1, 0, 0, ''),
(86, 33, 275, 275, 39, 1, 275, 0, '6;1;'),
(87, 33, 268, 268, 40, 8, 268, 0, '6;1;'),
(88, 33, 275, 0, 41, 7, 0, 0, ''),
(89, 33, 275, 0, 42, 10, 0, 0, '2'),
(90, 33, 275, 0, 43, 1, 0, 3, '5'),
(91, 33, 275, 0, 44, 1, 0, 3, '5'),
(92, 33, 275, 0, 45, 1, 0, 0, ''),
(93, 33, 275, 0, 46, 1, 0, 2, '4'),
(94, 33, 275, 0, 47, 1, 0, 0, ''),
(95, 34, 0, 0, 1, 3, 0, 2, ''),
(96, 34, 0, 0, 2, 3, 0, 0, ''),
(97, 34, 0, 0, 3, 4, 0, 0, ''),
(98, 34, 0, 0, 4, 3, 0, 0, ''),
(99, 34, 0, 0, 5, 4, 0, 3, ''),
(100, 34, 268, 268, 6, 5, 268, 0, '6;1;'),
(101, 34, 0, 0, 7, 3, 0, 0, ''),
(102, 34, 0, 0, 8, 4, 0, 0, ''),
(103, 34, 0, 0, 9, 3, 0, 0, ''),
(104, 34, 0, 0, 10, 3, 0, 0, ''),
(105, 34, 0, 0, 11, 4, 0, 0, ''),
(106, 34, 0, 0, 12, 3, 0, 0, ''),
(107, 34, 0, 0, 13, 3, 0, 0, ''),
(108, 34, 0, 0, 14, 3, 0, 0, ''),
(109, 34, 0, 0, 15, 4, 0, 0, ''),
(110, 34, 0, 0, 16, 3, 0, 0, ''),
(111, 34, -3, -3, 17, 5, -3, 0, '6;1;'),
(112, 34, 0, 0, 18, 4, 0, 0, ''),
(113, 34, 0, 0, 19, 4, 0, 3, ''),
(114, 34, 0, 0, 20, 3, 0, 0, ''),
(115, 34, 0, 0, 21, 3, 0, 0, ''),
(116, 34, 0, 0, 22, 3, 0, 0, ''),
(117, 34, -2, -2, 23, 4, -2, 0, '6;1;'),
(118, 34, 0, 0, 24, 3, 0, 0, ''),
(119, 34, 0, 0, 25, 3, 0, 0, ''),
(120, 34, 0, 0, 26, 4, 0, 0, ''),
(121, 34, 0, 0, 27, 3, 0, 0, ''),
(122, 34, 0, 0, 28, 4, 0, 0, ''),
(123, 34, 0, 0, 29, 3, 0, 1, ''),
(124, 34, 0, 0, 30, 3, 0, 0, ''),
(125, 34, 0, 0, 31, 3, 0, 0, ''),
(126, 34, -1, -1, 32, 4, -1, 3, '6;1;'),
(127, 34, 0, 0, 33, 4, 0, 0, ''),
(128, 34, 0, 0, 34, 3, 0, 0, ''),
(129, 34, 0, 0, 35, 3, 0, 0, ''),
(130, 34, 0, 0, 36, 3, 0, 0, ''),
(131, 34, 0, 0, 37, 3, 0, 0, ''),
(132, 34, 0, 0, 38, 3, 0, 2, ''),
(133, 34, 0, 0, 39, 3, 0, 0, ''),
(134, 34, 0, 0, 40, 3, 0, 0, ''),
(135, 34, 0, 0, 41, 3, 0, 0, ''),
(136, 34, 0, 0, 42, 3, 0, 2, ''),
(137, 34, 0, 0, 43, 3, 0, 0, ''),
(138, 34, 0, 0, 44, 3, 0, 0, ''),
(139, 34, 0, 0, 45, 3, 0, 0, ''),
(140, 34, 0, 0, 46, 3, 0, 0, ''),
(141, 34, 0, 0, 47, 3, 0, 0, ''),
(142, 35, 0, 0, 1, 3, 0, 0, ''),
(143, 35, 0, 0, 2, 3, 0, 0, ''),
(144, 35, 0, 0, 3, 4, 0, 0, ''),
(145, 35, 0, 0, 4, 3, 0, 0, ''),
(146, 35, 0, 0, 5, 4, 0, 0, ''),
(147, 35, 0, 0, 6, 4, 0, 0, ''),
(148, 35, 0, 0, 7, 3, 0, 0, ''),
(149, 35, 0, 0, 8, 4, 0, 0, ''),
(150, 35, 0, 0, 9, 3, 0, 2, ''),
(151, 35, 0, 0, 10, 3, 0, 0, ''),
(152, 35, 0, 0, 11, 4, 0, 0, ''),
(153, 35, 0, 0, 12, 3, 0, 1, ''),
(154, 35, 0, 0, 13, 3, 0, 3, ''),
(155, 35, 0, 0, 14, 3, 0, 1, ''),
(156, 35, 0, 0, 15, 4, 0, 3, ''),
(157, 35, 0, 0, 16, 2, 0, 2, ''),
(158, 35, 0, 0, 17, 4, 0, 0, ''),
(159, 35, 0, 0, 18, 4, 0, 0, ''),
(160, 35, 0, 0, 19, 4, 0, 2, ''),
(161, 35, 0, 0, 20, 3, 0, 0, ''),
(162, 35, 0, 0, 21, 3, 0, 1, ''),
(163, 35, 0, 0, 22, 3, 0, 0, ''),
(164, 35, 0, 0, 23, 3, 0, 0, ''),
(165, 35, 0, 0, 24, 3, 0, 0, ''),
(166, 35, 0, 0, 25, 3, 0, 2, ''),
(167, 35, 0, 0, 26, 4, 0, 0, ''),
(168, 35, 0, 0, 27, 3, 0, 3, ''),
(169, 35, 0, 0, 28, 4, 0, 1, ''),
(170, 35, 0, 0, 29, 3, 0, 3, ''),
(171, 35, 0, 0, 30, 3, 0, 0, ''),
(172, 35, 0, 0, 31, 3, 0, 1, ''),
(173, 35, 0, 0, 32, 3, 0, 0, ''),
(174, 35, 0, 0, 33, 4, 0, 2, ''),
(175, 35, 0, 0, 34, 3, 0, 0, ''),
(176, 35, 0, 0, 35, 3, 0, 0, ''),
(177, 35, 0, 0, 36, 3, 0, 3, ''),
(178, 35, 0, 0, 37, 3, 0, 0, ''),
(179, 35, 0, 0, 38, 3, 0, 2, ''),
(180, 35, 269, 0, 39, 1, 0, 0, ''),
(181, 35, 268, 268, 40, 1, 268, 0, '6;1;'),
(182, 35, 268, 269, 41, 4, 269, 0, '6;1;'),
(183, 35, 269, 0, 42, 1, 0, 0, ''),
(184, 35, 269, 0, 43, 4, 0, 0, ''),
(185, 35, 0, 0, 44, 3, 0, 3, ''),
(186, 35, 0, 0, 45, 3, 0, 2, ''),
(187, 35, 0, 0, 46, 3, 0, 1, ''),
(188, 35, 0, 0, 47, 3, 0, 0, ''),
(189, 36, 0, 0, 1, 3, 0, 0, ''),
(190, 36, 0, 0, 2, 3, 0, 0, ''),
(191, 36, 0, 0, 3, 4, 0, 3, ''),
(192, 36, 0, 0, 4, 3, 0, 0, ''),
(193, 36, 0, 0, 5, 4, 0, 0, ''),
(194, 36, 0, 0, 6, 4, 0, 3, ''),
(195, 36, 0, 0, 7, 3, 0, 0, ''),
(196, 36, 0, 0, 8, 4, 0, 0, ''),
(197, 36, 0, 0, 9, 3, 0, 0, ''),
(198, 36, 0, 0, 10, 3, 0, 2, ''),
(199, 36, 0, 0, 11, 4, 0, 0, ''),
(200, 36, 0, 0, 12, 3, 0, 0, ''),
(201, 36, 0, 0, 13, 3, 0, 3, ''),
(202, 36, 0, 0, 14, 3, 0, 0, ''),
(203, 36, 0, 0, 15, 4, 0, 0, ''),
(204, 36, 0, 0, 16, 3, 0, 0, ''),
(205, 36, 0, 0, 17, 4, 0, 0, ''),
(206, 36, 269, 269, 18, 5, 269, 0, '6;1;'),
(207, 36, 0, 0, 19, 4, 0, 3, ''),
(208, 36, 0, 0, 20, 3, 0, 0, ''),
(209, 36, 0, 0, 21, 3, 0, 0, ''),
(210, 36, 0, 0, 22, 3, 0, 0, ''),
(211, 36, 0, 0, 23, 3, 0, 3, ''),
(212, 36, 0, 0, 24, 3, 0, 0, ''),
(213, 36, 0, 0, 25, 3, 0, 0, ''),
(214, 36, 0, 0, 26, 4, 0, 0, ''),
(215, 36, 0, 0, 27, 3, 0, 0, ''),
(216, 36, 0, 0, 28, 4, 0, 0, ''),
(217, 36, 0, 0, 29, 3, 0, 2, ''),
(218, 36, 0, 0, 30, 3, 0, 0, ''),
(219, 36, 0, 0, 31, 3, 0, 0, ''),
(220, 36, 0, 0, 32, 3, 0, 0, ''),
(221, 36, 0, 0, 33, 4, 0, 0, ''),
(222, 36, 0, 0, 34, 3, 0, 0, ''),
(223, 36, 268, 268, 35, 4, 268, 0, '6;1;'),
(224, 36, 0, 0, 36, 3, 0, 0, ''),
(225, 36, 0, 0, 37, 3, 0, 3, ''),
(226, 36, 0, 0, 38, 3, 0, 3, ''),
(227, 36, 0, 0, 39, 3, 0, 0, ''),
(228, 36, 0, 0, 40, 3, 0, 0, ''),
(229, 36, 0, 0, 41, 3, 0, 0, ''),
(230, 36, 0, 0, 42, 3, 0, 0, ''),
(231, 36, 0, 0, 43, 3, 0, 0, ''),
(232, 36, 0, 0, 44, 3, 0, 0, ''),
(233, 36, 0, 0, 45, 3, 0, 3, ''),
(234, 36, 0, 0, 46, 3, 0, 0, ''),
(235, 36, 0, 0, 47, 3, 0, 0, ''),
(236, 37, 268, 0, 1, 1, 0, 0, ''),
(237, 37, 268, 0, 2, 3, 0, 2, ''),
(238, 37, 269, 269, 3, 1, 269, 0, '6;1;'),
(239, 37, 269, 0, 4, 1, 0, 0, ''),
(240, 37, 268, 268, 5, 1, 268, 2, '6;1;'),
(241, 37, 269, 0, 6, 1, 0, 3, ''),
(242, 37, 268, 0, 7, 1, 0, 3, ''),
(243, 37, 0, 0, 8, 4, 0, 0, ''),
(244, 37, 0, 0, 9, 3, 0, 0, ''),
(245, 37, 0, 0, 10, 3, 0, 2, ''),
(246, 37, 0, 0, 11, 4, 0, 0, ''),
(247, 37, 0, 0, 12, 3, 0, 0, ''),
(248, 37, 0, 0, 13, 3, 0, 0, ''),
(249, 37, 0, 0, 14, 3, 0, 0, ''),
(250, 37, 0, 0, 15, 4, 0, 0, ''),
(251, 37, 0, 0, 16, 3, 0, 0, ''),
(252, 37, 269, 0, 17, 6, 0, 0, ''),
(253, 37, 269, 0, 18, 1, 0, 0, ''),
(254, 37, 0, 0, 19, 4, 0, 2, ''),
(255, 37, 0, 0, 20, 3, 0, 0, ''),
(256, 37, 0, 0, 21, 3, 0, 0, ''),
(257, 37, 0, 0, 22, 3, 0, 0, ''),
(258, 37, 0, 0, 23, 3, 0, 0, ''),
(259, 37, 0, 0, 24, 3, 0, 0, ''),
(260, 37, 0, 0, 25, 3, 0, 2, ''),
(261, 37, 0, 0, 26, 4, 0, 0, ''),
(262, 37, 0, 0, 27, 3, 0, 1, ''),
(263, 37, 0, 0, 28, 4, 0, 0, ''),
(264, 37, 0, 0, 29, 3, 0, 0, ''),
(265, 37, 0, 0, 30, 3, 0, 0, ''),
(266, 37, 0, 0, 31, 3, 0, 1, ''),
(267, 37, 0, 0, 32, 3, 0, 0, ''),
(268, 37, 0, 0, 33, 4, 0, 1, ''),
(269, 37, 0, 0, 34, 3, 0, 2, ''),
(270, 37, 0, 0, 35, 3, 0, 2, ''),
(271, 37, 0, 0, 36, 3, 0, 0, ''),
(272, 37, 0, 0, 37, 3, 0, 1, ''),
(273, 37, 0, 0, 38, 3, 0, 0, ''),
(274, 37, 0, 0, 39, 3, 0, 0, ''),
(275, 37, 0, 0, 40, 3, 0, 0, ''),
(276, 37, 0, 0, 41, 3, 0, 0, ''),
(277, 37, 0, 0, 42, 3, 0, 0, ''),
(278, 37, 0, 0, 43, 3, 0, 2, ''),
(279, 37, 0, 0, 44, 3, 0, 0, ''),
(280, 37, 0, 0, 45, 3, 0, 0, ''),
(281, 37, 0, 0, 46, 3, 0, 1, ''),
(282, 37, 0, 0, 47, 3, 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `game_player`
--

CREATE TABLE IF NOT EXISTS `game_player` (
  `game_player_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `game_player_region_id` int(12) NOT NULL,
  `game_player_difficulty_id` int(12) NOT NULL DEFAULT '1',
  `game_player_statut` int(12) DEFAULT '1',
  `game_player_game_id` int(12) NOT NULL,
  `game_player_user_id` int(12) NOT NULL,
  `game_player_color_id` int(12) NOT NULL,
  `game_player_enter_time` int(12) NOT NULL,
  `game_player_order` int(12) NOT NULL,
  `game_player_bot` int(12) NOT NULL,
  `game_player_quit` int(12) NOT NULL,
  PRIMARY KEY (`game_player_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `game_player`
--

INSERT INTO `game_player` (`game_player_id`, `game_player_region_id`, `game_player_difficulty_id`, `game_player_statut`, `game_player_game_id`, `game_player_user_id`, `game_player_color_id`, `game_player_enter_time`, `game_player_order`, `game_player_bot`, `game_player_quit`) VALUES
(1, 1, 1, 1, 32, 268, 5, 1470514990, 2, 0, 1),
(2, 2, 1, 1, 32, -1, 7, 1470514995, 3, 1, 0),
(3, 4, 1, 1, 32, -2, 10, 1470514998, 1, 2, 0),
(4, 6, 1, 1, 33, 275, 6, 1470561190, 3, 0, 0),
(5, 5, 1, 1, 33, 268, 8, 1470561194, 2, 0, 1),
(6, 1, 1, 1, 33, 64, 9, 1470561229, 1, 0, 0),
(7, 1, 1, 1, 34, 268, 2, 1470687656, 3, 0, 1),
(8, 4, 1, 1, 34, -1, 4, 1470687674, 4, 1, 0),
(9, 3, 1, 1, 34, -2, 7, 1470687675, 1, 2, 0),
(10, 2, 1, 1, 34, -3, 5, 1470687676, 2, 3, 0),
(11, 1, 1, 1, 35, 268, 2, 1470688096, 2, 0, 1),
(12, 1, 1, 1, 35, 269, 8, 1470688109, 1, 0, 1),
(13, 2, 1, 1, 36, 269, 2, 1470761879, 2, 0, 1),
(14, 5, 1, 1, 36, 268, 8, 1470761883, 1, 0, 1),
(15, 1, 1, 1, 37, 269, 2, 1470761991, 1, 0, 0),
(16, 1, 1, 1, 37, 268, 7, 1470762048, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `harbor`
--

CREATE TABLE IF NOT EXISTS `harbor` (
  `harbor_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `harbor_land_id_one` int(12) NOT NULL,
  `harbor_land_id_two` int(12) NOT NULL,
  `harbor_map_id` int(11) NOT NULL,
  PRIMARY KEY (`harbor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `harbor`
--

INSERT INTO `harbor` (`harbor_id`, `harbor_land_id_one`, `harbor_land_id_two`, `harbor_map_id`) VALUES
(1, 28, 12, 1),
(2, 12, 28, 1),
(3, 31, 41, 1),
(4, 41, 31, 1),
(5, 36, 42, 1),
(6, 42, 36, 1),
(7, 48, 57, 2),
(8, 57, 48, 2),
(9, 79, 95, 2),
(10, 95, 79, 2);

-- --------------------------------------------------------

--
-- Structure de la table `land`
--

CREATE TABLE IF NOT EXISTS `land` (
  `land_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `land_name` varchar(128) NOT NULL,
  `land_map_id` int(11) NOT NULL,
  `land_abv` varchar(128) NOT NULL,
  `land_image` varchar(128) NOT NULL,
  `land_continent_id` int(16) NOT NULL,
  `land_position_top` varchar(16) NOT NULL,
  `land_position_left` varchar(16) NOT NULL,
  `land_base_units` int(4) NOT NULL,
  `land_harbor` int(4) NOT NULL,
  PRIMARY KEY (`land_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Contenu de la table `land`
--

INSERT INTO `land` (`land_id`, `land_name`, `land_map_id`, `land_abv`, `land_image`, `land_continent_id`, `land_position_top`, `land_position_left`, `land_base_units`, `land_harbor`) VALUES
(1, 'Britain', 1, 'GB', 'britain', 1, '6.3', '34', 3, 0),
(2, 'Iceland', 1, '', 'iceland', 1, '3.4', '30.5', 3, 0),
(3, 'Northern Europe', 1, ' EU-North', 'northern-europe', 1, '6.55', '38.55', 4, 0),
(4, 'Scandinavia', 1, '', 'scandinavia', 1, '3.1', '38.95', 3, 0),
(5, 'Southern Europe', 1, ' Eu-South', 'southern-europe', 1, '9.6', '39.35', 4, 0),
(6, 'Ukraine', 1, '', 'ukraine', 1, '3.3', '43.00', 4, 0),
(7, 'Western Europe', 1, ' EU-Western', 'western-europe', 1, '8.95', '35.2', 3, 0),
(8, 'Afghanistan', 1, '', 'afghanistan', 2, '7.75', '49.95', 4, 0),
(9, 'China', 1, '', 'china', 2, '9.55', '57.85', 3, 0),
(10, 'India', 1, '', 'india', 2, '13.05', '54.55', 3, 0),
(11, 'Tchita', 1, '', 'tchita', 2, '5.05', '60.6', 4, 0),
(12, 'Japan', 1, '', 'japan', 2, '11.1', '74.4', 3, 1),
(13, 'Kamchatka', 1, '', 'kamchatka', 2, '3.45', '69.8', 3, 0),
(14, 'Middle East', 1, '', 'middle-east', 2, '11.9', '44.8', 3, 0),
(15, 'Mongolia', 1, '', 'mongolia', 2, '8.25', '60.7', 4, 0),
(16, 'Siam', 1, '', 'siam', 2, '16.4', '64.4', 3, 0),
(17, 'Siberia', 1, '', 'siberia', 2, '1.45', '54.85', 4, 0),
(18, 'Urals', 1, '', 'urals', 2, '2.75', '51.27', 4, 0),
(19, 'Yakutia', 1, '', 'yakutia', 2, '2.4', '60.95', 4, 0),
(20, 'Alaska', 1, '', 'alaska', 3, '2.35', '0', 3, 0),
(21, 'Alberta', 1, '', 'alberta', 3, '5.5', '6.7', 3, 0),
(22, 'Central America', 1, 'USA-Central', 'central-america', 3, '14.05', '6.05', 3, 0),
(23, 'States of the East', 1, 'USA East', 'states-of-the-east', 3, '8.75', '8.85', 3, 0),
(24, 'Greenland', 1, '', 'greenland', 3, '1.3', '24.1', 3, 0),
(25, 'Northwest Territories', 1, 'Land-NO', 'northwest-territories', 3, '1.45', '6.45', 3, 0),
(26, 'Ontario', 1, '', 'ontario', 1, '5.4', '13.1', 4, 0),
(27, 'Quebec', 1, '', 'quebec', 3, '4.75', '18.45', 3, 0),
(28, 'States of the West', 1, 'USA-West', 'states-of-the-west', 3, '8.85', '5.2', 4, 1),
(29, 'Argentina', 1, '', 'argentina', 4, '30.35', '18.25', 3, 0),
(30, 'Brazil', 1, '', 'brazil', 4, '22.95', '17.15', 3, 0),
(31, 'Peru', 1, '', 'peru', 4, '24.1', '14.87', 3, 1),
(32, 'Venezuela', 1, '', 'venezuela', 4, '20.6', '15.435', 3, 0),
(33, 'Central Africa', 1, ' Afr Central', 'central-africa', 5, '21.9', '40.1', 4, 0),
(34, 'East Africa', 1, 'Afr East', 'east-africa', 5, '17.95', '43.95', 3, 0),
(35, 'Egypt', 1, '', 'egypt', 5, '14.75', '40.35', 3, 0),
(36, 'Madagascar', 1, '', 'madagascar', 5, '29.2', '50.5', 3, 1),
(37, 'North Africa', 1, 'Afr-Nord', 'north-africa', 5, '13.3', '32.25', 3, 0),
(38, 'South Africa', 1, 'Afr-South', 'south-africa', 5, '27.3', '40.95', 3, 0),
(39, 'East Australia', 1, ' Aust-East', 'east-australia', 6, '29.4', '74.55', 3, 0),
(40, 'Indonesia', 1, '', 'indonesia', 6, '18.9', '65.5', 3, 0),
(41, 'New Guinea', 1, 'New New Guinea', 'new-guinea', 6, '24.9', '75.5', 3, 1),
(42, 'Western Australia', 1, 'Austr-West', 'western-australia', 6, '30.3', '70.05', 3, 1),
(43, 'Land of Mac Robertson', 1, 'Mac-Robertson', 'land-of-mac-robertson', 7, '41.7', '63', 3, 0),
(44, 'Victoria Land', 1, '', 'victoria-land', 7, '41.7', '53', 3, 0),
(45, 'Queen Maud Land', 1, 'Queen Maud', 'queen-maud-land', 7, '42.2', '38.85', 3, 0),
(46, 'Marie Byrd Land', 1, '', 'marie-byrd-land', 7, '40.9', '24', 3, 0),
(47, 'Land of Ellsworth', 1, '', 'land-of-ellsworth', 7, '43.8', '8.85', 3, 0),
(48, 'Washington', 2, '', 'washington', 0, '0.95', '19', 4, 1),
(49, 'Oregon ', 2, '', 'oregon', 0, '4.5', '16.5', 3, 0),
(50, 'California', 2, '', 'california', 0, '11', '15.5', 4, 0),
(51, 'Nevada', 2, '', 'nevada', 0, '12.4', '19.95', 3, 0),
(52, 'Idaho ', 2, '', 'idaho', 0, '2.3', '24.75', 4, 0),
(53, 'Utah ', 2, '', 'utah', 0, '13.9', '27.05', 3, 0),
(54, 'Arizona', 2, '', 'arizona', 0, '22.35', '24.45', 4, 0),
(55, 'Wyoming', 2, '', 'wyoming', 0, '9.9', '31.75', 3, 0),
(56, 'Montana', 2, '', 'montana', 0, '2.65', '28.2', 3, 0),
(57, 'Alaska', 2, '', 'alaska', 0, '-0.5', '0', 3, 1),
(58, 'Texas', 2, '', 'texas', 0, '24.8', '35.5', 3, 0),
(59, 'North Dakota', 2, 'North Dakota', 'north-dakota', 0, '4.5', '40.8', 4, 0),
(60, 'South Dakota', 2, 'South Dakota', 'south-dakota', 0, '9.45', '40.5', 4, 0),
(61, 'New Mexico', 2, 'N. Mexico', 'new-mexico', 0, '23.2', '32', 4, 0),
(62, 'Nebraska', 2, '', 'nebraska', 0, '14.2', '40.2', 3, 0),
(63, 'Colorado', 2, '', 'colorado', 0, '16.7', '33.2', 4, 0),
(64, 'Kansas', 2, '', 'kansas', 0, '19.3', '42.1', 4, 0),
(65, 'Oklahoma', 2, '', 'oklahoma', 0, '23.9', '40.95', 3, 0),
(66, 'Minnesota', 2, '', 'minnesota', 0, '4.25', '48.55', 3, 0),
(67, 'Lowa', 2, '', 'lowa', 0, '13.6', '49.05', 4, 0),
(68, 'Missouri', 2, '', 'missouri', 0, '18.2', '50.3', 4, 0),
(69, 'Arkansas', 2, '', 'arkansas', 0, '24.85', '51.75', 4, 0),
(70, 'Louisiana', 2, '', 'louisiana', 0, '30.2', '52.75', 3, 0),
(71, 'Mississippi', 2, '', 'mississippi', 0, '26.9', '56.25', 4, 0),
(72, 'Wisconsin', 2, '', 'wisconsin', 0, '6.85', '53.4', 3, 0),
(73, 'Illinois', 2, '', 'illinois', 0, '14.95', '55.4', 3, 0),
(74, 'Michigan', 2, '', 'michigan', 0, '9.15', '60.8', 3, 0),
(75, 'Indiana ', 2, '', 'indiana', 0, '15.65', '59.95', 4, 0),
(76, 'Kentucky', 2, '', 'kentucky', 0, '20', '58.4', 3, 0),
(77, 'Tennessee', 2, '', 'tennessee', 0, '23.45', '57.6', 3, 0),
(78, 'Alabama', 2, '', 'alabama', 0, '26.55', '60.55', 4, 0),
(79, 'Florida', 2, '', 'florida', 0, '32.7', '61.7', 3, 1),
(80, 'Georgia', 2, '', 'georgia', 0, '26.15', '63.75', 3, 0),
(81, 'Ohio', 2, '', 'ohio', 0, '14.6', '63.2', 4, 0),
(82, 'South Carolina', 2, 'South Carolina', 'south-carolina', 0, '25.55', '66.75', 4, 0),
(83, 'North Carolina', 2, 'North Carolina', 'north-carolina', 0, '22.1', '65.4', 3, 0),
(84, 'Virginia', 2, '', 'virginia', 0, '18.2', '66.5', 3, 0),
(85, 'Western Virginia', 2, '', 'western-virginia', 0, '16.8', '66.9', 3, 0),
(86, 'Maryland', 2, '', 'maryland', 0, '15.8', '71', 4, 0),
(87, 'PA', 2, '', 'pa', 0, '13.45', '68.55', 4, 0),
(88, 'New Jersey', 2, '', 'new-jersey', 0, '14.25', '74.65', 3, 0),
(89, 'New York', 2, '', 'new-york', 0, '8.15', '69.2', 4, 0),
(90, 'Maine', 2, '', 'maine', 0, '3', '77.9', 3, 0),
(91, 'Vermont', 2, '', 'vermont', 0, '7.65', '75.6', 3, 0),
(92, 'New Hampshire', 2, 'N. Hampshire', 'new-hampshire', 0, '7.15', '77.2', 4, 0),
(93, 'Massachusetts', 2, '', 'massachusetts', 0, '10.8', '76.5', 3, 0),
(94, 'Connecticut', 2, '', 'connecticut', 0, '12.3', '76.55', 4, 0),
(95, 'Hawaii', 2, '', 'hawaii', 0, '35', '78', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `mail_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `mail_game_id` int(12) NOT NULL,
  `mail_time` int(12) NOT NULL,
  `mail_message` varchar(256) NOT NULL,
  `mail_subject` varchar(128) NOT NULL,
  `mail_pact_id` int(12) NOT NULL,
  `mail_user_send_id` int(12) NOT NULL,
  `mail_user_receive_id` int(12) NOT NULL,
  `mail_del` int(8) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `mail`
--

INSERT INTO `mail` (`mail_id`, `mail_game_id`, `mail_time`, `mail_message`, `mail_subject`, `mail_pact_id`, `mail_user_send_id`, `mail_user_receive_id`, `mail_del`) VALUES
(1, 11, 1441724952, 'GarZz souhaite vous proposer un pacte de Non agression de <span id=''nb_tr''>6</span> tours.', 'Proposition de pacte', 1, 243, 67, 0),
(2, 11, 1441724961, 'herklos a accepté votre proposition de pacte de Non agression de <span id=''nb_tr''>6</span> tours.', 'Proposition de pacte signée', 0, 67, 243, 0);

-- --------------------------------------------------------

--
-- Structure de la table `mail_read`
--

CREATE TABLE IF NOT EXISTS `mail_read` (
  `mail_read_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `mail_read_game_id` int(12) NOT NULL,
  `mail_read_message_id` int(12) NOT NULL,
  `mail_read_user_receive_id` int(12) NOT NULL,
  `mail_read_time` int(12) NOT NULL,
  PRIMARY KEY (`mail_read_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `mail_read`
--

INSERT INTO `mail_read` (`mail_read_id`, `mail_read_game_id`, `mail_read_message_id`, `mail_read_user_receive_id`, `mail_read_time`) VALUES
(1, 11, 1, 67, 1441724958);

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

CREATE TABLE IF NOT EXISTS `map` (
  `map_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `map_name` varchar(128) NOT NULL,
  `map_music` varchar(128) NOT NULL,
  `map_leftmenutop_top` int(11) NOT NULL,
  `map_leftmenutop_left` int(11) NOT NULL,
  `map_rightmenutop_top` int(11) NOT NULL,
  `map_rightmenutop_left` int(11) NOT NULL,
  `map_continent` int(11) NOT NULL,
  `map_land_id_begin` int(11) NOT NULL,
  `map_land_id_end` int(11) NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `map`
--

INSERT INTO `map` (`map_id`, `map_name`, `map_music`, `map_leftmenutop_top`, `map_leftmenutop_left`, `map_rightmenutop_top`, `map_rightmenutop_left`, `map_continent`, `map_land_id_begin`, `map_land_id_end`) VALUES
(1, 'World', 'Schwarzweiss-War_Theme.mp3', 35, 1, 33, 83, 1, 1, 47),
(2, 'USA', 'Schwarzweiss-Drums_of_liberty.mp3', 35, 1, 30, 84, 0, 48, 95),
(3, 'Europe', '', 0, 0, 0, 0, 0, 0, 0),
(4, 'France', '', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `mod`
--

CREATE TABLE IF NOT EXISTS `mod` (
  `mod_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(32) NOT NULL,
  `mod_max_unit_atk` int(16) NOT NULL,
  `mod_max_unit_def` int(16) NOT NULL,
  `mod_win_condition_id` int(16) NOT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `mod`
--

INSERT INTO `mod` (`mod_id`, `mod_name`, `mod_max_unit_atk`, `mod_max_unit_def`, `mod_win_condition_id`) VALUES
(1, 'Default', 3, 2, 1),
(2, 'Anarchy', 100, 100, 0),
(3, 'Capital', 3, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `move`
--

CREATE TABLE IF NOT EXISTS `move` (
  `move_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `move_game_id` int(11) NOT NULL,
  `move_user_id` int(11) NOT NULL,
  `move_time` int(11) NOT NULL,
  `move_land_id_from` int(11) NOT NULL,
  `move_land_id_arrive` int(11) NOT NULL,
  `move_units` int(11) NOT NULL,
  PRIMARY KEY (`move_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `move`
--

INSERT INTO `move` (`move_id`, `move_game_id`, `move_user_id`, `move_time`, `move_land_id_from`, `move_land_id_arrive`, `move_units`) VALUES
(1, 20, 269, 1469644697, 6, 4, 2),
(2, 20, 269, 1469644819, 4, 6, 3),
(3, 20, 269, 1469645005, 9, 8, 1),
(4, 20, 269, 1469645035, 9, 8, 1),
(5, 20, 269, 1469822628, 6, 18, 3),
(6, 23, 64, 1469825232, 41, 42, 150),
(7, 20, 268, 1469838612, 16, 10, 6),
(8, 20, 268, 1469838624, 10, 16, 5),
(9, 24, 64, 1469871683, 10, 16, 2),
(10, 24, 64, 1469871792, 9, 16, 2),
(11, 24, 269, 1469871817, 41, 42, 4),
(12, 24, 64, 1469871900, 9, 10, 4),
(13, 24, 64, 1469872038, 14, 10, 3),
(14, 24, 269, 1469872119, 16, 40, 2),
(15, 24, 64, 1469872208, 16, 10, 3),
(16, 24, 64, 1469872223, 10, 14, 3),
(17, 24, 64, 1469872729, 36, 34, 8),
(18, 24, 64, 1469872750, 34, 35, 8),
(19, 24, 64, 1469872763, 35, 14, 8),
(20, 24, 269, 1469873107, 12, 13, 13),
(21, 25, 269, 1469873779, 42, 43, 8),
(22, 25, 269, 1469874006, 43, 42, 8),
(23, 25, 269, 1469874220, 36, 38, 7),
(24, 25, 269, 1469874374, 35, 37, 4),
(25, 26, 64, 1469875540, 90, 92, 3),
(26, 26, 64, 1469875557, 92, 91, 3),
(27, 26, 64, 1469875894, 88, 87, 4),
(28, 26, 64, 1469876063, 74, 81, 3),
(29, 26, 64, 1469876079, 81, 85, 3),
(30, 26, 64, 1469876099, 85, 84, 3),
(31, 26, 64, 1469876458, 95, 79, 18),
(32, 29, 268, 1469988601, 8, 14, 9),
(33, 31, 268, 1470494490, 3, 7, 7),
(34, 31, 268, 1470494500, 7, 37, 7),
(35, 31, 275, 1470494668, 32, 30, 2),
(36, 31, 275, 1470494706, 20, 21, 2),
(37, 31, 275, 1470494766, 31, 30, 2),
(38, 31, 275, 1470494797, 21, 28, 2),
(39, 31, 275, 1470494805, 28, 22, 2),
(40, 31, 275, 1470494812, 22, 32, 2),
(41, 31, 275, 1470494819, 32, 30, 2),
(42, 31, 268, 1470498761, 28, 22, 31),
(43, 31, 268, 1470498838, 28, 22, 36),
(44, 31, 268, 1470498883, 23, 28, 10),
(45, 31, 268, 1470498900, 31, 30, 19),
(46, 31, 268, 1470498914, 30, 32, 19),
(47, 31, 268, 1470499041, 31, 32, 19),
(48, 31, 268, 1470499078, 23, 28, 15),
(49, 31, 268, 1470499096, 28, 21, 15),
(50, 33, 268, 1470561956, 16, 40, 9),
(51, 33, 268, 1470562253, 40, 16, 9),
(52, 33, 275, 1470562401, 41, 42, 5),
(53, 33, 275, 1470562414, 42, 43, 5),
(54, 33, 275, 1470562959, 36, 38, 7),
(55, 33, 275, 1470562967, 38, 33, 7),
(56, 33, 275, 1470563245, 33, 37, 9),
(57, 33, 64, 1470563499, 19, 17, 5),
(58, 33, 64, 1470563537, 17, 19, 5),
(59, 33, 268, 1470564170, 25, 26, 5),
(60, 33, 268, 1470564183, 26, 27, 5);

-- --------------------------------------------------------

--
-- Structure de la table `pact`
--

CREATE TABLE IF NOT EXISTS `pact` (
  `pact_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `pact_game_id` int(12) NOT NULL,
  `pact_ask_user_id` int(12) NOT NULL,
  `pact_accept_user_id` int(12) NOT NULL,
  `pact_pact_type` int(12) NOT NULL,
  `pact_time` int(12) NOT NULL,
  `pact_nb_turn` int(12) NOT NULL,
  `pact_create_turn` int(12) NOT NULL,
  `pact_end_turn` int(12) NOT NULL,
  PRIMARY KEY (`pact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pact`
--

INSERT INTO `pact` (`pact_id`, `pact_game_id`, `pact_ask_user_id`, `pact_accept_user_id`, `pact_pact_type`, `pact_time`, `pact_nb_turn`, `pact_create_turn`, `pact_end_turn`) VALUES
(1, 11, 67, 243, 1, 1441724961, 6, 20, 26);

-- --------------------------------------------------------

--
-- Structure de la table `pact_list`
--

CREATE TABLE IF NOT EXISTS `pact_list` (
  `pact_list_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `pact_list_name` varchar(128) NOT NULL,
  `pact_list_visibility` int(12) NOT NULL,
  `pact_list_exchange` int(12) NOT NULL,
  PRIMARY KEY (`pact_list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pact_list`
--

INSERT INTO `pact_list` (`pact_list_id`, `pact_list_name`, `pact_list_visibility`, `pact_list_exchange`) VALUES
(1, 'Non agression', 0, 0),
(2, 'Alliance', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `resource_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(128) NOT NULL,
  `resource_freq` int(12) NOT NULL,
  `resource_img` varchar(128) NOT NULL,
  `resource_building_id` int(11) NOT NULL,
  `resource_description` varchar(512) NOT NULL,
  PRIMARY KEY (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `resource`
--

INSERT INTO `resource` (`resource_id`, `resource_name`, `resource_freq`, `resource_img`, `resource_building_id`, `resource_description`) VALUES
(1, 'gold', 5, 'gold', 3, 'gold_description'),
(2, 'silver', 12, 'silver', 4, 'silver_description'),
(3, 'iron', 25, 'iron', 5, 'iron_description');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `create_time` int(16) NOT NULL,
  `session_id` varchar(128) NOT NULL,
  `session_key` varchar(512) NOT NULL,
  `time_closed` int(16) NOT NULL,
  `valid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `session`
--

INSERT INTO `session` (`id`, `user_id`, `ip`, `create_time`, `session_id`, `session_key`, `time_closed`, `valid`) VALUES
(47, 9, '0', 1426866182, '54ef33f59895c', '1f26c42291499fe0ddb2cdb0312f9142', 1426866186, 0),
(48, 9, '0', 1426866213, '54ef33f59895c', 'b7cbc1926a03bb816e8b7072da06b61d', 1426866220, 0),
(49, 9, '0', 1426867900, 'fauhlnahi9vaajib4v1sie3s24', 'c7e9bc825803a427a781a4c00d4eb340', 1426867902, 0),
(50, 9, '0', 1426885528, '54ef33f59895c', '6a6fce0ee5c7b67db7fe492f8510da27', 1426885536, 0),
(51, 9, '0', 1426885910, '54ef33f59895c', 'a1c14e69d2f998f19654136d4cb70c23', 1426885912, 0),
(52, 9, '0', 1426886026, '54ef33f59895c', '7d129585e88ae325e788ad2e4d1175a8', 1426886028, 0),
(53, 9, '0', 1426886215, '54ef33f59895c', '2bc6da3e2f66068450531ca7d16369e1', 1426887573, 0),
(54, 14, '0', 1426886357, '8b9ogv02c484r0s5cd60f0cl17', '695a082f2ce6b6ea2a15aa4eb31ad218', 1426886378, 0),
(55, 14, '0', 1426886467, '8b9ogv02c484r0s5cd60f0cl17', '23631a21f3676df19310a20fe6d70d64', 1426886469, 0),
(56, 14, '0', 1426886487, '8b9ogv02c484r0s5cd60f0cl17', 'c5eefabbb627b7bfe989d3ec526d569a', 1426886490, 0),
(57, 14, '0', 1426886575, '8b9ogv02c484r0s5cd60f0cl17', '0f9c092934788f1f6346c1e042b07cc9', 1426886577, 0),
(58, 14, '0', 1426886636, '8b9ogv02c484r0s5cd60f0cl17', '0c08b92abeb15d81e57b9eb9503a97b1', 1426886747, 0),
(59, 14, '0', 1426886761, '8b9ogv02c484r0s5cd60f0cl17', '5fb70a6879e8f4bf940fc9e571249b42', 0, 1),
(60, 9, '0', 1426887734, '54ef33f59895c', 'b5ca3666874453a7e7a77025a683f068', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `turn`
--

CREATE TABLE IF NOT EXISTS `turn` (
  `turn_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `turn_game_id` int(12) NOT NULL,
  `turn_user_id` int(12) NOT NULL,
  `turn_time` int(12) NOT NULL,
  `turn_time_begin` int(12) NOT NULL,
  `turn_gold` int(12) NOT NULL,
  `turn_gold_base` int(12) NOT NULL,
  `turn_income` int(12) NOT NULL,
  PRIMARY KEY (`turn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Contenu de la table `turn`
--

INSERT INTO `turn` (`turn_id`, `turn_game_id`, `turn_user_id`, `turn_time`, `turn_time_begin`, `turn_gold`, `turn_gold_base`, `turn_income`) VALUES
(1, 32, -2, 1470515080, 1470515080, 2, 2, 2),
(2, 32, -1, 1470516500, 1470516500, 2, 2, 2),
(3, 33, 64, 1470561288, 1470561288, 0, 2, 2),
(4, 33, 268, 1470561363, 1470561363, 0, 2, 2),
(5, 33, 275, 1470561429, 1470561429, 0, 2, 2),
(6, 33, 64, 1470561470, 1470561288, 0, 2, 2),
(7, 33, 268, 1470561550, 1470561363, 0, 2, 2),
(8, 33, 275, 1470561569, 1470561429, 0, 2, 2),
(9, 33, 64, 1470561592, 1470561288, 0, 3, 3),
(10, 33, 268, 1470561650, 1470561363, 2, 2, 2),
(11, 33, 275, 1470561650, 1470561429, 0, 2, 2),
(12, 33, 64, 1470561715, 1470561288, 0, 5, 5),
(13, 33, 268, 1470561795, 1470561363, 0, 4, 2),
(14, 33, 275, 1470561821, 1470561429, 0, 2, 2),
(15, 33, 64, 1470561848, 1470561288, 0, 6, 6),
(16, 33, 268, 1470561931, 1470561363, 0, 3, 3),
(17, 33, 275, 1470561959, 1470561429, 0, 3, 3),
(18, 33, 64, 1470561988, 1470561288, 0, 6, 6),
(19, 33, 268, 1470562051, 1470561363, 0, 3, 3),
(20, 33, 275, 1470562072, 1470561429, 1, 3, 3),
(21, 33, 64, 1470562089, 1470561288, 0, 7, 7),
(22, 33, 268, 1470562137, 1470561363, 0, 3, 3),
(23, 33, 275, 1470562170, 1470561429, 0, 4, 3),
(24, 33, 64, 1470562191, 1470561288, 0, 9, 9),
(25, 33, 268, 1470562238, 1470561363, 0, 3, 3),
(26, 33, 275, 1470562281, 1470561429, 0, 3, 3),
(27, 33, 64, 1470562330, 1470561288, 0, 10, 10),
(28, 33, 268, 1470562355, 1470561363, 0, 4, 4),
(29, 33, 275, 1470562391, 1470561429, 0, 5, 5),
(30, 33, 64, 1470562441, 1470561288, 0, 10, 10),
(31, 33, 268, 1470562492, 1470561363, 0, 4, 4),
(32, 33, 275, 1470562509, 1470561429, 0, 7, 7),
(33, 33, 64, 1470562536, 1470561288, 0, 10, 10),
(34, 33, 268, 1470562603, 1470561363, 1, 4, 4),
(35, 33, 275, 1470562625, 1470561429, 0, 9, 9),
(36, 33, 64, 1470562669, 1470561288, 0, 10, 10),
(37, 33, 268, 1470562709, 1470561363, 0, 5, 4),
(38, 33, 275, 1470562743, 1470561429, 0, 13, 13),
(39, 33, 64, 1470562808, 1470561288, 0, 11, 11),
(40, 33, 268, 1470562891, 1470561363, 0, 5, 5),
(41, 33, 275, 1470562919, 1470561429, 0, 16, 16),
(42, 33, 64, 1470563020, 1470561288, 0, 14, 14),
(43, 33, 268, 1470563126, 1470561363, 0, 6, 6),
(44, 33, 275, 1470563162, 1470561429, 0, 19, 19),
(45, 33, 64, 1470563250, 1470561288, 0, 17, 17),
(46, 33, 268, 1470563333, 1470561363, 0, 7, 7),
(47, 33, 275, 1470563361, 1470561429, 0, 23, 23),
(48, 33, 64, 1470563450, 1470561288, 0, 17, 17),
(49, 33, 268, 1470563550, 1470561363, 0, 8, 8),
(50, 33, 275, 1470563571, 1470561429, 0, 24, 24),
(51, 33, 64, 1470563639, 1470561288, 0, 18, 18),
(52, 33, 268, 1470563747, 1470561363, 0, 9, 9),
(53, 33, 275, 1470563800, 1470561429, 0, 26, 26),
(54, 33, 64, 1470563852, 1470561288, 0, 19, 19),
(55, 33, 268, 1470563924, 1470561363, 0, 12, 12),
(56, 33, 275, 1470564002, 1470561429, 0, 30, 30),
(57, 33, 64, 1470564071, 1470561288, 0, 20, 20),
(58, 33, 268, 1470564140, 1470561363, 0, 14, 14),
(59, 33, 275, 1470564197, 1470561429, 0, 30, 30),
(60, 34, -2, 1470687694, 1470687694, 2, 2, 2),
(61, 35, 269, 1470688118, 1470688118, 0, 2, 2),
(62, 35, 268, 1470688346, 1470688346, 0, 2, 2),
(63, 35, 269, 1470688364, 1470688118, 0, 3, 3),
(64, 35, 268, 1470688382, 1470688346, 2, 2, 2),
(65, 35, 269, 1470690992, 1470688118, 0, 4, 4),
(66, 35, 268, 1470691010, 1470688346, 0, 4, 2),
(67, 36, 268, 1470761940, 1470761940, 2, 2, 2),
(68, 37, 269, 1470762058, 1470762058, 0, 2, 2),
(69, 37, 268, 1470762105, 1470762105, 0, 2, 2),
(70, 37, 269, 1470762128, 1470762058, 0, 3, 3),
(71, 37, 268, 1470767949, 1470762105, 0, 3, 3),
(72, 37, 269, 1470767968, 1470762058, 0, 4, 4),
(73, 37, 268, 1470768177, 1470762105, 0, 4, 4),
(74, 37, 269, 1470768200, 1470762058, 0, 5, 5),
(75, 37, 268, 1470768220, 1470762105, 5, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(256) NOT NULL,
  `user_mail` varchar(128) NOT NULL,
  `user_ip` varchar(16) NOT NULL,
  `user_registration_time` int(12) NOT NULL,
  `user_last_login` int(12) NOT NULL,
  `user_role` int(12) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_key` varchar(256) NOT NULL,
  `user_authKey` varchar(128) NOT NULL,
  `user_accessToken` varchar(128) NOT NULL,
  `user_pwd` varchar(512) NOT NULL,
  `user_pwd2` varchar(512) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=276 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_mail`, `user_ip`, `user_registration_time`, `user_last_login`, `user_role`, `user_type`, `user_key`, `user_authKey`, `user_accessToken`, `user_pwd`, `user_pwd2`) VALUES
(67, '0jsQ/fEWB3MJ5N04p61LoEzZ1baOBnp4fKIzODyyrPg=', 'paul.bouquet@gmail.com', '0', 1438282542, 0, 0, 0, 'pBtwXN6prEBitILzNvHJGbXNq3r0gW2czVIfQWHOdDA=', '', '', 'bLwg5wJtG4CfirOoa4o5hciV1TBNrzixaJzhUENKZxVcJfS7F6fauk6Vs7MJqJGh5EabOXFqhE/MRF8vK3RqwRGVhF02uYvNcjpu0xSCHGmCk/TyUI7YgC20F/WsWfKV|N0XPWNJl27vYPJpukNABDjEpR/3zorcxnEYS7eWMNks=', 'qiTwRsCYAmF8QlkMYQuO6Hpc2i580dnup6VdIQ6WwO0U/kppVIv9gDnIjqEv0+ETsY1fwts7GeM7G+Rw7GqVkx8OI9e+yY6IsqdBV6f/TRE//a3dOdg71fN8Ab2LlEd5|EfTU0TvGHNDE54THEeGD1DmpCpy8y0h06AyOOwOZymA='),
(273, 'jnZXhf5w8ktqPDoxsQzx6BwWTuhKHXGLbPD6g5RfkaY=', 'laurent.bouquet@free.fr', '0', 1468658762, 0, 0, 0, '', '', '', '5xfjQj2Q2XI0/qLUzZ62VF75be3320GE8BHe/uBLsQqGznXsDE55piWKygJCKZAC0rddmLjpe/ky0NOCz2EPBrHVN34NvpNB8qzceDSS3S69OudHuf5g0WGpTOAVNK3M|GCk/DFjIfGMtNJKiAb5Nxui9GPpecJ8Md4RLhZ2KwvE=', '5xfjQj2Q2XI0/qLUzZ62VF75be3320GE8BHe/uBLsQqGznXsDE55piWKygJCKZAC0rddmLjpe/ky0NOCz2EPBrHVN34NvpNB8qzceDSS3S69OudHuf5g0WGpTOAVNK3M|GCk/DFjIfGMtNJKiAb5Nxui9GPpecJ8Md4RLhZ2KwvE='),
(274, 'Q9eG1w5Z4t5xR+nmZSVNObR5W00QBxPqde+1l6O1648=', 'jeanne.bouquet.jeanne@gmail.com', '0', 1468665052, 0, 0, 0, '', '', '', 'DAfmtnregNxOYq3Grr6w9w8L2ez1TwmJk6DWa/ZJQqKUMSmqDAtkiFM+VpOp8HR0bjwwU2Zd5ODzzV7YmePZpsR65GRWPZaLVdkdC5D1qaEKkk5DnVNGIgsff959bKc4|lVQmBL9lhUe5cygfH2otxDDioobuSJJ+MgzI0jPr/OE=', 'DAfmtnregNxOYq3Grr6w9w8L2ez1TwmJk6DWa/ZJQqKUMSmqDAtkiFM+VpOp8HR0bjwwU2Zd5ODzzV7YmePZpsR65GRWPZaLVdkdC5D1qaEKkk5DnVNGIgsff959bKc4|lVQmBL9lhUe5cygfH2otxDDioobuSJJ+MgzI0jPr/OE='),
(62, 'T/L2egcvYibE1tv2aHtN5FwJW5+sDi8or0SV39KmsjA=', 'testkey@gmail.com', '0', 1427224545, 0, 0, 0, 'IF6Ub+gJ+0y5y+o0SQweJRCbcp4C6er4x+ZfU8sbE0o=', '', '', 'HkUM3UAD739SI+gFpQAmaX2JCgJkpteh+eWTAP1Lq2qNv6zftlMSDBnS8HMZxNBv7VhQ3xz59EVUlahNVKFLXXMA68DCYX2AcgXbFHrU+ktFaICl6qJ4EVqi3pmqIeFq|/QvWIAzZuCadvt/06+FIVB/dAAt/dir8v3iRvFP58Ac=', 'tQeJnupeBKvEyaTrtuw609YHCXPRntFtyV3lqU09RV/uE8oMnOCqXMq3R0QYxKSog/JbxsobzeVPsA83G5tRb/xk8k/emnSwrKwUxfvGwwsELM0wT22fxQ9RovDPFA28|PXh6vkKP9wIzf4O7uMZjz8PlS3SdEulIA7kaF4Zp4qE='),
(64, 'T3JqAuV6KSQnGwjBnY6qJwLD/GTACsc8xBoeMqGeoUg=', 'jiji.bouquet@gmail.com', '0', 1437641893, 0, 0, 0, '/KrSOBVuiJ7i80XkQaljhUObLiH97qQ9O9tHBAg615Q=', '', '', '+jqUzow1f3TVuaYGrpOMabeVyT/uqd12B5bQS5DnbE9w3CqSD8okDZ/7a81QZe5XveHhZ168xCDTszQxnEMMIfeX1ogUmJ0E6GkunYkdzoT87iWGEShkiwaQOsT5eHu3|x6JyN4ClYRYtMHC1/MeSIqFlfokqVYiV1vqp7JjBPYA=', 'j5kWfJDlS58JX2F3HDSMJbhlLPbRv8FF/Lx3+9knq+Zh0AunhquIiT/nk+vwP16+Z/ewAXdkZu+2BovdNNh2OqJLG25xBDRpuUw3VMnAN2gsQG2tctOkRjZcZm8Pndy8|AOaNVB2A9Qnfcu+eZrjALdP9xoh2EcRg0twJFIRUkjc='),
(65, 'rh4g2pCEJ/GFPDmfPVwu/BDyfPWPfG/I3tSBAjbv48I=', 'XD@gmail.com', '0', 1438002056, 0, 0, 0, 'vmDvO5tVUWUNh7HkSQtq1oTtbDZ5y1K8ixKxVFdnljs=', '', '', '//5kXDCnEMSrlNgnxZ7AhriJi5F9jsYu+rRnrqmqwUlwbEXsSUCWsSR8jO5fc9Xahqi+Dcmed17UmjgWdjEHLNzXhKvZ1xi5cMG1P/F5g2BJq2ngUqj4/PuQrS739eWa|/JE39DMfBBkk4KT3ExKcjRRJQ0ihyj32HP/b1QEWMe4=', 'pRI25u/RmCjdyZhunmiYsaY/p1oTluvzlFPlhumrvHu2utg3fI6en18rlyiiC9wxNHn0rmztktZpKJefR3NoCorEu5UH7kigVQcyzKy4ENyr1jWlZIJiSEqXlhQ4xQu2|/Byr38Ilpi/S5mokXnSbjHOcqygRQUaf5pNHY2pAop8='),
(259, 'RWHt/feig9eZvgWgnorXplUHz4RdJj6JdRYNsF9s9fw=', 'test12@gmail.com', '0', 1467750405, 0, 0, 0, '', '', '', 'Tlj/FsEwau5hQ3AA6Vj8DXe2jzhAbh4AQGOIaFFbSNYj0f7YUqPtM+Q392ks3b6nX3wYvfV+8E7ic5/rcViWgXjQofhaRfRYGk4Ep4DnMk8fftQftZvIs4DnUI0rzVj/|D5kkNA+b7WBF6QFhQoke+bYBm7Oa7zo/8b5YVx+hhVk=', 'Tlj/FsEwau5hQ3AA6Vj8DXe2jzhAbh4AQGOIaFFbSNYj0f7YUqPtM+Q392ks3b6nX3wYvfV+8E7ic5/rcViWgXjQofhaRfRYGk4Ep4DnMk8fftQftZvIs4DnUI0rzVj/|D5kkNA+b7WBF6QFhQoke+bYBm7Oa7zo/8b5YVx+hhVk='),
(68, 'QoZM3MSEU1tScebYXo04IMeMVo+jHOs03DXlBvY51cI=', 'anastasia.daniel22@gmail.com', '0', 1438715396, 0, 0, 0, 'BRK4AVmdk1Bcl45cBEZRniRH+69Wyn5hX6Lnv/Zg5cI=', '', '', 'qD/svKSjwbrYUyUk34PuEZPKqAi1x4OuaaTKDqGD/JE3GBaJijy9AL/mesP5nzprdryf4bse+2Oa/+r6BsAqn2QdzXVN/VjB9OtVmddQUIg43modGkqnSr5Gb16+5T0F|ZiWhxYmeFuq/aeWbujSFqY27dUDKpbe6JbCBQ7ypzCw=', 'TTV/DSyIt07/oOaHM0QOIIWupkRtUWAhpm12EvYVIlUMl7dTXmg/VzdWgTGlrpChqUmVVMgo07JZbLmz8AV3W89aE9hwJOmIyoIq18FKIet/6y9Yjs/dQRxAQD5zaaOF|FKXcqA/9MV55cq0+gdgbap7H5/H07jfjTgdd4bO/7Mk='),
(69, 'YSZP7lWfwr4mjoouewQayBdnmNmpKdXD1ve5AuEsbGY=', 'boss@gmail.com', '0', 1438790733, 0, 0, 0, 'xegquLxagIlq9axZeqlcEOXDUGnRBorBYTvolh95isc=', '', '', 'IoJ2lj3T1uQJljWWgYxRvIqM6DdWDCGyACH2bdcYBKrwgnVISzPELxUmuH5cATzKUMhhufoKxHSl/Ew8/6R0PnsnIvB8Mg/hRR7+L3ijgfeIWdM1oLhyqo7Tw2UgoQZG|3knicdHH4gQ1CFrnWoLBmv3VtXyvYEhAnJw1Pb8jY3g=', 'Ot2Ga0dn0NuY+JMwiagyMQKLqGlz8U2WH7q+rz0gVaFMuqTiugyv633PjviZtOAvQ2aEhsbyJaY3LHLFYE7UV0UCJFreglZmAMSGQ70V2I29mv6b3DkVuSmM6IBjSgvm|Lh1seByM+eXeX60IWjvRzIwFXuvWqZvDngFwLjGfZPs='),
(275, 'kYOgdeGkWu/I28KbgfQLRQS5KThFN6UQH7l+qXLB8l4=', 'thuthur.bouquet@gmail.com', '0', 1470493793, 0, 0, 0, '', '', '', 'OYmnXZtthTuwBICOGYbN/e87zcdLbx97/j5oK5ai7bpNmn0cZwAX+qxX39AqanZeQpHcvgMqGqgy3D7XCwa81TRiEvm6+Xe8PahzrxqADW/8iLAOF22gtTyv64YgIBH/|oAhoGbvDTj13OBtFYnMyGsgD7WTuLlz02IUuA/LyiZs=', 'OYmnXZtthTuwBICOGYbN/e87zcdLbx97/j5oK5ai7bpNmn0cZwAX+qxX39AqanZeQpHcvgMqGqgy3D7XCwa81TRiEvm6+Xe8PahzrxqADW/8iLAOF22gtTyv64YgIBH/|oAhoGbvDTj13OBtFYnMyGsgD7WTuLlz02IUuA/LyiZs='),
(77, 'Wd4rxumIUWCEfk3Xelnyk0Y0EjA8cLXGu5E1PFgYqrs=', 'test13@test.fr', '0', 1439572014, 0, 0, 1, 'YBBdITkrFDKiBTqeVod1Z0JbMfdDbxnDISixQy7JamY=', '', '', 'IeEBl+QxoTSmIsjCWAj/du/27IIMxtbS9R/MbiM4gxoROFHdkaK3HPjayASCXKt9s9v4sOKoMJ6TaQ9YSo57UlPYw3S3mQX//QKb/QwBFQQkIwz1mdBAH9kS1SBoq9Ee|JmhPuCIRHTq1WHfQIWdE77XuKVzQzUkqfJTburHB6z0=', 'MMYZ6nVQ1P488qXQTtn9k+oGVgofanFwXbNXP4yXVKU0mWQY5FC0ro5KEf8bE/fyCczDKX9+U3V1b2S2WrbWwnh8yWDYnYelobg4bCDljOHOjuxK3i8Mtran3Zt08/Dr|YX9NBbUSKnxfT7JZxTvg3nveOFdX0cERol6c7Ggy5G8='),
(212, 'RWHt/feig9eZvgWgnorXplUHz4RdJj6JdRYNsF9s9fw=', 'test12@gmail.com', '0', 1440506249, 0, 0, 1, 'joKR/yJUQnAbxaXvCfoRNzaZlCH7eA27XxqlUm29xPM=', '', '', '9FonM7baJlN+ThJHf7wF4m+rrhzV1nIG7dv0apmIhTMld7ptxvZokunE0NL4IRAltV9Z1EfqRFfPkyUj0omp/P6Rv/3TgoR0Zh0MBHZNec2QQcgvj9O0bHXn+i3YT4pj|kz9Eng/DGMfjNCNlPOKw180SBArTpVaA98blnCIPNEo=', 'HXaYWhfvkxtxbbDhkKjBddPmyBO9f7XA3kF47mjgnU21D02Gi/S+k60ANSfFP2nFS3rcmuIo3MhCzhNUsusf4N+HiT6YsCCnuGg5BXo92oIn1ThjdswS1Mo3H2vFRBGY|ce6VR+2aC+klvfHuoc/UYs06hko51cKF2ikVOKN2wJo='),
(243, '+gPVVg77ZiD0DtDtYNvkMCuFp73h4CG9Ya2/NwCBSM8=', 'valee27@gmail.com', '0', 1441723334, 0, 0, 1, 'ELlD4XLRLOj5FP07NyPMRPKcDWNrgq9xuvLbXxOvTLI=', '', '', '0bEiMb4LWNoA1de1CbOOSzhjADu9Sk9HKBebgR8DBRS0/BE8ktUVyH+Ob8NfZwIaYkBw5Dxszd3pHkkzKJ2bH5nCHXMP9uUZB/EQjfg+qtBQjfDSIMzgJIVqr+KU91Aj|0YtLYXlFAgTJzd51SIin3kRVhFb8fJSPdnEV/Zo5Jr0=', 'XQqxcPGcRs8LyEUw6IIZUauDs1Jm+d75kh2M+SGTZe1t9eGaOuQfGEQJjsiYwDAegjbhtyPrTcKp928+/GvZO7mXOA4auIWnliCa4C7TLPcBwHcx+jaa8wXhuDpv+yda|F0hHbxrwaafDtArvhJJx+QbL9N1hvJmrk2Hyr2CqzBs='),
(269, '5dj3o1sP8Vrc7kGYMkqJH9i94N/TOjjHd/+sICahl18=', 'test47@gmail.com', '0', 1468000870, 0, 0, 0, '', '', '', 'oaYabnGbXxPt4qQmU5jl9Tfy2Z+8rIJRJmrE/nvx7JzzdveZFC6ruqIzxMK1rhZ7r9WRFkaJVpndxh9SGXh0sHZx9jQhCPvcglvchg/sOLL3BRdlxBP7cgnGccwBscGY|9o4TfFWqSMad5TudEZCP4WccTy2k9pc9nsyf96HAu0w=', 'oaYabnGbXxPt4qQmU5jl9Tfy2Z+8rIJRJmrE/nvx7JzzdveZFC6ruqIzxMK1rhZ7r9WRFkaJVpndxh9SGXh0sHZx9jQhCPvcglvchg/sOLL3BRdlxBP7cgnGccwBscGY|9o4TfFWqSMad5TudEZCP4WccTy2k9pc9nsyf96HAu0w='),
(268, 'd13Xeyophow89lQADX3zT4gOqLBnOqJFRVaRXTEVFhs=', 'test46@gmail.com', '0', 1467756751, 0, 0, 0, '', '', '', '6tXHaeUHBP/wAXSv2VacNVsoQ0K3xyDzlnh9p3XCHS5sLqf0sLdyHHkg5PsyVts2UR1mis99l0ctpUe9/fZL/cwbDktYI8R5gPshlPeSiO/4XcE0E29a3lUsxrr3TXrI|PnUGv0CHmbF1b0XYet8/DK4FbcyaAWYc/B6/PmVdIA8=', '6tXHaeUHBP/wAXSv2VacNVsoQ0K3xyDzlnh9p3XCHS5sLqf0sLdyHHkg5PsyVts2UR1mis99l0ctpUe9/fZL/cwbDktYI8R5gPshlPeSiO/4XcE0E29a3lUsxrr3TXrI|PnUGv0CHmbF1b0XYet8/DK4FbcyaAWYc/B6/PmVdIA8='),
(270, 'jk7yBw8LEkX7HYtDha8eCqHOIL7/nPDyHaPatB8botY=', 'test48@gds.fr', '0', 1468338897, 0, 0, 0, '', '', '', 'q4ZIwDO/pglyj1ENrVPlcEHxnyeK6kEhSzJ39DzZBK9sSbU3cHjH7SGUXZcAV6/JNzhlU32UrOpmN4YpRCgVDet8IuL21DngU985aD2smkD6PTgHtxjBMIs+Qd73wBec|Nu09GohL0GhQz4j28UHTA3h3aq/9h5hAJAISp1jXjH4=', 'q4ZIwDO/pglyj1ENrVPlcEHxnyeK6kEhSzJ39DzZBK9sSbU3cHjH7SGUXZcAV6/JNzhlU32UrOpmN4YpRCgVDet8IuL21DngU985aD2smkD6PTgHtxjBMIs+Qd73wBec|Nu09GohL0GhQz4j28UHTA3h3aq/9h5hAJAISp1jXjH4='),
(271, 'XY+q+f3Jz39mr3dQofYJZd/5ktMau5nkwlkw/UZv2nc=', 'test49@ezfd.gr', '0', 1468579527, 0, 0, 0, '', '', '', '5oR9Mwb2qPP8cyax2p8TTiUxiGU+PSlLjpScFinuoCKTmQRSL5YmU9xrVNhdRN5Un225+s1xtMOMNuP9KGTqW2CYTlxuP0QYemhP6A3gDTFNrCOHzfZt26XAQJlAtGOb|dThvbH9Nn4uyofo+LmCGa4+FzbI6Kw0zpmKPq7h3p0I=', '5oR9Mwb2qPP8cyax2p8TTiUxiGU+PSlLjpScFinuoCKTmQRSL5YmU9xrVNhdRN5Un225+s1xtMOMNuP9KGTqW2CYTlxuP0QYemhP6A3gDTFNrCOHzfZt26XAQJlAtGOb|dThvbH9Nn4uyofo+LmCGa4+FzbI6Kw0zpmKPq7h3p0I=');

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `version_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `version_name` varchar(32) NOT NULL,
  `version_time` int(16) NOT NULL,
  PRIMARY KEY (`version_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `version`
--

INSERT INTO `version` (`version_id`, `version_name`, `version_time`) VALUES
(1, '1.1.56', 0),
(2, '1.2.20', 0),
(3, '1.2.45', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
