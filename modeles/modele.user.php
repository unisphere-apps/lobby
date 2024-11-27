<?php
class user extends BDD
{
    function verifConnexion($email, $mdp)
    {
        try {
            // Étape 1: Récupérer l'utilisateur par l'email
            $requete = "SELECT * FROM user WHERE email = :email";
            $donnees = array(":email" => $email);
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $resultat = $select->fetch();

            if (!$resultat) {
                // Utilisateur non trouvé
                return false;
            }

            // Étape 2: Comparer le mot de passe en clair
            if ($mdp === $resultat['mdp']) {
                // Mot de passe correct
                return $resultat;
            } else {
                // Mot de passe incorrect
                return false;
            }
        } catch (PDOException $e) {
            // Gestion de l'exception PDO
            return "Erreur de connexion : " . $e->getMessage();
        }
    }

    function selectAllUser()
    {
        try {
            // Requête pour sélectionner tous les utilisateurs
            $requete = "SELECT * FROM user;";
            $select = $this->unPDO->query($requete);
            return $select->fetchAll();
        } catch (PDOException $e) {
            // Gestion de l'exception PDO
            return "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
        }
    }

    function inscriptionUtilisateur($tab)
    {
        try {
            // Vérifier si l'email est déjà utilisé
            $requete_verif = "SELECT COUNT(*) FROM user WHERE email = :email";
            $select = $this->unPDO->prepare($requete_verif);
            $select->execute([":email" => $tab['email']]);
            $count = $select->fetchColumn();

            if ($count > 0) {
                // Si l'email est déjà utilisé, retourner un message d'erreur
                return "Cet email est déjà utilisé.";
            }

            // Utiliser le mot de passe en clair (non recommandé)
            $clearPassword = $tab['mdp'];

            // Insertion de l'utilisateur dans la base de données
            $requete = "INSERT INTO user (nom, prenom, etablissement, email, mdp) 
                        VALUES (:nom, :prenom, :etablissement, :email, :mdp)";
            $donnees = array(
                ":nom" => $tab['nom'],
                ":prenom" => $tab['prenom'],
                ":etablissement" => $tab['etablissement'],
                ":email" => $tab['email'],
                ":mdp" => $clearPassword
            );

            $insert = $this->unPDO->prepare($requete);
            $result = $insert->execute($donnees);

            if ($result) {
                return true;
            } else {
                return "Erreur lors de l'insertion de l'utilisateur.";
            }
        } catch (PDOException $e) {
            return "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }


    function insertLog($tab)
    {
        try {
            // Préparation de la requête SQL pour insérer un log dans la base de données
            $requete = "INSERT INTO user_log (date, action, description, ip_address, user_agent, user_id) 
                        VALUES (NOW(), :action, :description, :ip_address, :user_agent, :user_id)";

            // Récupération de l'utilisateur depuis la session
            $id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

            // Assignation des données à insérer dans un tableau associatif
            $donnees = array(
                ":action"      => $tab['action'],
                ":description" => $tab['description'],
                ":ip_address"  => $_SERVER['REMOTE_ADDR'],
                ":user_agent"  => $_SERVER['HTTP_USER_AGENT'],
                ":user_id"     => $id
            );

            // Préparation de la requête avec PDO
            $insert = $this->unPDO->prepare($requete);

            // Exécution de la requête avec les données fournies
            return $insert->execute($donnees);
        } catch (PDOException $e) {
            // Gestion de l'exception PDO
            return "Erreur lors de l'insertion du log : " . $e->getMessage();
        }
    }
}
