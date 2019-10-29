-- Nom du fichier: bd_art_public.sql
-- Auteur: Michel Plamondon
-- Date: 6 septembre 2019
-- Base de données :  `artpublicmtl`

SET SQL_MODE = `NO_AUTO_VALUE_ON_ZERO`;
SET time_zone = `+00:00`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- ****************************** --
-- Base de données :  `artpublicmtl`
-- ****************************** --
CREATE DATABASE IF NOT EXISTS `artpublicmtl` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `artpublicmtl`;

-- Création de la table categorie
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
    id_categorie INT AUTO_INCREMENT,
    nom_francais VARCHAR(50) NOT NULL UNIQUE,
    nom_anglais VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY(id_categorie)
);

-- Création de la table type_support
DROP TABLE IF EXISTS `type_support`;
CREATE TABLE IF NOT EXISTS `type_support` (
    id_support INT AUTO_INCREMENT,
    nom_francais VARCHAR(50) NOT NULL UNIQUE,
    nom_anglais VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY(id_support)
);

-- Création de la table materiaux
DROP TABLE IF EXISTS `materiaux`;
CREATE TABLE IF NOT EXISTS `materiaux` (
    id_materiaux INT AUTO_INCREMENT,
    nom_francais VARCHAR(100) NOT NULL UNIQUE,
    nom_anglais VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY(id_materiaux)
);

-- Création de la table technique
DROP TABLE IF EXISTS `technique`;
CREATE TABLE IF NOT EXISTS `technique` (
    id_technique INT AUTO_INCREMENT,
    nom_francais VARCHAR(100) NOT NULL UNIQUE,
    nom_anglais VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY(id_technique)
);

-- Création de la table artiste
DROP TABLE IF EXISTS `artiste`;
CREATE TABLE IF NOT EXISTS `artiste` (
    id_artiste INT AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    nom_collectif VARCHAR(50),
    biographie TEXT,
    biographie_anglais TEXT,
    PRIMARY KEY(id_artiste)
);

-- Création de la table role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
    id_role INT AUTO_INCREMENT,
    type_acces VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY(id_role)
);

-- Création de la table usager
DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
    id_usager INT AUTO_INCREMENT,
    nom_connexion VARCHAR(50) NOT NULL UNIQUE,
    mot_passe VARCHAR(100) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NULL,
    courriel VARCHAR(50) NULL,
    id_role INT NOT NULL,
    PRIMARY KEY(id_usager),
    FOREIGN KEY(id_role) REFERENCES role(id_role)
);

-- Création de la table arrondissement
DROP TABLE IF EXISTS `arrondissement`;
CREATE TABLE IF NOT EXISTS `arrondissement` (
    id_arrondissement INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY(id_arrondissement)
);

-- Création de la table endroit
DROP TABLE IF EXISTS `endroit`;
CREATE TABLE IF NOT EXISTS `endroit` (
    id_endroit INT AUTO_INCREMENT,
    parc VARCHAR(100),
    batiment VARCHAR(100),
    adresse VARCHAR(100),
    coordonnee_latitude VARCHAR(15) NOT NULL,
    coordonnee_longitude VARCHAR(15) NOT NULL,
    id_arrondissement INT NOT NULL,
    PRIMARY KEY(id_endroit),
    FOREIGN KEY(id_arrondissement) REFERENCES arrondissement(id_arrondissement)    
);

-- Création de la table oeuvre
DROP TABLE IF EXISTS `oeuvre`;
CREATE TABLE IF NOT EXISTS `oeuvre` (
    id_oeuvre INT AUTO_INCREMENT,
    titre VARCHAR(50) NOT NULL,
    dimension VARCHAR(50) NOT NULL,
    description_francais TEXT,
    description_anglais TEXT,
    date_oeuvre TIMESTAMP,
    id_categorie INT NOT NULL,
    id_support INT,
    id_endroit INT NOT NULL,
    PRIMARY KEY(id_oeuvre),
    FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie),
    FOREIGN KEY(id_support) REFERENCES support(id_support),
    FOREIGN KEY(id_endroit) REFERENCES endroit(id_endroit)
);

