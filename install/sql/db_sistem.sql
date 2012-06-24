-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2012 at 11:33 PM
-- Server version: 5.5.12
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `tehnik`
--
CREATE DATABASE `tehnik` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mylabsql_data`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` enum('Prepare','Setup/Installation','Support Program','Running Equipment','Hunting','Dismantle') DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `rec_id`, `user_id`, `activity`, `keterangan`) VALUES
(18, 1, 1, 'Hunting', ''),
(21, 2, 1, 'Support Program', 'support'),
(22, 2, 1, 'Setup/Installation', 'set'),
(23, 2, 1, 'Prepare', 'prep'),
(24, 3, 1, 'Hunting', ''),
(25, 3, 1, 'Running Equipment', ''),
(26, 3, 1, 'Support Program', ''),
(27, 3, 1, 'Setup/Installation', ''),
(28, 3, 1, 'Prepare', ''),
(29, 3, 28, 'Prepare', NULL),
(30, 2, 28, 'Running Equipment', ''),
(31, 2, 28, 'Support Program', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `sn` varchar(40) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `ref` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `equipment`
--


-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event` varchar(50) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`,`event`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `regdate`, `event`, `keterangan`) VALUES
(1, '2012-01-09 20:38:33', 'Ipop', 'Program musik mingguan boy/girls band'),
(2, '2012-01-10 16:05:44', 'BGBI', 'Boy/girl band selection'),
(3, '2012-01-10 16:12:30', 'Liputan 6', 'Pemberitaan/News'),
(4, '2012-01-10 16:35:20', 'Inbox', 'Program reguler\nJam 07:00=>09:00'),
(5, '2012-01-10 18:38:59', 'Hip-hip hura', 'Program mingguan kategori musik\nJam 15:00-17:00'),
(6, '2012-01-13 16:31:53', 'Mata air', 'Segmen dakwah'),
(7, '2012-01-13 16:33:52', 'Ustad solmad', 'Dakwah dimasjid'),
(38, '2012-01-13 18:04:50', 'Non event', 'Kegiatan diluar event'),
(39, '2012-01-23 12:17:12', 'ghdhg', 'hgdh'),
(40, '2012-01-23 13:53:51', 'ddd', 'dddddd'),
(41, '2012-01-27 16:31:49', 'Liputan banjir', '3 cam ENG');

-- --------------------------------------------------------

--
-- Table structure for table `event_rec`
--

DROP TABLE IF EXISTS `event_rec`;
CREATE TABLE IF NOT EXISTS `event_rec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `jenis` enum('Live','Tapping','Live on Tape') DEFAULT NULL,
  `status` enum('none','Exellent','OK','OK + Kendala','Kendala non teknis','Kendala teknis''','Dibatalkan') DEFAULT NULL,
  `keterangan` text,
  `user_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`,`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `event_rec`
--

