/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `admins` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id_admin`, `nome`, `login`, `email`, `password`) VALUES
	(1, 'Yago ML', 'yagoml', 'yagoskor@gmail.com', '3fcfc1f7f34e78a937e81171ba51dc39538db993');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `bilhetes` (
  `id_bilhete` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `sorteios_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id_bilhete`),
  KEY `fk_sorteios_has_jogadores_jogadores1_idx` (`usuarios_id`),
  KEY `fk_sorteios_has_jogadores_sorteios_idx` (`sorteios_id`),
  CONSTRAINT `fk_sorteios_has_jogadores_jogadores1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sorteios_has_jogadores_sorteios` FOREIGN KEY (`sorteios_id`) REFERENCES `sorteios` (`id_sorteio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=530 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `bilhetes` DISABLE KEYS */;
INSERT INTO `bilhetes` (`id_bilhete`, `numero`, `sorteios_id`, `usuarios_id`) VALUES
	(1, 7819, 47, 11),
	(2, 5747, 47, 11),
	(3, 9286, 47, 11),
	(4, 6206, 47, 11),
	(5, 2188, 47, 11),
	(6, 2336, 47, 11),
	(7, 2522, 47, 11),
	(8, 9711, 47, 11),
	(9, 6876, 47, 11),
	(10, 7626, 47, 11),
	(11, 8185, 47, 11),
	(12, 8840, 47, 11),
	(13, 2476, 47, 11),
	(14, 3335, 47, 11),
	(15, 4620, 47, 11),
	(16, 1061, 47, 11),
	(17, 1082, 47, 11),
	(18, 2684, 47, 11),
	(19, 1670, 47, 11),
	(20, 6342, 47, 11),
	(21, 1287, 46, 11),
	(22, 5390, 46, 11),
	(23, 4679, 46, 11),
	(24, 4152, 46, 11),
	(25, 6186, 46, 11),
	(26, 6672, 46, 11),
	(27, 5491, 46, 11),
	(28, 5461, 46, 11),
	(29, 5372, 46, 11),
	(30, 6249, 46, 11),
	(31, 2024, 45, 11),
	(32, 7777, 45, 11),
	(33, 8057, 45, 11),
	(34, 4170, 45, 11),
	(35, 1131, 45, 11),
	(36, 3232, 48, 11),
	(37, 8210, 48, 11),
	(38, 1128, 48, 11),
	(39, 7603, 48, 11),
	(40, 9497, 48, 11),
	(41, 7712, 48, 11),
	(42, 8194, 48, 11),
	(43, 8784, 48, 11),
	(44, 6042, 48, 11),
	(45, 9658, 48, 11),
	(46, 2585, 48, 11),
	(47, 5518, 48, 11),
	(48, 3835, 48, 11),
	(49, 3641, 48, 11),
	(50, 2022, 48, 11),
	(51, 2593, 45, 12),
	(52, 1404, 45, 12),
	(53, 8973, 45, 12),
	(54, 1889, 45, 12),
	(55, 9249, 45, 12),
	(56, 5288, 45, 12),
	(57, 5355, 45, 12),
	(58, 6362, 45, 12),
	(59, 2318, 45, 12),
	(60, 4091, 45, 12),
	(61, 6009, 45, 12),
	(62, 8426, 45, 12),
	(63, 2892, 45, 12),
	(64, 2034, 45, 12),
	(65, 2778, 45, 12),
	(66, 1051, 45, 12),
	(67, 9567, 45, 12),
	(68, 7833, 45, 12),
	(69, 1006, 45, 12),
	(70, 8705, 45, 12),
	(71, 7434, 47, 12),
	(72, 7709, 47, 12),
	(73, 1536, 47, 12),
	(74, 6357, 47, 12),
	(75, 4089, 47, 12),
	(76, 4337, 46, 12),
	(77, 9319, 46, 12),
	(78, 5409, 46, 12),
	(79, 7167, 46, 12),
	(80, 6283, 46, 12),
	(81, 3710, 46, 12),
	(82, 2143, 46, 12),
	(83, 4960, 46, 12),
	(84, 9266, 46, 12),
	(85, 3147, 46, 12),
	(86, 8773, 46, 12),
	(87, 1469, 46, 12),
	(88, 7379, 46, 12),
	(89, 2847, 46, 12),
	(90, 8143, 46, 12),
	(91, 7482, 48, 12),
	(92, 9714, 48, 12),
	(93, 2505, 48, 12),
	(94, 6338, 48, 12),
	(95, 1601, 48, 12),
	(96, 8249, 48, 12),
	(97, 3189, 48, 12),
	(98, 5006, 48, 12),
	(99, 3156, 48, 12),
	(100, 7260, 48, 12),
	(101, 2939, 45, 13),
	(102, 6952, 45, 13),
	(103, 1605, 45, 13),
	(104, 2421, 45, 13),
	(105, 7473, 45, 13),
	(106, 2227, 45, 13),
	(107, 2368, 45, 13),
	(108, 5211, 45, 13),
	(109, 3833, 45, 13),
	(110, 6555, 45, 13),
	(111, 8880, 47, 13),
	(112, 4537, 47, 13),
	(113, 9738, 47, 13),
	(114, 7279, 47, 13),
	(115, 9608, 47, 13),
	(116, 3494, 47, 13),
	(117, 2407, 47, 13),
	(118, 5243, 47, 13),
	(119, 6522, 47, 13),
	(120, 9677, 47, 13),
	(121, 8558, 47, 13),
	(122, 5791, 47, 13),
	(123, 6090, 47, 13),
	(124, 8177, 47, 13),
	(125, 5411, 47, 13),
	(126, 1199, 46, 13),
	(127, 2781, 46, 13),
	(128, 9737, 46, 13),
	(129, 6707, 46, 13),
	(130, 9323, 46, 13),
	(131, 1088, 48, 13),
	(132, 1485, 48, 13),
	(133, 4666, 48, 13),
	(134, 5980, 48, 13),
	(135, 8909, 48, 13),
	(136, 4054, 48, 13),
	(137, 8576, 48, 13),
	(138, 9736, 48, 13),
	(139, 2650, 48, 13),
	(140, 1895, 48, 13),
	(141, 2310, 45, 15),
	(142, 8205, 45, 15),
	(143, 9871, 45, 15),
	(144, 1177, 45, 15),
	(145, 4665, 45, 15),
	(146, 8894, 45, 15),
	(147, 6767, 45, 15),
	(148, 5443, 45, 15),
	(149, 8970, 45, 15),
	(150, 6260, 45, 15),
	(151, 1536, 45, 15),
	(152, 2872, 45, 15),
	(153, 5946, 45, 15),
	(154, 5648, 45, 15),
	(155, 9648, 45, 15),
	(156, 5556, 47, 15),
	(157, 8810, 47, 15),
	(158, 7902, 47, 15),
	(159, 6069, 47, 15),
	(160, 3089, 47, 15),
	(161, 7743, 46, 15),
	(162, 8282, 46, 15),
	(163, 7907, 46, 15),
	(164, 2841, 46, 15),
	(165, 2371, 46, 15),
	(166, 8382, 46, 15),
	(167, 8117, 46, 15),
	(168, 3776, 46, 15),
	(169, 8092, 46, 15),
	(170, 2488, 46, 15),
	(171, 2965, 46, 15),
	(172, 5326, 46, 15),
	(173, 2514, 48, 15),
	(174, 2796, 48, 15),
	(175, 7024, 48, 15),
	(176, 8770, 45, 16),
	(177, 9326, 45, 16),
	(178, 6810, 45, 16),
	(179, 5162, 45, 16),
	(180, 8800, 45, 16),
	(181, 1872, 45, 16),
	(182, 9362, 45, 16),
	(183, 7156, 45, 16),
	(184, 1710, 45, 16),
	(185, 1432, 45, 16),
	(186, 2404, 47, 16),
	(187, 7586, 47, 16),
	(188, 4095, 47, 16),
	(189, 7723, 47, 16),
	(190, 9280, 47, 16),
	(191, 6163, 46, 16),
	(192, 5955, 46, 16),
	(193, 9649, 46, 16),
	(194, 2641, 46, 16),
	(195, 1952, 46, 16),
	(196, 6115, 48, 16),
	(197, 5979, 48, 16),
	(198, 3395, 48, 16),
	(199, 2197, 48, 16),
	(200, 4308, 48, 16),
	(201, 9801, 48, 16),
	(202, 6571, 48, 16),
	(203, 4710, 48, 16),
	(204, 4241, 48, 16),
	(205, 5309, 48, 16),
	(206, 5524, 49, 11),
	(207, 1178, 49, 11),
	(208, 3208, 49, 11),
	(209, 5465, 49, 11),
	(210, 1572, 49, 11),
	(211, 5247, 49, 11),
	(212, 6208, 49, 11),
	(213, 6817, 49, 11),
	(214, 1048, 49, 11),
	(215, 4938, 49, 12),
	(216, 9121, 49, 12),
	(217, 7589, 49, 12),
	(218, 9296, 49, 12),
	(219, 6721, 49, 12),
	(220, 6039, 49, 12),
	(221, 3000, 49, 12),
	(222, 9158, 49, 12),
	(223, 3565, 49, 12),
	(224, 4557, 49, 12),
	(225, 1769, 49, 12),
	(226, 5980, 49, 12),
	(227, 1937, 49, 12),
	(228, 7768, 49, 12),
	(229, 8113, 49, 12),
	(230, 9605, 49, 12),
	(231, 3808, 49, 12),
	(232, 5267, 49, 12),
	(233, 3753, 49, 12),
	(234, 7375, 49, 12),
	(235, 6646, 49, 13),
	(236, 9146, 49, 13),
	(237, 1906, 49, 13),
	(238, 9137, 49, 13),
	(239, 3420, 49, 13),
	(240, 9000, 49, 13),
	(241, 2292, 49, 13),
	(242, 2232, 49, 13),
	(243, 9597, 49, 13),
	(244, 7922, 49, 13),
	(245, 4712, 50, 16),
	(246, 8870, 50, 16),
	(247, 4022, 50, 16),
	(248, 5888, 50, 16),
	(249, 6614, 50, 16),
	(250, 2971, 50, 16),
	(251, 9641, 50, 16),
	(252, 4726, 50, 16),
	(253, 2100, 50, 16),
	(254, 8727, 50, 16),
	(255, 7579, 50, 16),
	(256, 3266, 50, 16),
	(257, 1013, 50, 16),
	(258, 1106, 50, 16),
	(259, 5429, 50, 16),
	(260, 1226, 50, 16),
	(261, 8698, 50, 16),
	(262, 4576, 50, 16),
	(263, 6285, 50, 16),
	(264, 2825, 50, 16),
	(265, 9994, 53, 16),
	(266, 7618, 53, 16),
	(267, 3299, 53, 16),
	(268, 3702, 53, 16),
	(269, 4228, 53, 16),
	(270, 5108, 53, 16),
	(271, 2480, 53, 16),
	(272, 5050, 53, 16),
	(273, 5475, 53, 16),
	(274, 2088, 53, 16),
	(275, 9097, 53, 16),
	(276, 6873, 53, 16),
	(277, 4454, 53, 16),
	(278, 3902, 53, 16),
	(279, 2619, 53, 16),
	(280, 3264, 53, 16),
	(281, 5384, 53, 16),
	(282, 2393, 53, 16),
	(283, 3013, 53, 16),
	(284, 1817, 53, 16),
	(285, 7998, 50, 15),
	(286, 3108, 50, 15),
	(287, 8740, 50, 15),
	(288, 7781, 50, 15),
	(289, 4257, 50, 15),
	(290, 3168, 50, 15),
	(291, 6889, 50, 15),
	(292, 2313, 50, 15),
	(293, 7319, 50, 15),
	(294, 6726, 50, 15),
	(295, 8325, 50, 15),
	(296, 4140, 50, 15),
	(297, 4528, 50, 15),
	(298, 2252, 50, 15),
	(299, 7142, 50, 15),
	(300, 9230, 53, 15),
	(301, 6286, 53, 15),
	(302, 1368, 53, 15),
	(303, 4569, 53, 15),
	(304, 6913, 53, 15),
	(305, 8544, 53, 15),
	(306, 5018, 53, 15),
	(307, 4814, 53, 15),
	(308, 2680, 53, 15),
	(309, 8956, 53, 15),
	(310, 5487, 53, 15),
	(311, 9260, 53, 15),
	(312, 6375, 53, 15),
	(313, 9491, 53, 15),
	(314, 1369, 53, 15),
	(315, 4932, 50, 13),
	(316, 4806, 50, 13),
	(317, 2736, 50, 13),
	(318, 5390, 50, 13),
	(319, 8165, 50, 13),
	(320, 2295, 50, 13),
	(321, 1918, 50, 13),
	(322, 6738, 50, 13),
	(323, 9412, 50, 13),
	(324, 8275, 50, 13),
	(325, 5377, 53, 13),
	(326, 3021, 53, 13),
	(327, 8732, 53, 13),
	(328, 7837, 53, 13),
	(329, 9692, 53, 13),
	(330, 5846, 53, 13),
	(331, 8924, 53, 13),
	(332, 6856, 53, 13),
	(333, 4566, 53, 13),
	(334, 5770, 53, 13),
	(335, 7187, 50, 12),
	(336, 7313, 50, 12),
	(337, 2412, 50, 12),
	(338, 3472, 50, 12),
	(339, 9233, 50, 12),
	(340, 5972, 50, 12),
	(341, 7508, 50, 12),
	(342, 6059, 50, 12),
	(343, 6060, 50, 12),
	(344, 2574, 50, 12),
	(345, 4431, 50, 12),
	(346, 8699, 50, 12),
	(347, 8634, 50, 12),
	(348, 4713, 50, 12),
	(349, 1898, 50, 12),
	(350, 7736, 50, 12),
	(351, 5425, 50, 12),
	(352, 6483, 50, 12),
	(353, 4130, 50, 12),
	(354, 4013, 50, 12),
	(355, 7401, 50, 12),
	(356, 6477, 50, 12),
	(357, 1844, 50, 12),
	(358, 2873, 50, 12),
	(359, 3032, 50, 12),
	(360, 6173, 53, 12),
	(361, 6471, 53, 12),
	(362, 4500, 53, 12),
	(363, 3306, 53, 12),
	(364, 8589, 53, 12),
	(365, 9366, 53, 12),
	(366, 3356, 53, 12),
	(367, 9708, 53, 12),
	(368, 7190, 53, 12),
	(369, 1485, 53, 12),
	(370, 6695, 53, 12),
	(371, 9694, 53, 12),
	(372, 8446, 53, 12),
	(373, 3923, 53, 12),
	(374, 9735, 53, 12),
	(375, 4107, 53, 12),
	(376, 5325, 53, 12),
	(377, 6273, 53, 12),
	(378, 3195, 53, 12),
	(379, 7292, 53, 12),
	(380, 4295, 53, 12),
	(381, 2629, 53, 12),
	(382, 9293, 53, 12),
	(383, 2092, 53, 12),
	(384, 7326, 53, 12),
	(495, 9709, 50, 11),
	(496, 7762, 50, 11),
	(497, 1770, 50, 11),
	(498, 1037, 50, 11),
	(499, 9365, 50, 11),
	(500, 6842, 50, 11),
	(501, 7851, 50, 11),
	(502, 2922, 50, 11),
	(503, 1551, 50, 11),
	(504, 1616, 50, 11),
	(505, 3508, 50, 11),
	(506, 2608, 50, 11),
	(507, 6234, 50, 11),
	(508, 8677, 50, 11),
	(509, 6460, 50, 11),
	(510, 5442, 50, 11),
	(511, 2884, 50, 11),
	(512, 4119, 50, 11),
	(513, 2926, 50, 11),
	(514, 3265, 50, 11),
	(515, 1651, 53, 11),
	(516, 7340, 53, 11),
	(517, 6300, 53, 11),
	(518, 3597, 53, 11),
	(519, 9274, 53, 11),
	(520, 8605, 53, 11),
	(521, 5196, 53, 11),
	(522, 3060, 53, 11),
	(523, 5279, 53, 11),
	(524, 3383, 53, 11),
	(525, 8082, 53, 11),
	(526, 5459, 53, 11),
	(527, 6258, 53, 11),
	(528, 9393, 53, 11),
	(529, 2302, 53, 11);
