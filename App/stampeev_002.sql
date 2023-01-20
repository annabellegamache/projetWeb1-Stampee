-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 29 sep. 2022 à 17:43
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stampee`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `cat_nom`) VALUES
(1, 'présente'),
(2, 'passé'),
(3, 'future');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `enc_id` int(11) NOT NULL,
  `enc_nom` varchar(100) NOT NULL,
  `enc_type` varchar(100) DEFAULT NULL,
  `enc_date_debut` datetime NOT NULL,
  `enc_date_fin` datetime DEFAULT NULL,
  `enc_prix_reserve` float NOT NULL,
  `enc_prix_depart` float NOT NULL,
  `enc_prix` float DEFAULT NULL,
  `enc_ce_cat_id` int(11) NOT NULL,
  `enc_tim_id` int(11) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`enc_id`, `enc_nom`, `enc_type`, `enc_date_debut`, `enc_date_fin`, `enc_prix_reserve`, `enc_prix_depart`, `enc_prix`, `enc_ce_cat_id`, `enc_tim_id`, `userId`) VALUES
(1, 'Enchère timbre voilier', '0', '2022-09-05 13:49:00', '2022-09-19 13:49:00', 120, 200, 200, 1, 1, 1),
(2, 'Époque Québec', '0', '2022-09-26 06:34:00', '2022-10-03 06:34:00', 250, 200, 200, 0, 2, 3),
(3, 'Ferme Canada', '0', '2022-09-13 06:35:00', '2022-09-26 06:35:00', 320, 300, 300, 1, 3, 3),
(4, 'Roi George VI', '0', '2022-10-04 06:36:00', '2022-10-25 06:36:00', 600, 500, 500, 2, 4, 3),
(5, 'Reine Elizabeth 2', '0', '2022-09-12 06:36:00', '2022-11-22 06:36:00', 680, 600, 900, 0, 5, 3),
(6, 'Reine Couronne', '0', '2022-09-05 06:37:00', '2022-11-23 06:37:00', 900, 800, 850, 0, 6, 3),
(7, 'Charles Péguy', '0', '2022-09-26 06:50:00', '2022-10-17 06:50:00', 500, 475, 475, 0, 7, 2),
(8, 'Aérien poste', '0', '2022-09-19 06:51:00', '2022-11-16 06:51:00', 850, 700, 750, 0, 9, 2),
(9, 'Train Canada', '2', '2022-09-19 06:51:00', '2022-11-15 06:51:00', 550, 400, 400, 0, 10, 2),
(10, 'Conférence Lord', '0', '2022-09-29 06:52:00', '2022-10-06 06:52:00', 850, 810, 810, 0, 11, 2),
(11, 'Russie Songe', '0', '2022-10-08 07:06:00', '2022-10-29 07:06:00', 650, 600, 600, 2, 16, 1),
(12, 'Présidence du Nicaragua', '0', '2022-10-05 07:07:00', '2022-10-19 07:07:00', 275, 200, 200, 2, 17, 1),
(13, 'Ministres du Canada', '0', '2022-10-04 07:07:00', '2022-10-25 07:07:00', 400, 300, 300, 2, 13, 1),
(14, 'Adolf Hitler', '0', '2022-09-19 07:08:00', '2022-10-25 07:08:00', 540, 500, 500, 0, 18, 1),
(15, 'Chateau de France', '0', '2022-10-05 09:56:00', '2022-10-25 09:56:00', 950, 900, 900, 2, 15, 1),
(16, 'Canard du Canada', '0', '2022-09-29 13:44:00', '2022-10-06 13:44:00', 550, 550, 550, 2, 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `img_id` int(11) NOT NULL,
  `img_nom` varchar(100) NOT NULL,
  `img_chemin` varchar(255) NOT NULL,
  `tim_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`img_id`, `img_nom`, `img_chemin`, `tim_id`) VALUES
