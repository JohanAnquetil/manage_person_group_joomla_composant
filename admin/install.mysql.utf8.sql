DROP TABLE IF EXISTS `#__elus`;

CREATE TABLE IF NOT EXISTS `#__elus` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `prenom` varchar(255) NOT NULL,
    `poste` varchar(255) NOT NULL,
    `syndicat` varchar(255) NOT NULL,
    `etablissement` varchar(255),
    `commissions` text,
    `missions_local` text,
    `cse_local` varchar(255),
    `coordonnees` text,
    `photo` varchar(255),
    `fichier` varchar(255),
    `published` tinyint(1) NOT NULL DEFAULT '1',
    `state` tinyint(1) NOT NULL DEFAULT '1',
    `ordering` int(11) NOT NULL DEFAULT '0',
    `checked_out` int(11) NOT NULL DEFAULT '0',
    `checked_out_time` datetime NULL DEFAULT NULL,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by` int(11) NOT NULL DEFAULT '0',
    `modified` datetime NULL DEFAULT NULL,
    `modified_by` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