/*!40000 ALTER TABLE `bilhetes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `comissoes` (
  `id_patrocinador` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `operacao` varchar(255) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` datetime NOT NULL,
  KEY `fk_comissoes_usuarios1_idx` (`id_patrocinador`),
  KEY `fk_comissoes_operacoes1_idx` (`operacao`),
  KEY `fk_comissoes_usuarios2_idx` (`id_usuario`),
  CONSTRAINT `fk_comissoes_operacoes1` FOREIGN KEY (`operacao`) REFERENCES `operacoes` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comissoes_usuarios1` FOREIGN KEY (`id_patrocinador`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comissoes_usuarios2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `comissoes` DISABLE KEYS */;
INSERT INTO `comissoes` (`id_patrocinador`, `id_usuario`, `operacao`, `valor`, `data`) VALUES
	(12, 16, 'comissao_premio', 12.00, '2017-01-25 19:52:02'),
	(11, 12, 'comissao_premio', 9.60, '2017-01-25 19:52:06'),
	(12, 15, 'comissao_premio', 9.40, '2017-01-25 19:55:01'),
	(11, 13, 'comissao_premio', 10.00, '2017-01-25 19:55:03'),
	(11, 12, 'comissao_premio', 7.80, '2017-01-25 20:10:01'),
	(11, 13, 'comissao_premio', 18.00, '2017-02-01 20:00:00'),
	(11, 12, 'comissao_premio', 18.00, '2017-02-01 20:05:01'),
	(12, 15, 'comissao_premio', 19.00, '2017-02-01 20:08:00'),
	(12, 16, 'comissao_premio', 18.00, '2017-02-01 20:15:00'),
	(12, 15, 'comissao_premio', 17.00, '2017-02-01 20:23:01'),
	(11, 12, 'comissao_premio', 18.00, '2017-02-02 11:57:00'),
	(12, 16, 'comissao_premio', 17.00, '2017-02-02 12:00:01');
