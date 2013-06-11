/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : alc

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-06-12 01:11:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `carrousel`
-- ----------------------------
DROP TABLE IF EXISTS `carrousel`;
CREATE TABLE `carrousel` (
  `url_images` varchar(200) DEFAULT NULL,
  `nom_images` varchar(200) DEFAULT NULL,
  `desc_images` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of carrousel
-- ----------------------------
INSERT INTO `carrousel` VALUES ('?page=presentation', 'captions.jpg', 'Exemple');
INSERT INTO `carrousel` VALUES ('?page=galerie&Theme=Moto', 'features.jpg', 'exemple 2');

-- ----------------------------
-- Table structure for `devis`
-- ----------------------------
DROP TABLE IF EXISTS `devis`;
CREATE TABLE `devis` (
  `num_devis` int(4) NOT NULL AUTO_INCREMENT,
  `nom_devis` varchar(32) NOT NULL,
  `prenom_devis` varchar(32) NOT NULL,
  `mail_devis` varchar(32) NOT NULL,
  `marque` varchar(32) NOT NULL,
  `modele` varchar(32) NOT NULL,
  `annee` int(4) NOT NULL,
  `budget_min` float NOT NULL,
  `budget_max` float NOT NULL,
  `description` text NOT NULL,
  `file1` text NOT NULL,
  `file2` text NOT NULL,
  `file3` text NOT NULL,
  `etat` int(1) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`num_devis`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of devis
-- ----------------------------
-- ----------------------------
-- Table structure for `image`
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `num_image` int(4) NOT NULL AUTO_INCREMENT,
  `num_projet` int(4) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`num_image`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of image
-- ----------------------------

-- ----------------------------
-- Table structure for `membre`
-- ----------------------------
DROP TABLE IF EXISTS `membre`;
CREATE TABLE `membre` (
  `num_membre` int(4) NOT NULL AUTO_INCREMENT,
  `nom_membre` varchar(32) NOT NULL,
  `prenom_membre` varchar(32) NOT NULL,
  `mail_membre` varchar(32) NOT NULL,
  `login_membre` varchar(16) NOT NULL,
  `mdp_membre` varchar(33) NOT NULL,
  `permission_membre` int(1) DEFAULT NULL,
  `runlevel` int(1) NOT NULL,
  `date_inscription` int(12) DEFAULT NULL,
  PRIMARY KEY (`num_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of membre
-- ----------------------------
INSERT INTO `membre` VALUES ('1', 'Journaud', 'Nicolas', 'nj@nj.fr', '', '098f6bcd4621d373cade4e832627b4f6', '1', '0', '1370795639');

-- ----------------------------
-- Table structure for `projet`
-- ----------------------------
DROP TABLE IF EXISTS `projet`;
CREATE TABLE `projet` (
  `num_projet` int(4) NOT NULL AUTO_INCREMENT,
  `nom_projet` varchar(32) NOT NULL,
  `num_vehicule` int(4) NOT NULL,
  `num_membre` int(4) NOT NULL,
  `theme` varchar(6) NOT NULL,
  `date_projet` int(4) NOT NULL,
  `description_projet` text NOT NULL,
  `motscles_projet` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `en_ligne` tinyint(1) NOT NULL,
  `progression` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`num_projet`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of projet
-- ----------------------------

-- ----------------------------
-- Table structure for `vehicule`
-- ----------------------------
DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE `vehicule` (
  `num_vehicule` int(4) NOT NULL AUTO_INCREMENT,
  `marque` varchar(20) NOT NULL,
  `modele` varchar(32) NOT NULL,
  `annee` int(4) NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`num_vehicule`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vehicule
-- ----------------------------
