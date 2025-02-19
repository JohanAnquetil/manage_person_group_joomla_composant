
CREATE TABLE IF NOT EXISTS `#__elus` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `syndicat` VARCHAR(100) NOT NULL,
    `nom` VARCHAR(100) NOT NULL,
    `prenom` VARCHAR(100) NOT NULL,
    `poste` VARCHAR(100) NOT NULL,
    `etablissement` VARCHAR(255) NOT NULL,
    `commissions` TEXT NOT NULL,
    `missions_local` VARCHAR(255) NOT NULL,
    `cse_local` VARCHAR(255) NOT NULL,
    `coordonnees` VARCHAR(255) DEFAULT NULL,
    `photo` VARCHAR(255) DEFAULT NULL,
    `fichier` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