/*!40000 ALTER TABLE `comissoes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `completa_cadastro` (
  `id_usuario` int(11) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `data` datetime NOT NULL,
  `auth` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_completa_cadastro_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `completa_cadastro` DISABLE KEYS */;
/*!40000 ALTER TABLE `completa_cadastro` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `config_email` (
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_port` int(11) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `config_email` DISABLE KEYS */;
INSERT INTO `config_email` (`smtp_host`, `smtp_user`, `smtp_port`, `smtp_pass`) VALUES
	('ssl://smtp.gmail.com', 'yagoskor@gmail.com', 465, '53gur4NC4');
/*!40000 ALTER TABLE `config_email` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `config_sorteios` (
  `preco_bilhete` decimal(8,2) DEFAULT NULL,
  `mult_bilhete` int(11) DEFAULT NULL,
  `mult_premio` int(11) DEFAULT NULL,
  `mult_bonus_xp_bilhetes` int(11) DEFAULT NULL,
  `mult_bonus_xp_premio` decimal(8,2) DEFAULT NULL,
  `desc_arrecadado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `config_sorteios` DISABLE KEYS */;
INSERT INTO `config_sorteios` (`preco_bilhete`, `mult_bilhete`, `mult_premio`, `mult_bonus_xp_bilhetes`, `mult_bonus_xp_premio`, `desc_arrecadado`) VALUES
	(2.00, 10, 3, 2, 1.00, 30);
