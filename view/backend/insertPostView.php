<?php 

$title = 'ADMIN'; 
ob_start(); 
?>


    <h1>ADMIN</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="col-12">
        <form action="index.php?action=addPost" method="post">
            <div class="form-group">
                <label for="title">Titre :</label><br />
                <input type="text" class="form-control"  id="title" name="title" aria-describedby="emailHelp"/>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
                <label for="author">Auteur :</label><br />
                <input type="text" class="form-control" id="author" name="author"/>
            </div class="form-group">
                <label for="mytextarea">Contenu :</label>
                <textarea name="content" id="mytextarea"></textarea>
            <div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>