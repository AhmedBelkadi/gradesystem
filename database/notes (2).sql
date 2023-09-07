-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 07 sep. 2023 à 14:07
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `notes`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `NumCours` int(11) NOT NULL,
  `Salle` varchar(50) DEFAULT NULL,
  `MatriculeProfesseur` int(11) DEFAULT NULL,
  `Titre` varchar(50) DEFAULT NULL,
  `Coef` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`NumCours`, `Salle`, `MatriculeProfesseur`, `Titre`, `Coef`) VALUES
(1, 'k505', 6, 'INFORMATIQUE', 4),
(11, 'k505', 6, 'ALGORITHME', 4);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `CodeEtudiant` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Date_naiss` date DEFAULT NULL,
  `Tel` varchar(20) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`CodeEtudiant`, `Nom`, `Date_naiss`, `Tel`, `mail`) VALUES
(2, 'Johnson', '1999-08-20', '987654321', 'johnson@example.com'),
(3, 'Davis', '2000-01-15', '000000000000000', 'davis@example.com'),
(8, 'Lee', '2005-09-18', '654789321', 'lee@example.com'),
(55, 'hh', '2023-09-05', '0699887766', 'ehhhhhhhhhhhhhhh@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE `examen` (
  `CodeEtudiant` int(11) NOT NULL,
  `NumCours` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Note` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `MatriculeProfesseur` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Tel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`MatriculeProfesseur`, `Nom`, `Tel`) VALUES
(1, 'Harrison', '0697755345633'),
(6, 'Moore', '555-2345'),
(7, 'mouad', '555-7890000'),
(10, 'Allen', '555-8901'),
(11, 'ahmed', '0699887766'),
(33330000, 'Harrisooo', '06977553456');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`NumCours`),
  ADD KEY `cours_ibfk_1` (`MatriculeProfesseur`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`CodeEtudiant`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`CodeEtudiant`,`NumCours`),
  ADD KEY `examen_ibfk_2` (`NumCours`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`MatriculeProfesseur`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`MatriculeProfesseur`) REFERENCES `professeur` (`MatriculeProfesseur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `examen_ibfk_1` FOREIGN KEY (`CodeEtudiant`) REFERENCES `etudiant` (`CodeEtudiant`) ON DELETE CASCADE,
  ADD CONSTRAINT `examen_ibfk_2` FOREIGN KEY (`NumCours`) REFERENCES `cours` (`NumCours`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
