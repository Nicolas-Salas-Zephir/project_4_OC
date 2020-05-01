<?php 

$title = 'Mon blog'; 
$navigation = "navBackend.php";
ob_start(); 
?>  
        <div class="row blog-posts-content blog-posts-content__backend d-flex justify-content-center"> 
            <div class="col-sm-7 d-flex align-items-baseline mb-5 blog-post__info">
                <i class="fas fa-user mr-2"></i><span><?= $post['author']; ?></span>
                <i class="far fa-clock ml-5 mr-2"></i><span><?= $post['create_date_fr']; ?></span>
            </div>

        <!-- <div class="row blog-posts-content d-flex justify-content-center">  -->
            <div class="col-sm-12 col-md-7 d-flex justify-content-start mb-3">
                <h1><?= $post['title'] ?></h1>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="news mb-5">
                    <p><?= $post['content']; ?></p>
                    <a href="index.php?action=viewAdminPost&amp;postId=<?= $post['id'] ?>">Modifier</a>
                    <a href="index.php?action=viewAdminPost&amp;postId=<?= $post['id'] ?>">Effacer</a>
                </div>
                
                

               
            </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>