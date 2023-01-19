-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for application_task
CREATE DATABASE IF NOT EXISTS `application_task` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `application_task`;

-- Dumping structure for table application_task.ent_application
CREATE TABLE IF NOT EXISTS `ent_application` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL COMMENT 'M/F',
  `title` varchar(80) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '1 - open, 2- closed, 3 - cancelled',
  `date_added` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_ent_application_ent_user` (`user_id`),
  CONSTRAINT `FK_ent_application_ent_user` FOREIGN KEY (`user_id`) REFERENCES `ent_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table application_task.ent_application: ~0 rows (approximately)
/*!40000 ALTER TABLE `ent_application` DISABLE KEYS */;
INSERT INTO `ent_application` (`id`, `user_id`, `first_name`, `last_name`, `dob`, `gender`, `title`, `status`, `date_added`) VALUES
	(1, 1, 'Ivan', 'Ivanov', '1997-02-25', 'M', 'Application 1', 1, '2023-01-19 00:26:21'),
	(2, 1, 'Slavena', 'Georgieva', '2023-01-20', 'F', 'App Test', 2, '2023-01-19 22:49:19'),
	(3, 1, 'John', 'Smith', '2023-01-07', 'M', 'App 3', 3, '2023-01-19 22:51:35'),
	(4, 1, 'Eugene', 'Eugenov', '2023-01-20', 'M', 'test', 1, '2023-01-19 22:58:45'),
	(5, 1, 'Emily', 'Lawrence', '2022-09-01', 'M', 'Fifth Application', 1, '2023-01-20 00:25:07'),
	(6, 1, 'Test', 'Test', '2023-01-12', 'F', 'App Title 6', 1, '2023-01-20 00:26:01');
/*!40000 ALTER TABLE `ent_application` ENABLE KEYS */;

-- Dumping structure for table application_task.ent_application_service
CREATE TABLE IF NOT EXISTS `ent_application_service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `service_id` int(11) unsigned NOT NULL DEFAULT 0,
  `date_ordered` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_ent_application_service_ent_service` (`service_id`),
  KEY `FK_ent_application_service_ent_application` (`application_id`),
  CONSTRAINT `FK_ent_application_service_ent_application` FOREIGN KEY (`application_id`) REFERENCES `ent_application` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ent_application_service_ent_service` FOREIGN KEY (`service_id`) REFERENCES `ent_service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table application_task.ent_application_service: ~0 rows (approximately)
/*!40000 ALTER TABLE `ent_application_service` DISABLE KEYS */;
INSERT INTO `ent_application_service` (`id`, `application_id`, `service_id`, `date_ordered`) VALUES
	(42, 1, 1, '2023-01-19 22:14:00'),
	(46, 4, 1, '2023-01-19 22:59:10'),
	(47, 4, 4, '2017-01-07 00:23:43'),
	(48, 4, 2, '2023-01-20 00:23:43'),
	(49, 5, 5, '2014-01-20 00:25:07'),
	(50, 5, 4, '2023-01-20 00:25:07'),
	(51, 5, 1, '2023-01-20 00:25:07'),
	(52, 6, 5, '2023-01-20 00:26:01'),
	(53, 6, 4, '2023-01-20 00:26:01'),
	(54, 6, 3, '2023-01-20 00:26:01'),
	(55, 6, 2, '2023-01-20 00:26:01'),
	(56, 6, 1, '2023-01-20 00:26:01');
/*!40000 ALTER TABLE `ent_application_service` ENABLE KEYS */;

-- Dumping structure for table application_task.ent_service
CREATE TABLE IF NOT EXISTS `ent_service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` tinyint(4) unsigned NOT NULL DEFAULT 0,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL COMMENT '0 - No, 1 - Yes',
  `date_added` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ent_service_ent_user` (`user_id`),
  KEY `FK_ent_service_par_country` (`country_id`),
  CONSTRAINT `FK_ent_service_ent_user` FOREIGN KEY (`user_id`) REFERENCES `ent_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ent_service_par_country` FOREIGN KEY (`country_id`) REFERENCES `par_country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table application_task.ent_service: ~5 rows (approximately)
/*!40000 ALTER TABLE `ent_service` DISABLE KEYS */;
INSERT INTO `ent_service` (`id`, `country_id`, `user_id`, `name`, `description`, `available`, `date_added`, `date_updated`) VALUES
	(1, 12, 1, 'AML Check', 'Anti Money Laundering check', 1, '2023-01-18 23:52:43', NULL),
	(2, 35, 1, 'Credit Risk Check', 'Credit Risk Check', 1, '2023-01-19 00:25:22', NULL),
	(3, 3, 1, 'Education Check', 'Education Check', 1, '2023-01-19 00:27:03', NULL),
	(4, 3, 1, 'Employment Check', 'Employment Check', 1, '2023-01-19 00:27:16', NULL),
	(5, 237, 1, 'Custom Check', 'Custom Check Description', 1, '2023-01-19 00:27:33', NULL);
