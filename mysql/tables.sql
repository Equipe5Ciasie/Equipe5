-- table USERS
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nom` text NOT NULL,
    `siret` text NOT NULL,
    `email` text NOT NULL,
    `password` char(128) NOT NULL,
    `account_type` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);
INSERT INTO `users`(`id`, `email`, `password`, `account_type`) VALUES
(1, 'root@root.fr', '$2y$10$tMpttxj11mBpb2vAQclug.bz5V41qKTiSRF1KBdbJzuKTYMXiwJiK', 3);

-- table entreprise
DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE `entreprise`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `domaine` text NOT NULL,
    PRIMARY KEY (`id`)
);

-- table MOA
DROP TABLE IF EXISTS `MOA`;
CREATE TABLE `MOA`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `ville` text NOT NULL,
    PRIMARY KEY (`id`)
);
-- table APPELS_OFFRES
DROP TABLE IF EXISTS `appels_offres`;
CREATE TABLE `appels_offres`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titre` text NOT NULL,
    `description` text NOT NULL,
    `contenu` text NOT NULL,
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);
INSERT INTO `appels_offres`(`id`, `titre`, `description`, `contenu`, `user_id`) VALUES
(1, "Un appel d'offre", 'Sa description', 'Son contenu', 1);

-- table METIERS
DROP TABLE IF EXISTS `metiers`;
CREATE TABLE `metiers`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nom` text NOT NULL,
    PRIMARY KEY (`id`)
);
INSERT INTO `metiers`(`id`, `nom`) VALUES
(1, "Architecte"),
(2, "Masson"),
(3, "Bureau d'étude"),
(4, "Maire");