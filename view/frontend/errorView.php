<?php 
$title = 'Page d\'erreur'; 
ob_start();
?>

    <div class="row">
        <div class="col-12 text-center">
            <?php if ($ErrorMessage == "La page n'existe pas !!!"): ?>
                <h1 class="p-3"><?= $ErrorMessage ?></h1>
            <?php else: ?>
                <h1 class="p-3">Une erreur est survenue : <?= $ErrorMessage ?></h1>
            <?php endif; ?>
        </div>
        <div class="col-12 text-center">
            <a href="<?= "index.php"; ?>">Retour à la principale</a>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateErrorView.php'); ?>