/*!40000 ALTER TABLE `config_sorteios` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `config_system` (
  `titulo` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `google_api_key` varchar(255) DEFAULT NULL,
  `google_api_key_sec` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `config_system` DISABLE KEYS */;
INSERT INTO `config_system` (`titulo`, `logo`, `google_api_key`, `google_api_key_sec`) VALUES
	('Lottery Network', 'uploaded_imgs/14831310485866c8a8525c2.png', '6LdIswgUAAAAAEFOHWjf4Janh7dLCtzLHqfTt7Qu', '6LdIswgUAAAAAHEoTjNvOiejaQ9AHCCgWKlQw80P');
/*!40000 ALTER TABLE `config_system` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `extratos` (
  `id_extrato` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `operacao` varchar(255) NOT NULL,
  `saldo` decimal(8,2) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_extrato`,`usuarios_id`),
  KEY `fk_extratos_usuarios1_idx` (`usuarios_id`),
  KEY `fk_extratos_operacoes1_idx` (`operacao`),
  CONSTRAINT `fk_extratos_operacoes1` FOREIGN KEY (`operacao`) REFERENCES `operacoes` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_extratos_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `extratos` DISABLE KEYS */;
INSERT INTO `extratos` (`id_extrato`, `usuarios_id`, `valor`, `operacao`, `saldo`, `data`) VALUES
	(1, 11, 100.00, 'compra_bilhetes', 0.00, '2017-01-25 18:28:19'),
	(2, 12, 100.00, 'compra_bilhetes', 0.00, '2017-01-25 18:31:27'),
	(3, 13, 80.00, 'compra_bilhetes', 0.00, '2017-01-25 19:05:48'),
	(4, 15, 70.00, 'compra_bilhetes', 0.00, '2017-01-25 19:08:28'),
	(5, 16, 60.00, 'compra_bilhetes', 0.00, '2017-01-25 19:10:26'),
	(6, 16, 84.00, 'premiacao_sorteio', 84.00, '2017-01-25 19:52:02'),
	(7, 12, 12.00, 'comissao_premio', 12.00, '2017-01-25 19:52:02'),
	(8, 12, 67.20, 'premiacao_sorteio', 79.20, '2017-01-25 19:52:06'),
	(9, 11, 9.60, 'comissao_premio', 9.60, '2017-01-25 19:52:06'),
	(10, 15, 65.80, 'premiacao_sorteio', 65.80, '2017-01-25 19:55:00'),
	(11, 12, 9.40, 'comissao_premio', 88.60, '2017-01-25 19:55:01'),
	(12, 13, 70.00, 'premiacao_sorteio', 70.00, '2017-01-25 19:55:03'),
	(13, 11, 10.00, 'comissao_premio', 19.60, '2017-01-25 19:55:03'),
	(14, 11, 18.00, 'compra_bilhetes', 1.60, '2017-01-25 20:06:19'),
	(15, 12, 40.00, 'compra_bilhetes', 48.60, '2017-01-25 20:07:32'),
	(16, 13, 60.00, 'compra_bilhetes', 10.00, '2017-01-25 20:08:39'),
	(17, 12, 54.60, 'premiacao_sorteio', 103.20, '2017-01-25 20:10:01'),
	(18, 11, 7.80, 'comissao_premio', 9.40, '2017-01-25 20:10:01'),
	(19, 16, 80.00, 'compra_bilhetes', 4.00, '2017-02-01 19:29:50'),
	(20, 15, 60.00, 'compra_bilhetes', 5.80, '2017-02-01 19:34:06'),
	(21, 12, 100.00, 'compra_bilhetes', 3.20, '2017-02-01 19:39:38'),
	(24, 13, 126.00, 'premiacao_sorteio', 136.00, '2017-02-01 20:00:00'),
	(25, 11, 18.00, 'comissao_premio', 18.00, '2017-02-01 20:00:00'),
	(27, 12, 126.00, 'premiacao_sorteio', 129.20, '2017-02-01 20:05:00'),
	(28, 11, 18.00, 'comissao_premio', 18.00, '2017-02-01 20:05:01'),
	(30, 15, 133.00, 'premiacao_sorteio', 138.80, '2017-02-01 20:08:00'),
	(31, 12, 19.00, 'comissao_premio', 148.20, '2017-02-01 20:08:00'),
	(33, 16, 126.00, 'premiacao_sorteio', 130.00, '2017-02-01 20:15:00'),
	(34, 12, 18.00, 'comissao_premio', 166.20, '2017-02-01 20:15:00'),
	(35, 11, 70.00, 'compra_bilhetes', 0.00, '2017-02-01 20:19:40'),
	(36, 11, 126.00, 'premiacao_sorteio', 126.00, '2017-02-01 20:21:00'),
	(37, 15, 119.00, 'premiacao_sorteio', 257.80, '2017-02-01 20:23:01'),
	(38, 12, 17.00, 'comissao_premio', 183.20, '2017-02-01 20:23:01'),
	(39, 11, 70.00, 'compra_bilhetes', 56.00, '2017-02-02 11:52:08'),
	(40, 12, 126.00, 'premiacao_sorteio', 309.20, '2017-02-02 11:57:00'),
	(41, 11, 18.00, 'comissao_premio', 74.00, '2017-02-02 11:57:00'),
	(42, 16, 119.00, 'premiacao_sorteio', 249.00, '2017-02-02 12:00:01'),
	(43, 12, 17.00, 'comissao_premio', 326.20, '2017-02-02 12:00:01');
