DROP TABLE IF EXISTS `#__elus`;

CREATE TABLE IF NOT EXISTS `#__syndicats` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `photo` varchar(255),
    `published` TINYINT(1) NOT NULL DEFAULT 1,
    `checked_out` INT(11),
    `checked_out_time` DATETIME,
    `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by` INT(11) NOT NULL DEFAULT 0,
    `modified` DATETIME,
    `modified_by` INT(11),
    `ordering` INT(11) NOT NULL DEFAULT 0,
    `state` TINYINT(1) NOT NULL DEFAULT 1,
    `params` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__commissions` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `published` TINYINT(1) NOT NULL DEFAULT 1,
    `checked_out` INT(11),
    `checked_out_time` DATETIME,
    `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by` INT(11) NOT NULL DEFAULT 0,
    `modified` DATETIME,
    `modified_by` INT(11),
    `ordering` INT(11) NOT NULL DEFAULT 0,
    `state` TINYINT(1) NOT NULL DEFAULT 1,
    `params` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

-- Table des élus avec clé étrangère pour syndicat
CREATE TABLE IF NOT EXISTS `#__elus` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `prenom` varchar(255) NOT NULL,
    `poste` varchar(255) NOT NULL,
    `syndicat` int(11) NOT NULL,  -- Changé en INT pour la clé étrangère
    `etablissement` varchar(255),
    `commissions` text,  -- Garde TEXT car c'est du JSON pour multiple commissions
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
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_elu_syndicat` FOREIGN KEY (`syndicat`) 
    REFERENCES `#__syndicats` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

-- DROP TABLE IF EXISTS `#__elus`;

-- CREATE TABLE IF NOT EXISTS `#__elus` (
--     `id` int(11) NOT NULL AUTO_INCREMENT,
--     `nom` varchar(255) NOT NULL,
--     `prenom` varchar(255) NOT NULL,
--     `poste` varchar(255) NOT NULL,
--     `syndicat` varchar(255) NOT NULL,
--     `etablissement` varchar(255),
--     `commissions` text,
--     `missions_local` text,
--     `cse_local` varchar(255),
--     `coordonnees` text,
--     `photo` varchar(255),
--     `fichier` varchar(255),
--     `published` tinyint(1) NOT NULL DEFAULT '1',
--     `state` tinyint(1) NOT NULL DEFAULT '1',
--     `ordering` int(11) NOT NULL DEFAULT '0',
--     `checked_out` int(11) NOT NULL DEFAULT '0',
--     `checked_out_time` datetime NULL DEFAULT NULL,
--     `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
--     `created_by` int(11) NOT NULL DEFAULT '0',
--     `modified` datetime NULL DEFAULT NULL,
--     `modified_by` int(11) NOT NULL DEFAULT '0',
--     PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

-- CREATE TABLE IF NOT EXISTS `#__syndicats` (
--     `id` INT(11) NOT NULL AUTO_INCREMENT,
--     `nom` VARCHAR(255) NOT NULL,
--     `description` TEXT NOT NULL,
--     `photo` varchar(255),
--     `published` TINYINT(1) NOT NULL DEFAULT 1,
--     `checked_out` INT(11),
--     `checked_out_time` DATETIME,
--     `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--     `created_by` INT(11) NOT NULL DEFAULT 0,
--     `modified` DATETIME,
--     `modified_by` INT(11),
--     `ordering` INT(11) NOT NULL DEFAULT 0,
--     `state` TINYINT(1) NOT NULL DEFAULT 1,
--     `params` TEXT,
--     PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

-- CREATE TABLE IF NOT EXISTS `#__commissions` (
--     `id` INT(11) NOT NULL AUTO_INCREMENT,
--     `nom` VARCHAR(255) NOT NULL,
--     `description` TEXT NOT NULL,
--     `published` TINYINT(1) NOT NULL DEFAULT 1,
--     `checked_out` INT(11),
--     `checked_out_time` DATETIME,
--     `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--     `created_by` INT(11) NOT NULL DEFAULT 0,
--     `modified` DATETIME,
--     `modified_by` INT(11),
--     `ordering` INT(11) NOT NULL DEFAULT 0,
--     `state` TINYINT(1) NOT NULL DEFAULT 1,
--     `params` TEXT,
--     PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;