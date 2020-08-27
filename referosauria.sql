-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 27 août 2020 à 18:20
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `referosauria`
--

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_categories`
--

DROP TABLE IF EXISTS `r3f3r0_categories`;
CREATE TABLE IF NOT EXISTS `r3f3r0_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_categories`
--

INSERT INTO `r3f3r0_categories` (`id`, `name`) VALUES
(4, 'Dinosaure'),
(5, 'Mammifère'),
(6, 'Réptile marin'),
(7, 'Réptile volant'),
(8, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_comments`
--

DROP TABLE IF EXISTS `r3f3r0_comments`;
CREATE TABLE IF NOT EXISTS `r3f3r0_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `postDate` datetime NOT NULL,
  `id_r3f3r0_users` int(11) NOT NULL,
  `id_r3f3r0_creatures` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `r3f3r0_comments_r3f3r0_users_FK` (`id_r3f3r0_users`),
  KEY `r3f3r0_comments_r3f3r0_creatures0_FK` (`id_r3f3r0_creatures`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_creatures`
--

DROP TABLE IF EXISTS `r3f3r0_creatures`;
CREATE TABLE IF NOT EXISTS `r3f3r0_creatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `addDate` date DEFAULT NULL,
  `miniImage` varchar(255) DEFAULT '../assets/img/miniImgDefault.png',
  `mainImage` varchar(255) NOT NULL,
  `detailImage` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `discovery` text DEFAULT NULL,
  `etymology` text DEFAULT NULL,
  `paleobiology` text DEFAULT NULL,
  `environment` varchar(50) NOT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `predatory` varchar(50) DEFAULT NULL,
  `id_r3f3r0_categories` int(11) DEFAULT NULL,
  `id_r3f3r0_period` int(11) DEFAULT NULL,
  `id_r3f3r0_discoverer` int(11) DEFAULT NULL,
  `id_r3f3r0_diet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `r3f3r0_creatures_r3f3r0_categories_FK` (`id_r3f3r0_categories`),
  KEY `r3f3r0_creatures_r3f3r0_period_FK` (`id_r3f3r0_period`) USING BTREE,
  KEY `	r3f3r0_creatures_r3f3r0_discoverer_FK` (`id_r3f3r0_discoverer`),
  KEY `	r3f3r0_creatures_r3f3r0_diet_FK` (`id_r3f3r0_diet`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_creatures`
--

INSERT INTO `r3f3r0_creatures` (`id`, `name`, `addDate`, `miniImage`, `mainImage`, `detailImage`, `description`, `discovery`, `etymology`, `paleobiology`, `environment`, `width`, `height`, `weight`, `predatory`, `id_r3f3r0_categories`, `id_r3f3r0_period`, `id_r3f3r0_discoverer`, `id_r3f3r0_diet`) VALUES
(10, 'Tyrannosaurus Rex', NULL, 'assets/img/rexHead.png', 'assets/img/tyrannosaurus.png', 'assets/img/tyrannosaurusSkeleton.jpg', 'Tyrannosaurus rex est l\'un des plus grands carnivores ayant vécu sur Terre. Le plus grand spécimen complet (mais pas le plus grand spécimen) découvert à ce jour,\r\n                            répertorié\r\n                            sous le code FMNH PR2081 et\r\n                            surnommé Sue, du nom de la paléontologue Sue Hendrickson, mesure 12,8 mètres de long et 4 mètres de haut au niveau des hanches.</br></br>\r\n                            Si Tyrannosaurus rex était plus grand qu\'Allosaurus, un autre théropode bien connu du Jurassique, il était peut-être légèrement moins imposant que Spinosaurus et\r\n                            Giganotosaurus, deux carnivores du Crétacé.</br></br>\r\n                            Il se tenait sur ses deux pattes arrière. Ses membres postérieurs, terminés par un pied à trois orteils griffus, étaient particulièrement puissants. Sa vision frontale\r\n                            lui\r\n                            permettait d\'évaluer\r\n                            efficacement les distances. Afin de pouvoir soutenir son immense tête, ses membres antérieurs étaient atrophiés (miniaturisés). Ses bras avaient néanmoins des muscles\r\n                            développés et ils disposaient de\r\n                            deux doigts avec des griffes acérées. Ils servaient sans doute à maintenir la nourriture, mais étaient trop courts (comparables à ceux d\'un homme) pour pouvoir la\r\n                            ramasser\r\n                            au sol. Le tyrannosaure\r\n                            était donc obligé de se pencher pour ronger les carcasses de ses proies. Certaines de ses dents, particulièrement impressionnantes (atteignant 18 cm de long), étaient\r\n                            crénelées comme des couteaux à\r\n                            viande. On suppose qu\'il pouvait déplacer l\'un de ses maxillaires vers l\'arrière.', 'En 1874, A. Lakes découvre près de Golden, dans le Colorado des dents ayant appartenu à Tyrannosaurus. Dans les années 1890, J. B. Hatcher rassemble des\r\n                        éléments post-crâniens à\r\n                        l\'est du Wyoming. À\r\n                        l\'époque, les paléontologues pensaient avoir trouvé des fossiles d\'une espèce de grand Ornithomimus (O. grandis), mais ils appartenaient en réalité à Tyrannosaurus rex. Les\r\n                        fragments de vertèbres\r\n                        découverts dans le Dakota du Sud par E. D. Cope en 1892 et nommés Manospondylus gigas ont également été reclassés en Tyrannosaurus rex.\r\n                        Les premiers restes significatifs furent découverts en 1902 et l\'animal fut décrit et baptisé par Henry Fairfield Osborn en 1905. Des découvertes de squelettes entiers, en 1988\r\n                        (au Montana) et 1990\r\n                        (Dakota du Sud), ont fait considérablement évoluer la connaissance du tyrannosaure.', 'Le genre Tyrannosaurus fut créé en 1905 par Henry Fairfield Osborn, alors conservateur du tout nouveau département de paléontologie des vertébrés à\r\n                        l’American Museum of Natural\r\n                        History de New York. Le\r\n                        nom de genre dérive, par l\'intermédiaire du latin, des racines grecques τύραννος / túrannos (maître, tyran) et σαῦρος / saûros (lézard). Quant à l\'épithète spécifique rex, elle\r\n                        signifie roi en latin.\r\n                        Osborn lui attribua cette appellation car ce fut un prédateur impressionnant, avec des griffes et des dents particulièrement développées. Le nom binominal complet Tyrannosaurus\r\n                        rex peut être ainsi\r\n                        traduit par roi des lézards tyrans, soulignant la domination imaginée de l\'animal sur les autres espèces de son temps11.\r\n\r\n                        On l\'appelle souvent T. rex, qui est l\'initiale du nom de genre suivie de l\'épithète spécifique. Cependant, le diminutif T-Rex est fréquemment utilisé et abusif puisque\r\n                        l\'espèce Tyrannosaurus rex ne\r\n                        possède pas de trait d\'union, et les termes spécifiques ne portent jamais de majuscule. Dans le cas présent le nom scientifique de l\'espèce est Tyrannosaurus rex, nom binominal\r\n                        où Tyrannosaurus est le\r\n                        terme générique, le genre, et où rex est le terme spécifique, ce dernier étant toujours écrit entièrement en minuscules. De même, la prononciation Ti-rex, popularisée après la\r\n                        sortie du film Jurassic\r\n                        Park en 1993, n\'a aucune raison d\'être dans le monde francophone puisque les noms binomiaux des espèces ne sont pas en anglais, mais en latin.\r\n\r\n                        Originellement nommé Dynamosaurus imperiosus (Saurien dynamique impérial) par Barnum Brown lors de sa découverte, ces noms de genre et d\'espèce ne perdureront cependant pas\r\n                        dans la littérature.', '', 'Amérique du nord (Etats-Unis)', 12, 4, 7, NULL, 4, 8, 1, 1),
(11, 'Parasaurolophus', NULL, 'assets/img/parasaurolophusHead.jpg', 'assets/img/parasaurolophus', '', '', '', '', '', 'Amérique du Nord (Canada, Etats-Unis)', 8, 3, 5, NULL, 4, 8, 4, 2),
(12, 'Plateosaurus', NULL, 'assets/img/plateosaurusHead.jpg', 'assets/img/plateosaurus.jpg', 'assets/img/plateosaurusSkeleton.jpg', '', '', '', '', '', 8, 0, 4, NULL, 4, 3, NULL, 2),
(13, 'Baryonyx', NULL, 'assets/img/baryonyxHead.jpg', 'assets/img/baryonyx.jpg', 'assets/img/baryonyxSkeleton.jpg', '', '', '', '', 'Angleterre, Espagne, Portugal', 10, 2, 4, NULL, 4, 7, 6, 3),
(14, 'Tyran', '0000-00-00', NULL, 'dtc', NULL, 'fuckoff ', NULL, NULL, NULL, 'USA', NULL, NULL, NULL, NULL, 4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_diet`
--

DROP TABLE IF EXISTS `r3f3r0_diet`;
CREATE TABLE IF NOT EXISTS `r3f3r0_diet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_diet`
--

INSERT INTO `r3f3r0_diet` (`id`, `name`) VALUES
(1, 'Carnivore'),
(2, 'Herbivore'),
(3, 'Piscivore');

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_discoverer`
--

DROP TABLE IF EXISTS `r3f3r0_discoverer`;
CREATE TABLE IF NOT EXISTS `r3f3r0_discoverer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_discoverer`
--

INSERT INTO `r3f3r0_discoverer` (`id`, `name`) VALUES
(1, 'Inconnu'),
(2, 'Osborn'),
(4, 'Parks'),
(5, 'Meyer'),
(6, 'Charig & Milner');

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_period`
--

DROP TABLE IF EXISTS `r3f3r0_period`;
CREATE TABLE IF NOT EXISTS `r3f3r0_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_period`
--

INSERT INTO `r3f3r0_period` (`id`, `name`) VALUES
(1, 'Trias inférieur'),
(2, 'Trias moyen'),
(3, 'Trias supérieur'),
(4, 'Jurassique inférieur'),
(5, 'Jurassique moyen'),
(6, 'Jurassique supérieur'),
(7, 'Crétacé inférieur'),
(8, 'Crétacé supérieur');

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_roles`
--

DROP TABLE IF EXISTS `r3f3r0_roles`;
CREATE TABLE IF NOT EXISTS `r3f3r0_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_roles`
--

INSERT INTO `r3f3r0_roles` (`id`, `name`) VALUES
(1, 'Administrateur'),
(2, 'Modérateur'),
(3, 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_sources`
--

DROP TABLE IF EXISTS `r3f3r0_sources`;
CREATE TABLE IF NOT EXISTS `r3f3r0_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceLink` varchar(255) NOT NULL,
  `sourceTitle` varchar(50) NOT NULL,
  `id_r3f3r0_creatures` int(11) NOT NULL,
  `id_r3f3r0_sourceType` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `r3f3r0_sources_r3f3r0_creatures_FK` (`id_r3f3r0_creatures`),
  KEY `r3f3r0_sources_r3f3r0_sourceType0_FK` (`id_r3f3r0_sourceType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_sourcetype`
--

DROP TABLE IF EXISTS `r3f3r0_sourcetype`;
CREATE TABLE IF NOT EXISTS `r3f3r0_sourcetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_sourcetype`
--

INSERT INTO `r3f3r0_sourcetype` (`id`, `name`) VALUES
(1, 'descriptionSource'),
(2, 'etymologySource'),
(3, 'discoverySource'),
(4, 'paleobiologySource');

-- --------------------------------------------------------

--
-- Structure de la table `r3f3r0_users`
--

DROP TABLE IF EXISTS `r3f3r0_users`;
CREATE TABLE IF NOT EXISTS `r3f3r0_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `inscriptionDate` date NOT NULL,
  `id_r3f3r0_roles` int(11) NOT NULL DEFAULT 3,
  PRIMARY KEY (`id`),
  KEY `r3f3r0_users_r3f3r0_roles_FK` (`id_r3f3r0_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_users`
--

INSERT INTO `r3f3r0_users` (`id`, `username`, `password`, `mail`, `avatar`, `inscriptionDate`, `id_r3f3r0_roles`) VALUES
(2, 'Fabien', 'Nekrose12', 'fab@fab.com', NULL, '2020-08-11', 1),
(3, 'Fabien12', 'Nekrose12', 'fabu@fab.com', NULL, '2020-08-12', 2),
(4, 'Vivien', 'CKH96RGL2NQ', 'tincidunt@viverraDonectempus.ca', NULL, '2021-02-07', 3),
(5, 'Melanie', 'FTV33QHM8RP', 'auctor.ullamcorper.nisl@enimmi.net', NULL, '2019-09-25', 3),
(6, 'Ifeoma', 'XGL82BXG3YH', 'natoque.penatibus.et@faucibusut.edu', NULL, '2020-01-09', 3),
(7, 'Bruce', 'DTH59YNO6TX', 'Donec@NullafacilisisSuspendisse.net', NULL, '2019-11-17', 2),
(8, 'Dillon', 'AKY27CGU6HP', 'et.magnis@nonarcuVivamus.org', NULL, '2020-01-15', 3),
(9, 'Lacey', 'GIP81VVG0QY', 'a@lobortis.com', NULL, '2020-05-13', 3),
(10, 'Rinah', 'HNG53LGY6HT', 'dictum@turpisegestas.org', NULL, '2019-10-21', 2),
(11, 'Garrison', 'QIE74GGB1FC', 'Cum@VivamusnisiMauris.com', NULL, '2020-09-11', 3),
(12, 'Alden', 'GUV52MOE4XQ', 'In@ut.co.uk', NULL, '2021-05-14', 3),
(13, 'Nadine', 'HKS31KHK8IR', 'lectus@aliquet.edu', NULL, '2021-04-04', 2),
(14, 'Rina', 'IXM65TNP2CX', 'vulputate.mauris@Quisquetinciduntpede.edu', NULL, '2019-12-05', 3),
(15, 'Derek', 'XLB28TZB0EC', 'eu.tellus.Phasellus@aliquetmagna.ca', NULL, '2021-08-03', 3),
(16, 'Byron', 'RVB19HCC4PI', 'posuere.cubilia.Curae@laoreetlibero.org', NULL, '2020-09-22', 2),
(17, 'Amela', 'IRK74GMI3BH', 'ullamcorper.Duis@Suspendissenonleo.org', NULL, '2020-05-10', 3),
(18, 'Zena', 'HUH43XMA4UO', 'lectus.a.sollicitudin@eterosProin.co.uk', NULL, '2020-08-07', 3),
(19, 'Samuel', 'YTJ65LYV3AP', 'ultrices.posuere@ultricesmauris.co.uk', NULL, '2021-01-17', 2),
(20, 'Fritz', 'CUR78LIY2DJ', 'luctus@erategetipsum.net', NULL, '2020-03-16', 3),
(21, 'Inez', 'OER78ODJ6HV', 'penatibus@enimnectempus.com', NULL, '2019-10-09', 2),
(22, 'Giacomo', 'MEM72ZFE5HP', 'at.risus.Nunc@ipsumSuspendissenon.net', NULL, '2020-11-13', 3),
(23, 'Madison', 'YLZ89KXN9KP', 'blandit@atsemmolestie.co.uk', NULL, '2020-04-18', 3),
(24, 'Chastity', 'JVY59NCY7BP', 'Aliquam.nisl.Nulla@blanditenimconsequat.co.uk', NULL, '2021-07-16', 3),
(25, 'Tasha', 'GIQ38PTL9UC', 'luctus.felis@quamafelis.net', NULL, '2019-09-22', 3),
(26, 'Lucius', 'FJL71CZH2YP', 'Mauris.nulla@risus.co.uk', NULL, '2021-03-13', 3),
(27, 'Roary', 'UWZ14SUJ3MU', 'tristique@Suspendissetristiqueneque.org', NULL, '2019-11-14', 3),
(28, 'Barclay', 'THU36EFT2HR', 'interdum.Sed@estacfacilisis.edu', NULL, '2019-08-16', 3),
(29, 'Jordan', 'HDY91HQO5CE', 'risus@massa.ca', NULL, '2020-09-18', 3),
(30, 'Savannah', 'PNU63OEG0IU', 'eu.nulla@scelerisqueneque.net', NULL, '2021-08-07', 3),
(31, 'Yolanda', 'ZXZ23MIK2JA', 'lacus@magnisdis.edu', NULL, '2020-05-01', 3),
(32, 'Kendall', 'RXC13VHT9XT', 'ante.Vivamus@blandit.edu', NULL, '2019-10-31', 3),
(33, 'Colorado', 'IZS14FYJ5HX', 'lacus.varius@magnanec.ca', NULL, '2020-06-21', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `r3f3r0_comments`
--
ALTER TABLE `r3f3r0_comments`
  ADD CONSTRAINT `r3f3r0_comments_r3f3r0_creatures0_FK` FOREIGN KEY (`id_r3f3r0_creatures`) REFERENCES `r3f3r0_creatures` (`id`),
  ADD CONSTRAINT `r3f3r0_comments_r3f3r0_users_FK` FOREIGN KEY (`id_r3f3r0_users`) REFERENCES `r3f3r0_users` (`id`);

--
-- Contraintes pour la table `r3f3r0_creatures`
--
ALTER TABLE `r3f3r0_creatures`
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_categories_FK` FOREIGN KEY (`id_r3f3r0_categories`) REFERENCES `r3f3r0_categories` (`id`),
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_diet_FK` FOREIGN KEY (`id_r3f3r0_diet`) REFERENCES `r3f3r0_diet` (`id`),
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_discoverer_FK` FOREIGN KEY (`id_r3f3r0_discoverer`) REFERENCES `r3f3r0_discoverer` (`id`),
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_period_FK` FOREIGN KEY (`id_r3f3r0_period`) REFERENCES `r3f3r0_period` (`id`);

--
-- Contraintes pour la table `r3f3r0_sources`
--
ALTER TABLE `r3f3r0_sources`
  ADD CONSTRAINT `r3f3r0_sources_r3f3r0_creatures_FK` FOREIGN KEY (`id_r3f3r0_creatures`) REFERENCES `r3f3r0_creatures` (`id`),
  ADD CONSTRAINT `r3f3r0_sources_r3f3r0_sourceType0_FK` FOREIGN KEY (`id_r3f3r0_sourceType`) REFERENCES `r3f3r0_sourcetype` (`id`);

--
-- Contraintes pour la table `r3f3r0_users`
--
ALTER TABLE `r3f3r0_users`
  ADD CONSTRAINT `r3f3r0_users_r3f3r0_roles_FK` FOREIGN KEY (`id_r3f3r0_roles`) REFERENCES `r3f3r0_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
