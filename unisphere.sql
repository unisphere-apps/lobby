DROP DATABASE IF EXISTS unisphere;
CREATE DATABASE unisphere;
USE unisphere;

-- Création de la table des rôles
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Création de la table des utilisateurs
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `etablissement` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id_user`),
  FOREIGN KEY (`role_id`) REFERENCES `role`(`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Création de la table des logs d'utilisateur
CREATE TABLE IF NOT EXISTS `user_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `action` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Création de la table des articles
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `titre` varchar(30) DEFAULT NULL,
  `contenu` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL, -- Ajout de la clé étrangère pour l'utilisateur
  PRIMARY KEY (`id_article`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id_user`) -- Clé étrangère pointant vers la table 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO role (role_name) VALUES 
    ('etudiant'),
    ('admin'),
    ('super_admin');


DELIMITER //

CREATE TRIGGER before_user_delete
BEFORE DELETE ON `user`
FOR EACH ROW
BEGIN
  -- Mettre le champ `user_id` à NULL pour les articles de l'utilisateur supprimé
  UPDATE `article`
  SET `user_id` = NULL
  WHERE `user_id` = OLD.id_user;
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER check_email_before_insert
BEFORE INSERT ON `user`
FOR EACH ROW
BEGIN
  DECLARE email_count INT;

  -- Vérifier si l'email existe déjà dans la table `user`
  SELECT COUNT(*)
  INTO email_count
  FROM `user`
  WHERE `email` = NEW.email;

  -- Si l'email existe déjà, lever une exception
  IF email_count > 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cet email est déjà utilisé.';
  END IF;
  
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER delete_user_logs
AFTER DELETE ON `user`
FOR EACH ROW
BEGIN
  -- Supprimer les logs associés à l'utilisateur supprimé
  DELETE FROM user_log
  WHERE user_id = OLD.id_user;
END //

DELIMITER ;



