<?php 
ob_start(); 
?>
    <div class="row">
        <div class="col-12">
            <h1 id="addPost">Ajouter un article</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p><a href="index.php?action=postsAdmin">Retour à la liste des billets</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">            
            <form enctype="multipart/form-data" action="index.php?action=addPost" method="post">
                <div class="form-group">
                    <label for="title">Titre :</label><br />
                    <input type="text" class="form-control"  id="title" name="title" aria-describedby="emailHelp" placeholder="Titre de l'article"/>
                </div>
                <div class="form-group">
                    <label for="author">Auteur :</label><br />
                    <input type="text" class="form-control" id="author" name="author" placeholder="Nom et Prénom" value="<?= $_SESSION['pseudo'] ?>"/>
                </div class="form-group">
                    <label for="mytextarea">Contenu :</label>
                    <textarea name="content" id="mytextarea" placeholder="Contenu de l'article"></textarea>
                <div class="mt-4 mb-5">
                    <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>