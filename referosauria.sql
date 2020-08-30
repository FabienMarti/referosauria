-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 30 août 2020 à 19:03
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
  `minWidth` float DEFAULT NULL,
  `maxWidth` float DEFAULT NULL,
  `minHeight` float DEFAULT NULL,
  `maxHeight` float DEFAULT NULL,
  `minWeight` float DEFAULT NULL,
  `maxWeight` float DEFAULT NULL,
  `predatory` varchar(50) DEFAULT 'Aucun',
  `id_r3f3r0_categories` int(11) DEFAULT NULL,
  `id_r3f3r0_period` int(11) DEFAULT NULL,
  `id_r3f3r0_discoverer` int(11) DEFAULT NULL,
  `id_r3f3r0_diet` int(11) DEFAULT NULL,
  `id_r3f3r0_environment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `r3f3r0_creatures_r3f3r0_categories_FK` (`id_r3f3r0_categories`),
  KEY `r3f3r0_creatures_r3f3r0_period_FK` (`id_r3f3r0_period`) USING BTREE,
  KEY `	r3f3r0_creatures_r3f3r0_discoverer_FK` (`id_r3f3r0_discoverer`),
  KEY `	r3f3r0_creatures_r3f3r0_diet_FK` (`id_r3f3r0_diet`),
  KEY `r3f3r0_creatures_r3f3r0_environment_FK` (`id_r3f3r0_environment`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_creatures`
--

