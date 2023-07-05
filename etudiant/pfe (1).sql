-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 juin 2021 à 01:45
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `CNE` varchar(10) NOT NULL,
  `Code_Mat` varchar(15) NOT NULL,
  `Date_absence` date NOT NULL,
  `Nombre_heures` int(11) NOT NULL,
  `Justification` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`CNE`, `Code_Mat`, `Date_absence`, `Nombre_heures`, `Justification`) VALUES
('ABC123', '4', '2021-05-22', 4, ''),
('ABC123', '6', '2021-05-21', 2, 'Certificat Maladie'),
('ABC123', '6', '2021-05-22', 4, ''),
('ABC456', '4', '2021-05-22', 2, ''),
('ABC456', '5', '2021-05-29', 2, ''),
('ABC456', '6', '2021-05-21', 4, ''),
('ABC789', '4', '2021-05-22', 2, ''),
('ABC789', '6', '2021-05-21', 2, ''),
('ABC789', '6', '2021-05-22', 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `Id_annonce` int(10) NOT NULL,
  `Annonce` varchar(200) DEFAULT NULL,
  `Date_annonce` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
  `Id_class` varchar(10) NOT NULL,
  `Code_Filiere` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`Id_class`, `Code_Filiere`) VALUES
('GI1', '1'),
('GI2', '1'),
('GILP', '1'),
('GIM1', '2'),
('GIM2', '2'),
('GIMLP', '2'),
('TM1', '3'),
('TM2', '3'),
('TMLP', '3'),
('TIMQ1', '4'),
('TIMQ2', '4'),
('TIMQLP', '4');

-- --------------------------------------------------------

--
-- Structure de la table `classeannonce`
--

