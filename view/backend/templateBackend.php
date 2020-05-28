<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="./public/css/style.css" rel="stylesheet" />
      <link href="./public/css/min-reset.css" rel="stylesheet" />
      <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
        />
      <?php if(isset($_GET['action']) && $_GET['action'] == "admin" || isset($_GET['action']) && $_GET['action'] == 'viewAdminPost'): ?>
        <script src="https://cdn.tiny.cloud/1/wfzahiopz5oatrodub9d4woydvz1ywku0wspusi7zdcunqvc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
        tinymce.init({
          selector: '#mytextarea',
          height: 500
        });
        </script>
      <?php endif ?>
  </head>
  <body>
      <div id="backToTheTop">
          <a class="arrow-up" href="#"></a>
      </div>

      
      <?php if (isset($navigation)): ?>
        <?php include $navigation; ?>
      <?php endif; ?>
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
              <h1 class="display-4">Espace administrateur de <?= $_SESSION['pseudo'];?></h1>
            <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == "editor"): ?>
              <h1 class="display-4">Espace éditeur de <?= $_SESSION['pseudo'];?></h1>
            <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == "modo"): ?>
              <h1 class="display-4 d-flex align-items-center">Espace modérateur de <?= $_SESSION['pseudo'];?></h1>
            <?php endif ?>
            <p class="lead"></p>
          </div>
        </div>
        <div class='header-img-blog mb-5 d-flex align-items-end justify-content-end'>
          <h1><a href="index.php"><img src="https://fontmeme.com/permalink/200503/c43085b2a66bfe90f1e505be73ec8971.png" alt="polices-de-signature" border="0"></a></h1>
        </div>
      <div class="container">
        <?= $content ?>
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