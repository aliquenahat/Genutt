-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 22 Mai 2014 à 17:16
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `genutt`
--

-- --------------------------------------------------------

--
-- Structure de la table `ec`
--

CREATE TABLE IF NOT EXISTS `ec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `bureau` varchar(30) NOT NULL,
  `pole` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bureau` (`bureau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etu`
--

CREATE TABLE IF NOT EXISTS `etu` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `programme` varchar(3) NOT NULL,
  `semestre` smallint(6) NOT NULL,
  `id_ec` int(11) DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

CREATE TABLE IF NOT EXISTS `habilitation` (
  `id_ec` int(11) NOT NULL,
  `programme` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `programme` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `motdepasse`, `categorie`, `programme`) VALUES
(1, 'drh', '19e8170b3975f5a24906acea19ec2df9a77a603a ', 'drh', ''),
(2, 'Lemercier', '19e8170b3975f5a24906acea19ec2df9a77a603a', 'responsable', 'ISI'),
(3, 'scolarite', '19e8170b3975f5a24906acea19ec2df9a77a603a', 'scolarite', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
