SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `cv`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h3` varchar(256) NOT NULL DEFAULT '',
  `h4` varchar(256) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id`, `h3`, `h4`, `description`) VALUES
(11, 'IA et Robotique', 'Débutant', 'Apprentissage dans mon cursus de Master.'),
(12, 'IHM,', 'Intermédiaire', 'Apprentissage dans mon cursus scolaire.'),
(13, 'Développement web', 'Débutant', 'Apprentissage dans mon cursus scolaire.'),
(14, 'Blender', 'Débutant', 'Modélisation / Animation 3D Autodidacte.'),
(15, 'Java', 'Avancé', 'Principale langage de programmation dans ma licences d\'informatique générale. '),
(16, 'C/ C++', 'Intermédiaire', 'Initiation du langage en licence informatique générale. '),
(17, 'Python', 'Intermédiaire', 'Initiation du langage en licence informatique générale.'),
(18, 'Ocaml', 'Débutant', 'Initiation du langage en licence informatique générale. '),
(19, 'C#', 'Intermédiaire', '2ans d\'expériences, en entreprise et scolaire.'),
(20, 'MySQL', 'Intermédiaire', 'Initiation du langage en licence informatique générale.'),
(21, 'PHP', 'Intermédiaire', 'Initiation du langage en licence informatique générale. '),
(22, 'Html', 'Intermédiaire', 'Initiation du langage en licence informatique générale.'),
(23, 'JavaScript', 'Intermédiaire', 'Initiation du langage en licence informatique générale.'),
(24, 'Anglais', 'Intermédiaire', 'Bonne compréhension écrite et oral.'),
(25, 'Japonais', 'Débutant', 'Bonne compréhension et expression oral.');

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `h4` varchar(256) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `experiences`
--

INSERT INTO `experiences` (`id`, `date_from`, `date_to`, `h4`, `description`) VALUES
(5, '2019-07-01', '2019-08-31', 'DEVELOPPEUR LOGICIEL / GROUPE-CONVERGENCE', 'Stage pour le développement d’une API afin d’accéder aux équipements connecter aux réseaux.\r\n\r\n(ref: https://www.groupe-convergence.com/)'),
(6, '2020-03-07', '2020-09-12', 'DEVELOPPEUR UNITY / NEXTMIND', 'Stage pour le développement d’application utilisant la nouvelle technologie de l’entreprise, un capteur EEG, qui permet de capter les ondes cérébrale pour interagir avec.\r\n\r\n(ref: https://www.next-mind.com/)');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `h4` varchar(256) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `date_from`, `date_to`, `h4`, `description`) VALUES
(3, '2018-09-01', '2020-09-15', 'MASTER INFORMATIQUE SPECIALITE IA ET ROBOTIQUE', 'Sorbonne Université.\r\nEnvironnement Virtuels Hautement Interactifs : Étude des principes, technologie et principaux axes de recherches dans le domaine de la conception d’environnements virtuels interactifs, qui incluent la réalité virtuelle et le jeu vidéo. (ref : https://sciences.sorbonne-universite.fr/formation-sciences/masters/master-informatique/parcours-androide)'),
(4, '2015-09-01', '2018-08-01', 'LICENCE INFORMATIQUE', 'Paris Diderot 7, Mention Bien.');

-- --------------------------------------------------------

--
-- Structure de la table `loisirs`
--

DROP TABLE IF EXISTS `loisirs`;
CREATE TABLE IF NOT EXISTS `loisirs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h3` varchar(256) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `loisirs`
--

INSERT INTO `loisirs` (`id`, `h3`, `description`) VALUES
(3, 'Jeux vidéo', 'Joue au jeux vidéos depuis ma plus grande enfance.'),
(4, 'Manga / Anime', 'Actuellement mon loisir principal.'),
(5, 'Sport', 'Football en club au lycée. Volleyball, Basketball, Cyclisme et Tennis occasionnellement.');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h3` varchar(256) NOT NULL DEFAULT '',
  `h4` varchar(256) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `h3`, `h4`, `description`) VALUES
(2, 'IronManModel3D', 'Blender', 'Premier modélisation 3D.'),
(3, 'CV', 'Html, CSS, JavaScript, MySQL, PHP', 'Site web affichant mon CV.');
COMMIT;
