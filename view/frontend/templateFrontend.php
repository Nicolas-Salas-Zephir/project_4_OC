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
              <h1>LOGO</h1>
            </div>
            <nav>
              <ul>
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="index.php?action=blog" class="link">blog</a></li>
                <li><a class="link">qui je suis</a></li>
                <li><a class="link">du text</a></li>
                <li><a href='index.php?action=identification' class="link">Se
                    connecter</a></li>
                <li><a href='index.php?action=userRegistration' class="link">S'inscrire</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <header>
          <div class="menu-hamburger">
            <a href="#hamburger-toggle" id="hamburger-toggle">
              <img src="./public/images/Menu_icon_2_icon-icons.com.svg" />
            </a>
          </div>
          <nav class="show nav-hamburger pb-5">
            <div class="cross d-flex justify-content-end show mr-4 mt-4">X</div>
            <ul class="d-flex flex-column justify-content-center
              align-items-center">
              <li><a href="index.php" class="active">Accueil</a></li>
              <li><a href="index.php?action=blog" class="link">blog</a></li>
              <li><a class="link">qui je suis</a></li>
              <li><a class="link">du text</a></li>
              <li><a href='index.php?action=identification' class="link">Se
                  connecter</a></li>
              <li><a href='index.php?action=userRegistration' class="link">S'inscrire</a></li>
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
              </div>
              <footer class="d-flex align-items-center">
                <div class="container">
                  <div class="row">
                    <div class="col-xs-12">
                      <p>Ce site est un projet étudiant OpenClassRoom</p>
                    </div>
                  </div>
                </div>
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