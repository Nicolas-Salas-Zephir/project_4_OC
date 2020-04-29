<?php 
$title = 'Mon blog'; 
ob_start(); 
?>

        <h1>Modifier le commentaire</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <form action="index.php?action=editComment&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $comment['post_id'] ?>" method="post">
            <div>
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" value="<?= $comment['author'] ?>" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"><?= $comment['comment'] ?></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
        

<?php $content = ob_get_clean(); ?>

<?php require('templateFrontend.php'); ?>