/*!40000 ALTER TABLE `extratos` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `extratos_company` (
  `id_extrato` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(8,2) NOT NULL,
  `saldo` decimal(8,2) NOT NULL,
  `data` datetime NOT NULL,
  `operacao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_extrato`),
  KEY `fk_extratos_company_operacoes1_idx` (`operacao`),
  CONSTRAINT `fk_extratos_company_operacoes1` FOREIGN KEY (`operacao`) REFERENCES `operacoes` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `extratos_company` DISABLE KEYS */;
INSERT INTO `extratos_company` (`id_extrato`, `valor`, `saldo`, `data`, `operacao`) VALUES
	(1, 24.00, 0.00, '2017-01-25 19:52:02', 'premiacao_sorteio'),
	(2, 19.20, 0.00, '2017-01-25 19:52:06', 'premiacao_sorteio'),
	(3, 18.80, 0.00, '2017-01-25 19:55:01', 'premiacao_sorteio'),
	(4, 20.00, 0.00, '2017-01-25 19:55:04', 'premiacao_sorteio'),
	(5, 15.60, 0.00, '2017-01-25 20:10:01', 'premiacao_sorteio'),
	(6, 36.00, 0.00, '2017-02-01 20:00:00', 'premiacao_sorteio'),
	(7, 36.00, 0.00, '2017-02-01 20:05:01', 'premiacao_sorteio'),
	(8, 38.00, 0.00, '2017-02-01 20:08:01', 'premiacao_sorteio'),
	(9, 36.00, 0.00, '2017-02-01 20:15:00', 'premiacao_sorteio'),
	(10, 54.00, 0.00, '2017-02-01 20:21:00', 'premiacao_sorteio'),
	(11, 34.00, 0.00, '2017-02-01 20:23:01', 'premiacao_sorteio'),
	(12, 36.00, 0.00, '2017-02-02 11:57:00', 'premiacao_sorteio'),
	(13, 34.00, 0.00, '2017-02-02 12:00:01', 'premiacao_sorteio');