(1, 'timbre-placeholder.jpg', 'E:\\xampp\\tmp\\phpAD4B.tmp', 1),
(2, '1908-quebec-1700-1908-10-cents-g.jpg', 'E:\\xampp\\tmp\\phpA8D2.tmp', 2),
(3, '1946-farm-scene-1946-8-cents-g.jpg', 'E:\\xampp\\tmp\\phpC186.tmp', 3),
(4, '1948-george-vi.jpg', 'E:\\xampp\\tmp\\php16A7.tmp', 4),
(5, '1954-queen-elizabeth.jpg', 'E:\\xampp\\tmp\\php87BD.tmp', 5),
(6, '1962-queen-elizabeth.jpg', 'E:\\xampp\\tmp\\phpCF22.tmp', 6),
(7, '1311137-Timbre_à_leffigie_de_Charles_Péguy.jpg', 'E:\\xampp\\tmp\\php6AD9.tmp', 7),
(9, 'AERIEN-1946-1.jpg', 'E:\\xampp\\tmp\\phpB1C4.tmp', 9),
(10, 'canada-stamp-311-trains-of-1851-and-1951-4-1951.jpg', 'E:\\xampp\\tmp\\phpA117.tmp', 10),
(11, 'canada-vers-1966-un-timbre-poste-du-canada-affiche-conference-de-londres-1866-fk7wpm.jpg', 'E:\\xampp\\tmp\\phpBB52.tmp', 11),
(13, 'e011196838-v8.jpg', '', 13),
(15, 'POSTE-1958-9.jpg', 'E:\\xampp\\tmp\\php38F0.tmp', 15),
(16, 'Czechoslovakia 1971 Weiner a.jpg', '', 16),
(17, 'president-roosevelt-on-old-stamp-of-nicaagua-2J6FPMX.jpg', 'E:\\xampp\\tmp\\php1854.tmp', 17),
(18, 'Stamp_1942_DRBM_MiNr0094_mt_B002.jpg', 'E:\\xampp\\tmp\\phpF75A.tmp', 18),
(20, 'canada-stamp.jpg', '', 20);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `rol_id` int(11) NOT NULL,
  `rol_nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`rol_id`, `rol_nom`) VALUES
(3, 'admin'),
(4, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `timbre`
--

CREATE TABLE `timbre` (
  `tim_id` int(11) NOT NULL,
  `tim_nom` varchar(100) NOT NULL,
  `tim_description` longtext NOT NULL,
  `tim_date_creation` int(4) NOT NULL,
  `tim_pays` varchar(100) NOT NULL,
  `tim_couleur` varchar(100) NOT NULL,
  `tim_condition` set('Entièrement neuf','Comme neuf','Très bon','Bon Acceptable') NOT NULL,
  `tim_dimension` varchar(100) NOT NULL,
  `tim_certifie` tinyint(1) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `timbre`
--

INSERT INTO `timbre` (`tim_id`, `tim_nom`, `tim_description`, `tim_date_creation`, `tim_pays`, `tim_couleur`, `tim_condition`, `tim_dimension`, `tim_certifie`, `userId`) VALUES
(1, 'voilier', 'Macaroon croissant gingerbread soufflé carrot cake cookie gingerbread. Danish tart dessert biscuit pastry. Cookie jujubes soufflé chocolate brownie apple pie sweet pie pastry', 1942, 'Royaume-Unis', 'bleu', 'Entièrement neuf', '55 X 24', 1, 1),
(2, 'quebecEpoque', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Consequat semper viverra nam libero. Aliquet risus feugiat in ante metus. Laoreet non curabitur gravida arcu ac. Velit egestas dui id ornare.', 1924, 'Canada', 'violet', 'Comme neuf', '60 X 40', 1, 3),
(3, 'ferme', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Consequat semper viverra nam libero. Aliquet risus feugiat in ante metus. Laoreet non curabitur gravida arcu ac. Velit egestas dui id ornare', 1850, 'Canada', 'orange', 'Très bon', '30 X 56', 0, 3),
(4, 'roiGeorge', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Consequat semper viverra nam libero.', 1937, 'Royaume-Unis', 'vert', 'Entièrement neuf', '45 X 74', 1, 3),
(5, 'reineJeune', 'Aliquet risus feugiat in ante metus. Laoreet non curabitur gravida arcu ac. Velit egestas dui id ornare', 1950, 'Canada', 'vert', 'Bon Acceptable', '30 X 35', 0, 3),
(6, 'reine Epoque', 'Lorem ipsum dolor sit amet, Laoreet non curabitur gravida arcu ac. Velit egestas dui id ornare. Consectetur adipiscing elit, sed do eiusmod tempor incididunt.', 1946, 'Royaume-Unis', 'violet', 'Comme neuf', '60 X 40', 1, 3),
(7, 'CharlesPeguy', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1985, 'France', 'gris', 'Comme neuf', '55 X 36', 1, 2),
(9, 'Ange avion', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1970, 'Australie', 'rouge', 'Très bon', '30 X 84', 1, 2),
(10, 'train', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1935, 'Canada', 'gris', 'Très bon', '45 X 78', 0, 2),
(11, 'lordConference', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1952, 'Royaume-Unis', 'brun', 'Comme neuf', '55 X 40', 1, 2),
(13, 'MinistreCanada', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1944, 'Canada', 'brun', 'Comme neuf', '60 X 40', 0, 1),
(15, 'ChateauFrance', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1875, 'France', 'bleu', 'Entièrement neuf', '30 X 56', 1, 1),
(16, 'Penseur', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 0, 'Russie', 'bleu', 'Comme neuf', '30 X 56', 0, 1),
(17, 'PresidentNicaragua', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1898, 'Nicaragua', 'bleu', 'Très bon', '40 X 68', 0, 1),
(18, 'Hitler', 'Metus vulputate eu scelerisque felis imperdiet proin fermentum. Laoreet suspendisse interdum consectetur libero. Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. Mauris a diam maecenas sed.', 1939, 'Allemagne', 'rouge', 'Entièrement neuf', '60 X 40', 1, 1),
(20, 'canard', 'adsfsdf alkklfjdajka lakj fdlkajsdfk asldkfj adf', 1992, 'canada', 'bleu', 'Très bon', '30 X 56', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `uti_id` int(11) NOT NULL,
  `uti_courriel` varchar(100) NOT NULL,
  `uti_mdp` varchar(100) NOT NULL,
  `uti_prenom` varchar(100) NOT NULL,
  `uti_nom` varchar(100) NOT NULL,
  `uti_status` tinyint(4) NOT NULL,
  `uti_rol_id_ce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`uti_id`, `uti_courriel`, `uti_mdp`, `uti_prenom`, `uti_nom`, `uti_status`, `uti_rol_id_ce`) VALUES
