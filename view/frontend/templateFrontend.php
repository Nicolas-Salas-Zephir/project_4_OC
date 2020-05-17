<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="utf-8" />
      <title><?= $title ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./public/css/style.css" rel="stylesheet" />
      <link href="./public/css/min-reset.css" rel="stylesheet" />
      <link rel="icon" href="https://fontmeme.com/permalink/200503/c43085b2a66bfe90f1e505be73ec8971.png" />
      <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
        />
  </head>
  <body>
    <div id="backToTheTop">
        <a class="arrow-up" href="#"></a>
    </div>

    <div id="wrapper">
        <div id="sidebar">
          <div class="sidebar__container">
            <div class="sidebar__logo">
                <h1><a href="index.php"><img src="https://fontmeme.com/permalink/200503/c43085b2a66bfe90f1e505be73ec8971.png" alt="polices-de-signature" border="0"></a></h1>
            </div>
            <nav>
              <ul class="nav flex-column">
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="index.php?action=blog#blog" class="link">blog</a></li>
                <li><a href="index.php?action=authorDescript#author" class="link">qui suis-je ?</a></li>
                <li class="nav-item dropdown">
                  <?php if(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a class="link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Espace administrateur</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  href='index.php?action=postsAdmin' class="link">Espace administrateur</a>
                        <a class="dropdown-item"  href="index.php?action=logout" class="link">Déconnexion</a>
                    </div>
                  <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'editor'): ?>
                    <a class="link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Espace éditeur</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  href='index.php?action=postsAdmin' class="link">Espace éditeur</a>
                        <a class="dropdown-item"  href="index.php?action=logout" class="link">Déconnexion</a>
                    </div>
                  <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'modo'): ?>
                    <a class="link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Espace modérateur</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  href='index.php?action=postsAdmin' class="link">Espace modérateur</a>
                        <a class="dropdown-item"  href="index.php?action=logout" class="link">Déconnexion</a>
                    </div>
                  <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 0): ?>
                    <a href="index.php?action=logout" class="link text-warning">Déconnexion</a>
                  <?php else: ?>
                    <a class="link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Connexion</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?action=identification">Se connecter</a>
                        <a class="dropdown-item" href="index.php?action=userRegistration">S'inscrire</a>
                    </div>
                  <?php endif ?>
                </li>
              </ul>
            </nav>
          </div>
        </div>
    <?php if (isset($_GET['action'])): ?>
        <header class="header-xs" >
    <?php else: ?>
        <header class="header-xl" >
    <?php endif; ?>
            <div class="menu-hamburger">
                <a href="#hamburger-toggle" id="hamburger-toggle">
                  <img src="./public/images/Menu_icon_2_icon-icons.com.svg" />
                </a>
            </div>
            <nav class="showw nav-hamburger pb-5">
                <div class="cross d-flex justify-content-end showw mr-5 mt-4">X</div>
                <ul class="d-flex flex-column justify-content-center align-items-center">
                      <li><a href="index.php" class="active text-center">Accueil</a></li>
                      <li><a href="index.php?action=blog" class="link text-center">blog</a></li>
                      <li><a href="index.php?action=authorDescript" class="link text-center">qui je suis ?</a></li>
                    <?php if(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                      <li><a href='index.php?action=postsAdmin' class="link text-center">Espace administrateur</a></li>
                      <li><a href="index.php?action=logout" class="link text-center mb-5">Déconnexion</a></li>
                    <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'editor'): ?>
                      <li><a href='index.php?action=postsAdmin' class="link text-center">Espace éditeur</a></li>
                      <li><a href="index.php?action=logout" class="link text-center mb-5">Déconnexion</a></li>
                    <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'modo'): ?>
                      <li><a href='index.php?action=postsAdmin' class="link text-center">Espace modérateur</a></li>
                      <li><a href="index.php?action=logout" class="link text-center mb-5">Déconnexion</a></li>
                    <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 0): ?>
                      <li><a href="index.php?action=logout" class="link text-center mb-5">Déconnexion</a></li>
                    <?php else: ?>
                      <li><a href='index.php?action=identification' class="link text-center">Se connecter</a></li>
                      <li><a href='index.php?action=userRegistration' class="link text-center">S'inscrire</a></li>
                    <?php endif ?>
                </ul>
            </nav>
            <?php if (isset($_GET['action'])): ?>
              <div class='header-img-blog d-flex align-items-end justify-content-end'>
                <h1 class="hidden"><a href="index.php"><img src="https://fontmeme.com/permalink/200503/c43085b2a66bfe90f1e505be73ec8971.png" alt="polices-de-signature" border="0"></a></h1>
              </div>
            <?php else: ?>
                <div class='header-img'>
                  <div class="container">
                    <div class="row d-flex flex-column justify-content-center align-items-center">
                      <h1 class="title-main text-white">Voyages en Alaska</h1>
                      <h2 class="title-main text-white"><img src="https://fontmeme.com/permalink/200503/c43085b2a66bfe90f1e505be73ec8971.png" alt="polices-de-signature" border="0"></h2>
                    </div>
                    <!-- <div class="row d-flex justify-content-center">
                      <h2 class="hidden"><a href="index.php"><img src="https://fontmeme.com/permalink/200503/c43085b2a66bfe90f1e505be73ec8971.png" alt="polices-de-signature" border="0"></a></h2>
                    </div> -->
                  </div>
                </div>
            <?php endif; ?>
        </header>
        <div class="container-fluid bg main">
          <?= $content ?>
        </div>
        <footer class="d-flex align-items-center">
            <div class="container-fluid">
              <div class="row mt-2 mb-4">
                <div class="col-12">
                  <a href="https://openclassrooms.com/" target="_blank"><p class="ml-5">Ce site est un projet étudiant OpenClassRoom</p></a>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-12">
                  <a href="http://www.gutenberg.org/files/7345/7345-h/7345-h.htm" target="_blank"><p class="ml-5">Livre utilisé pour ce projet</p></a>
                </div>
              </div>
            </div>
        </footer>
      </div>
      <script src="./public/js/script.js"></script>
      <script src="https://kit.fontawesome.com/d441c3b81b.js"
        crossorigin="anonymous"></script>
      <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
      <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
      <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
  </body>
</html>