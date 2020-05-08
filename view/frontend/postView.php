<?php 
session_start();
$title = 'Mon blog'; 
ob_start(); 
?>  
        <div id="content-article" class="blog-posts-content d-flex flex-column justify-content-center mt-5 mb-5"> 
            <div class="row d-flex align-items-baseline justify-content-center mb-5">
                <div class="col-10 col-md-4 col-lg-3 col-xl-3">
                    <i class="fas fa-user mr-2"></i><span><?= $post['author']; ?></span>
                </div>
                <div class="col-10 col-md-4 col-lg-3 col-xl-3">
                    <i class="far fa-clock mr-2"></i><span><?= $post['create_date_fr']; ?></span>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-10 col-md-8 col-lg-6 col-xl-6">
                    <h1><?= $post['title'] ?></h1>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="news mb-5">
                        <p><?= $post['content']; ?></p>
                    </div>
                </div>  
            </div> 
                
                <div class="row d-flex justify-content-center">
                    <div class="col-10 col-md-8 col-lg-6 col-xl-6">
                        <div id="comments" class="title-comments mb-4">
                            <h2>Commentaires</h2>
                        </div>
                        <?php while ($comment = $comments->fetch()): ?>
                            <div class="comment ml-3 ml-3 mb-5 pb-5 border-bottom">
                                <p class="author"><?= htmlspecialchars($comment['author']) ?>
                                </p>
                                <p class="mb-5"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                <p>Le <?= $comment['comment_date_fr'] ?> </p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php if (isset($_SESSION['pseudo']) && isset($_SESSION['id'])): ?>
                
                <div class="row d-flex justify-content-center">
                    <div class="col-10 col-md-8 col-lg-6 col-xl-6">
                        <h3 class="mb-5">Donnez votre avis</h3>
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
                    </div>
                </div>
                <?php endif ?>
            
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateFrontend.php'); ?>