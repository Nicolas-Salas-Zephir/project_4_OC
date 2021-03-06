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
                <?php if (isset($_SESSION['pseudo'], $_SESSION['id'], $_SESSION['role'])): ?>
                    <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor' || $_SESSION['role'] === 'modo'): ?>
                        <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor'): ?>
                            <a href="index.php?action=viewAdminPost&amp;postId=<?= $post['id'] ?>#editPost" class="mr-5">Modifier</a>
                            <a href="index.php?action=deletePost&amp;postId=<?= $post['id'] ?>">Effacer</a>
                        <?php endif; ?>
                        <?php if($_SESSION['role'] === 'modo' || $_SESSION['role'] === 'admin'): ?>
                            <?php if ($totalComments['total_comment'] == 1): ?>
                                <h2 class="d-flex align-items-center mt-5 mb-5"><span class="totalComments mr-3 mt-1"><?= $totalComments['total_comment']; ?></span> Commentaire</h2>
                            <?php elseif ($totalComments['total_comment'] > 1): ?>
                                <h2 class="d-flex align-items-center mt-5 mb-5"><span class="totalComments mr-3 mt-1"><?= $totalComments['total_comment']; ?></span> Commentaires</h2>
                            <?php endif ?>
                            <?php while ($comment = $comments->fetch()): ?>
                                <div class="comment ml-3 mb-5 pb-5 border-bottom">
                                    <p id="comment<?= $comment['id'] ?>" class="author"><?= htmlspecialchars($comment['author']) ?></p>
                                    <p class="mb-5"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                    <p>Le <?= $comment['comment_date_fr'] ?> </p>
                                    <?php if ($comment['flag'] == 0): ?>
                                        <a href="index.php?action=deleteComment&amp;postId=<?= $post['id'] ?>&amp;id=<?= $comment['id'] ?>" class="text-secondary">Effacer le commentaire</a>
                                    <?php endif; ?>
                                    <?php if ($comment['flag'] == 1): ?>
                                        <p class="text-left text-success"><a href="index.php?action=reportCancel&amp;id=<?= $post['id'] ?>&amp;commentId=<?= $comment['id'] ?>&amp;flag=<?= $comment['flag'] ?>#comments" class="mr-5" >Retirer le signalement
                                        <a href="index.php?action=deleteComment&amp;postId=<?= $post['id'] ?>&amp;id=<?= $comment['id'] ?>" class="text-danger">Effacer le commentaire</a></p>
                                    <?php endif; ?>
                                    <?php if ($comment['flag'] == 2): ?>
                                        <p class="text-right text-success" data-toggle="tooltip" title="Commentaire approuvé"><img src="./public/images/emblemdefault.svg" alt="Icone validé"></p>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>   
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

<?php 
$content = ob_get_clean();
require('templateBackend.php'); 
?>