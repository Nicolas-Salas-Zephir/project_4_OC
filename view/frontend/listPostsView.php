<?php $title = 'PAGE PRINCIPALE'; ?>

<?php ob_start(); ?>

<div class="row blog-posts-content d-flex justify-content-center"> 
<?php

while ($data = $posts->fetch())
{
?>
        <?php if (isset($_GET['action']) == 'blog'): ?>
            <div class="col-sm-8">
        <?php else: ?>
            <div class="col-sm-12 col-lg-6">
        <?php endif; ?>
        <div id="post-id" class="post">
            <div class="post-img">
                <!-- <img> -->
                IMAGE
            </div>
            <div class="post-main">
                <div class="post-content">
                    <p><i class="fas fa-user mr-3"></i><?= $data['author']; ?></p>
                    <h2><a href="index.php?action=post&id=<?= $data['id']; ?>"><?= $data['title']; ?></a></h2>
                    <p><?php
                        $rest = substr($data['content'], 0, 300); 
                        echo $rest;
                     ?>
                     <a href="index.php?action=post&id=<?= $data['id']; ?>">Lire la suite</a>
                     </p>
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
?>
</div>
<?php
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('templateFrontend.php'); ?>