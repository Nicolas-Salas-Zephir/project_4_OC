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

      <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

      <body>
        <div class="container">
          <div class="identification d-flex flex-column justify-content-center">
            <div class="row mb-5">
              <div class="col-lg-12 d-flex justify-content-center">
                <h1>Se connecter</h1>
              </div>
              <div class="col-lg-12 d-flex justify-content-center">
                <p><a href="index.php">Retour à la page d'accueil</a></p>
              </div>
            </div>

            <div class="row d-flex justify-content-center">
              <div class="col-md-4">
                <form action="index.php?action=postsAdmin" method="post">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                      id="username" name="username" placeholder="Votre nom"
                      required/>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg"
                      id="password" name="password" placeholder="Mot de passe"
                      required/>
                  </div>
                  <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg
                      btn-block">Valider</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

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