-- Création de la table image
DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
    id_image INT AUTO_INCREMENT,
    nom_fichier VARCHAR(50) NOT NULL UNIQUE,
    id_oeuvre INT NOT NULL,
    PRIMARY KEY(id_image),
    FOREIGN KEY(id_oeuvre) REFERENCES oeuvre(id_oeuvre)
);

-- Création de la table parcours
DROP TABLE IF EXISTS `parcours`;
CREATE TABLE IF NOT EXISTS `parcours` (
    id_parcours INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    PRIMARY KEY(id_parcours)
);

-- Création de la table parcours_endroit
DROP TABLE IF EXISTS `parcours_endroit`;
CREATE TABLE IF NOT EXISTS `parcours_endroit` (
    id_parcours INT NOT NULL,
    id_endroit INT NOT NULL,
    id_usager INT NOT NULL,
    createur VARCHAR(50) NOT NULL,
    PRIMARY KEY(id_parcours, id_endroit),
    FOREIGN KEY(id_parcours) REFERENCES parcours(id_parcours),
    FOREIGN KEY(id_endroit) REFERENCES endroit(id_endroit),
    FOREIGN KEY(id_usager) REFERENCES usager(id_usager)
);

-- Création de la table artiste_oeuvre
DROP TABLE IF EXISTS `artiste_oeuvre`;
CREATE TABLE IF NOT EXISTS `artiste_oeuvre` (
    id_artiste INT NOT NULL,
    id_oeuvre INT NOT NULL,
    PRIMARY KEY(id_artiste, id_oeuvre),
    FOREIGN KEY(id_artiste) REFERENCES artiste(id_artiste),
    FOREIGN KEY(id_oeuvre) REFERENCES oeuvre(id_oeuvre)
);

-- Création de la table favoris
DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
    id_usager INT NOT NULL,
    id_oeuvre INT NOT NULL,
    PRIMARY KEY(id_usager, id_oeuvre),
    FOREIGN KEY(id_usager) REFERENCES usager(id_usager),
    FOREIGN KEY(id_oeuvre) REFERENCES oeuvre(id_oeuvre)
);

-- Création de la table commentaire
DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
    id_commentaire INT AUTO_INCREMENT,
    id_usager INT NOT NULL,
    id_oeuvre INT NOT NULL,
    texte TEXT NOT NULL,
    PRIMARY KEY(id_commentaire),
    FOREIGN KEY(id_usager) REFERENCES usager(id_usager),
    FOREIGN KEY(id_oeuvre) REFERENCES oeuvre(id_oeuvre)
);

-- Création de la table oeuvre_materiaux
DROP TABLE IF EXISTS `oeuvre_materiaux`;
CREATE TABLE IF NOT EXISTS `oeuvre_materiaux` (
    id_materiaux INT NOT NULL,
    id_oeuvre INT NOT NULL,
    PRIMARY KEY(id_materiaux, id_oeuvre),
    FOREIGN KEY(id_materiaux) REFERENCES materiaux(id_materiaux),
    FOREIGN KEY(id_oeuvre) REFERENCES oeuvre(id_oeuvre)
);

-- Création de la table oeuvre_technique
DROP TABLE IF EXISTS `oeuvre_technique`;
CREATE TABLE IF NOT EXISTS `oeuvre_technique` (
    id_technique INT NOT NULL,
    id_oeuvre INT NOT NULL,
    PRIMARY KEY(id_technique, id_oeuvre),
    FOREIGN KEY(id_technique) REFERENCES technique(id_technique),
    FOREIGN KEY(id_oeuvre) REFERENCES oeuvre(id_oeuvre)
);

-- Insertion dans la table de role
INSERT INTO `role` (`type_acces`) VALUES ('modérateur'),('admin'),('usager');

-- Insertion dans la table d'usager
INSERT INTO `usager` (`nom_connexion`, `mot_passe`, `nom`, `prenom`, `courriel`, `id_role`) VALUES
('modo', 'modo', 'modérateur', 'super', 'modo@hotmail.com', 1),
('admin', 'admin', 'administrateur', 'adminart', 'admin@hotmail.com', 2),
('usager', 'usager', 'usager1', 'sanspouvoir', 'usager@hotmail.com', 3);