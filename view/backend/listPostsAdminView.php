<?php 
$title = 'LISTE DES ARTICLES'; 
$navigation = "navBackend.php";
?>

<?php ob_start(); ?>

<h1 id="list-posts-admin" class="text-center">Liste des articles publiés</h1>
<?php
while ($data = $posts->fetch())
{
?>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 ">
            <div id="post-id" class="post post-backend mb-5 mt-5">
                <div class="post-main">
                    <div class="post-content d-flex flex-row justify-content-between align-items-center">
                        <div class="post-main__content">
                            <p><i class="fas fa-user mr-3"></i><?= $data['author']; ?></p>
                            <h2><?= $data['title']; ?></h2>
                            <p><?php
                                    $rest = substr($data['content'], 0, 300); 
                                    echo $rest;
                                ?></p>
                        </div>
                        <div class="post-main__view ">
                            <a href="index.php?action=postAdmin&id=<?= $data['id']; ?>#postBakend"><i class="far fa-eye text-info"></i></a>
                        </div>
                    </div>
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