<?php

if (isset($_POST['inscrire'])) {
  if ($_POST['mdp'] === $_POST['mdp_confirm']) {
    // Tenter l'inscription
    $newUser = $unControleur->inscriptionUtilisateur($_POST);

    if ($newUser === true) {
      // Préparation des logs
      $logs = array(
        "action" => "inscription",
        "description" => "Nouvelle inscription pour l'utilisateur: " . $_POST['email']
      );

      // Insérer les logs, et vérifier s'il y a une erreur
      $logResult = $unControleur->insertLog($logs);

      if ($logResult) {
        // Rediriger si tout est correct
        header("Location: index.php?page=connexion");
        exit(); // S'assurer que le script s'arrête après la redirection
      } else {
        echo "Erreur lors de l'insertion du log.";
      }

    } else {
      // Afficher l'erreur retournée par la fonction inscriptionUtilisateur
      echo $newUser;
    }

  } else {
    echo "Les mots de passe ne sont pas identiques.";
  }
}

?>


<link rel="stylesheet" href="vue/css/theme-inscription.css">

<main>
  <section class="container forms large-form">
    <div class="form signup">
      <div class="form-content">
        <header>Inscription</header>
        <form method="post">
          <div class="field-group">
            <div class="field input-field half-width">
              <input type="text" name="nom" placeholder="Nom" required class="input" />
            </div>
            <div class="field input-field half-width">
              <input type="text" name="prenom" placeholder="Prénom" required class="input" />
            </div>
          </div>
          <div class="field input-field">
            <input type="email" name="email" placeholder="Email" required class="input" />
          </div>
          <div class="field input-field">
            <input type="password" name="mdp" placeholder="Mot de passe" required class="password" />
            <i class="bx bx-hide eye-icon" onclick="togglePasswordVisibility(this)"></i>
          </div>
          <div class="field input-field">
            <input type="password" name="mdp_confirm" placeholder="Confirmer mot de passe" required class="password" />
            <i class="bx bx-hide eye-icon" onclick="togglePasswordVisibility(this)"></i>
          </div>
          <div class="field input-field">
            <div class="col-md-6 mb-3">
              <label for="etablissement" class="form-label">etablissement</label>
              <select class="form-select" id="etablissement" name="etablissement" required>
                <option value="iris">Iris Paris</option>
                <option value="hec">HEC</option>
                <option value="essec">ESSEC</option>
                <option value="epita">EPITA</option>
                <option value="epitec">EPITEC</option>
              </select>
            </div>
          </div><br><br>
          <div class="field button-field">
            <button type="submit" name="inscrire">S'inscrire</button>
          </div>
        </form>
        <div class="form-link">
          <span>Vous avez déjà un compte ?
            <a href="index.php?page=connexion" class="link login-link">Connexion</a></span>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Bootstrap JS (optional, for Bootstrap functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Toggle Password Visibility Script -->
<script>
  function togglePasswordVisibility(icon) {
    const passwordInput = icon.previousElementSibling;
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.replace("bx-hide", "bx-show");
    } else {
      passwordInput.type = "password";
      icon.classList.replace("bx-show", "bx-hide");
    }
  }
</script>