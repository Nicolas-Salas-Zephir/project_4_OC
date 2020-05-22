<?php 
$title = 'Page d\'erreur'; 
ob_start();
?>

    <div class="row">
        <div class="col-12 text-center">
            <h1 class="p-3">Une erreur est survenue : <?= $ErrorMessage ?></h1>
        </div>
        <div class="col-12 text-center">
            <a href="<?= "index.php"; ?>">Retour à la principale</a>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateErrorView.php'); ?>