/*!40000 ALTER TABLE `extratos_company` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `niveis` (
  `nivel` int(11) NOT NULL,
  `exp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `niveis` DISABLE KEYS */;
INSERT INTO `niveis` (`nivel`, `exp`) VALUES
	(1, 0),
	(2, 50),
	(3, 110),
	(4, 174),
	(5, 242),
	(6, 313),
	(7, 389),
	(8, 469),
	(9, 554),
	(10, 644),
	(11, 740),
	(12, 841),
	(13, 949),
	(14, 1063),
	(15, 1183),
	(16, 1311),
	(17, 1447),
	(18, 1591),
	(19, 1743),
	(20, 1905),
	(21, 2076),
	(22, 2258),
	(23, 2450),
	(24, 2654),
	(25, 2870),
	(26, 3099),
	(27, 3342),
	(28, 3600),
	(29, 3873),
	(30, 4162),
	(31, 4469),
	(32, 4794),
	(33, 5139),
	(34, 5504),
	(35, 5891),
	(36, 6302),
	(37, 6737),
	(38, 7198),
	(39, 7687),
	(40, 8205),
	(41, 8754),
	(42, 9336),
	(43, 9953),
	(44, 10608),
	(45, 11301),
	(46, 12036),
	(47, 12815),
	(48, 13641),
	(49, 14516),
	(50, 15444),
	(51, 16428),
	(52, 17471),
	(53, 18576),
	(54, 19747),
	(55, 20989),
	(56, 22306),
	(57, 23701),
	(58, 25180),
	(59, 26748),
	(60, 28409),
	(61, 30171),
	(62, 32038),
	(63, 34017),
	(64, 36115),
	(65, 38339),
	(66, 40697),
	(67, 43195),
	(68, 45844),
	(69, 48652),
	(70, 51628),
	(71, 54783),
	(72, 58126),
	(73, 61671),
	(74, 65428),
	(75, 69411),
	(76, 73633),
	(77, 78107),
	(78, 82851),
	(79, 87879),
	(80, 93209),
	(81, 98858),
	(82, 104846),
	(83, 111194),
	(84, 117923),
	(85, 125055),
	(86, 132616),
	(87, 140629),
	(88, 149124),
	(89, 158129),
	(90, 167673),
	(91, 177791),
	(92, 188515),
	(93, 199883),
	(94, 211933),
	(95, 224706),
	(96, 238245),
	(97, 252597),
	(98, 267810),
	(99, 283935),
	(100, 301028);
