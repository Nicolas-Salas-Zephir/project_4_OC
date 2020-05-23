<?php 
$title = 'Erreur'; 
?>

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
        <div <?php 
            if ($ErrorMessage !== "La page n'existe pas !!!") {
                echo "style='width: 100%; background-color: #214C55;'";
            }
            ?>>
            <div class="main-error d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <?php if ($ErrorMessage == "La page n'existe pas !!!"): ?>
                            <div class="col-12 text-center">
                                <img src="./public/images/page404.jpg" alt="Image 404">
                                <h1 class="p-3"><?= $ErrorMessage ?></h1>
                            </div>
                        <?php else: ?>
                            <div class="col-12 text-center">
                                <img src="./public/images/messageError.jpg"  style="width: 70%;" alt="Image erreur">
                                <h1 class="p-3 mt-3" style="color: white;">Une erreur est survenue : <?= $ErrorMessage ?></h1>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 text-center">
                            <a href="<?= "index.php"; ?>">Retour à la principale</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>