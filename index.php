<?php
session_start();
session_regenerate_id(true);

require_once("controleur/controleur.php");
$unControleur = new Controleur();
?>

<!doctype html>
<html lang="fr">

<head>
    <title>UniSphère</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (via CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <?php

    if (isset($_SESSION['id'])) {
        // Vérifie si une page est spécifiée dans l'URL, sinon défaut à 'home'
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        // Si l'utilisateur est connecté mais tente d'accéder à une page non autorisée
        if ($page === 'connexion' || $page === 'inscription') {
            $page = 'home'; // Redirige vers 'home' car l'utilisateur est déjà connecté
        }
    } else {
        // Si l'utilisateur n'est pas connecté, redirige vers 'connexion' par défaut
        $page = isset($_GET['page']) && $_GET['page'] === 'inscription' ? 'inscription' : 'connexion';
    }

    // Charge le contenu de la page appropriée
    switch ($page) {
        case 'home':
            require_once("vue/home.php");
            break;
        case 'connexion':
            require_once("vue/connexion.php");
            break;
        case 'inscription':
            require_once("vue/inscription.php");
            break;
        case 'deconnexion':

            $logs = array(
                "action" => "deconnexion",
                "description" => ""
            );

            $unControleur->insertLog($logs);

            session_destroy();
            unset($_SESSION);
            header("Location: index.php");
            break;
        default:
            require_once("vue/erreur.php"); // page d'erreur si la page est inconnue
            break;
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>