/*!40000 ALTER TABLE `niveis` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `operacoes` (
  `codigo` varchar(255) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` char(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `operacoes` DISABLE KEYS */;
INSERT INTO `operacoes` (`codigo`, `nome`, `tipo`) VALUES
	('comissao_bilhetes', 'Comissão Bilhetes', 'C'),
	('comissao_premio', 'Comissão Prêmio', 'C'),
	('compra_bilhetes', 'Compra de Bilhetes', 'D'),
	('premiacao_sorteio', 'Premiação Sorteio', 'C'),
	('retirada', 'Retirada', 'D');
/*!40000 ALTER TABLE `operacoes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `percent_comissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordem` int(11) NOT NULL,
  `niveis` varchar(7) NOT NULL,
  `cod_comissao` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_percent_comissoes_operacoes1_idx` (`cod_comissao`),
  CONSTRAINT `fk_percent_comissoes_operacoes1` FOREIGN KEY (`cod_comissao`) REFERENCES `operacoes` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `percent_comissoes` DISABLE KEYS */;
INSERT INTO `percent_comissoes` (`id`, `ordem`, `niveis`, `cod_comissao`, `percent`) VALUES
	(8, 1, '1-100', 'comissao_premio', 10),
	(16, 1, '1-100', 'comissao_bilhetes', 10);
/*!40000 ALTER TABLE `percent_comissoes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pre_edicao_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `auth` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_pre_edicao_usuarios_usuarios1_idx` (`id_usuario`),
  CONSTRAINT `fk_pre_edicao_usuarios_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `pre_edicao_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `pre_edicao_usuarios` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `saldo_company` (
  `saldo` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `saldo_company` DISABLE KEYS */;
INSERT INTO `saldo_company` (`saldo`) VALUES
	(401.60);
/*!40000 ALTER TABLE `saldo_company` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `sorteios` (
  `id_sorteio` int(11) NOT NULL AUTO_INCREMENT,
  `numero_sorteio` int(11) NOT NULL,
  `data_sorteio` datetime DEFAULT NULL,
  `bilhete_premiado` int(11) DEFAULT '0',
  `preco` int(11) NOT NULL DEFAULT '1',
  `premio` decimal(8,2) DEFAULT '0.00',
  `min_bilhetes` int(11) NOT NULL DEFAULT '0',
  `show_users` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sorteio`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `sorteios` DISABLE KEYS */;
INSERT INTO `sorteios` (`id_sorteio`, `numero_sorteio`, `data_sorteio`, `bilhete_premiado`, `preco`, `premio`, `min_bilhetes`, `show_users`) VALUES
	(45, 1, '2017-01-25 19:52:02', 178, 2, 84.00, 60, 0),
	(46, 1, '2017-01-25 19:55:00', 165, 2, 65.80, 40, 1),
	(47, 2, '2017-01-25 19:55:03', 125, 2, 70.00, 50, 0),
	(48, 2, '2017-01-25 19:52:06', 57, 2, 64.20, 40, 1),
	(49, 3, '2017-01-25 20:14:00', 215, 2, 54.60, 30, 0),
	(50, 4, '2017-02-02 11:57:00', 350, 1, 126.00, 90, 0),
	(51, 4, '2017-02-03 20:25:00', 0, 1, 0.00, 50, 1),
	(52, 5, '2017-02-02 20:00:00', 0, 1, 0.00, 30, 0),
	(53, 4, '2017-02-02 12:00:01', 278, 1, 119.00, 85, 1),
	(54, 6, '2017-02-03 20:00:00', 0, 1, 0.00, 30, 0),
	(55, 5, '2017-02-04 20:00:00', 0, 1, 0.00, 30, 1),
	(56, 7, '2017-02-04 20:00:00', 0, 1, 0.00, 30, 0),
	(57, 8, '2017-02-04 20:00:00', 0, 1, 0.00, 30, 0);
