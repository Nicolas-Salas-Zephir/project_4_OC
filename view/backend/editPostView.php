<?php 
$title = 'Mon blog'; 
$navigation = "navBackend.php";
ob_start(); 
?>

        <div class="mt-5">
            <h1>Modifier l'article</h1>
            <p><a href="index.php">Retour à la liste des billets</a></p>
        </div>

        <form action="index.php?action=editPost&amp;postId=<?= $post['id'] ?>" method="post">
            <div class="form-group">
                <label for="author">Auteur :</label><br />
                <input type="text" class="form-control" id="author" name="author" value="<?= $post['author'] ?>" />
            </div>
            <div class="form-group">
                <label for="title">Titre : </label><br />
                <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>" />
            </div>
            <div class="form-group">
                <label for="content">Article :</label><br />
                <textarea class="form-control" rows="10" id="content" name="content"><?= $post['content'] ?></textarea>
            </div>
            <div class="mb-5">
                <button type="submit" class="btn bnt-lg btn-primary">Valider</button>
            </div>
        </form>
        

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>