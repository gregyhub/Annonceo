-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 20 fév. 2018 à 17:14
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `annonceo`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id_annonce` int(3) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description_courte` varchar(255) NOT NULL,
  `description_longue` text NOT NULL,
  `prix` float NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `membre_id` int(3) DEFAULT NULL,
  `photo_id` int(3) DEFAULT NULL,
  `categorie_id` int(3) DEFAULT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `titre`, `description_courte`, `description_longue`, `prix`, `photo`, `pays`, `ville`, `adresse`, `cp`, `membre_id`, `photo_id`, `categorie_id`, `date_enregistrement`) VALUES
(7, 'voiture vert', 'belle voiture verte', 'super belle voiture verte de ouf', 3000, 'bb7cfcf4bfc0ab8296cb74fd72dce08e.jpg', 'France', 'PARIS', '82 bd denfer', 75014, 1, 22, 2, '2018-02-19 00:00:00'),
(13, 'Bracelet Wrap Pierre FLIBUSTIER', 'Bracelet Wrap Pierre FLIBUSTIER  de couleur bleue, sur élastique à enrouler   comme neuf dans son coffret avec certificat d’authenticité.', 'Bracelet Wrap Pierre FLIBUSTIER  de couleur bleue, sur élastique à enrouler   comme neuf dans son coffret avec certificat d’authenticité.  Taille S, pour poignet homme environ 18 cm  le créateur peut réajuster en boutique la longueur sur présentation du certificat  allez jeter un oeuil sur leur site pour vous rendre compte du prix neuf et de la qualité des details', 60, '91bdf398d08d316c1182d0138d33c2c4.jpg', 'France', 'PARIS', '50 rue m', 75014, 1, 24, 3, '2018-02-20 00:00:00'),
(14, 'Location d utilitaires avec chauffeur a prix bas', 'nous vous propossont nos services de transport et de demenagement adaptez a votre budget disponible 7jr/7 LOCATION camion avec chauffeur', 'nous vous propossont nos services de transport et de demenagement adaptez a votre budget disponible 7jr/7 LOCATION camion avec chauffeur Transporteur, déménageur, livreur,  service de livraison de colis, meuble, Electroménager, mobilier. Objets acheter sur Lebon coin, canapé, bz, armoire, moto scooter qwad refrigerateur fauteuil, table, chambre, dressing commode, cuisine, lit, Gasiniere, meuble télé, bibliotheque salon de jardin machine à laver.But, ikea,conforama - Avec le matériel nécessaire pour faciliter le transport et la protection de vos meubles (diable, couverture, sangles travail serieux ponctualite pour plus de renseignement me contacter par tel 0762489481', 25, '61e92167d6da74127f6bc1dda0655497.jpg', 'France', 'Marseille', '10 rue marseille', 13000, 1, 25, 4, '2018-02-20 00:00:00'),
(15, 'Suzuki 1250 GSXF', 'Bonjour,  Je vends mon 1250 GSXF en parfait état, nombreuses options comme selle confort, prise 12v, lèche roue, bulle fumée, Top case + fixation, pot Scorpion, gravage', 'Bonjour,  Je vends mon 1250 GSXF en parfait état, nombreuses options comme selle confort, prise 12v, lèche roue, bulle fumée, Top case + fixation, pot Scorpion, gravage. Révision des 18000km ok, pneus avant et arrière neufs (Michelin pilot road 4 GT). Toujours suivi par un garage, je suis nul en mécanique moto :) pas sérieux s&#039;abstenir.', 6200, '69d924bcb33ece2dd28208ae9b8b343b.jpg', 'France', 'Marseille', '80 rue du bordel', 13666, 1, 26, 2, '2018-02-20 00:00:00'),
(16, 'Appartement 115m² dans le Parc', 'XCLUSIVITE Maisons-Laffitte Parc. Appartement 100m² avec 3 chambres et une chambre de service 15m² , 2ème étage avec ascenseur. ', 'EXCLUSIVITE Maisons-Laffitte Parc. Appartement 100m² avec 3 chambres et une chambre de service 15m² , 2ème étage avec ascenseur.  Dans un bel immeuble en face d’une réserve boisée, situé dans un environnement calme et verdoyant, sécurisé avec gardien. Idéalement situé au début du parc à 10 mn à pied de la gare (RER A et train pour St-Lazare) et des commerces, à 5 mn à pied de l&#039;école internationale l&#039;Ermitage et des écoles. Superbe appartement familial comprenant : entrée, 1 wc, séjour exposé plein Sud, ensoleillé, avec vue dégagée sur les arbres et sans vis-à-vis avec balcon et grande terrasse , cuisine équipée, 3 belles chambres dont une suite parentale avec salle d&#039;eau et 1 chambre de service avec douche. Nombreux rangements. Belles prestations. Une cave complète ce bien. Date de construction : 1965 Charges (chauffage, eau, gardien, ascenseur): 440€/mois Superficie des pièces : - Cuisine : 12m² - Séjour double : 28m² - Chambre1 : 12m² , Chambre2 : 11m², Chambre 3: 12,5m²+salle d&#039;eau; Chambre de service : 12,5 m2+douche Les honoraires: 11 000€ sont à la charge de l’acheteur.  IMMO CAMILLE SAS, agence immobilière installée à Maisons-Laffitte Représentée par Camille Reynaud, fondatrice et gérante Portable 06 38 87 34 53 RCS: 831770011 Carte professionnelle: CPI 7801 2017 000 021 647 Vente, Achat, home staging accompagnement sur-mesure de vos projets immobiliers. Honoraires réduits 2% à la charge de l’acquéreur', 571, 'ca0b2f869bedb154882b50488c1e8bfb.jpg', 'france', 'Maisons Laffitte ', '5 rue laffite', 78555, 1, 27, 1, '2018-02-20 00:00:00'),
(18, 'Pull gris', 'S', 'vente', 25, '29d48ae96ac05f11b2d1321661dd4349.png', 'France', 'Paris', '82 avenue ferre', 75012, 1, 28, 1, '2018-02-20 00:00:00'),
(19, 'voiture', 'belle bagnole', 'super belle voiture qui roule vite', 20000, '0d636a6197696edfcd9ce5a30aaedc96.jpg', 'france', 'PARIS', '82 bd denfer', 75014, 1, 29, 5, '2018-02-20 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(3) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `motscles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `titre`, `motscles`) VALUES
(1, 'immobilier', 'vente,loc'),
(2, 'moto', 'moto, scooter'),
(3, 'bijoux', 'bracelet, montre luxe, bague, boucles d\'oreilles...'),
(4, 'location vehicule', 'location voiture,location moto,location camion...'),
(5, 'voiture', 'dllo');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(3) NOT NULL,
  `membre_id` int(3) NOT NULL,
  `annonce_id` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `membre_id`, `annonce_id`, `commentaire`, `date_enregistrement`) VALUES
