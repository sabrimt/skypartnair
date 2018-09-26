-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 14 Avril 2017 à 19:39
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mkpartnair`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `author` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_article` date NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `photo_1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `photo_2` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `author`, `title`, `category`, `date_article`, `content`, `photo_1`, `photo_2`) VALUES
(1, '', 'qsdqsdqsd', '', '2017-04-07', 'qsdqsdqsd', '', ''),
(2, '', 'fdsqdsqdqs', '', '2017-04-07', 'qsdqsdsqdqs', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `fleet`
--

CREATE TABLE `fleet` (
  `id` int(3) NOT NULL,
  `manufact_flag` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturer` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Jet privé','Avion de ligne') COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `passengers` int(3) NOT NULL,
  `cruise_speed` int(10) NOT NULL,
  `aircraft_range` int(10) NOT NULL,
  `crew` enum('2 pilotes','2 pilotes - hôtesse sur demande','2 pilotes - 1 hôtesse','2 pilotes - hôtesses') COLLATE utf8_unicode_ci NOT NULL,
  `photo_picto` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `photo_exter` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `photo_inter` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `photo_plan` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `photo_bonus` varchar(400) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `departure` varchar(400) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `arrival` varchar(400) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `price` int(7) NOT NULL,
  `id_avion` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `name` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('super admin','admin','redacteur') COLLATE utf8_unicode_ci NOT NULL,
  `last_connection` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fleet`
--
ALTER TABLE `fleet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `fleet`
--
ALTER TABLE `fleet`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
