<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./public/css/style.css" rel="stylesheet" />
      <link href="./public/css/min-reset.css" rel="stylesheet" />
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
                <li><a href="index.php?action=blog" class="link">blog</a></li>
                <li><a class="link">qui je suis</a></li>
                <li><a class="link">du text</a></li>
                <li class="nav-item dropdown">
                <?php if(isset($_SESSION['pseudo']) && isset($_SESSION['id'])): ?>
                  <a class="link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Espace administrateur</a>
                  <div class="dropdown-menu">
                      <a class="dropdown-item"  href='index.php?action=postsAdmin' class="link">Espace administrateur</a>
                      <a class="dropdown-item"  href="index.php?action=logout" class="link">Déconnexion</a>
                <?php else: ?>
                  <a class="link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Connexion</a>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="index.php?action=identification">Se connecter</a>
                      <a class="dropdown-item" href="index.php?action=userRegistration">S'inscrire</a>
                <?php endif ?>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <?php if (isset($_GET['action'])) : ?>
          <header class="header-xs" >
        <?php else: ?>
            <header class="header-xl" >
        <?php endif ?>
          <div class="menu-hamburger">
            <a href="#hamburger-toggle" id="hamburger-toggle">
              <img src="./public/images/Menu_icon_2_icon-icons.com.svg" />
            </a>
          </div>
          <nav class="show nav-hamburger pb-5">
            <div class="cross d-flex justify-content-end show mr-5 mt-4">X</div>
            <ul class="d-flex flex-column justify-content-center
              align-items-center">
              <li><a href="index.php" class="active">Accueil</a></li>
              <li><a href="index.php?action=blog" class="link">blog</a></li>
              <li><a class="link">qui je suis</a></li>
              <li><a class="link">du text</a></li>
              <?php if(isset($_SESSION['pseudo']) && isset($_SESSION['id'])): ?>
                <li><a href='index.php?action=postsAdmin' class="link">Espace administrateur</a></li>
                <li><a href="index.php?action=logout" class="link">Déconnexion</a></li>
              <?php else: ?>
                <li><a href='index.php?action=identification' class="link">Se connecter</a></li>
                <li><a href='index.php?action=userRegistration' class="link">S'inscrire</a></li>
              <?php endif ?>
            </ul>
          </nav>

          <?php if (isset($_GET['action'])): ?>
          <div class='header-img-blog'>
          </div>
          <?php else: ?>
          <div class='header-img'></div>
          <?php endif; ?>
        </header>
          <div class="container-fluid main">
            <?= $content ?>
          </div>
          <footer class="d-flex align-items-center">
              <a href="https://openclassrooms.com/" target="_blank"><p class="ml-5">Ce site est un projet étudiant OpenClassRoom</p></a>
          </footer>
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