INSERT INTO `r3f3r0_creatures` (`id`, `name`, `addDate`, `miniImage`, `mainImage`, `detailImage`, `description`, `discovery`, `etymology`, `paleobiology`, `minWidth`, `maxWidth`, `minHeight`, `maxHeight`, `minWeight`, `maxWeight`, `predatory`, `id_r3f3r0_categories`, `id_r3f3r0_period`, `id_r3f3r0_discoverer`, `id_r3f3r0_diet`, `id_r3f3r0_environment`) VALUES
(11, 'Parasaurolophus', '2019-01-01', '../assets/img/parasaurolophusHead.jpg', 'assets/img/parasaurolophus', '', '', '', '', '', 8, NULL, 3, NULL, 5, NULL, NULL, 4, 8, 4, 2, 1),
(12, 'Plateosaurus', '2019-01-01', '../assets/img/plateosaurusHead.jpg', 'assets/img/plateosaurus.jpg', 'assets/img/plateosaurusSkeleton.jpg', '', '', '', '', 8, NULL, 0, NULL, 4, NULL, NULL, 4, 3, NULL, 2, 3),
(13, 'Baryonyx', '2019-01-01', '../assets/img/baryonyxHead.jpg', 'assets/img/baryonyx.jpg', 'assets/img/baryonyxSkeleton.jpg', 'Baryonyx est un genre éteint de dinosaures théropodes de la famille des Spinosauridae, il est pourvu d\'un museau long et étroit et d\'une large griffe au niveau du pouce.  Il ne comprend pour l\'instant que l\'espèce Baryonyx walkeri bien que certains paléontologues considèrent que les espèces Suchomimus tenerensis1 et Cristatusaurus lapparenti2 sont toutes deux des espèces de Baryonyx et que Suchosaurus cultridens3 pourrait peut-être en être une autre.  Ce dinosaure vivait dans ce qui est aujourd\'hui l\'Angleterre, l\'Espagne et le Portugal au Barrémien (Crétacé inférieur). Il est un des rares dinosaures dont on connait précisément le régime alimentaire et il est pour l\'instant le seul théropode non-avien dont on est sûr qu\'il était au moins partiellement piscivore.', '', '', '', 10, NULL, 2, NULL, 4, NULL, NULL, 4, 7, 6, 3, 3),
(15, 'Triceratops', '2020-08-28', '../assets/img/triceratopsHead.jpg', '../uploads/TriceratopsImagePrincipale_2020-08-28_18-07-52.jpg', NULL, 'On estime que Triceratops mesurait de 7 à 10 mètres de long (avec une moyenne allant de 8 à 9 mètres), mesurait jusqu\'à 3,50 mètres voire 4 au garrot et pesait de 5 à 10 tonnes (avec une moyenne de 7 à 8 tonnes)14. La caractéristique la plus distinctive est leur large crâne, parmi les plus grands de tous les animaux terrestres ayant vécu sur terre. Le crâne le plus large retrouvé (sur le specimen BYU 12183) mesure 2,5 m en largeur15, et atteint presque le tiers de la longueur de l\'animal13. Il portait une corne sur le museau, au-dessus des narines, et une paire de cornes, d\'une longueur approximative d\'un mètre, réparties au-dessus de chaque œil. À l\'arrière du crâne se dresse une collerette osseuse ornée d\'os époccipitaux chez certaines espèces. La plupart des autres cératopsidés possédaient de larges ouvertures sur leur collerette, contrairement aux tricératops qui avaient de très solides collerettes.\r\n\r\nLa peau du Triceratops est très particulière pour un dinosaure. Des reproductions de la peau d\'un spécimen ont montré que certaines espèces pourraient avoir été couvertes de poils, comme chez le cératopsidé plus primitif Psittacosaurus16.', 'Marsh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 8, NULL, 2, 1),
(16, 'Mosasauroidea', '2020-08-28', '../uploads/MosasauroideaMiniImage_2020-08-28_18-13-02.jpg', '../uploads/MosasauroideaImagePrincipale_2020-08-28_18-13-02.jpg', NULL, 'Les mosasaures (Mosasauroidea) forment une super-famille éteinte de reptiles marins, souvent de grande taille, appartennant à l\'ordre des squamates, donc très proches des lézards et des serpents mais nullement apparenté au dinosaures, pliosaures ou aux ichthyosaures.\r\n\r\nLa famille tire son nom de la première espèce décrite, le Mosasaurus, littéralement « lézard de la Meuse » (du latin Mosa et du grec σαῦρος / saûros), ainsi nommé du fait de sa découverte en 17662 à proximité de Maastricht, ville traversée par la Meuse.', 'Gervais', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 7, NULL, 1, 3),
(20, 'Kentrosaurus', '2020-08-29', '../assets/img/Kentrosaurus/KentrosaurusMiniImage_2020-08-29_13-34-48.png', '../assets/img/Kentrosaurus/KentrosaurusImagePrincipale_2020-08-29_13-34-48.png', NULL, 'Kentrosaurus est un genre éteint de dinosaures herbivores stégosauriens africains ayant vécu au Jurassique supérieur. Il est apparenté au Stegosaurus du continent américain, ce qui est un exemple d\'évolution séparée liée à la dérive des continents. Kentrosaurus était cependant plus petit et ne possédait pas le même type d\'armure osseuse.\r\n\r\nUne seule espèce est connue : Kentrosaurus aethiopicus, elle a été décrite en 1915 par le paléontologue allemand Hennig qui le place dans la famille des stégosauridés1.', 'Hennig', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aucun', 4, 6, NULL, 2, 4),
(21, 'Pteranodon', '2020-08-29', '../assets/img/Pteranodon/PteranodonMiniImage_2020-08-29_13-42-42.jpg', '../assets/img/Pteranodon/PteranodonImagePrincipale_2020-08-29_13-42-42.jpg', NULL, 'Pteranodon mesurait 6 mètres d\'envergure. Sa masse a été estimée entre 20 et 93 kilogrammes, deux extrêmes désormais considérées fausses par Mark Witton et Mike Habib. À la différence de plus anciens ptérosaures, comme Rhamphorhynchus ou Pterodactylus, le ptéranodon était dépourvu de dents, avait la queue atrophiée et des os creux, très légers et souples, mais renforcés par un réseau interne de longerons. Ces caractères le rapprochent des oiseaux. Toutefois, les ptéranodons n\'étaient pas des oiseaux, bien qu\'issus de la même branche d\'archosaures, avec les dinosaures: les ornithodiriens. Ils avaient la peau protégée de poils et étaient probablement capables de réguler au moins partiellement leur température interne.\r\n\r\nLe ptéranodon est facilement reconnaissable à la longue et fine crête au dessus de son crâne. On n\'en connait pas encore l\'utilité exacte, mais l\'on suppose qu\'elle pouvait servir de contre-poids au bec, ou d\'attribut de séduction pour l\'accouplement, ou encore de gouvernail de direction en vol. Il a également été avancé que les mâles étaient dotés de plus longues crêtes, mais cela reste à prouver car le sexe des animaux fossilisés est difficilement identifiable.\r\n\r\nPlusieurs espèces de ptéranodons ont été nommées, telles que Pteranodon ingens, P. longiceps, P. sternbergi (souvent classée dans son propre genre Geosternbergia), etc.', 'Marsh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aucun', 7, 8, NULL, 1, 1),
(22, 'Tyrannosaure', '2020-08-29', '../assets/img/creatures/tyrannosaure/tyrannosaureMiniImage_2020-08-29_15-29-04.png', '../assets/img/creatures/tyrannosaure/tyrannosaureImagePrincipale_2020-08-29_15-29-04.png', NULL, 'Tyrannosaurus, communément appelé tyrannosaure, est un genre éteint de dinosaures théropodes appartenant à la famille des Tyrannosauridae et ayant vécu durant la partie supérieure du Maastrichtien, dernier étage du système Crétacé1, il y a environ 68 à 66 millions d\'années2, dans ce qui est actuellement l\'Amérique du Nord. Tyrannosaurus rex, dont l\'étymologie du nom signifie « roi des lézards tyrans », est l\'une des plus célèbres espèces de dinosaure et l\'unique espèce de Tyrannosaurus si le taxon Tarbosaurus bataar n\'est pas considéré comme faisant partie du même genre. Tyrannosaurus fut l\'un des derniers dinosaures non-aviens à avoir vécu jusqu\'à l\'extinction survenue à la limite Crétacé-Paléocène il y a 66 millions d\'années1.\r\n\r\nTout comme les autres membres du clade des Tyrannosauridae, Tyrannosaurus était un carnassier bipède doté d\'un crâne massif équilibré par une longue queue puissante. Comparés à ses larges membres postérieurs, les bras du Tyrannosaurus étaient petits et atrophiés et ne portaient que deux doigts griffus. Même si d\'autres théropodes rivalisaient voire dépassaient Tyrannosaurus en taille, il est le plus grand Tyrannosauridae connu et l\'un des plus grands carnivores terrestres ayant existé sur la planète, avec une longueur de plus de 13,2 mètres3,4, 4 mètres à hauteur de hanches5 et un poids pouvant atteindre 8 tonnes6(pour les spécimens les plus lourds). De loin le plus grand des carnivores de son temps, le T. rex a pu être un superprédateur au sommet de la chaîne alimentaire, chassant notamment des herbivores de grande taille tels que les Hadrosauridae et les Ceratopsidae, même si certains experts suggèrent qu\'il était avant tout charognard.', 'Osborn', NULL, NULL, 12, 13, 4, 4.3, 6, 7, 'Aucun', 4, 8, NULL, 1, 1),
(24, 'Dilophosaure', '2020-08-30', '../assets/img/creatures/dilophosaure/DilophosaureMiniImage_2020-08-30_13-43-48.jpg', '../assets/img/creatures/dilophosaure/DilophosaureImagePrincipale_2020-08-30_13-43-48.jpg', NULL, 'Le dilophosaure ou Dilophosaurus (en grec : « lézard à deux crêtes ») est un genre éteint de grands dinosaures théropodes carnivores, découvert en Chine et en Arizona où il vivait au Jurassique inférieur, il y a environ entre 199 et 183 Ma (millions d\'années), au cours des étages Sinémurien et Pliensbachien.\r\n\r\nLes premiers spécimens furent décrits en 1954, mais ce n\'est que plus d\'une décennie plus tard que leur genre reçut leur nom actuel. Le dilophosaure est l\'un des plus anciens théropodes connus, mais également l\'un des moins bien compris. Le dilophosaure est apparu à plusieurs reprises dans la culture populaire, notamment dans le film Jurassic Park, de Steven Spielberg, en 1993.', 'Welles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aucun', 4, 4, NULL, 1, 1);

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
-- Structure de la table `r3f3r0_environment`
--

DROP TABLE IF EXISTS `r3f3r0_environment`;
CREATE TABLE IF NOT EXISTS `r3f3r0_environment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r3f3r0_environment`
--

INSERT INTO `r3f3r0_environment` (`id`, `name`) VALUES
(1, 'Amérique du Nord'),
(2, 'Amérique du Sud'),
(3, 'Europe'),
(4, 'Asie'),
(5, 'Afrique'),
(6, 'Océanie'),
(7, 'Antartique');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

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
(33, 'Colorado', 'IZS14FYJ5HX', 'lacus.varius@magnanec.ca', NULL, '2020-06-21', 3),
(34, 'Fabien', 'Nekrose12', 'heeeeeee@hotmail.fr', NULL, '2020-08-29', 3),
(35, 'Fabien2', 'Nekrose12', 'heeeeeee@hotm1ail.fr', NULL, '2020-08-29', 3);

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
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_categories_FK` FOREIGN KEY (`id_r3f3r0_categories`) REFERENCES `r3f3r0_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_diet_FK` FOREIGN KEY (`id_r3f3r0_diet`) REFERENCES `r3f3r0_diet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_discoverer_FK` FOREIGN KEY (`id_r3f3r0_discoverer`) REFERENCES `r3f3r0_discoverer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_environment_FK` FOREIGN KEY (`id_r3f3r0_environment`) REFERENCES `r3f3r0_environment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `r3f3r0_creatures_r3f3r0_period_FK` FOREIGN KEY (`id_r3f3r0_period`) REFERENCES `r3f3r0_period` (`id`) ON DELETE CASCADE;

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
