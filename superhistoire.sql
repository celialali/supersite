-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 15 avr. 2022 à 16:15
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `superhistoire`
--
CREATE DATABASE IF NOT EXISTS `superhistoire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `superhistoire`;

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

CREATE TABLE IF NOT EXISTS `choix` (
  `id_choix` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(150) NOT NULL,
  `vie` int(11) NOT NULL,
  `id_sit_suivante` int(11) NOT NULL,
  `id_sit_precedente` int(11) NOT NULL,
  PRIMARY KEY (`id_choix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `histoire`
--

CREATE TABLE IF NOT EXISTS `histoire` (
  `id_hist` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `image` varchar(20) NOT NULL,
  `description` varchar(700) NOT NULL,
  `affichee` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_hist`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `histoire`
--

INSERT INTO `histoire` (`id_hist`, `titre`, `image`, `description`, `affichee`) VALUES
(1, 'Monsieur Charles', 'monsieurcharles.png', 'Tous les lundis après l\'école, monsieur Charles nous raconte une histoire. Mais aujourd\'hui, j\'ai l\'impression que la situation est différente...', 1);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id_profil` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `situation`
--

CREATE TABLE IF NOT EXISTS `situation` (
  `id_sit` int(11) NOT NULL AUTO_INCREMENT,
  `paragraphe` varchar(2000) NOT NULL,
  `id_hist` int(11) NOT NULL,
  PRIMARY KEY (`id_sit`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `situation`
--

INSERT INTO `situation` (`id_sit`, `paragraphe`, `id_hist`) VALUES
(1, 'Aujourd’hui, comme tous les lundis, dès la sortie de la classe, je cours vers le parc avec mes\r\ncopains pour y retrouver monsieur Charles. J’essaye d’arriver le premier pour pouvoir choisir\r\nl’histoire qu’il va nous conter. Moi, je choisis toujours des histoires de détectives... Vite je\r\ndois me dépêcher...', 1),
(2, 'Nous voilà arrivés au parc. On repère toujours monsieur Charles de loin grâce à son grand panier rouge. Mais ce soir, le banc vert sur lequel monsieur Charles s’assoit est vide. Nous partons à sa recherche dans le parc..\r\n', 1),
(3, 'Nous avons beau chercher, mais nous ne le trouvons toujours pas. Nous décidons de retourner vers le banc vert.', 1),
(4, 'Il n’y a personne du côté du petit ruisseau. Nous décidons de retourner vers le banc vert. Pour aller plus vite nous décidons de revenir par le petit talus. ', 1),
(5, 'Nous nous asseyons sur le banc et attendons un peu. Mais personne ne vient. Pour la première fois, nous n’aurons pas d’histoire... ', 1),
(6, 'Arrivés à l’entrée du parc, nous voyons un petit monsieur avec un manteau gris. C’est lui !!! Nous l’appelons « Monsieur Charles !!! » Mais il ne se retourne pas : ce n’était pas lui... nous décidons de retourner vers le banc vert. ', 1),
(7, 'Nous nous dirigeons vers la sortie du parc. Tout à coup Fabien crie : « Regardez, regardez, c’est le panier de monsieur Charles ! ». Il montrait une dame qui portait le panier rouge de notre ami. Tout ceci est bien mystérieux. ', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
