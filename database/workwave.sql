-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 21 mai 2025 à 10:53
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `workwave`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id_candidat` int(11) NOT NULL,
  `nom_candidat` varchar(50) NOT NULL,
  `prenom_candidat` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `photo_candidat` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `email_candidat` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `cv` varchar(50) NOT NULL,
  `autres` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id_candidat`, `nom_candidat`, `prenom_candidat`, `age`, `photo_candidat`, `specialite`, `pays`, `email_candidat`, `genre`, `cv`, `autres`) VALUES
(4, 'Lemrani', 'Amira', 20, '681f7c6e52375_houdaa.png', 'Etudiante', 'Maroc', 'amiralemrani1@gmail.com', 'Femme', '681f7c6e544fe_Document1.pdf', 'Bac2021'),
(5, 'Lamrini', 'Houda', 20, '681f7d998570d_houdaa2.png', 'Etudiante', 'Maroc', 'houdalamrini8@gmail.com', 'Femme', '681f7d9987c8a_Document1.pdf', 'Bac2022'),
(6, 'Amrani', 'Mehdi', 22, '681f7efc5141b_mehddiii.png', 'Etudiant', 'Maroc', 'amranimehdi2@gmail.com', 'Homme', '681f7efc52406_Document1.pdf', 'Bac2021'),
(7, 'Houda', 'Amira', 21, '6823cc428deb8_pfe.png', 'Etudiante', 'Maroc', 'pfe@gmail.com', 'Femme', '6823cc428fc1e_Document1.pdf', 'Bac2021'),
(12, 'Bennaani', 'Amine', 24, '6828b2dc2521b_Amine.png', 'Developpement Web ', 'Maroc', 'amine@gmail.com', 'Homme', '6828b2dc26be0_Document1.pdf', 'Disponible immediatement');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_offre`, `contenu`, `date_commentaire`, `id_utilisateur`) VALUES
(1, 47, 'c\'est un bon Offre', '2025-05-13 23:37:00', 17),
(2, 47, 'Exactement ce que je cherchais', '2025-05-14 01:04:11', 23);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom_entreprise` varchar(50) NOT NULL,
  `domaine` varchar(50) NOT NULL,
  `email_entreprise` varchar(50) NOT NULL,
  `photo_entreprise` varchar(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `horaire` varchar(50) NOT NULL,
  `siteweb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `domaine`, `email_entreprise`, `photo_entreprise`, `statut`, `adresse`, `horaire`, `siteweb`) VALUES
(43, 'MARJANE', 'Grande distribution', 'marjane1@gmail.com', '681f567f3ff74_MARJANE.png', 'Active', 'Fes,Maroc', '09:00-21:00', 'https://www.marjane.ma'),
(44, 'BIM', 'Distribution alimentaire', 'bim1@gmail.com', '681f76778c689_BIM.png', 'Active', 'Rabat,Maroc', '09:00-21:00', 'https://www.bim.ma'),
(45, 'BMW', 'Automobile', 'bmw@gmail.com', '681f78b420cbf_BMW.png', 'Active', 'Munich, Allemagne', '08:00 - 18:00', 'https://www.bmw.com/'),
(46, 'BINOME2', 'Developpement', 'pfe2@gmail.com', '6823d2be414ad_pic.png', 'Active', 'Fes,Maroc', '09:00 - 21:00', 'https://www.binome.com/'),
(49, 'Maroc Telecom', 'Telecomunication', 'iam@gmail.com', '68289cac080f1_IAM.png', 'Active', 'Rabat,Maroc', '09:00 - 21:00', 'www.iam.ma');

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id_offre` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `salaire` int(11) NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `type_contrat` varchar(50) NOT NULL,
  `date_publication` varchar(50) NOT NULL,
  `autres` varchar(50) NOT NULL,
  `doc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`id_offre`, `id_entreprise`, `titre`, `description`, `salaire`, `lieu`, `type_contrat`, `date_publication`, `autres`, `doc`) VALUES
(47, 43, 'Caissier(e)', 'Gestion de caisse ', 4000, 'Fes', 'CDI', '2025-05-10', 'Travail en equipe', '681f567f475c6_Document1.pdf'),
(48, 43, 'Responsable de rayon', 'Supervision des stocks', 6000, 'Fes', 'CDI', '2025-05-11', 'Travail en Ã©quipe', '681f63c730d1f_Document1.pdf'),
(49, 43, 'Agent de sÃ©curitÃ©', 'Surveillance des clients', 4500, 'Fes', 'CDD', '2025-05-08', 'Travail par roulement', '681f6483c2fe5_Document1.pdf'),
(50, 44, 'Vendeur rayon alimentaire', 'Mise en rayon ', 3900, 'RABAT', 'CDD', '2025-05-02', 'Formation assurÃ©e', '681f76778e864_Document1.pdf'),
(51, 44, 'Assistant de magasin', 'la gestion du point de vente', 4800, 'Agadir', 'CDI', '2025-05-04', 'Ã‰volution vers poste de gÃ©rant', '681f773937446_Document1.pdf'),
(52, 45, 'Technicien automobile', 'Entretien  vÃ©hicules', 9000, 'Munich', 'CDI', '2025-05-01', '2 ans d\'expÃ©rience requis', '681f78b421632_Document1.pdf'),
(53, 45, 'IngÃ©nieur mÃ©canique', 'Conception  de moteurs', 12000, 'Munich', 'CDI', '2025-05-24', 'ExpÃ©rience 3+ ans requise', '681f797500f92_Document1.pdf'),
(54, 45, 'ChargÃ© de qualitÃ©', 'ContrÃ´le qualitÃ© ', 9500, 'Leipzig', 'CDI', '2025-05-31', 'Formation interne assurÃ©e', '681f79f29661f_Document1.pdf'),
(55, 45, 'Assistant commercial', 'Support aux ventes ', 8500, 'Berlin', 'CDD', '2025-05-28', 'Bon niveau dâ€™allemand requis', '681f7a8ba846d_Document1.pdf'),
(58, 49, 'Technicien Reseau', 'bac+2 en reseau et telecoms requis', 5000, 'Rabat', 'CDD', '2025-05-14', 'Rien', '68289cac0854c_Document1.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `id_candidat` int(11) DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `user_type` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `id_candidat`, `id_entreprise`, `name`, `password`, `email`, `user_type`) VALUES
(16, 4, NULL, 'LEMRANI', '$2y$10$vHtnXPCN7jjm9GRCA4k93uC.XjFDsDzvKC2xipO8YgERXByNV833O', 'amiralemarni1@gmail.com', 'candidat'),
(17, 5, NULL, 'LAMRINI', '$2y$10$4nk4j0SHtwJ2k//DmtPGquBYwm/3dv6N/hri1GshrfTl9LzTAkisO', 'houdalamrini8@gmail.com', 'candidat'),
(18, 6, NULL, 'AMRANI', '$2y$10$gCJb073Eo96IKN0RJ4tiuO9/RgGUjvvqntzu.48FPBq4qLCZhGuFm', 'houdalamrini9@gmail.com', 'candidat'),
(19, NULL, 43, 'MARJANE', '$2y$10$EArHUWcGg/ECNQR9e4XFb.j8ip.0Qr7NIHo1i5jFdT6DyMFUyAi9y', 'marjane1@gmail.com', 'entreprise'),
(20, NULL, 44, 'BIM', '$2y$10$ZG.HhJ.brfeyuWBBjAGYlOevlb/avoth6wVuA2v80KEKhA0KitEEO', 'bim1@gmail.com', 'entreprise'),
(21, NULL, 45, 'BMW', '$2y$10$oI.15VZGc6qwhsaH.5biuuN1msqYXhO07sjxiQ2gfvNweRhNWTRyC', 'bmw@gmail.com', 'entreprise'),
(22, NULL, NULL, 'AXA', '$2y$10$tdYG7d8B38B5nIVqrVUCsuC3YeS/ArgYRSDPyBun9.fQ5jzkqpMne', 'axa@gmail.com', 'entreprise'),
(23, 7, NULL, 'BINOME', '$2y$10$A9o.71rK4.pCBqb0rPCM/.G8Kc.XCd/g1g.ckkSXnoeyK9UJpy6hq', 'pfe@gmail.com', 'candidat'),
(24, NULL, 46, 'BINOME2', '$2y$10$Z8YJk90WSlqGcsmimzs8euHG1xyxw645euHZehfDnJT6LXt9b5hPG', 'pfe2@gmail.com', 'entreprise'),
(29, NULL, 49, 'IAM', '$2y$10$Zy4eRvQHmXTBkfNaeVqGaePVAgugETbJ5sjJ2c7FCiEN9wVFSq9BC', 'iam@gmail.com', 'entreprise'),
(35, 12, NULL, 'AMINE', '$2y$10$8jRJPBRn7nEMNHskMJ0.h.DRU0aURChGi8Qe2Vy8UK3vrxqy1hctG', 'amine@gmail.com', 'candidat');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id_candidat`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_offre` (`id_offre`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `id_entrepris` (`id_entreprise`) USING BTREE;

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `unique_name` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_candidat` (`id_candidat`),
  ADD KEY `id_entreprise` (`id_entreprise`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id_candidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `id_offre` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`),
  ADD CONSTRAINT `id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `id_candidat` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id_candidat`),
  ADD CONSTRAINT `id_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