(2, 1, 15, 'salut elle a cb de km ?', '2018-02-20 00:00:00'),
(5, 4, 15, 'elle est belle ta moto !', '2018-02-20 00:00:00'),
(6, 4, 15, 'en fait j&#039;en veux pas', '2018-02-20 00:00:00'),
(8, 4, 14, 'il est beau le chauffeur ?? ', '2018-02-20 00:00:00'),
(9, 4, 14, 'ou gros ?', '2018-02-20 14:58:45'),
(10, 4, 15, 'Belle moto noire\r\n', '2018-02-20 16:57:36');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enr` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `telephone`, `email`, `civilite`, `statut`, `date_enr`) VALUES
(1, 'Kyzer', '21232f297a57a5a743894a0e4a801fc3', 'Malaud', 'super Admin de ouf', '0000000', 'g@g.com', 'm', 1, '2018-02-16 00:00:00'),
(2, 'erlame', 'edfae', 'aefaef', 'moundir', '0615544', 't@t.com', 'm', 0, '2018-02-16 00:00:00'),
(3, 'Tom', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'DE MACEDO', 'Thomas', '06666666', 't@t.com', 'm', 0, '2018-02-19 00:00:00'),
(4, 'gregg', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Malaud', 'Grégoire', '062222', 'm@m.com', 'm', 0, '2018-02-20 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id_note` int(3) NOT NULL,
  `membre_id1` int(3) DEFAULT NULL,
  `membre_id2` int(3) DEFAULT NULL,
  `note` int(3) NOT NULL,
  `avis` int(11) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id_photo` int(3) NOT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id_photo`, `photo1`, `photo2`, `photo3`, `photo4`) VALUES
(22, 'd536beb0d41ad152d6fe5001ef90baef.jpg', '8d260d4a7f446b8b6ccab9b49e3a4f93.jpg', '', ''),
(23, '', '', '', ''),
(24, '3c0f527fad209e369b97280f9bacc7b4.jpg', '71f942c7bb18fdd4a36baf9d5c841e38.jpg', '', ''),
(25, '', '', '', ''),
(26, '207500142df58d5c6e281c252ec525f1.jpg', 'b4315ccab9a2b43aa2ecd108cca5ba9f.jpg', '', ''),
(27, 'db85912b38934b51cfec2f98be593eb9.jpg', '1cc696d48104a5b0b46d9b0a7fd0630b.jpg', '', ''),
(28, '7f0bc22f1e350315a1219122443df494.jpg', '', '', ''),
(29, '035cd75cdf3f36e461edcfb70f2be854.jpg', '', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `fk_id_membre` (`membre_id`),
  ADD KEY `fk_id_categorie` (`categorie_id`),
  ADD KEY `fk_id_photo` (`photo_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `fk2_id_membre` (`membre_id`) USING BTREE,
  ADD KEY `fk_id_annonce` (`annonce_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `fk_clt` (`membre_id1`),
  ADD KEY `fk_vdr` (`membre_id2`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `fk_id_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_membre` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_photo` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id_photo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_id_annonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id_annonce`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_clt` FOREIGN KEY (`membre_id1`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vdr` FOREIGN KEY (`membre_id2`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
