<?php 
$navigation = "navBackend.php";
$title = 'ADMIN'; 
ob_start(); 
?>
    <div class="row">
        <div class="col-12">
            <h1>ADMIN</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p><a href="index.php">Retour à la liste des billets</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <h3>Envoi d'une image</h3>
            <form enctype="multipart/form-data" action="#" method="post">
                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                    <input type="file" name="fic" size=50 />
                    <button type="submit"  class="btn btn-primary">Envoyer</button>
                </div>
            </form>
            <form action="index.php?action=addPost" method="post">
                <div class="form-group">
                    <label for="title">Titre :</label><br />
                    <input type="text" class="form-control"  id="title" name="title" aria-describedby="emailHelp" placeholder="Titre de l'article"/>
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
                <div class="form-group">
                    <label for="author">Auteur :</label><br />
                    <input type="text" class="form-control" id="author" name="author" placeholder="Nom et Prénom"/>
                </div class="form-group">
                    <label for="mytextarea">Contenu :</label>
                    <textarea name="content" id="mytextarea" placeholder="Contenu de l'article"></textarea>
                <div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>