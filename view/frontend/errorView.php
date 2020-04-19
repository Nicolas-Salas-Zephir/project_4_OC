<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<p>Une erreur est survenue : <?= $ErrorMessage ?></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>