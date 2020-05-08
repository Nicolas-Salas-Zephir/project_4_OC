<?php 
ob_start(); 
?>  
        <div class="row blog-posts-content blog-posts-content__backend d-flex justify-content-center"> 
            <div class="col-sm-7 d-flex align-items-baseline mb-5 blog-post__info">
                <i class="fas fa-user mr-2"></i><span><?= $post['author']; ?></span>
                <i class="far fa-clock ml-5 mr-2"></i><span><?= $post['create_date_fr']; ?></span>
            </div>
            <div class="col-sm-12 col-md-7 d-flex justify-content-start mb-3">
                <h1 id="postBakend"><?= $post['title'] ?></h1>
            </div>
            <div class="col-sm-12 col-md-7 mb-5">
                <div class="news mb-5">
                    <p><?= $post['content']; ?></p>
                </div>
                <?php if(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin' || isset($_SESSION['role']) && $_SESSION['role'] == 'editor'): ?>
                    <a href="index.php?action=viewAdminPost&amp;postId=<?= $post['id'] ?>#editPost" class="mr-5">Modifier</a>
                    <a href="index.php?action=deletePost&amp;postId=<?= $post['id'] ?>">Effacer</a>
                <?php elseif(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'modo'): ?>
                    <div id="comments" class="title-comments mb-4">
                        <h2>Commentaires</h2>
                    </div>
                <?php while ($comment = $comments->fetch()): ?>
                    <div class="comment ml-3 mb-5 pb-5 border-bottom">
                        <p class="author"><?= htmlspecialchars($comment['author']) ?>
                        </p>
                        <p class="mb-5"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                        <p>Le <?= $comment['comment_date_fr'] ?> </p>
                        <a href="index.php?action=deleteComment&amp;postId=<?= $post['id'] ?>&amp;id=<?= $comment['id'] ?>">Effacer le commentaire</a>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>