INSERT INTO `event_rec` (`id`, `tanggal`, `event_id`, `lokasi`, `durasi`, `jenis`, `status`, `keterangan`, `user_id`, `active`) VALUES
(1, '2012-01-01', 4, 'satu', 35, 'Live', NULL, NULL, 1, NULL),
(2, '2012-01-26', 2, 'dua', 45, 'Live', NULL, NULL, 1, NULL),
(3, '2012-01-29', 3, 'Jakarta', NULL, 'Tapping', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iconcls`
--

DROP TABLE IF EXISTS `iconcls`;
CREATE TABLE IF NOT EXISTS `iconcls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `clsname` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `iconcls`
--

INSERT INTO `iconcls` (`id`, `title`, `clsname`, `icon`) VALUES
(1, 'Computer', 'base', 'application_cascade.png'),
(3, 'Check Password', 'chk-pwd', 'user_edit.png'),
(4, 'User Female', 'user-female', 'user_female.png'),
(50, 'user-manager', 'user-comment', 'user_go.png'),
(6, 'Logout', 'logout', 'key_go.png'),
(7, 'Login', 'login', 'lock_open.png'),
(8, 'Lock', 'lock', 'lock.png'),
(9, 'Browse', 'browse', 'grid.png'),
(10, 'Config', 'conf', 'cog_edit.png'),
(49, 'Application', 'app', 'plugin.gif'),
(12, 'Refresh', 'drop', 'table_refresh.png'),
(62, 'Duplicate', 'duplicate', 'table_multiple.png'),
(14, 'Menu Panel', 'mymenu', 'application_side_tree.png'),
(15, 'Navigator', 'navigator', 'application_side_boxes.png'),
(16, 'Setting', 'setting', 'application_get.png'),
(17, 'Form', 'form', 'application_form.png'),
(18, 'Add data', 'add-data', 'add.png'),
(19, 'Table Delete', 'table-delete', 'table_delete.png'),
(20, 'Table Addc', 'table-add', 'table_add.png'),
(21, 'Row Delete', 'row-delete', 'cancel.png'),
(22, 'App Grid', 'app-grid', 'table.png'),
(23, 'Form Edit', 'form-edit', 'application_form_edit.png'),
(24, 'Report Mode', 'report-mode', 'report_disk.png'),
(25, 'Report Pdf', 'report-pdf', 'page_white_acrobat.png'),
(26, 'Report Xls', 'report-xls', 'page_white_excel.png'),
(27, 'Parent Form', 'parent-form', 'vcard.png'),
(28, 'Arrow Down', 'arrow-down', 'arrow_down.png'),
(29, 'App Add', 'app-add', 'plugin_add.gif'),
(30, 'Panel Collapse', 'panel-collapse', 'application_put.png'),
(31, 'Image Add', 'image-add', 'image_add.png'),
(32, 'Db Table', 'db-table', 'database_table.png'),
(33, 'Db Refresh', 'db-refresh', 'database_refresh.png'),
(34, 'Menu Add', 'menu-add', 'page.png'),
(35, 'Sub Menu Add', 'submenu-add', 'page_add.png'),
(36, 'Menu Remove', 'menu-remove', 'page_delete.png'),
(37, 'Save', 'icon-save', 'disk.png'),
(38, 'Accept', 'accept', 'accept.png'),
(39, 'Js File', 'js-file', 'page_white_code.png'),
(40, 'Php File', 'php-file', 'page_white_php.png'),
(41, 'Image', 'image', 'images.png'),
(55, 'rss', 'rss', 'rss.png'),
(45, 'Event Menu', 'event-menu', 'attach.png'),
(48, 'Css Refresh', 'css-refresh', 'css_valid.png'),
(52, 'error', 'error-cls', 'error.png'),
(61, 'autosave', 'autosave', 'server_link.png'),
(64, 'pindah-kk', 'pindah-kk', 'book_go.png'),
(65, 'kk-baru', 'kk-baru', 'book_key.png'),
(66, 'split-kk', 'split-kk', 'book_open.png'),
(67, 'csv', 'csv', 'page_white_text.png'),
(68, 'upload', 'upload', 'page_attach.png'),
(69, 'group-manager', 'group-manager', 'group.png'),
(70, 'group-delete', 'group-delete', 'group_delete.png'),
(71, 'group-add', 'group-add', 'group_add.png'),
(72, 'user-delete', 'user-delete', 'user_delete.gif'),
(73, 'user-add', 'user-add', 'user_add.gif'),
(74, 'admin-page', 'admin-page', 'cog_error.png'),
(75, 'menu-disabled', 'check-none', 'plugin_disabled.png'),
(77, 'statistik', 'stat', 'chart_bar.png'),
(78, 'stat-line', 'stat-line', 'chart_curve.png'),
(79, 'stat-pie', 'stat-pie', 'chart_pie.png'),
(80, 'stat-bar', 'stat-bar', 'chart_bar_edit.png'),
(82, 'stat-line2', 'stat-line2', 'chart_line.png'),
(83, 'report-word', 'report-word', 'page_white_word.png'),
(84, 'arr', 'arrow-up', 'arrow_up.png'),
(85, 'sort', 'sort', 'text_padding_right.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(32) NOT NULL,
  `iconcls` varchar(32) NOT NULL,
  `handler` varchar(128) NOT NULL,
  `ajax` varchar(128) NOT NULL,
  `report` varchar(128) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `sort_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `iconcls`, `handler`, `ajax`, `report`, `published`, `sort_id`) VALUES
(6, 0, 'Sample Chart', 'stat', '', '', '', 1, 35),
(7, 6, 'Sample Chart 1', 'stat-line2', 'chart_v.js', 'chart_c.php', '', 1, 7),
(35, 0, 'Application', 'base', '', '', '', 1, 28),
(30, 28, 'Logistic Inventory', '', '', '', '', 1, 30),
(29, 28, 'Event', 'base', 'regevent_v.js', 'regevent_c.php', 'regevent_r.php', 1, 29),
(28, 0, 'Basic', 'conf', '', '', '', 1, 14),
(38, 42, 'PJT schedulling', 'table-add', 'event_pjt2_v.js', 'event_pjt_c.php', '', 1, 38),
(41, 28, 'Sistem', 'stat-line2', 'regsistem_v.js', 'regsistem_c.php', 'regsistem_r.php', 1, 41),
(42, 0, 'Event', '', '', '', '', 1, 37),
(43, 42, 'uu', '', '', '', '', 1, 43),
(44, 0, 'Activity', '', '', '', '', 1, 36),
(45, 44, 'Crew report', 'autosave', 'crew_activity2_v.js', 'crew_activity_c.php', '', 1, 45),
(46, 44, 'PJT Activity', '', 'Activity_v.js', 'activity_c.php', '', 1, 46);

-- --------------------------------------------------------

--
-- Table structure for table `menu_event`
--

DROP TABLE IF EXISTS `menu_event`;
CREATE TABLE IF NOT EXISTS `menu_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `event_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `menu_event`
--

INSERT INTO `menu_event` (`id`, `menu_id`, `event_name`) VALUES
(1, 1, 'PRINT_DATA'),
(2, 1, 'EDIT_DATA'),
(3, 1, 'CANCEL_DATA'),
(8, 5, 'ADD_DATA'),
(9, 5, 'EDIT_DATA'),
(10, 5, 'REMOVE_DATA'),
(11, 5, 'PRINT_DATA'),
(12, 9, 'SAVE_DATA'),
(13, 10, 'REMOVE_DATA'),
(14, 10, 'EDIT_DATA'),
(15, 10, 'ADD_DATA'),
(20, 11, 'SAVE_DATA'),
(21, 11, 'ADD_DATA'),
(22, 11, 'REMOVE_DATA'),
(23, 29, 'SAVE_DATA'),
(24, 29, 'EDIT_DATA'),
(25, 29, 'ADD_DATA'),
(26, 29, 'REFRESH_DATA'),
(27, 41, 'REFRESH_DATA'),
(28, 41, 'EDIT_DATA'),
(29, 41, 'ADD_DATA'),
(30, 41, 'SAVE_DATA'),
(52, 38, 'Refresh_DATA'),
(53, 38, 'REMOVE_DATA'),
(51, 38, 'SAVE_DATA'),
(47, 39, 'REFRESH_DATA'),
(48, 39, 'SAVE_DATA'),
(49, 39, 'EDIT_DATA'),
(50, 39, 'ADD_DATA'),
(54, 38, 'Edit_DATA'),
(55, 38, 'Add_DATA'),
(56, 45, 'REMOVE_DATA'),
(57, 45, 'Refresh_data'),
(58, 45, 'Edit_data'),
(59, 45, 'Add_data'),
(64, 46, 'EDIT_DATA'),
(63, 46, 'REMOVE_DATA'),
(65, 46, 'ADD_DATA');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu_event_group`
--

DROP TABLE IF EXISTS `role_menu_event_group`;
CREATE TABLE IF NOT EXISTS `role_menu_event_group` (
  `role_menu_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_menu_event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=522 ;

--
-- Dumping data for table `role_menu_event_group`
--

INSERT INTO `role_menu_event_group` (`role_menu_event_id`, `role_id`, `group_id`, `is_active`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 11, 1, 1),
(12, 12, 1, 1),
(13, 13, 1, 1),
(14, 14, 1, 1),
(15, 15, 1, 1),
(20, 20, 1, 1),
(21, 21, 1, 1),
(22, 22, 1, 1),
(23, 1, 8, 0),
(24, 1, 9, 0),
(25, 1, 10, 0),
(26, 1, 11, 0),
(27, 1, 12, 0),
(28, 2, 8, 0),
(29, 2, 9, 0),
(30, 2, 10, 0),
(31, 2, 11, 0),
(32, 2, 12, 0),
(33, 3, 8, 0),
(34, 3, 9, 0),
(35, 3, 10, 0),
(36, 3, 11, 0),
(37, 3, 12, 0),
(38, 8, 8, 0),
(39, 8, 9, 0),
(40, 8, 10, 0),
(41, 8, 11, 0),
(42, 8, 12, 0),
(43, 9, 8, 0),
(44, 9, 9, 0),
(45, 9, 10, 0),
(46, 9, 11, 0),
(47, 9, 12, 0),
(48, 10, 8, 0),
(49, 10, 9, 0),
(50, 10, 10, 0),
(51, 10, 11, 0),
(52, 10, 12, 0),
(53, 11, 8, 0),
(54, 11, 9, 0),
(55, 11, 10, 0),
(56, 11, 11, 0),
(57, 11, 12, 0),
(58, 12, 8, 0),
(59, 12, 9, 0),
(60, 12, 10, 0),
(61, 12, 11, 0),
(62, 12, 12, 0),
(63, 13, 8, 0),
(64, 13, 9, 0),
(65, 13, 10, 0),
(66, 13, 11, 0),
(67, 13, 12, 0),
(68, 14, 8, 0),
(69, 14, 9, 0),
(70, 14, 10, 0),
(71, 14, 11, 0),
(72, 14, 12, 0),
(73, 15, 8, 0),
(74, 15, 9, 0),
(75, 15, 10, 0),
(76, 15, 11, 0),
(77, 15, 12, 0),
(78, 20, 8, 0),
(79, 20, 9, 0),
(80, 20, 10, 0),
(81, 20, 11, 0),
(82, 20, 12, 0),
(83, 21, 8, 0),
(84, 21, 9, 0),
(85, 21, 10, 0),
(86, 21, 11, 0),
(87, 21, 12, 0),
(88, 22, 8, 0),
(89, 22, 9, 0),
(90, 22, 10, 0),
(91, 22, 11, 0),
(92, 22, 12, 0),
(93, 23, 1, 1),
(94, 24, 1, 1),
(95, 25, 1, 1),
(96, 23, 8, 0),
(97, 24, 8, 0),
(98, 25, 8, 0),
(99, 23, 9, 0),
(100, 24, 9, 0),
(101, 25, 9, 0),
(102, 23, 10, 0),
(103, 24, 10, 0),
(104, 25, 10, 0),
(105, 23, 11, 0),
(106, 24, 11, 0),
(107, 25, 11, 0),
(108, 23, 12, 0),
(109, 24, 12, 0),
(110, 25, 12, 0),
(111, 26, 1, 1),
(112, 26, 8, 0),
(113, 26, 9, 0),
(114, 26, 10, 0),
(115, 26, 11, 0),
(116, 26, 12, 0),
(117, 27, 1, 1),
(118, 28, 1, 1),
(119, 29, 1, 1),
(120, 27, 8, 0),
(121, 28, 8, 0),
(122, 29, 8, 0),
(123, 27, 9, 0),
(124, 28, 9, 0),
(125, 29, 9, 0),
(126, 27, 10, 0),
(127, 28, 10, 0),
(128, 29, 10, 0),
(129, 27, 11, 0),
(130, 28, 11, 0),
(131, 29, 11, 0),
(132, 27, 12, 0),
(133, 28, 12, 0),
(134, 29, 12, 0),
(135, 30, 1, 1),
(136, 30, 8, 0),
(137, 30, 9, 0),
(138, 30, 10, 0),
(139, 30, 11, 0),
(140, 30, 12, 0),
(141, 1, 13, 0),
(142, 1, 14, 0),
(143, 1, 15, 0),
(144, 2, 13, 0),
(145, 2, 14, 0),
(146, 2, 15, 0),
(147, 3, 13, 0),
(148, 3, 14, 0),
(149, 3, 15, 0),
(150, 8, 13, 0),
(151, 8, 14, 0),
(152, 8, 15, 0),
(153, 9, 13, 0),
(154, 9, 14, 0),
(155, 9, 15, 0),
(156, 10, 13, 0),
(157, 10, 14, 0),
(158, 10, 15, 0),
(159, 11, 13, 0),
(160, 11, 14, 0),
(161, 11, 15, 0),
(162, 12, 13, 0),
(163, 12, 14, 0),
(164, 12, 15, 0),
(165, 13, 13, 0),
(166, 13, 14, 0),
(167, 13, 15, 0),
(168, 14, 13, 0),
(169, 14, 14, 0),
(170, 14, 15, 0),
(171, 15, 13, 0),
(172, 15, 14, 0),
(173, 15, 15, 0),
(174, 20, 13, 0),
(175, 20, 14, 0),
(176, 20, 15, 0),
(177, 21, 13, 0),
(178, 21, 14, 0),
(179, 21, 15, 0),
(180, 22, 13, 0),
(181, 22, 14, 0),
(182, 22, 15, 0),
(183, 23, 13, 0),
(184, 23, 14, 0),
(185, 23, 15, 0),
(186, 24, 13, 0),
(187, 24, 14, 0),
(188, 24, 15, 0),
(189, 25, 13, 0),
(190, 25, 14, 0),
(191, 25, 15, 0),
(192, 26, 13, 0),
(193, 26, 14, 0),
(194, 26, 15, 0),
(195, 27, 13, 0),
(196, 27, 14, 0),
(197, 27, 15, 0),
(198, 28, 13, 0),
(199, 28, 14, 0),
(200, 28, 15, 0),
(201, 29, 13, 0),
(202, 29, 14, 0),
(203, 29, 15, 0),
(204, 30, 13, 0),
(205, 30, 14, 0),
(206, 30, 15, 0),
(422, 51, 14, 0),
(421, 55, 13, 0),
(420, 54, 13, 0),
(395, 54, 8, 0),
(413, 52, 12, 0),
(412, 51, 12, 0),
(394, 53, 8, 0),
(411, 55, 11, 0),
(393, 52, 8, 0),
(404, 53, 10, 0),
(403, 52, 10, 0),
(402, 51, 10, 0),
(419, 53, 13, 0),
(392, 51, 8, 0),
(418, 52, 13, 0),
(417, 51, 13, 0),
(410, 54, 11, 0),
(409, 53, 11, 0),
(408, 52, 11, 0),
(391, 55, 1, 1),
(401, 55, 9, 0),
(400, 54, 9, 0),
(390, 54, 1, 1),
(399, 53, 9, 0),
(389, 53, 1, 1),
(416, 55, 12, 0),
(415, 54, 12, 0),
(414, 53, 12, 0),
(407, 51, 11, 0),
(388, 52, 1, 1),
(406, 55, 10, 0),
(405, 54, 10, 0),
(398, 52, 9, 0),
(397, 51, 9, 0),
(396, 55, 8, 0),
(387, 51, 1, 1),
(359, 47, 9, 0),
(368, 48, 11, 0),
(377, 49, 13, 0),
(386, 50, 15, 0),
(358, 50, 8, 0),
(367, 47, 11, 0),
(376, 48, 13, 0),
(385, 49, 15, 0),
(357, 49, 8, 0),
(366, 50, 10, 0),
(375, 47, 13, 0),
(384, 48, 15, 0),
(356, 48, 8, 0),
(365, 49, 10, 0),
(374, 50, 12, 0),
(383, 47, 15, 0),
(355, 47, 8, 0),
(364, 48, 10, 0),
(373, 49, 12, 0),
(382, 50, 14, 0),
(354, 50, 1, 1),
(363, 47, 10, 0),
(372, 48, 12, 0),
(381, 49, 14, 0),
(353, 49, 1, 1),
(362, 50, 9, 0),
(371, 47, 12, 0),
(380, 48, 14, 0),
(352, 48, 1, 1),
(361, 49, 9, 0),
(370, 50, 11, 0),
(379, 47, 14, 0),
(351, 47, 1, 1),
(360, 48, 9, 0),
(369, 49, 11, 0),
(378, 50, 13, 0),
(423, 52, 14, 0),
(424, 53, 14, 0),
(425, 54, 14, 0),
(426, 55, 14, 0),
(427, 51, 15, 0),
(428, 52, 15, 0),
(429, 53, 15, 0),
(430, 54, 15, 0),
(431, 55, 15, 0),
(432, 56, 1, 1),
(433, 57, 1, 1),
(434, 58, 1, 1),
(435, 59, 1, 1),
(436, 56, 8, 0),
(437, 57, 8, 0),
(438, 58, 8, 0),
(439, 59, 8, 0),
(440, 56, 9, 0),
(441, 57, 9, 0),
(442, 58, 9, 0),
(443, 59, 9, 0),
(444, 56, 10, 0),
(445, 57, 10, 0),
(446, 58, 10, 0),
(447, 59, 10, 0),
(448, 56, 11, 0),
(449, 57, 11, 0),
(450, 58, 11, 0),
(451, 59, 11, 0),
(452, 56, 12, 0),
(453, 57, 12, 0),
(454, 58, 12, 0),
(455, 59, 12, 0),
(456, 56, 13, 0),
(457, 57, 13, 0),
(458, 58, 13, 0),
(459, 59, 13, 0),
(460, 56, 14, 0),
(461, 57, 14, 0),
(462, 58, 14, 0),
(463, 59, 14, 0),
(464, 56, 15, 0),
(465, 57, 15, 0),
(466, 58, 15, 0),
(467, 59, 15, 0),
(512, 65, 12, 0),
(503, 65, 9, 0),
(521, 65, 15, 0),
(511, 64, 12, 0),
(502, 64, 9, 0),
(520, 64, 15, 0),
(510, 63, 12, 0),
(501, 63, 9, 0),
(519, 63, 15, 0),
(509, 65, 11, 0),
(500, 65, 8, 0),
(518, 65, 14, 0),
(508, 64, 11, 0),
(499, 64, 8, 0),
(517, 64, 14, 0),
(507, 63, 11, 0),
(498, 63, 8, 0),
(516, 63, 14, 0),
(506, 65, 10, 0),
(497, 65, 1, 0),
(515, 65, 13, 0),
(505, 64, 10, 0),
(496, 64, 1, 0),
(514, 64, 13, 0),
(504, 63, 10, 0),
(495, 63, 1, 1),
(513, 63, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_menu_group`
--

DROP TABLE IF EXISTS `role_menu_group`;
CREATE TABLE IF NOT EXISTS `role_menu_group` (
  `role_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=301 ;

--
-- Dumping data for table `role_menu_group`
--

INSERT INTO `role_menu_group` (`role_menu_id`, `menu_id`, `group_id`, `is_active`) VALUES
(6, 6, 1, 1),
(7, 7, 1, 1),
(180, 35, 12, 0),
(150, 30, 12, 0),
(17, 6, 8, 0),
(18, 6, 9, 0),
(19, 6, 10, 0),
(20, 6, 11, 0),
(21, 6, 12, 0),
(22, 7, 8, 0),
(23, 7, 9, 0),
(24, 7, 10, 0),
(25, 7, 11, 0),
(26, 7, 12, 0),
(179, 35, 11, 0),
(178, 35, 10, 0),
(177, 35, 9, 0),
(176, 35, 8, 0),
(175, 35, 1, 1),
(149, 30, 11, 0),
(148, 30, 10, 0),
(147, 30, 9, 0),
(146, 30, 8, 0),
(145, 30, 1, 1),
(198, 38, 12, 0),
(197, 38, 11, 0),
(196, 38, 10, 0),
(195, 38, 9, 0),
(194, 38, 8, 0),
(193, 38, 1, 1),
(144, 29, 12, 0),
(143, 29, 11, 0),
(142, 29, 10, 0),
(141, 29, 9, 0),
(140, 29, 8, 0),
(139, 29, 1, 1),
(138, 28, 12, 0),
(137, 28, 11, 0),
(136, 28, 10, 0),
(135, 28, 9, 0),
(134, 28, 8, 0),
(133, 28, 1, 1),
(211, 41, 1, 1),
(212, 41, 8, 0),
(213, 41, 9, 0),
(214, 41, 10, 0),
(215, 41, 11, 0),
(216, 41, 12, 0),
(217, 6, 13, 0),
(218, 6, 14, 0),
(219, 6, 15, 0),
(220, 7, 13, 0),
(221, 7, 14, 0),
(222, 7, 15, 0),
(226, 28, 13, 0),
(227, 28, 14, 0),
(228, 28, 15, 0),
(229, 29, 13, 0),
(230, 29, 14, 0),
(231, 29, 15, 0),
(232, 30, 13, 0),
(233, 30, 14, 0),
(234, 30, 15, 0),
(235, 35, 13, 0),
(236, 35, 14, 0),
(237, 35, 15, 0),
(244, 38, 13, 0),
(245, 38, 14, 0),
(246, 38, 15, 0),
(253, 41, 13, 0),
(254, 41, 14, 0),
(255, 41, 15, 0),
(256, 42, 1, 1),
(257, 42, 8, 0),
(258, 42, 9, 0),
(259, 42, 10, 0),
(260, 42, 11, 0),
(261, 42, 12, 0),
(262, 42, 13, 0),
(263, 42, 14, 0),
(264, 42, 15, 0),
(265, 43, 1, 1),
(266, 43, 8, 0),
(267, 43, 9, 0),
(268, 43, 10, 0),
(269, 43, 11, 0),
(270, 43, 12, 0),
(271, 43, 13, 0),
(272, 43, 14, 0),
(273, 43, 15, 0),
(274, 44, 1, 1),
(275, 44, 8, 0),
(276, 44, 9, 0),
(277, 44, 10, 0),
(278, 44, 11, 0),
(279, 44, 12, 0),
(280, 44, 13, 0),
(281, 44, 14, 0),
(282, 44, 15, 0),
(283, 45, 1, 1),
(284, 45, 8, 0),
(285, 45, 9, 0),
(286, 45, 10, 0),
(287, 45, 11, 0),
(288, 45, 12, 0),
(289, 45, 13, 0),
(290, 45, 14, 0),
(291, 45, 15, 0),
(292, 46, 1, 1),
(293, 46, 8, 0),
(294, 46, 9, 0),
(295, 46, 10, 0),
(296, 46, 11, 0),
(297, 46, 12, 0),
(298, 46, 13, 0),
(299, 46, 14, 0),
(300, 46, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sistem`
--

DROP TABLE IF EXISTS `sistem`;
CREATE TABLE IF NOT EXISTS `sistem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sistem` varchar(50) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`,`sistem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sistem`
--

INSERT INTO `sistem` (`id`, `sistem`, `keterangan`) VALUES
(1, 'OB-VAN', ''),
(2, 'SNG', ''),
(3, 'MPU', ''),
(4, 'SNG II', ''),
(5, 'Logistik Inventory 64', '--------'),
(6, 'Logistik Inventory Sency', ''),
(7, 'Rental', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(128) DEFAULT NULL,
  `group_description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_name` (`group_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`group_id`, `group_name`, `group_description`) VALUES
(1, 'Administrator', 'Super Administrator'),
(8, 'PJT', ''),
(9, 'Assisten Manager', ''),
(10, 'Staff tehnik', ''),
(11, 'Manager', ''),
(12, 'Logistic', ''),
(13, 'Viewer', ''),
(14, 'Koordinator+PJT', ''),
(15, 'Driver Tehnik', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nik` varchar(6) DEFAULT NULL,
  `dept` enum('Broadcast Support','Produksi','News') DEFAULT NULL,
  `jabatan` enum('Manager','Asisten Manager','Kepala Unit','Kepala Seksi','Staff') DEFAULT 'Staff',
  `bagian` enum('Video','Audio','ME','Mikrolink','Logistik','Maintenance') DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `hp2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `real_name` varchar(128) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `count_login` int(11) DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `user_password` varchar(128) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `group_id`, `real_name`, `last_login`, `count_login`, `date_created`, `user_password`, `is_active`) VALUES
(1, 'admin', 1, 'Administrator System', '2012-01-28 20:23:33', 123, '2010-02-28 15:03:33', 'YWRtaW4=', 1),
(2, 'dfgdfg', 12, 'vvv', '2012-01-13 12:55:07', 0, '2010-02-28 15:03:33', 'YWRtaW4=', 1),
(26, 'ddd', 9, 'sasa', '1998-11-30 00:00:00', 0, '2012-01-13 14:24:23', 'YXNhcw==', 1),
(27, 'sd', 10, 'asdas', '0000-11-30 00:00:00', 0, '2012-01-13 14:25:09', 'YXNkYXNk', 1),
(28, 'Andi', 1, 'Andi k', '2012-01-28 17:55:05', 1, '2012-01-28 17:54:10', 'QW5kaQ==', 1);
