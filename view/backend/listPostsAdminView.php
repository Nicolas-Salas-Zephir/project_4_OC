<?php 
$title = 'LISTE DES ARTICLES'; 
$navigation = "navBackend.php";
?>

<?php ob_start(); ?>

<?php
while ($data = $posts->fetch())
{
?>
    
    <div class="col-sm-12 col-lg-6">
        <div id="post-id" class="post">
            <div class="post-main">
                <div class="post-content">
                    <p><i class="fas fa-user mr-3"></i><?= $data['author']; ?></p>
                    <h2><a href="index.php?action=post&id=<?= $data['id']; ?>"><?= $data['title']; ?></a></h2>
                    <p><?= $data['content']; ?></p>
                </div>
            </div>
            <div class="post-footer">
                <div class="post-link">
                    <a>le <?= $data['create_date_fr']; ?></a>
                </div>
                <div class="post-link">
                    <a>Commentaire du poste</a>
                </div>
            </div>
        </div>
    </div>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>