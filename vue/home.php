<link rel="stylesheet" href="vue/css/home.css">

<!-- Sidebar -->
<div class="sidebar d-flex flex-column">
    <h2>UniSphère</h2>
    <ul class="nav flex-column">
        <!-- Links for the app -->
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-app"></i> Capella</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-app"></i> Bellatrix</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-app"></i> Rigel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-app"></i> Vega</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-app"></i> Atlair</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-app"></i> Sirius</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-gear"></i> Polaris</a>
        </li>
    </ul>

    <!-- Separate div for Settings & Logout at the bottom -->
    <div class="mt-auto">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="index.php?page=deconnexion"><i class="bi bi-box-arrow-left"></i> Se déconnecter</a>
            </li>
        </ul>
    </div>
</div>


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- Partie profil -->
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle me-2" style="font-size: 2rem;"></i> <!-- Add margin end for spacing -->
                    <h1>Hello <?= $_SESSION['prenom'] ?></h1>
                </div><br>

                <form>
                    <div class="mb-3">
                        <label for="ecole" class="form-label">Ecole</label>
                        <input type="email" class="form-control" id="ecole" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe actuel</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirmer nouveau mot de passe</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button><br><br>
                    <div id="emailHelp" class="form-text">Le mot de passe actuel est nécessaire pour chaque modification ou suppresion du compte.</div>
                </form>
            </div>


            <!-- Partie actualités -->
            <div class="col-md-6">
                <div class="container mt-3">
                    <h2 class="mb-4">Articles récents</h2>
                    <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                        <!-- Article Item 1 -->
                        <div class="list-group-item">
                            <h5 class="mb-1">
                                <a class="nav-link" href="#">Article Title 1</a>
                                <h6>23-10-2024</h6>
                            </h5>
                            <p class="mb-1">This is a brief description of Article 1. It gives a short overview of the content.</p>
                        </div>

                        <!-- Article Item 2 -->
                        <div class="list-group-item">
                            <h5 class="mb-1">
                                <a class="nav-link" href="#">Article Title 2</a>
                                <h6>23-10-2024</h6>
                            </h5>
                            <p class="mb-1">This is a brief description of Article 1. It gives a short overview of the content.</p>
                        </div>
                        <!-- Article Item 3 -->
                        <div class="list-group-item">
                            <h5 class="mb-1">
                                <a class="nav-link" href="#">Article Title 3</a>
                                <h6>23-10-2024</h6>
                            </h5>
                            <p class="mb-1">This is a brief description of Article 1. It gives a short overview of the content.</p>
                        </div>
                        <!-- Article Item 4 -->
                        <div class="list-group-item">
                            <h5 class="mb-1">
                                <a class="nav-link" href="#">Article Title 4</a>
                                <h6>23-10-2024</h6>
                            </h5>
                            <p class="mb-1">This is a brief description of Article 1. It gives a short overview of the content.</p>
                        </div>
                        <!-- Article Item 5 -->
                        <div class="list-group-item">
                            <h5 class="mb-1">
                                <a class="nav-link" href="#">Article Title 5</a>
                                <h6>23-10-2024</h6>
                            </h5>
                            <p class="mb-1">This is a brief description of Article 1. It gives a short overview of the content.</p>
                        </div>
                        <!-- Article Item 6 -->
                        <div class="list-group-item">
                            <h5 class="mb-1">
                                <a class="nav-link" href="#">Article Title 6</a>
                                <h6>23-10-2024</h6>
                            </h5>
                            <p class="mb-1">This is a brief description of Article 1. It gives a short overview of the content.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</div>

<!-- Bootstrap JS (via CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>