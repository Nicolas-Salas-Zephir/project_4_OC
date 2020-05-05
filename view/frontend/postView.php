<?php 
session_start();
$title = 'Mon blog'; 
ob_start(); 
?>  
        <div id="content-article" class="row blog-posts-content d-flex justify-content-center mt-5 mb-5"> 
            <div class="col-sm-7 d-flex align-items-baseline mb-5 blog-post__info">
                <i class="fas fa-user mr-2"></i><span><?= $post['author']; ?></span>
                <i class="far fa-clock ml-5 mr-2"></i><span><?= $post['create_date_fr']; ?></span>
            </div>

        <!-- <div class="row blog-posts-content d-flex justify-content-center">  -->
            <div class="col-sm-8 col-md-7 d-flex justify-content-start mb-3">
                <h1><?= $post['title'] ?></h1>
            </div>
            <div class="col-sm-8 col-md-7">
                <div class="news mb-5">
                    <p><?= $post['content']; ?></p>
                </div>
                
                
                <div id="comments" class="title-comments mb-4">
                    <h2>Commentaires</h2>
                </div>
                <?php
                while ($comment = $comments->fetch())
                {
                ?>

                    <div class="comment ml-3 mb-5 pb-5 border-bottom">
                        <p class="author"><?= htmlspecialchars($comment['author']) ?>
                        </p>
                        <p class="mb-5"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                        <p>Le <?= $comment['comment_date_fr'] ?> </p>
                    </div>
                <?php
                }
                ?>
                <?php if (isset($_SESSION['pseudo']) && isset($_SESSION['id'])): ?>
                <h3 class="mb-5">Donnez votre avis</h3>
                    <div class="row">
                        <div class="col-md-9 col-sm-12 ">
                            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>#comments" method="post">
                                <div class="form-group mb-4">
                                    <p class="author"><?= $_SESSION['pseudo'] ?></p>
                                    <input type="hidden" name="author" id="author" value="<?= $_SESSION['pseudo'] ?>">
                                    
                                    
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                    <textarea  class="form-control" id="comment" name="comment" placeholder="Votre commentaire" rows="10" required></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-dark">Envoyer</button>
                                </div>
                            </form>
                            <?php var_dump($_SESSION) ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateFrontend.php'); ?>