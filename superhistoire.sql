-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 10:13 PM
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
  `id_hist` int(11) NOT NULL,
  `intitule` varchar(150) NOT NULL,
  `vie` int(11) NOT NULL,
  `id_sit_suivante` int(11) NOT NULL,
  `id_sit_precedente` int(11) NOT NULL,
  `choix_mortel` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choix`
--

INSERT INTO `choix` (`id_choix`, `id_hist`, `intitule`, `vie`, `id_sit_suivante`, `id_sit_precedente`, `choix_mortel`) VALUES
(1, 1, 'Prendre mon vélo', 0, 2, 1, 0),
(2, 1, 'Y aller en courant', 0, 2, 1, 0),
(3, 1, 'Partir vers le grand arbre', -1, 3, 2, 0),
(4, 1, 'Partir vers le petit ruisseau', -1, 4, 2, 0),
(5, 1, 'Partir vers l\'entrée du parc', 1, 6, 2, 0),
(6, 1, 'Retourner vers le banc vert', 0, 5, 3, 0),
(7, 1, 'Passer par le petit talus', 0, 5, 4, 0),
(8, 1, 'Retourner à la maison', 0, 7, 5, 0),
(9, 1, 'Chercher encore un peu dans le parc', 0, 2, 5, 0),
(10, 1, 'Retourner vers le banc vert', 0, 5, 6, 0),
(11, 1, 'Suivre la dame', 1, 9, 7, 0),
(12, 1, 'Retourner jouer à la GameBoy à la maison', -1, 0, 7, 1),
(13, 1, 'Mon lacet est défait', -1, 10, 9, 0),
(14, 1, 'Dire à Fabien de partir devant', 0, 10, 9, 0),
(15, 1, 'Nous suivons la dame du regard', 1, 11, 9, 0),
(16, 1, 'Nous retournons sur nos pas', 0, 9, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `histoire`
--

CREATE TABLE `histoire` (
  `id_hist` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `image` varchar(20) NOT NULL,
  `description` varchar(700) NOT NULL,
  `affichee` int(1) NOT NULL DEFAULT 1,
  `id_sit_initiale` int(11) NOT NULL,
  `id_sit_finale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `histoire`
--

INSERT INTO `histoire` (`id_hist`, `titre`, `image`, `description`, `affichee`, `id_sit_initiale`, `id_sit_finale`) VALUES
(1, 'Monsieur Charles', 'monsieurcharles.png', 'Tous les lundis, nous rejoignons Monsieur Charles au parc pour qu\'il nous raconte une histoire. Mais aujourd\'hui, je sens qu\'il y a quelque chose de bizarre...', 1, 1, 11),
(2, 'Le monstre de l\'ENSC', 'monstrechat.png', 'Dans cette histoire, vous pourrez découvrir tous les mystères de l\'ENSC (notamment le monstre caché sous le patio...)', 1, 14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id_lecture` int(11) NOT NULL,
  `id_hist` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `nb_vies` int(11) NOT NULL DEFAULT 3,
  `nb_fois_jouee` int(11) NOT NULL DEFAULT 0,
  `nb_morts` int(11) NOT NULL DEFAULT 0,
  `nb_victoires` int(11) NOT NULL DEFAULT 0,
  `id_sit_en_cours` int(11) NOT NULL,
  `en_cours` tinyint(4) NOT NULL DEFAULT 0,
  `liste_choix` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id_lecture`, `id_hist`, `id_profil`, `nb_vies`, `nb_fois_jouee`, `nb_morts`, `nb_victoires`, `id_sit_en_cours`, `en_cours`, `liste_choix`) VALUES
(24, 2, 5, 3, 8, 0, 8, 14, 0, ''),
(25, 1, 5, 3, 10, 4, 6, 2, 1, ''),
(29, 1, 16, 3, 2, 1, 1, 1, 0, ''),
(30, 2, 16, 3, 1, 0, 1, 14, 0, '');

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

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `login`, `mdp`, `admin`) VALUES
(3, 'correcteur', 'mdp_correcteur_1234', 0),
(4, 'correcteur_admin', 'mdp_correcteur_1234', 1),
(5, 'lalali', 'lalala', 1),
(16, 'lalalou', 'lalala', 0);

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
(14, 'Lol c\'est déjà terminé', 2);

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
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id_lecture`);

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
  MODIFY `id_choix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `histoire`
--
ALTER TABLE `histoire`
  MODIFY `id_hist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id_lecture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `situation`
--
ALTER TABLE `situation`
  MODIFY `id_sit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;