CREATE TABLE `classeannonce` (
  `Id_class` varchar(10) NOT NULL,
  `Id_annonce` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `demmande`
--

CREATE TABLE `demmande` (
  `Id_demmande` int(15) NOT NULL,
  `Date_demmande` date NOT NULL,
  `Etat` varchar(20) NOT NULL,
  `Lien` varchar(50) NOT NULL,
  `CNE` varchar(10) NOT NULL,
  `Id_type` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `demmande`
--

INSERT INTO `demmande` (`Id_demmande`, `Date_demmande`, `Etat`, `Lien`, `CNE`, `Id_type`) VALUES
(1, '2021-06-12', 'Non traite', '', 'D130000000', 1),
(2, '2021-06-13', 'Non traite', '', 'D130000000', 1),
(3, '2021-05-30', 'Non traite\r\n', '', 'D130000001', 1),
(4, '2021-06-17', '<br />\r\n<b>Notice</b', '', 'D130000000', 1),
(5, '2021-06-17', '<br />\r\n<b>Notice</b', '', 'D130000000', 1),
(6, '2021-06-17', '<br />\r\n<b>Notice</b', '', 'D130000000', 2),
(7, '2021-06-17', 'NON Traiter', '', 'D130000000', 2);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id_doc` int(11) NOT NULL,
  `lien_doc` varchar(256) CHARACTER SET utf8mb4 NOT NULL,
  `id_type` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id_doc`, `lien_doc`, `id_type`) VALUES
(1, 'RH1902021_Responsableelearning.pdf', 1),
(2, 'cv+hicham+_2.pdf', 2);

-- --------------------------------------------------------

--
-- Structure de la table `dtype`
--

CREATE TABLE `dtype` (
  `Id_type` int(15) NOT NULL,
  `Nom_demmande` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dtype`
--

INSERT INTO `dtype` (`Id_type`, `Nom_demmande`) VALUES
(1, 'Attestation de stage'),
(2, 'Convention de stage');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `CNE` varchar(10) NOT NULL,
  `CNI` varchar(10) NOT NULL,
  `Avatar` varchar(100) NOT NULL DEFAULT 'assets/images/default.png',
  `N_tele` int(10) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(256) NOT NULL,
  `Date_Nais` date NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Bac_Annee` int(4) NOT NULL,
  `Bac_Mention` varchar(15) NOT NULL,
  `Bac_Filiere` varchar(50) NOT NULL,
  `Bac_Option` varchar(50) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Nom_AR` varchar(50) NOT NULL,
  `Prenom_AR` varchar(50) NOT NULL,
  `Ville_Origine` varchar(50) NOT NULL,
  `Ville_Origine_AR` varchar(50) NOT NULL,
  `Ville_Actuelle` varchar(50) NOT NULL,
  `Addresse` varchar(200) NOT NULL,
  `Id_class` varchar(10) NOT NULL,
  `Bac_scan` varchar(255) NOT NULL,
  `Carte_scan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`CNE`, `CNI`, `Avatar`, `N_tele`, `email`, `password`, `Date_Nais`, `Role`, `Bac_Annee`, `Bac_Mention`, `Bac_Filiere`, `Bac_Option`, `Nom`, `Prenom`, `Nom_AR`, `Prenom_AR`, `Ville_Origine`, `Ville_Origine_AR`, `Ville_Actuelle`, `Addresse`, `Id_class`, `Bac_scan`, `Carte_scan`) VALUES
('D130000000', 'JB000000', 'images/D130000000.png', 605962809, 'oussama122@gmail.com', 'agadir ', '2001-01-23', '1ère année', 2018, 'Bien', 'Bac sciences physiques', 'Arabe', 'EL-AJI', 'Oussama', 'العاجي', 'أسامة', 'Taounate', 'تاونات', 'Agadir', 'agadir Maroc', 'GI1', 'images/D130000000Bac.png', 'images/D130000000Carte.png'),
('D130000001', 'JB000001', 'assets/images/default.png', 623755298, 'elajio9@gmail.com', '8dfe50c813caa72e93bb96f700358c51cc91cf0fb66a3c6dea15e12c5629b782', '2002-01-23', '1ère année', 2019, 'Très Bien', 'Bac sciences physiques', 'Français', 'Allami', 'Anas', 'العالمي', 'انس', 'Marrakech', 'مراكش', 'Safi', 'Safi', 'GIM2', '', ''),
('K134452863', 'azer1234', 'assets/images/default.png', 605962804, 'bouzianeamina631@gmail.com', '2d2b6a990379ccc054fdf81ef0c030b6d085d5009852a692cfe9e8edc737fdcc', '2001-06-13', '1ère année', 0, '', '', '', '', '', '', '', '', '', '', 'Safi 101,blad eljed', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `etudiantnotif`
--

CREATE TABLE `etudiantnotif` (
  `CNE` varchar(10) NOT NULL,
  `Id_notification` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiantnotif`
--

INSERT INTO `etudiantnotif` (`CNE`, `Id_notification`) VALUES
('ABC123', 1),
('ABC123', 2),
('ABC123', 3);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
  `Id_eval` int(15) NOT NULL,
  `Nom_eval` varchar(50) NOT NULL,
  `Coef_eval` varchar(10) NOT NULL,
  `Code_Mat` varchar(15) NOT NULL,
  `CNE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `Code_Filiere` varchar(10) NOT NULL,
  `Nom_Filiere` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`Code_Filiere`, `Nom_Filiere`) VALUES
('1', 'Génie Informatique'),
('2', 'GIM'),
('3', 'TM'),
('4', 'TIMQ');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `Code_Mat` varchar(15) NOT NULL,
  `Nom_Mat` varchar(50) NOT NULL,
  `coeffMat` float NOT NULL,
  `Num_module` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`Code_Mat`, `Nom_Mat`, `coeffMat`, `Num_module`) VALUES
('1', 'Algorithme ', 0.5, '1'),
('2', 'Langage de programation', 0.5, '1'),
('3', 'Automatismes logique', 0.4, '2'),
('4', 'Architecture des ordinateurs', 0.6, '2'),
('5', 'Analyse', 0.35, '3'),
('6', 'Algèbre', 0.45, '3'),
('7', 'Probabilités', 0.2, '3'),
('8', 'Français', 0.35, '4'),
('9', 'TEC', 0.3, '4');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `Num_module` varchar(10) NOT NULL,
  `Nom_module` varchar(50) DEFAULT NULL,
  `Id_class` varchar(10) NOT NULL,
  `Code_Sem` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`Num_module`, `Nom_module`, `Id_class`, `Code_Sem`) VALUES
