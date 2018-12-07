DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` text NOT NULL,
    `password` char(128) NOT NULL,
    `account_type` int(11) NOT NULL, 
    PRIMARY KEY (`id`)
);

