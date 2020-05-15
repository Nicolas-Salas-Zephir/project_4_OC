<header class="header-admin">
    <nav class="navbar navbar-expand-md navbar-dark d-flex align-items-baseline justify-content-between">
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarText" aria-controls="navbarText"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto d-flex justify-content-between align-items-center">
                <li class="nav-item">
                    <a class="navbar-brand navbar__title ml-3" href="index.php?action=postsAdmin">
                        Tableau de bord
                    </a>
                </li>
            <?php if(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link mr-lg-3 text-center" href="index.php?action=admin#addPost">Ajouter un article</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-lg-3 text-center" href="index.php?action=addSuperUsers#superUser">Ajouter un utilisateur</a>
                </li>
            <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'editor'): ?>
                <li class="nav-item">
                    <a class="nav-link mr-lg-3 text-center" href="index.php?action=admin#addPost">Ajouter un article</a>
                </li>
            <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link mr-lg-3 text-center" href="index.php">Accéder au site</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning mr-lg-3" href="index.php?action=logout">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
