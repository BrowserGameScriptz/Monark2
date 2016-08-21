-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 19 Août 2016 à 22:42
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `buy`
--

INSERT INTO `buy` (`buy_id`, `buy_user_id`, `buy_turn_id`, `buy_game_id`, `buy_land_id`, `buy_units_nb`, `buy_build_id`, `buy_time`) VALUES
(1, 268, 5, 3, 91, 0, 2, 1471630049),
(2, 268, 20, 5, 3, 8, 0, 1471636174),
(3, 268, 29, 5, 37, 13, 0, 1471636204),
(4, 268, 35, 5, 30, 12, 0, 1471636222);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`chat_id`, `chat_game_id`, `chat_user_id`, `chat_message`, `chat_time`) VALUES
(1, 3, 268, 'test', 1471629158);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `difficulty_rate_resource_freq` varchar(50) NOT NULL,
  `difficulty_rate_building_cost` varchar(50) NOT NULL,
  `difficulty_rate_building_icome` varchar(50) NOT NULL,
  `difficulty_rate_land_base_units` varchar(50) NOT NULL,
  `difficulty_bot_action_per_turn` varchar(50) NOT NULL,
  `difficulty_bot_bonus_income` varchar(50) NOT NULL,
  PRIMARY KEY (`difficulty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `difficulty`
--

INSERT INTO `difficulty` (`difficulty_id`, `difficulty_name`, `difficulty_rate_resource_freq`, `difficulty_rate_building_cost`, `difficulty_rate_building_icome`, `difficulty_rate_land_base_units`, `difficulty_bot_action_per_turn`, `difficulty_bot_bonus_income`) VALUES
(1, 'Very_easy', '3', '0.5', '2', '0.5', '5', '0.5'),
(2, 'Easy', '2', '0.5', '1', '0.5', '10', '0.75'),
(3, 'Normal', '1', '1', '1', '1', '30', '1'),
(4, 'Hard', '1', '2', '1', '2', '200', '1.25'),
(5, 'Very_hard', '0.5', '2', '0.5', '2', '10000', '1.5');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fight`
--

INSERT INTO `fight` (`fight_id`, `fight_game_id`, `fight_atk_user_id`, `fight_def_user_id`, `fight_atk_land_id`, `fight_def_land_id`, `fight_atk_nb_units`, `fight_def_nb_units`, `fight_atk_lost_unit`, `fight_def_lost_unit`, `fight_atk_units`, `fight_def_units`, `fight_thimble_atk`, `fight_thimble_def`, `fight_time`, `fight_turn_id`, `fight_conquest`) VALUES
(1, 5, 268, 0, 3, 7, 12, 3, 2, 3, '/12/12/11/10/10', '/3/1/1/1/0', '/6;4;2;/6;5;1;/4;3;2;/5;4;1;', '/2;2;/6;/5;/3;', 1471636180, 20, 1),
(2, 5, 268, -2, 7, 37, 9, 4, 7, 4, '/9/7/4/3/2/2', '/4/3/3/1/1/0', '/4;3;2;/3;2;1;/5;5;5;/2;2;1;/4;4;', '/6;4;1;/3;2;1;/6;4;4;/5;/3;', 1471636190, 23, 1),
(3, 5, 268, 0, 37, 30, 14, 3, 5, 3, '/14/14/13/12/11/10/9/9', '/3/1/1/1/1/1/1/0', '/6;5;4;/3;2;1;/1;1;1;/3;2;1;/6;5;5;/4;3;1;/4;3;2;', '/5;2;/5;/4;/3;/6;/5;/3;', 1471636210, 29, 1),
(4, 5, 268, -1, 30, 32, 20, 4, 4, 4, '/20/17/16/16', '/4/4/2/0', '/5;2;2;/6;4;3;/4;4;2;', '/5;4;2;/5;4;2;/3;1;', 1471636228, 35, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`game_id`, `game_name`, `game_owner_id`, `game_max_player`, `game_create_time`, `game_statut`, `game_map_id`, `game_map_cont`, `game_mod_id`, `game_turn_time`, `game_difficulty_id`, `game_won_user_id`, `game_won_time`, `game_pwd`, `game_key`) VALUES
(1, 'cCbYWqSq5xIA7UP2sv62LQ8F0cDFURd11nthr3/KFtQ=', 268, 5, 1471602626, 50, 1, 0, 0, 0, 0, 0, 0, 'xLwJZu5IadFQi/3pB5SOdmN4DBhWW8i3nH4X0aRWyFMav1luOOBkte05LwbQp3yUdrpiB8tGPL1EobY/he5v/GOa9I5lhyZVMzjfci6+xdOMupTkCMXJPjkkrN2N3D4M|SXKHYuiJTZaSlDgAED+iQr1/hmcwfXr0L5tX/0RqXkc=', '0'),
(2, 'FONdawqHav0XpW2YjPo/8rMv+o7xjhy7+byZs8DMlic=', 268, 3, 1471612929, 100, 1, 0, 0, 0, 0, 0, 0, 'IknHb6Yk2lr3NCKRu8Ie8E/nCHE8bgl2mfJuyCuWpR/Pi7rS2b6jx/p0sR+30M8ymDw3iZb65okcXBOhuM6eSBfaBHiXSES6RouTohi0z0ZT/PKgw3LqiIm0utPXjAXp|9TDyy0GOhBaqcoSMKPjQ/ip67Wdr/1Vs4Cnf9JhSxpo=', '0'),
(3, 'EJWxvJaVGm6kgg/4D7MOSW/UjMI3UmdBzUfV63wxtoM=', 268, 2, 1471613451, 50, 2, 0, 0, 0, 0, 0, 0, 'gmLmQNYJ669jpwAuDjV/qRx+SiRh0gegSKjUXrrvaXIYuK7P9zzwtv1yTOXz71K4yCDiCtlGDQ5vpAArSk8iUWwcW+LnIXw9pdnYjmdKIAjzV91w0Hl/CDWjaKABN+8H|kL7leYhGTj0EaIZX/RZAUbHZPrssDuRHSIeLUHN1Hfw=', '0'),
(4, 'J6ghkity9EFOP2IQ05O9FJk1XX+nln1jbG8qunvCocc=', 268, 2, 1471634615, 50, 2, 0, 0, 0, 0, 0, 0, 'qOYnt+CDiFpcextcWZT2NQAtBC1iOIRlfay0xi3BwkO0wDnDeH4XDRVC3Xa6UNeF68qsih8TC43rzKkr+oE3PtkzxHcdewl/ASsxUR8gBI1Vi5cP+9EC31X2u63uNvKW|rmV5KJkUI6pJJuWibm//hHlR3gZkdwrHMNZUfk1pNn0=', '0'),
(5, 'jXAh/0rHbBRCx93r9oawnDHsx0Lhijt6BkX90dyRmfU=', 268, 3, 1471635213, 100, 1, 0, 0, 0, 0, 0, 0, 'F6UTrkbLW71AnJCSaTyAXQ1VokenuM+cfgt4CVihw9VGJHNZ3zFlfSjR5HFFoK+T6P+BYTWnw4CEDRuAVnASv4scFInpWozOlxYG4FyJ5Q9n2N+D4rUPIiQ7+OZDZ9gz|uYi4a7/oNLgPOijEFGldtznNQDMgCw6DHJt2CWEP7qU=', '0'),
(6, 'jAyZs52vc1INiHYc/4cDjgFwA4jEhnQgJ/9tlInyqQM=', 268, 5, 1471636273, 50, 1, 0, 0, 0, 0, 0, 0, 'xrlNSbDnhuYS+vm/GV0QVwx3ZKokLjq/Hjo+IC6DZb5+OU7Mv6FPNe2Sy0gghBtou8tikLG08uY0d24/ZMlwTxZhYic6SVOImEMfmwyJDgbrUtIJbkAIgT/stEQf+XbT|RYmzAvimhfeLGdotRbkBQT9vwQ0SETsA9bq0rlv2Ti0=', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=332 ;

--
-- Contenu de la table `game_data`
--

INSERT INTO `game_data` (`game_data_id`, `game_data_game_id`, `game_data_user_id`, `game_data_user_id_base`, `game_data_land_id`, `game_data_units`, `game_data_capital`, `game_data_resource_id`, `game_data_buildings`) VALUES
(1, 1, 0, 0, 1, 3, 0, 0, ''),
(2, 1, 269, 269, 2, 4, 269, 0, '6;1;'),
(3, 1, 0, 0, 3, 4, 0, 0, ''),
(4, 1, 0, 0, 4, 3, 0, 0, ''),
(5, 1, 0, 0, 5, 4, 0, 0, ''),
(6, 1, 268, 268, 6, 5, 268, 2, '6;1;'),
(7, 1, 0, 0, 7, 3, 0, 0, ''),
(8, 1, 0, 0, 8, 4, 0, 2, ''),
(9, 1, 0, 0, 9, 3, 0, 0, ''),
(10, 1, 0, 0, 10, 3, 0, 2, ''),
(11, 1, 0, 0, 11, 4, 0, 0, ''),
(12, 1, 0, 0, 12, 3, 0, 0, ''),
(13, 1, 0, 0, 13, 3, 0, 0, ''),
(14, 1, 0, 0, 14, 3, 0, 0, ''),
(15, 1, 0, 0, 15, 4, 0, 2, ''),
(16, 1, 0, 0, 16, 3, 0, 0, ''),
(17, 1, 0, 0, 17, 4, 0, 0, ''),
(18, 1, 0, 0, 18, 4, 0, 0, ''),
(19, 1, 0, 0, 19, 4, 0, 0, ''),
(20, 1, 0, 0, 20, 3, 0, 0, ''),
(21, 1, 0, 0, 21, 3, 0, 0, ''),
(22, 1, 0, 0, 22, 3, 0, 0, ''),
(23, 1, 0, 0, 23, 3, 0, 0, ''),
(24, 1, 0, 0, 24, 3, 0, 1, ''),
(25, 1, 0, 0, 25, 3, 0, 0, ''),
(26, 1, 0, 0, 26, 4, 0, 0, ''),
(27, 1, 0, 0, 27, 3, 0, 0, ''),
(28, 1, 0, 0, 28, 4, 0, 0, ''),
(29, 1, 0, 0, 29, 3, 0, 0, ''),
(30, 1, 0, 0, 30, 3, 0, 3, ''),
(31, 1, 0, 0, 31, 3, 0, 0, ''),
(32, 1, 0, 0, 32, 3, 0, 2, ''),
(33, 1, 0, 0, 33, 4, 0, 0, ''),
(34, 1, 0, 0, 34, 3, 0, 1, ''),
(35, 1, 0, 0, 35, 3, 0, 0, ''),
(36, 1, 0, 0, 36, 3, 0, 0, ''),
(37, 1, 0, 0, 37, 3, 0, 3, ''),
(38, 1, 0, 0, 38, 3, 0, 3, ''),
(39, 1, 0, 0, 39, 3, 0, 0, ''),
(40, 1, 0, 0, 40, 3, 0, 3, ''),
(41, 1, 0, 0, 41, 3, 0, 0, ''),
(42, 1, 0, 0, 42, 3, 0, 0, ''),
(43, 1, 0, 0, 43, 3, 0, 1, ''),
(44, 1, 0, 0, 44, 3, 0, 3, ''),
(45, 1, 0, 0, 45, 3, 0, 3, ''),
(46, 1, 0, 0, 46, 3, 0, 0, ''),
(47, 1, 0, 0, 47, 3, 0, 0, ''),
(48, 3, 0, 0, 48, 4, 0, 2, ''),
(49, 3, 0, 0, 49, 3, 0, 0, ''),
(50, 3, 0, 0, 50, 4, 0, 0, ''),
(51, 3, 0, 0, 51, 3, 0, 0, ''),
(52, 3, 0, 0, 52, 4, 0, 0, ''),
(53, 3, 0, 0, 53, 3, 0, 0, ''),
(54, 3, 0, 0, 54, 4, 0, 0, ''),
(55, 3, 0, 0, 55, 3, 0, 0, ''),
(56, 3, 0, 0, 56, 3, 0, 0, ''),
(57, 3, 0, 0, 57, 3, 0, 3, ''),
(58, 3, 0, 0, 58, 3, 0, 3, ''),
(59, 3, 0, 0, 59, 4, 0, 0, ''),
(60, 3, 0, 0, 60, 4, 0, 0, ''),
(61, 3, 0, 0, 61, 4, 0, 1, ''),
(62, 3, 0, 0, 62, 3, 0, 0, ''),
(63, 3, 0, 0, 63, 4, 0, 0, ''),
(64, 3, 0, 0, 64, 4, 0, 3, ''),
(65, 3, 0, 0, 65, 3, 0, 0, ''),
(66, 3, 0, 0, 66, 3, 0, 0, ''),
(67, 3, 269, 269, 67, 5, 269, 3, '6;1;'),
(68, 3, 0, 0, 68, 4, 0, 0, ''),
(69, 3, 0, 0, 69, 4, 0, 0, ''),
(70, 3, 0, 0, 70, 3, 0, 0, ''),
(71, 3, 0, 0, 71, 4, 0, 0, ''),
(72, 3, 0, 0, 72, 3, 0, 2, ''),
(73, 3, 0, 0, 73, 3, 0, 0, ''),
(74, 3, 0, 0, 74, 3, 0, 2, ''),
(75, 3, 0, 0, 75, 4, 0, 0, ''),
(76, 3, 0, 0, 76, 3, 0, 3, ''),
(77, 3, 0, 0, 77, 3, 0, 0, ''),
(78, 3, 0, 0, 78, 4, 0, 0, ''),
(79, 3, 0, 0, 79, 3, 0, 0, ''),
(80, 3, 0, 0, 80, 3, 0, 0, ''),
(81, 3, 0, 0, 81, 4, 0, 0, ''),
(82, 3, 0, 0, 82, 4, 0, 2, ''),
(83, 3, 0, 0, 83, 3, 0, 0, ''),
(84, 3, 0, 0, 84, 3, 0, 0, ''),
(85, 3, 0, 0, 85, 3, 0, 2, ''),
(86, 3, 0, 0, 86, 4, 0, 0, ''),
(87, 3, 0, 0, 87, 4, 0, 0, ''),
(88, 3, 0, 0, 88, 3, 0, 0, ''),
(89, 3, 0, 0, 89, 4, 0, 0, ''),
(90, 3, 0, 0, 90, 3, 0, 0, ''),
(91, 3, 268, 268, 91, 4, 268, 0, '6;1;;2'),
(92, 3, 0, 0, 92, 4, 0, 3, ''),
(93, 3, 0, 0, 93, 3, 0, 0, ''),
(94, 3, 0, 0, 94, 4, 0, 0, ''),
(95, 3, 0, 0, 95, 3, 0, 2, ''),
(96, 2, 0, 0, 1, 3, 0, 0, ''),
(97, 2, 0, 0, 2, 3, 0, 0, ''),
(98, 2, 268, 268, 3, 5, 268, 0, '6;1;'),
(99, 2, 0, 0, 4, 3, 0, 0, ''),
(100, 2, 0, 0, 5, 4, 0, 3, ''),
(101, 2, 0, 0, 6, 4, 0, 0, ''),
(102, 2, 0, 0, 7, 3, 0, 0, ''),
(103, 2, 0, 0, 8, 4, 0, 0, ''),
(104, 2, 0, 0, 9, 3, 0, 0, ''),
(105, 2, 0, 0, 10, 3, 0, 0, ''),
(106, 2, 0, 0, 11, 4, 0, 1, ''),
(107, 2, 0, 0, 12, 3, 0, 0, ''),
(108, 2, 0, 0, 13, 3, 0, 0, ''),
(109, 2, 0, 0, 14, 3, 0, 0, ''),
(110, 2, 0, 0, 15, 4, 0, 0, ''),
(111, 2, 0, 0, 16, 3, 0, 0, ''),
(112, 2, 0, 0, 17, 4, 0, 0, ''),
(113, 2, 0, 0, 18, 4, 0, 0, ''),
(114, 2, 0, 0, 19, 4, 0, 0, ''),
(115, 2, 0, 0, 20, 3, 0, 0, ''),
(116, 2, 0, 0, 21, 3, 0, 0, ''),
(117, 2, 0, 0, 22, 3, 0, 0, ''),
(118, 2, 0, 0, 23, 3, 0, 0, ''),
(119, 2, 0, 0, 24, 3, 0, 0, ''),
(120, 2, 0, 0, 25, 3, 0, 0, ''),
(121, 2, 0, 0, 26, 4, 0, 3, ''),
(122, 2, 0, 0, 27, 3, 0, 0, ''),
(123, 2, 0, 0, 28, 4, 0, 0, ''),
(124, 2, 0, 0, 29, 3, 0, 3, ''),
(125, 2, 0, 0, 30, 3, 0, 2, ''),
(126, 2, 0, 0, 31, 3, 0, 0, ''),
(127, 2, 0, 0, 32, 3, 0, 0, ''),
(128, 2, 0, 0, 33, 4, 0, 0, ''),
(129, 2, 0, 0, 34, 3, 0, 0, ''),
(130, 2, 0, 0, 35, 3, 0, 0, ''),
(131, 2, 0, 0, 36, 3, 0, 0, ''),
(132, 2, 0, 0, 37, 3, 0, 1, ''),
(133, 2, 0, 0, 38, 3, 0, 2, ''),
(134, 2, 0, 0, 39, 3, 0, 0, ''),
(135, 2, 0, 0, 40, 3, 0, 0, ''),
(136, 2, 0, 0, 41, 3, 0, 0, ''),
(137, 2, 0, 0, 42, 3, 0, 3, ''),
(138, 2, 0, 0, 43, 3, 0, 0, ''),
(139, 2, 0, 0, 44, 3, 0, 3, ''),
(140, 2, 0, 0, 45, 3, 0, 0, ''),
(141, 2, 0, 0, 46, 3, 0, 0, ''),
(142, 2, 0, 0, 47, 3, 0, 0, ''),
(143, 4, 0, 0, 48, 4, 0, 3, ''),
(144, 4, 0, 0, 49, 3, 0, 0, ''),
(145, 4, 0, 0, 50, 4, 0, 0, ''),
(146, 4, 0, 0, 51, 3, 0, 3, ''),
(147, 4, 0, 0, 52, 4, 0, 0, ''),
(148, 4, 0, 0, 53, 3, 0, 0, ''),
(149, 4, 0, 0, 54, 4, 0, 0, ''),
(150, 4, 0, 0, 55, 3, 0, 0, ''),
(151, 4, 0, 0, 56, 3, 0, 0, ''),
(152, 4, 0, 0, 57, 3, 0, 2, ''),
(153, 4, 0, 0, 58, 3, 0, 0, ''),
(154, 4, 0, 0, 59, 4, 0, 0, ''),
(155, 4, 0, 0, 60, 4, 0, 0, ''),
(156, 4, 0, 0, 61, 4, 0, 0, ''),
(157, 4, 0, 0, 62, 3, 0, 1, ''),
(158, 4, 0, 0, 63, 4, 0, 0, ''),
(159, 4, 0, 0, 64, 4, 0, 0, ''),
(160, 4, 0, 0, 65, 3, 0, 0, ''),
(161, 4, 0, 0, 66, 3, 0, 0, ''),
(162, 4, 0, 0, 67, 4, 0, 3, ''),
(163, 4, 0, 0, 68, 4, 0, 0, ''),
(164, 4, 0, 0, 69, 4, 0, 0, ''),
(165, 4, 0, 0, 70, 3, 0, 0, ''),
(166, 4, 0, 0, 71, 4, 0, 0, ''),
(167, 4, 0, 0, 72, 3, 0, 0, ''),
(168, 4, 0, 0, 73, 3, 0, 0, ''),
(169, 4, 0, 0, 74, 3, 0, 2, ''),
(170, 4, 0, 0, 75, 4, 0, 0, ''),
(171, 4, 0, 0, 76, 3, 0, 0, ''),
(172, 4, 0, 0, 77, 3, 0, 0, ''),
(173, 4, 0, 0, 78, 4, 0, 0, ''),
(174, 4, 0, 0, 79, 3, 0, 0, ''),
(175, 4, 0, 0, 80, 3, 0, 0, ''),
(176, 4, 0, 0, 81, 4, 0, 0, ''),
(177, 4, -1, -1, 82, 5, -1, 0, '6;1;'),
(178, 4, 0, 0, 83, 3, 0, 0, ''),
(179, 4, 0, 0, 84, 3, 0, 0, ''),
(180, 4, 0, 0, 85, 3, 0, 0, ''),
(181, 4, 0, 0, 86, 4, 0, 0, ''),
(182, 4, 0, 0, 87, 4, 0, 0, ''),
(183, 4, 0, 0, 88, 3, 0, 0, ''),
(184, 4, 0, 0, 89, 4, 0, 0, ''),
(185, 4, 268, 268, 90, 4, 268, 0, '6;1;'),
(186, 4, 0, 0, 91, 3, 0, 3, ''),
(187, 4, 0, 0, 92, 4, 0, 1, ''),
(188, 4, 0, 0, 93, 3, 0, 3, ''),
(189, 4, 0, 0, 94, 4, 0, 0, ''),
(190, 4, 0, 0, 95, 3, 0, 0, ''),
(191, 5, 0, 0, 1, 3, 0, 0, ''),
(192, 5, 0, 0, 2, 3, 0, 3, ''),
(193, 5, 268, 268, 3, 1, 268, 0, '6;1;'),
(194, 5, 0, 0, 4, 3, 0, 0, ''),
(195, 5, 0, 0, 5, 4, 0, 2, ''),
(196, 5, 0, 0, 6, 4, 0, 0, ''),
(197, 5, 268, 0, 7, 1, 0, 0, ''),
(198, 5, 0, 0, 8, 4, 0, 0, ''),
(199, 5, 0, 0, 9, 3, 0, 3, ''),
(200, 5, 0, 0, 10, 3, 0, 0, ''),
(201, 5, 0, 0, 11, 4, 0, 0, ''),
(202, 5, 0, 0, 12, 3, 0, 0, ''),
(203, 5, 0, 0, 13, 3, 0, 0, ''),
(204, 5, 0, 0, 14, 3, 0, 0, ''),
(205, 5, 0, 0, 15, 4, 0, 1, ''),
(206, 5, 0, 0, 16, 3, 0, 3, ''),
(207, 5, 0, 0, 17, 4, 0, 0, ''),
(208, 5, 0, 0, 18, 4, 0, 3, ''),
(209, 5, 0, 0, 19, 4, 0, 0, ''),
(210, 5, 0, 0, 20, 3, 0, 0, ''),
(211, 5, 0, 0, 21, 3, 0, 0, ''),
(212, 5, 0, 0, 22, 3, 0, 0, ''),
(213, 5, 0, 0, 23, 3, 0, 0, ''),
(214, 5, 0, 0, 24, 3, 0, 0, ''),
(215, 5, 0, 0, 25, 3, 0, 0, ''),
(216, 5, 0, 0, 26, 4, 0, 0, ''),
(217, 5, 0, 0, 27, 3, 0, 0, ''),
(218, 5, 0, 0, 28, 4, 0, 1, ''),
(219, 5, 0, 0, 29, 3, 0, 2, ''),
(220, 5, 268, 0, 30, 1, 0, 0, ''),
(221, 5, 0, 0, 31, 3, 0, 0, ''),
(222, 5, 268, -1, 32, 16, -1, 0, '6;1;'),
(223, 5, 0, 0, 33, 4, 0, 2, ''),
(224, 5, 0, 0, 34, 3, 0, 0, ''),
(225, 5, 0, 0, 35, 3, 0, 0, ''),
(226, 5, 0, 0, 36, 3, 0, 1, ''),
(227, 5, 268, -2, 37, 1, -2, 1, '6;1;'),
(228, 5, 0, 0, 38, 3, 0, 0, ''),
(229, 5, 0, 0, 39, 3, 0, 3, ''),
(230, 5, 0, 0, 40, 3, 0, 3, ''),
(231, 5, 0, 0, 41, 3, 0, 2, ''),
(232, 5, 0, 0, 42, 3, 0, 3, ''),
(233, 5, 0, 0, 43, 3, 0, 0, ''),
(234, 5, 0, 0, 44, 3, 0, 0, ''),
(235, 5, 0, 0, 45, 3, 0, 1, ''),
(236, 5, 0, 0, 46, 3, 0, 1, ''),
(237, 5, 0, 0, 47, 3, 0, 0, ''),
(238, 6, 0, 0, 1, 3, 0, 3, ''),
(239, 6, 268, 268, 2, 4, 268, 2, '6;1;'),
(240, 6, 0, 0, 3, 4, 0, 0, ''),
(241, 6, 0, 0, 4, 3, 0, 0, ''),
(242, 6, 0, 0, 5, 4, 0, 0, ''),
(243, 6, 0, 0, 6, 4, 0, 0, ''),
(244, 6, 0, 0, 7, 3, 0, 0, ''),
(245, 6, -1, -1, 8, 5, -1, 0, '6;1;'),
(246, 6, 0, 0, 9, 3, 0, 0, ''),
(247, 6, 0, 0, 10, 3, 0, 3, ''),
(248, 6, 0, 0, 11, 4, 0, 0, ''),
(249, 6, 0, 0, 12, 3, 0, 0, ''),
(250, 6, 0, 0, 13, 3, 0, 1, ''),
(251, 6, 0, 0, 14, 3, 0, 0, ''),
(252, 6, 0, 0, 15, 4, 0, 1, ''),
(253, 6, 0, 0, 16, 3, 0, 0, ''),
(254, 6, 0, 0, 17, 4, 0, 0, ''),
(255, 6, 0, 0, 18, 4, 0, 0, ''),
(256, 6, 0, 0, 19, 4, 0, 0, ''),
(257, 6, 0, 0, 20, 3, 0, 0, ''),
(258, 6, -3, -3, 21, 4, -3, 0, '6;1;'),
(259, 6, 0, 0, 22, 3, 0, 3, ''),
(260, 6, 0, 0, 23, 3, 0, 0, ''),
(261, 6, 0, 0, 24, 3, 0, 0, ''),
(262, 6, 0, 0, 25, 3, 0, 0, ''),
(263, 6, 0, 0, 26, 4, 0, 0, ''),
(264, 6, 0, 0, 27, 3, 0, 0, ''),
(265, 6, 0, 0, 28, 4, 0, 3, ''),
(266, 6, 0, 0, 29, 3, 0, 0, ''),
(267, 6, -4, -4, 30, 4, -4, 0, '6;1;'),
(268, 6, 0, 0, 31, 3, 0, 0, ''),
(269, 6, 0, 0, 32, 3, 0, 0, ''),
(270, 6, 0, 0, 33, 4, 0, 0, ''),
(271, 6, 0, 0, 34, 3, 0, 0, ''),
(272, 6, 0, 0, 35, 3, 0, 1, ''),
(273, 6, 0, 0, 36, 3, 0, 0, ''),
(274, 6, 0, 0, 37, 3, 0, 0, ''),
(275, 6, 0, 0, 38, 3, 0, 2, ''),
(276, 6, 0, 0, 39, 3, 0, 0, ''),
(277, 6, 0, 0, 40, 3, 0, 0, ''),
(278, 6, -2, -2, 41, 4, -2, 0, '6;1;'),
(279, 6, 0, 0, 42, 3, 0, 0, ''),
(280, 6, 0, 0, 43, 3, 0, 0, ''),
(281, 6, 0, 0, 44, 3, 0, 0, ''),
(282, 6, 0, 0, 45, 3, 0, 0, ''),
(283, 6, 0, 0, 46, 3, 0, 0, ''),
(284, 6, 0, 0, 47, 3, 0, 0, ''),
(285, 6, 0, 0, 1, 3, 0, 0, ''),
(286, 6, 0, 0, 2, 3, 0, 0, ''),
(287, 6, 0, 0, 3, 4, 0, 0, ''),
(288, 6, 0, 0, 4, 3, 0, 0, ''),
(289, 6, 0, 0, 5, 4, 0, 0, ''),
(290, 6, 0, 0, 6, 4, 0, 0, ''),
(291, 6, 268, 268, 7, 4, 268, 0, '6;1;'),
(292, 6, 0, 0, 8, 4, 0, 0, ''),
(293, 6, 0, 0, 9, 3, 0, 3, ''),
(294, 6, 0, 0, 10, 3, 0, 3, ''),
(295, 6, 0, 0, 11, 4, 0, 3, ''),
(296, 6, -1, -1, 12, 4, -1, 0, '6;1;'),
(297, 6, 0, 0, 13, 3, 0, 0, ''),
(298, 6, 0, 0, 14, 3, 0, 0, ''),
(299, 6, 0, 0, 15, 4, 0, 3, ''),
(300, 6, 0, 0, 16, 3, 0, 0, ''),
(301, 6, 0, 0, 17, 4, 0, 0, ''),
(302, 6, 0, 0, 18, 4, 0, 0, ''),
(303, 6, 0, 0, 19, 4, 0, 3, ''),
(304, 6, 0, 0, 20, 3, 0, 3, ''),
(305, 6, 0, 0, 21, 3, 0, 0, ''),
(306, 6, 0, 0, 22, 3, 0, 0, ''),
(307, 6, -3, -3, 23, 4, -3, 1, '6;1;'),
(308, 6, 0, 0, 24, 3, 0, 0, ''),
(309, 6, 0, 0, 25, 3, 0, 3, ''),
(310, 6, 0, 0, 26, 4, 0, 1, ''),
(311, 6, 0, 0, 27, 3, 0, 0, ''),
(312, 6, 0, 0, 28, 4, 0, 0, ''),
(313, 6, -4, -4, 29, 4, -4, 3, '6;1;'),
(314, 6, 0, 0, 30, 3, 0, 0, ''),
(315, 6, 0, 0, 31, 3, 0, 1, ''),
(316, 6, 0, 0, 32, 3, 0, 0, ''),
(317, 6, 0, 0, 33, 4, 0, 0, ''),
(318, 6, 0, 0, 34, 3, 0, 0, ''),
(319, 6, 0, 0, 35, 3, 0, 0, ''),
(320, 6, 0, 0, 36, 3, 0, 0, ''),
(321, 6, 0, 0, 37, 3, 0, 0, ''),
(322, 6, 0, 0, 38, 3, 0, 2, ''),
(323, 6, 0, 0, 39, 3, 0, 0, ''),
(324, 6, 0, 0, 40, 3, 0, 0, ''),
(325, 6, 0, 0, 41, 3, 0, 0, ''),
(326, 6, 0, 0, 42, 3, 0, 0, ''),
(327, 6, 0, 0, 43, 3, 0, 0, ''),
(328, 6, 0, 0, 44, 3, 0, 0, ''),
(329, 6, -2, -2, 45, 4, -2, 0, '6;1;'),
(330, 6, 0, 0, 46, 3, 0, 0, ''),
(331, 6, 0, 0, 47, 3, 0, 0, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `game_player`
--

INSERT INTO `game_player` (`game_player_id`, `game_player_region_id`, `game_player_difficulty_id`, `game_player_statut`, `game_player_game_id`, `game_player_user_id`, `game_player_color_id`, `game_player_enter_time`, `game_player_order`, `game_player_bot`, `game_player_quit`) VALUES
(5, 1, 1, 1, 1, 269, 2, 1471612647, 1, 0, 1),
(7, 1, 1, 1, 1, 268, 6, 1471612844, 2, 0, 1),
(8, 1, 1, 1, 2, 268, 2, 1471612992, 1, 0, 1),
(9, 1, 1, 1, 3, 269, 2, 1471613456, 1, 0, 0),
(10, 1, 1, 1, 3, 268, 7, 1471628635, 2, 0, 1),
(11, 1, 1, 1, 4, 268, 9, 1471634618, 2, 0, 1),
(12, 1, 1, 1, 4, -1, 2, 1471634620, 1, 1, 0),
(13, 1, 1, 1, 5, 268, 2, 1471635217, 3, 0, 1),
(14, 4, 1, 1, 5, -1, 4, 1471635219, 1, 1, 0),
(15, 5, 1, 1, 5, -2, 7, 1471635221, 2, 2, 0),
(16, 1, 1, 1, 6, 268, 2, 1471636275, 4, 0, 0),
(17, 2, 1, 1, 6, -1, 5, 1471636277, 5, 1, 0),
(18, 6, 1, 1, 6, -2, 7, 1471636278, 1, 2, 0),
(19, 3, 1, 1, 6, -3, 10, 1471636279, 2, 3, 0),
(20, 4, 1, 1, 6, -4, 11, 1471636281, 3, 4, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mail_read`
--

CREATE TABLE IF NOT EXISTS `mail_read` (
  `mail_read_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `mail_read_game_id` int(12) NOT NULL,
  `mail_read_mail_id` int(12) NOT NULL,
  `mail_read_user_receive_id` int(12) NOT NULL,
  `mail_read_time` int(12) NOT NULL,
  PRIMARY KEY (`mail_read_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

CREATE TABLE IF NOT EXISTS `map` (
  `map_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `map_name` varchar(128) NOT NULL,
  `map_music` varchar(128) NOT NULL,
  `map_continent` int(11) NOT NULL,
  `map_land_id_begin` int(11) NOT NULL,
  `map_land_id_end` int(11) NOT NULL,
  `map_hide` int(4) NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `map`
--

INSERT INTO `map` (`map_id`, `map_name`, `map_music`, `map_continent`, `map_land_id_begin`, `map_land_id_end`, `map_hide`) VALUES
(1, 'risk', 'Schwarzweiss-War_Theme.mp3', 1, 1, 47, 0),
(2, 'USA', 'Schwarzweiss-Drums_of_liberty.mp3', 0, 48, 95, 0),
(3, 'europa', '', 0, 0, 0, 0),
(4, 'france', '', 0, 0, 0, 0),
(5, 'africa', '', 0, 0, 0, 0),
(6, 'russia', '', 0, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Contenu de la table `turn`
--

INSERT INTO `turn` (`turn_id`, `turn_game_id`, `turn_user_id`, `turn_time`, `turn_time_begin`, `turn_gold`, `turn_gold_base`, `turn_income`) VALUES
(1, 1, 269, 1471612954, 1471612954, 2, 2, 2),
(2, 3, 269, 1471629322, 1471629322, 2, 2, 2),
(3, 3, 268, 1471629878, 1471629322, 2, 2, 2),
(4, 3, 269, 1471629952, 1471629878, 4, 4, 2),
(5, 3, 268, 1471629954, 1471629952, 0, 4, 2),
(6, 2, 268, 1471632650, 1471632650, 2, 2, 2),
(7, 2, 268, 1471632666, 1471632650, 4, 4, 2),
(8, 2, 268, 1471632673, 1471632666, 6, 6, 2),
(9, 2, 268, 1471634289, 1471632673, 8, 8, 2),
(10, 5, 268, 1471635234, 1471635234, 2, 2, 2),
(11, 5, 268, 1471635341, 1471635234, 2, 2, 2),
(12, 5, -1, 1471635436, 1471635341, 2, 2, 2),
(13, 5, -2, 1471635856, 1471635436, 2, 2, 2),
(14, 5, 268, 1471635900, 1471635856, 4, 4, 2),
(15, 5, -1, 1471636161, 1471635900, 4, 4, 2),
(16, 5, -2, 1471636161, 1471636161, 4, 4, 2),
(17, 5, 268, 1471636161, 1471636161, 6, 6, 2),
(18, 5, -1, 1471636164, 1471636161, 6, 6, 2),
(19, 5, -2, 1471636164, 1471636164, 6, 6, 2),
(20, 5, 268, 1471636164, 1471636164, 0, 8, 2),
(21, 5, -1, 1471636185, 1471636164, 8, 8, 2),
(22, 5, -2, 1471636185, 1471636185, 8, 8, 2),
(23, 5, 268, 1471636185, 1471636185, 3, 3, 3),
(24, 5, -1, 1471636195, 1471636185, 10, 10, 2),
(25, 5, -2, 1471636195, 1471636195, 8, 8, 0),
(26, 5, 268, 1471636195, 1471636195, 8, 8, 5),
(27, 5, -1, 1471636197, 1471636195, 12, 12, 2),
(28, 5, -2, 1471636197, 1471636197, 8, 8, 0),
(29, 5, 268, 1471636198, 1471636197, 0, 13, 5),
(30, 5, -1, 1471636213, 1471636198, 14, 14, 2),
(31, 5, -2, 1471636213, 1471636213, 8, 8, 0),
(32, 5, 268, 1471636213, 1471636213, 6, 6, 6),
(33, 5, -1, 1471636216, 1471636213, 16, 16, 2),
(34, 5, -2, 1471636216, 1471636216, 8, 8, 0),
(35, 5, 268, 1471636216, 1471636216, 0, 12, 6),
(36, 6, -4, 1471636301, 1471636301, 2, 2, 2),
(37, 6, 268, 1471636409, 1471636301, 2, 2, 2),
(38, 6, -1, 1471636811, 1471636409, 2, 2, 2),
(39, 6, -2, 1471636811, 1471636811, 2, 2, 2),
(40, 6, -3, 1471636811, 1471636811, 2, 2, 2),
(41, 6, -4, 1471636811, 1471636811, 4, 4, 2),
(42, 6, 268, 1471636811, 1471636811, 4, 4, 2),
(43, 6, -1, 1471637043, 1471636811, 4, 4, 2),
(44, 6, -2, 1471637043, 1471637043, 4, 4, 2),
(45, 6, -3, 1471637043, 1471637043, 4, 4, 2),
(46, 6, -4, 1471637043, 1471637043, 6, 6, 2),
(47, 6, 268, 1471637043, 1471637043, 6, 6, 2);

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
