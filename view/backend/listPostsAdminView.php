<?php 
$title = 'LISTE DES ARTICLES'; 
$navigation = "navBackend.php";
?>

<?php ob_start(); ?>

<?php
while ($data = $posts->fetch())
{
?>
    
    <div class="col-sm-12">
        <div id="post-id" class="post post-backend mt-5">
            <div class="post-main">
                <div class="post-content">
                    <p><i class="fas fa-user mr-3"></i><?= $data['author']; ?></p>
                    <h2><a href="index.php?action=post&id=<?= $data['id']; ?>"><?= $data['title']; ?></a></h2>
                    <p><?php
                            $rest = substr($data['content'], 0, 300); 
                            echo $rest;
                        ?>
                     </p>
                </div>
            </div>
            <div class="post-footer">
                <div class="post-link">
                    <a><i class="far fa-trash-alt text-danger"></i></a>
                    <a href=""><i class="far fa-edit text-primary"></i></a>
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