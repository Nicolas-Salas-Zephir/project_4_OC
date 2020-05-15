<?php 
ob_start(); 
?>
        <div class="mt-5 mb-5">
            <h1 id="editPost">Modifier l'article</h1>
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
                <label for="mytextarea">Article :</label>
                <textarea name="content" id="mytextarea" ><?= $post['content'] ?></textarea>
            </div>
            <div class="mb-5">
                <button type="submit" class="btn bnt-lg btn-primary">Valider</button>
            </div>
        </form>
        

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>