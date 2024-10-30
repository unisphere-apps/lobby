<?php
if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $unUser = $unControleur->verifConnexion($email, $mdp);

    if ($unUser != null) {
        $_SESSION['id'] = $unUser['id_user'];
        $_SESSION['prenom'] = $unUser['prenom'];

        $logs = array(
            "action" => "connexion",
            "description" => ""
        );

        $unControleur->insertLog($logs);

        header('Location: index.php');
    } else {
        echo "Identifiants incorrects";
    }
}

?>

<link rel="stylesheet" href="vue/css/theme-connexion.css">
<main>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Connexion</header>
                <form method="post">
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" required class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" name="mdp" placeholder="Mot de passe" required class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <!-- <div class="form-link">
                        <a href="#" class="forgot-pass">Mot de passe oublié ?</a>
                    </div> -->

                    <div class="field button-field">
                        <button type="submit" name="connexion">Se connecter</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Vous n'avez pas de compte ? <a href="index.php?page=inscription" class="link signup-link">S'inscrire</a></span>
                </div>
            </div>
    </section>
</main>