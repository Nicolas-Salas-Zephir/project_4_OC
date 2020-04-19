<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="./public/css/style.css" rel="stylesheet" /> 
        
    </head>        
    <body>
    <h1><?= $title ?></h1>
    <nav>
        <a href="index.php">Acceuil</a>
        <a href="index.php?action=blog">Blog</a>
        <a href='index.php?action=admin'>Administrateur</a>
    </nav>
        <?= $content ?>
    </body>
</html>