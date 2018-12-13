-- table USERS
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` text NOT NULL,
    `password` char(128) NOT NULL,
    `account_type` int(11) NOT NULL, 
    `metier_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);
INSERT INTO `users`(`id`, `email`, `password`, `account_type`) VALUES
(1, 'root@root.fr', '$2y$10$tMpttxj11mBpb2vAQclug.bz5V41qKTiSRF1KBdbJzuKTYMXiwJiK', 3);

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