(1, 'admin@admin.com', '$2y$10$uey5L.xhBc./E5fq.7cnKuYt51T8l5HjwhB3Qblh.9r2.PUEr17Zu', 'admin', 'admin', 1, 3),
(2, 'test@test.com', '$2y$10$Vxe3dkqqznprDzoMXqzf8.Dura7SUKzr2.K8siCl0aNJHw8T0WS/u', 'test', 'test', 1, 4),
(3, 'annabellegamache@gmail.com', '$2y$10$yYUyPAqrMm3FNc1ojpz/Se4kqCFC.2Tf3i3cHy9SRgKj3dHvSMYAy', 'Annabelle', 'Gamache', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `uti_mise_enc`
--

CREATE TABLE `uti_mise_enc` (
  `mise_id` int(11) NOT NULL,
  `enc_id` int(11) NOT NULL,
  `uti_id` int(11) NOT NULL,
  `uti_mise_date` datetime NOT NULL,
  `uti_enc_prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uti_mise_enc`
--

INSERT INTO `uti_mise_enc` (`mise_id`, `enc_id`, `uti_id`, `uti_mise_date`, `uti_enc_prix`) VALUES
(7, 5, 1, '2022-09-28 13:14:42', 850),
(8, 5, 1, '2022-09-28 13:15:28', 900),
(9, 5, 1, '2022-09-28 13:34:13', 900),
(10, 6, 1, '2022-09-28 13:40:34', 850),
(11, 6, 1, '2022-09-28 13:40:56', 850),
(12, 8, 1, '2022-09-28 13:57:48', 750);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`enc_id`),
  ADD UNIQUE KEY `tim_id` (`enc_tim_id`),
  ADD KEY `enc_id` (`enc_id`),
  ADD KEY `enc_ce_tim_id` (`enc_tim_id`),
  ADD KEY `enc_ce_cat_id_ce` (`enc_ce_cat_id`),
  ADD KEY `enc_ce_uti_id` (`userId`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `image_ibfk_1` (`tim_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`rol_id`);

--
-- Index pour la table `timbre`
--
ALTER TABLE `timbre`
  ADD PRIMARY KEY (`tim_id`),
  ADD KEY `tim_ce_uti_id` (`userId`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`uti_id`),
  ADD KEY `uti_rol_id_ce` (`uti_rol_id_ce`);

--
-- Index pour la table `uti_mise_enc`
--
ALTER TABLE `uti_mise_enc`
  ADD PRIMARY KEY (`mise_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `enc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `timbre`
--
ALTER TABLE `timbre`
  MODIFY `tim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `uti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `uti_mise_enc`
--
ALTER TABLE `uti_mise_enc`
  MODIFY `mise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`tim_id`) REFERENCES `timbre` (`tim_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`uti_rol_id_ce`) REFERENCES `role` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