/*!40000 ALTER TABLE `ent_service` ENABLE KEYS */;

-- Dumping structure for table application_task.ent_user
CREATE TABLE IF NOT EXISTS `ent_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table application_task.ent_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `ent_user` DISABLE KEYS */;
INSERT INTO `ent_user` (`id`, `email`, `password`, `first_name`, `last_name`, `date_added`) VALUES
	(1, 'stoyan.rachev.4@gmail.com', '06678fe45dcd567cf5fa19d3ec526b68', 'Stoyan', 'Rachev', '2023-01-18 23:52:15');
/*!40000 ALTER TABLE `ent_user` ENABLE KEYS */;

-- Dumping structure for table application_task.par_country
CREATE TABLE IF NOT EXISTS `par_country` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `iso2` varchar(2) DEFAULT '0',
  `name` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso2` (`iso2`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table application_task.par_country: ~252 rows (approximately)
/*!40000 ALTER TABLE `par_country` DISABLE KEYS */;
INSERT INTO `par_country` (`id`, `iso2`, `name`) VALUES
	(1, 'AF', 'Afghanistan'),
	(2, 'AX', 'Aland Islands'),
	(3, 'AL', 'Albania'),
	(4, 'DZ', 'Algeria'),
	(5, 'AS', 'American Samoa'),
	(6, 'AD', 'Andorra'),
	(7, 'AO', 'Angola'),
	(8, 'AI', 'Anguilla'),
	(9, 'AQ', 'Antarctica'),
	(10, 'AG', 'Antigua and Barbuda'),
	(11, 'AR', 'Argentina'),
	(12, 'AM', 'Armenia'),
	(13, 'AW', 'Aruba'),
	(14, 'AU', 'Australia'),
	(15, 'AT', 'Austria'),
	(16, 'AZ', 'Azerbaijan'),
	(17, 'BS', 'Bahamas'),
	(18, 'BH', 'Bahrain'),
	(19, 'BD', 'Bangladesh'),
	(20, 'BB', 'Barbados'),
	(21, 'BY', 'Belarus'),
	(22, 'BE', 'Belgium'),
	(23, 'BZ', 'Belize'),
	(24, 'BJ', 'Benin'),
	(25, 'BM', 'Bermuda'),
	(26, 'BT', 'Bhutan'),
	(27, 'BO', 'Bolivia'),
	(28, 'BQ', 'Bonaire, Sint Eustatius and Saba'),
	(29, 'BA', 'Bosnia and Herzegovina'),
	(30, 'BW', 'Botswana'),
	(31, 'BV', 'Bouvet Island'),
	(32, 'BR', 'Brazil'),
	(33, 'IO', 'British Indian Ocean Territory'),
	(34, 'BN', 'Brunei Darussalam'),
	(35, 'BG', 'Bulgaria'),
	(36, 'BF', 'Burkina Faso'),
	(37, 'BI', 'Burundi'),
	(38, 'KH', 'Cambodia'),
	(39, 'CM', 'Cameroon'),
	(40, 'CA', 'Canada'),
	(41, 'CV', 'Cape Verde'),
	(42, 'KY', 'Cayman Islands'),
	(43, 'CF', 'Central African Republic'),
	(44, 'TD', 'Chad'),
	(45, 'CL', 'Chile'),
	(46, 'CN', 'China'),
	(47, 'CX', 'Christmas Island'),
	(48, 'CC', 'Cocos (Keeling) Islands'),
	(49, 'CO', 'Colombia'),
	(50, 'KM', 'Comoros'),
	(51, 'CG', 'Congo'),
	(52, 'CD', 'Congo, Democratic Republic of the Congo'),
	(53, 'CK', 'Cook Islands'),
	(54, 'CR', 'Costa Rica'),
	(55, 'CI', 'Cote D\'Ivoire'),
	(56, 'HR', 'Croatia'),
	(57, 'CU', 'Cuba'),
	(58, 'CW', 'Curacao'),
	(59, 'CY', 'Cyprus'),
	(60, 'CZ', 'Czech Republic'),
	(61, 'DK', 'Denmark'),
	(62, 'DJ', 'Djibouti'),
	(63, 'DM', 'Dominica'),
	(64, 'DO', 'Dominican Republic'),
	(65, 'EC', 'Ecuador'),
	(66, 'EG', 'Egypt'),
	(67, 'SV', 'El Salvador'),
	(68, 'GQ', 'Equatorial Guinea'),
	(69, 'ER', 'Eritrea'),
	(70, 'EE', 'Estonia'),
	(71, 'ET', 'Ethiopia'),
	(72, 'FK', 'Falkland Islands (Malvinas)'),
	(73, 'FO', 'Faroe Islands'),
	(74, 'FJ', 'Fiji'),
	(75, 'FI', 'Finland'),
	(76, 'FR', 'France'),
	(77, 'GF', 'French Guiana'),
	(78, 'PF', 'French Polynesia'),
	(79, 'TF', 'French Southern Territories'),
	(80, 'GA', 'Gabon'),
	(81, 'GM', 'Gambia'),
	(82, 'GE', 'Georgia'),
	(83, 'DE', 'Germany'),
	(84, 'GH', 'Ghana'),
	(85, 'GI', 'Gibraltar'),
	(86, 'GR', 'Greece'),
	(87, 'GL', 'Greenland'),
	(88, 'GD', 'Grenada'),
	(89, 'GP', 'Guadeloupe'),
	(90, 'GU', 'Guam'),
	(91, 'GT', 'Guatemala'),
	(92, 'GG', 'Guernsey'),
	(93, 'GN', 'Guinea'),
	(94, 'GW', 'Guinea-Bissau'),
	(95, 'GY', 'Guyana'),
	(96, 'HT', 'Haiti'),
	(97, 'HM', 'Heard Island and Mcdonald Islands'),
	(98, 'VA', 'Holy See (Vatican City State)'),
	(99, 'HN', 'Honduras'),
	(100, 'HK', 'Hong Kong'),
	(101, 'HU', 'Hungary'),
	(102, 'IS', 'Iceland'),
	(103, 'IN', 'India'),
	(104, 'ID', 'Indonesia'),
	(105, 'IR', 'Iran, Islamic Republic of'),
	(106, 'IQ', 'Iraq'),
	(107, 'IE', 'Ireland'),
	(108, 'IM', 'Isle of Man'),
	(109, 'IL', 'Israel'),
	(110, 'IT', 'Italy'),
	(111, 'JM', 'Jamaica'),
	(112, 'JP', 'Japan'),
	(113, 'JE', 'Jersey'),
	(114, 'JO', 'Jordan'),
	(115, 'KZ', 'Kazakhstan'),
	(116, 'KE', 'Kenya'),
	(117, 'KI', 'Kiribati'),
	(118, 'KP', 'Korea, Democratic People\'s Republic of'),
	(119, 'KR', 'Korea, Republic of'),
	(120, 'XK', 'Kosovo'),
	(121, 'KW', 'Kuwait'),
	(122, 'KG', 'Kyrgyzstan'),
	(123, 'LA', 'Lao People\'s Democratic Republic'),
	(124, 'LV', 'Latvia'),
	(125, 'LB', 'Lebanon'),
	(126, 'LS', 'Lesotho'),
	(127, 'LR', 'Liberia'),
	(128, 'LY', 'Libyan Arab Jamahiriya'),
	(129, 'LI', 'Liechtenstein'),
	(130, 'LT', 'Lithuania'),
	(131, 'LU', 'Luxembourg'),
	(132, 'MO', 'Macao'),
	(133, 'MK', 'Macedonia, the Former Yugoslav Republic of'),
	(134, 'MG', 'Madagascar'),
	(135, 'MW', 'Malawi'),
	(136, 'MY', 'Malaysia'),
	(137, 'MV', 'Maldives'),
	(138, 'ML', 'Mali'),
	(139, 'MT', 'Malta'),
	(140, 'MH', 'Marshall Islands'),
	(141, 'MQ', 'Martinique'),
	(142, 'MR', 'Mauritania'),
	(143, 'MU', 'Mauritius'),
	(144, 'YT', 'Mayotte'),
	(145, 'MX', 'Mexico'),
	(146, 'FM', 'Micronesia, Federated States of'),
	(147, 'MD', 'Moldova, Republic of'),
	(148, 'MC', 'Monaco'),
	(149, 'MN', 'Mongolia'),
	(150, 'ME', 'Montenegro'),
	(151, 'MS', 'Montserrat'),
	(152, 'MA', 'Morocco'),
	(153, 'MZ', 'Mozambique'),
	(154, 'MM', 'Myanmar'),
	(155, 'NA', 'Namibia'),
	(156, 'NR', 'Nauru'),
	(157, 'NP', 'Nepal'),
	(158, 'NL', 'Netherlands'),
	(159, 'AN', 'Netherlands Antilles'),
	(160, 'NC', 'New Caledonia'),
	(161, 'NZ', 'New Zealand'),
	(162, 'NI', 'Nicaragua'),
	(163, 'NE', 'Niger'),
	(164, 'NG', 'Nigeria'),
	(165, 'NU', 'Niue'),
	(166, 'NF', 'Norfolk Island'),
	(167, 'MP', 'Northern Mariana Islands'),
	(168, 'NO', 'Norway'),
	(169, 'OM', 'Oman'),
	(170, 'PK', 'Pakistan'),
	(171, 'PW', 'Palau'),
	(172, 'PS', 'Palestinian Territory, Occupied'),
	(173, 'PA', 'Panama'),
	(174, 'PG', 'Papua New Guinea'),
	(175, 'PY', 'Paraguay'),
	(176, 'PE', 'Peru'),
	(177, 'PH', 'Philippines'),
	(178, 'PN', 'Pitcairn'),
	(179, 'PL', 'Poland'),
	(180, 'PT', 'Portugal'),
	(181, 'PR', 'Puerto Rico'),
	(182, 'QA', 'Qatar'),
	(183, 'RE', 'Reunion'),
	(184, 'RO', 'Romania'),
	(185, 'RU', 'Russian Federation'),
	(186, 'RW', 'Rwanda'),
	(187, 'BL', 'Saint Barthelemy'),
	(188, 'SH', 'Saint Helena'),
	(189, 'KN', 'Saint Kitts and Nevis'),
	(190, 'LC', 'Saint Lucia'),
	(191, 'MF', 'Saint Martin'),
	(192, 'PM', 'Saint Pierre and Miquelon'),
	(193, 'VC', 'Saint Vincent and the Grenadines'),
	(194, 'WS', 'Samoa'),
	(195, 'SM', 'San Marino'),
	(196, 'ST', 'Sao Tome and Principe'),
	(197, 'SA', 'Saudi Arabia'),
	(198, 'SN', 'Senegal'),
	(199, 'RS', 'Serbia'),
	(200, 'CS', 'Serbia and Montenegro'),
	(201, 'SC', 'Seychelles'),
	(202, 'SL', 'Sierra Leone'),
	(203, 'SG', 'Singapore'),
	(204, 'SX', 'Sint Maarten'),
	(205, 'SK', 'Slovakia'),
	(206, 'SI', 'Slovenia'),
	(207, 'SB', 'Solomon Islands'),
	(208, 'SO', 'Somalia'),
	(209, 'ZA', 'South Africa'),
	(210, 'GS', 'South Georgia and the South Sandwich Islands'),
	(211, 'SS', 'South Sudan'),
	(212, 'ES', 'Spain'),
	(213, 'LK', 'Sri Lanka'),
	(214, 'SD', 'Sudan'),
	(215, 'SR', 'Suriname'),
	(216, 'SJ', 'Svalbard and Jan Mayen'),
	(217, 'SZ', 'Swaziland'),
	(218, 'SE', 'Sweden'),
	(219, 'CH', 'Switzerland'),
	(220, 'SY', 'Syrian Arab Republic'),
	(221, 'TW', 'Taiwan, Province of China'),
	(222, 'TJ', 'Tajikistan'),
	(223, 'TZ', 'Tanzania, United Republic of'),
	(224, 'TH', 'Thailand'),
	(225, 'TL', 'Timor-Leste'),
	(226, 'TG', 'Togo'),
	(227, 'TK', 'Tokelau'),
	(228, 'TO', 'Tonga'),
	(229, 'TT', 'Trinidad and Tobago'),
	(230, 'TN', 'Tunisia'),
	(231, 'TR', 'Turkey'),
	(232, 'TM', 'Turkmenistan'),
	(233, 'TC', 'Turks and Caicos Islands'),
	(234, 'TV', 'Tuvalu'),
	(235, 'UG', 'Uganda'),
	(236, 'UA', 'Ukraine'),
	(237, 'AE', 'United Arab Emirates'),
	(238, 'GB', 'United Kingdom'),
	(239, 'US', 'United States'),
	(240, 'UM', 'United States Minor Outlying Islands'),
	(241, 'UY', 'Uruguay'),
	(242, 'UZ', 'Uzbekistan'),
	(243, 'VU', 'Vanuatu'),
	(244, 'VE', 'Venezuela'),
	(245, 'VN', 'Viet Nam'),
	(246, 'VG', 'Virgin Islands, British'),
	(247, 'VI', 'Virgin Islands, U.s.'),
	(248, 'WF', 'Wallis and Futuna'),
	(249, 'EH', 'Western Sahara'),
	(250, 'YE', 'Yemen'),
	(251, 'ZM', 'Zambia'),
	(252, 'ZW', 'Zimbabwe');
/*!40000 ALTER TABLE `par_country` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