('1', 'Algorithmique et bases de la programmation', 'GI1', '1'),
('2', 'Architecture des ordinateurs', 'GI1', '1'),
('3', 'Mathématiques', 'GI1', '1'),
('4', 'Langues & TEC', 'GI1', '1');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `Id_notification` int(15) NOT NULL,
  `Notification` varchar(50) NOT NULL,
  `Date_notification` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`Id_notification`, `Notification`, `Date_notification`) VALUES
(1, 'Notification1', '2021-05-11'),
(2, 'Notification2', '2021-05-15'),
(3, 'Notification3', '2021-05-18');

-- --------------------------------------------------------

--
-- Structure de la table `rattmat`
--

CREATE TABLE `rattmat` (
  `CNE` varchar(10) NOT NULL,
  `Code_Mat` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `Id_Reclamation` int(10) NOT NULL,
  `Sujet` varchar(50) NOT NULL,
  `Reclamation` varchar(200) NOT NULL,
  `Date_reclamation` date NOT NULL,
  `CNE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`Id_Reclamation`, `Sujet`, `Reclamation`, `Date_reclamation`, `CNE`) VALUES
(1, 'reclamation 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultrices sagittis ex vitae congue.', '2021-05-31', 'D130000000'),
(2, 'Reclamation 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at nisi metus. Fusce tincidunt erat sit amet consequat condimentum. Etiam dignissim turpis eu porttitor mattis. Vivamus ut ex portt', '2021-05-29', 'D130000001'),
(3, 'AAAA', 'AAA', '2021-06-16', 'ABC123'),
(4, 'aaa', 'aaa', '2021-06-16', 'ABC123'),
(5, 'Amina', 'AAAA', '2021-06-17', 'D130000000');

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE `semestre` (
  `Code_Sem` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `semestre`
--

INSERT INTO `semestre` (`Code_Sem`) VALUES
('1'),
('2'),
('3'),
('4'),
('5'),
('6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`CNE`,`Code_Mat`,`Date_absence`),
  ADD KEY `Code_Mat` (`Code_Mat`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`Id_annonce`);

--
-- Index pour la table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`Id_class`),
  ADD KEY `Code_Filiere` (`Code_Filiere`);

--
-- Index pour la table `classeannonce`
--
ALTER TABLE `classeannonce`
  ADD PRIMARY KEY (`Id_class`,`Id_annonce`),
  ADD KEY `Id_annonce` (`Id_annonce`);

--
-- Index pour la table `demmande`
--
ALTER TABLE `demmande`
  ADD PRIMARY KEY (`Id_demmande`),
  ADD KEY `CNE` (`CNE`),
  ADD KEY `Id_type` (`Id_type`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `document_ibfk_2` (`id_type`);

--
-- Index pour la table `dtype`
--
ALTER TABLE `dtype`
  ADD PRIMARY KEY (`Id_type`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`CNE`,`CNI`),
  ADD KEY `Id_class` (`Id_class`);

--
-- Index pour la table `etudiantnotif`
--
ALTER TABLE `etudiantnotif`
  ADD PRIMARY KEY (`CNE`,`Id_notification`),
  ADD KEY `Id_notification` (`Id_notification`);

--
-- Index pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`Id_eval`),
  ADD KEY `Code_Mat` (`Code_Mat`),
  ADD KEY `CNE` (`CNE`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`Code_Filiere`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`Code_Mat`),
  ADD KEY `Num_module` (`Num_module`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`Num_module`),
  ADD KEY `Id_class` (`Id_class`),
  ADD KEY `Code_Sem` (`Code_Sem`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Id_notification`);

--
-- Index pour la table `rattmat`
--
ALTER TABLE `rattmat`
  ADD PRIMARY KEY (`CNE`,`Code_Mat`),
  ADD KEY `Code_Mat` (`Code_Mat`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`Id_Reclamation`),
  ADD KEY `CNE` (`CNE`);

--
-- Index pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`Code_Sem`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `demmande`
--
ALTER TABLE `demmande`
  MODIFY `Id_demmande` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `dtype`
--
ALTER TABLE `dtype`
  MODIFY `Id_type` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `Id_eval` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `Id_Reclamation` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`Code_Filiere`) REFERENCES `filiere` (`Code_Filiere`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`Num_module`) REFERENCES `module` (`Num_module`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`Id_class`) REFERENCES `class` (`Id_class`),
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`Code_Sem`) REFERENCES `semestre` (`Code_Sem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
