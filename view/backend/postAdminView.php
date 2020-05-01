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
                    <a href="index.php?action=viewAdminPost&amp;postId=<?= $post['id'] ?>" class="mr-5">Modifier</a>
                    <a href="index.php?action=deletePost&amp;postId=<?= $post['id'] ?>">Effacer</a>
                </div>
                

                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Effacer
                </button>
                </div> -->

                <!-- <a href="index.php?action=viewAdminPost&amp;postId=<?= $post['id'] ?>" data-toggle="modal" data-target="#exampleModal">Effacer</a> -->


                <!-- Modal -->
                <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLabel">Attention</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Vous êtes sur le point d'effacer tout le contenu de l'article. </br> Cette action est irréversible
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Ne pas effacer</button>
                            <form action="index.php?action=viewAdminPost&amp;postId=<?= $post['id'] ?>">
                                <button type="submit" class="btn btn-danger">Effacer</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div> -->
                

               
            </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>