-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 10:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `superhistoire`
--

-- --------------------------------------------------------

--
-- Table structure for table `choix`
--

CREATE TABLE `choix` (
  `id_choix` int(11) NOT NULL,
  `intitule` varchar(150) NOT NULL,
  `vie` int(11) NOT NULL,
  `id_sit_suivante` int(11) NOT NULL,
  `id_sit_precedente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choix`
--

INSERT INTO `choix` (`id_choix`, `intitule`, `vie`, `id_sit_suivante`, `id_sit_precedente`) VALUES
(1, 'Prendre mon vélo', 0, 2, 1),
(2, 'Y aller en courant', 0, 2, 1),
(3, 'Partir vers le grand arbre', -1, 3, 2),
(4, 'Partir vers le petit ruisseau', -1, 4, 2),
(5, 'Partir vers l\'entrée du parc', 1, 6, 2),
(6, 'Retourner vers le banc vert', 0, 5, 3),
(7, 'Passer par le petit talus', 0, 5, 4),
(8, 'Retourner à la maison', 0, 7, 5),
(9, 'Chercher encore un peu dans le parc', 0, 2, 5),
(10, 'Retourner vers le banc vert', 0, 5, 6),
(11, 'Suivre la dame', 1, 9, 7),
(12, 'Retourner jouer à la GameBoy à la maison', -1, 12, 7);

-- --------------------------------------------------------

--
-- Table structure for table `histoire`
--

CREATE TABLE `histoire` (
  `id_hist` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `image` varchar(20) NOT NULL,
  `description` varchar(700) NOT NULL,
  `affichee` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `histoire`
--

INSERT INTO `histoire` (`id_hist`, `titre`, `image`, `description`, `affichee`) VALUES
(1, 'Monsieur Charles', 'monsieurcharles.png', 'Tous les lundis après l\'école, monsieur Charles nous raconte une histoire. Mais aujourd\'hui, j\'ai l\'impression que la situation est différente...', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `situation`
--

CREATE TABLE `situation` (
  `id_sit` int(11) NOT NULL,
  `paragraphe` varchar(2000) NOT NULL,
  `id_hist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `situation`
--

INSERT INTO `situation` (`id_sit`, `paragraphe`, `id_hist`) VALUES
(1, 'Aujourd’hui, comme tous les lundis, dès la sortie de la classe, je cours vers le parc avec mes\r\ncopains pour y retrouver monsieur Charles. J’essaye d’arriver le premier pour pouvoir choisir\r\nl’histoire qu’il va nous conter. Moi, je choisis toujours des histoires de détectives... Vite je\r\ndois me dépêcher...', 1),
(2, 'Nous voilà arrivés au parc. On repère toujours monsieur Charles de loin grâce à son grand panier rouge. Mais ce soir, le banc vert sur lequel monsieur Charles s’assoit est vide. Nous partons à sa recherche dans le parc..\r\n', 1),
(3, 'Nous avons beau chercher, mais nous ne le trouvons toujours pas. Nous décidons de retourner vers le banc vert.', 1),
(4, 'Il n’y a personne du côté du petit ruisseau. Nous décidons de retourner vers le banc vert. Pour aller plus vite nous décidons de revenir par le petit talus. ', 1),
(5, 'Nous nous asseyons sur le banc et attendons un peu. Mais personne ne vient. Pour la première fois, nous n’aurons pas d’histoire... ', 1),
(6, 'Arrivés à l’entrée du parc, nous voyons un petit monsieur avec un manteau gris. C’est lui !!! Nous l’appelons « Monsieur Charles !!! » Mais il ne se retourne pas : ce n’était pas lui... nous décidons de retourner vers le banc vert. ', 1),
(7, 'Nous nous dirigeons vers la sortie du parc. Tout à coup Fabien crie : « Regardez, regardez, c’est le panier de monsieur Charles ! ». Il montrait une dame qui portait le panier rouge de notre ami. Tout ceci est bien mystérieux. ', 1),
(8, 'Nous rentrons tous à la maison, on reviendra lundi prochain pour voir s’il sera là...  \r\n', 1),
(9, 'Nous suivons la dame. Lucie avait un peu peur, mais je l’ai encouragée : nous devons savoir ce qui est arrivé à monsieur Charles. Nous courons jusqu’à la grille.', 1),
(10, 'Nous avons perdu la trace de la dame. Nous retournons sur nos pas.\r\n', 1),
(11, 'Nous voyons la dame entrer dans un immeuble. Nous la suivons et voyons au loin un Monsieur en rouge. Nous appelons « Monsieur Charles, monsieur Charles !!! ». Monsieur Charles nous attend tranquillement sur le palier. Il nous dit bonjour et nous demande ce que nous faisons ici. Nous lui racontons alors notre histoire de détectives. Mais voilà que monsieur Charles se met à rire : « Mais Rose est mon aide-ménagère ! Quand je suis malade, je prête mon panier pour qu’elle aille faire mes courses. Nous avons tous bien rigolé et nous avons eu droit à une très belle histoire comme tous les lundis soirs. ', 1),
(12, 'Gros LOOSER c\'est PERDU', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choix`
--
ALTER TABLE `choix`
  ADD PRIMARY KEY (`id_choix`);

--
-- Indexes for table `histoire`
--
ALTER TABLE `histoire`
  ADD PRIMARY KEY (`id_hist`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `situation`
--
ALTER TABLE `situation`
  ADD PRIMARY KEY (`id_sit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choix`
--
ALTER TABLE `choix`
  MODIFY `id_choix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `histoire`
--
ALTER TABLE `histoire`
  MODIFY `id_hist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `situation`
--
ALTER TABLE `situation`
  MODIFY `id_sit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;
