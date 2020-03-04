-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 17 fév. 2020 à 17:41
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `resum` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `nom`, `id_topic`, `id_user`, `resum`, `status`, `date`) VALUES
(1, 'sd', 4, 12, 'ddddddddd', 0, '2020-02-12 19:47:39'),
(2, 'ttt', 4, 12, 'rtrete', 0, '2020-02-12 19:48:01'),
(3, 'ze', 4, 14, 'efazfzf', 2, '2020-02-12 19:48:42'),
(4, 'ze', 4, 14, 'efazfzf', 2, '2020-02-12 22:21:21'),
(5, 'ze', 4, 14, 'efazfzf', 2, '2020-02-12 22:22:36'),
(6, 'guitar', 1, 13, 'aeddddddddddddddd', 0, '2020-02-14 14:52:30'),
(7, 'j', 9, 12, 'pp', 0, '2020-02-15 15:17:42'),
(8, 'j', 9, 12, 'pp', 0, '2020-02-15 15:17:52');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_user`, `id_message`, `type`) VALUES
(30, 14, 6, 1),
(29, 14, 9, 0),
(41, 12, 29, 0),
(25, 13, 24, 1),
(23, 13, 6, 1),
(21, 13, 23, 1),
(16, 13, 5, 1),
(19, 13, 4, 0),
(22, 13, 7, 1),
(31, 14, 24, 1),
(33, 14, 7, 1),
(39, 12, 32, 1),
(40, 12, 33, 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_conversation` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_conversation`, `message`, `date`, `id_user`) VALUES
(1, 2, 'hhh', '2020-02-13 14:36:22', 12),
(2, 2, 'h', '2020-02-13 14:44:03', 12),
(3, 2, 'h', '2020-02-13 14:44:44', 12),
(30, 1, 'sd<cgvhj', '2020-02-14 14:57:11', 13),
(31, 1, 'dfsss', '2020-02-14 19:35:26', 12),
(32, 6, 'sdvd', '2020-02-14 19:48:52', 12),
(29, 6, 'hello', '2020-02-14 14:54:38', 13),
(10, 3, 'bonjour\r\n', '2020-02-13 15:26:17', 13),
(11, 3, 'Ã©', '2020-02-13 15:26:22', 13),
(12, 3, 'jk\r\n', '2020-02-13 15:26:26', 13),
(13, 3, 'j\r\n', '2020-02-13 15:35:21', 13),
(14, 3, 'j\r\n', '2020-02-13 15:38:09', 13),
(15, 3, 'j\r\n', '2020-02-13 15:38:19', 13),
(16, 3, 'jolk', '2020-02-13 15:38:44', 13),
(17, 3, 'https://www.youtube.com/watch?v=ckTHKCY6Q3s', '2020-02-13 15:41:11', 13),
(18, 3, 'azerty\r\n', '2020-02-13 15:41:47', 13),
(19, 3, 'azerty\r\n', '2020-02-13 15:47:26', 13),
(20, 3, 'azerty\r\n', '2020-02-13 15:48:18', 13),
(21, 3, 'azerty\r\n', '2020-02-13 15:50:00', 13),
(33, 6, 'cxc', '2020-02-14 19:49:05', 12),
(34, 6, 'cxc', '2020-02-14 19:50:08', 12),
(35, 6, 'sqq', '2020-02-14 19:50:21', 12),
(36, 6, 'ddddddddddd', '2020-02-14 19:50:27', 12),
(37, 6, 'sqq', '2020-02-14 19:57:51', 12),
(38, 1, 'gh\r\n', '2020-02-15 13:40:26', 12),
(39, 1, 'gh\r\n', '2020-02-15 13:40:40', 12),
(40, 1, 'swagg', '2020-02-15 15:00:39', 14),
(41, 7, 'ooooooooooooooo', '2020-02-17 18:23:56', 14),
(42, 7, 'ooooooooooooooo', '2020-02-17 18:24:09', 14);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id`, `nom`, `status`, `id_user`) VALUES
(1, 'musique', 0, 13),
(9, 'test ', 1, 14),
(4, 'informatique', 0, 14),
(7, 'jeu', 2, 14);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `date`, `status`) VALUES
(11, 'd', '64e027e1320a7b58f1dd39d6447108143192d8362c8ca40efc6937c02df654ce', '2020-02-12 09:15:29', 0),
(12, 'a', 'da70a2087094607054219dab0aa2218c23ce50fed7a4c4e5d67511be753ae770', '2020-02-12 15:40:02', 0),
(13, 'modo', '07136f5ac2fdaf7a1b810eea81a0b260ce66f77599b8de2949304faf011c3bc2', '2020-02-12 17:10:18', 1),
(14, 'admin', '091594048cb11bf4faf3e80f2cfaf6fade89bc1ad6a238444a04aed8995b10d9', '2020-02-12 17:15:55', 2),
(15, 'eti', '64e027e1320a7b58f1dd39d6447108143192d8362c8ca40efc6937c02df654ce', '2020-02-16 21:46:15', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