/*!40000 ALTER TABLE `sorteios` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `transf_tickets` (
  `auth` varchar(255) NOT NULL,
  `remetente` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `valida` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auth`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `transf_tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `transf_tickets` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `xp` int(11) DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `saldo` decimal(8,2) DEFAULT '0.00',
  `bilhetes` int(11) DEFAULT '0',
  `patrocinador` int(11) DEFAULT '0',
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ultimo_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `nome`, `apelido`, `email`, `celular`, `cpf`, `xp`, `password`, `saldo`, `bilhetes`, `patrocinador`, `data_cadastro`, `ultimo_login`) VALUES
	(11, 'Yago Laignier', 'yagoskor', 'yagoskor@gmail.com', '(62) 99456-7890', '546.546.743-51', 3097, '7c222fb2927d828af22f592134e8932480637c0d', 74.00, 0, 0, '2016-12-04 18:47:30', '2017-04-16 17:45:13'),
	(12, 'Landeslano Silva', 'landers', 'landers@gmail.com', '(62) 99456-7891', '546.546.743-52', 2733, '7c222fb2927d828af22f592134e8932480637c0d', 326.20, 0, 11, '2016-12-04 19:31:50', '2017-02-01 19:39:00'),
	(13, 'Carlos Roberto', 'carlos', 'carlos@gmail.com', '(62) 99456-7892', '546.546.743-53', 1120, '7c222fb2927d828af22f592134e8932480637c0d', 136.00, 0, 11, '2016-12-04 19:41:19', '2017-02-01 19:37:37'),
	(15, 'Armando Cruz', 'madara', 'armando@gmail.com', '(62) 99456-7893', '546.546.743-54', 1331, '7c222fb2927d828af22f592134e8932480637c0d', 257.80, 0, 12, '2016-12-04 19:53:58', '2017-02-01 19:32:58'),
	(16, 'Chico Leite', 'chicao', 'chico@gmail.com', '(62) 99456-7894', '546.546.743-56', 1405, '7c222fb2927d828af22f592134e8932480637c0d', 249.00, 0, 12, '2016-12-04 19:57:21', '2017-02-01 19:24:40');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `usuarios_online` (
  `id_usuario` int(11) NOT NULL,
  `sessao` text NOT NULL,
  `tempo` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_online_usuarios1_idx` (`id_usuario`),
  CONSTRAINT `fk_usuarios_online_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `usuarios_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_online` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `vendas` (
  `id_venda` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `bilhetes` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `metodo_pgto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_venda`,`id_usuario`),
  KEY `fk_vendas_usuarios1_idx` (`id_usuario`),
  CONSTRAINT `fk_vendas_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` (`id_venda`, `id_usuario`, `bilhetes`, `data`, `metodo_pgto`) VALUES
	(1, 11, 50, '2017-01-25 18:28:19', 'saldo'),
	(2, 12, 50, '2017-01-25 18:31:27', 'saldo'),
	(3, 13, 40, '2017-01-25 19:05:48', 'saldo'),
	(4, 15, 35, '2017-01-25 19:08:28', 'saldo'),
	(5, 16, 30, '2017-01-25 19:10:26', 'saldo'),
	(6, 11, 9, '2017-01-25 20:06:19', 'saldo'),
	(7, 12, 20, '2017-01-25 20:07:32', 'saldo'),
	(8, 13, 30, '2017-01-25 20:08:39', 'saldo'),
	(9, 16, 40, '2017-02-01 19:29:50', 'saldo'),
	(10, 15, 30, '2017-02-01 19:34:06', 'saldo'),
	(11, 12, 50, '2017-02-01 19:39:38', 'saldo'),
	(12, 11, 35, '2017-02-01 19:53:20', 'saldo'),
	(13, 11, 35, '2017-02-01 19:58:25', 'saldo'),
	(14, 11, 35, '2017-02-01 20:04:44', 'saldo'),
	(15, 11, 35, '2017-02-01 20:07:27', 'saldo'),
	(16, 11, 35, '2017-02-01 20:13:59', 'saldo'),
	(17, 11, 35, '2017-02-01 20:19:40', 'saldo'),
	(18, 11, 35, '2017-02-02 11:52:08', 'saldo');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `visitantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessao` text NOT NULL,
  `ip` varchar(15) NOT NULL,
  `tempo` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2395 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `visitantes` DISABLE KEYS */;
INSERT INTO `visitantes` (`id`, `sessao`, `ip`, `tempo`) VALUES
	(2394, 'f63767832fb08d8b8e24275e9d5865344a78521b', '::1', '2017-06-10 15:01:00');
/*!40000 ALTER TABLE `visitantes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id_voucher` int(11) NOT NULL AUTO_INCREMENT,
  `voucher` char(23) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `bilhetes` int(11) NOT NULL,
  `validade` datetime NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  `usado` datetime DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_voucher`),
  UNIQUE KEY `voucher_UNIQUE` (`voucher`),
  KEY `fk_vouchers_usuarios1_idx` (`usuario`),
  CONSTRAINT `fk_vouchers_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `vouchers` DISABLE KEYS */;
INSERT INTO `vouchers` (`id_voucher`, `voucher`, `descricao`, `bilhetes`, `validade`, `usuario`, `usado`, `ativo`) VALUES
	(1, 'b5Eno-O9cv7-UMX8b', 'Test', 20, '2017-02-28 23:59:59', NULL, NULL, 1);
/*!40000 ALTER TABLE `vouchers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
