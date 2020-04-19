<?php 

$title = 'ADMIN'; 
ob_start(); 
?>


    <h1>ADMIN</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>
    <form action="index.php?action=addPost" method="post">
        <div>
            <label for="title">Titre :</label><br />
            <input type="text" id="title" name="title" />
        </div>
        <div>
            <label for="author">Auteur :</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <label for="mytextarea">Contenu :</label>
        <textarea name="content" id="mytextarea"></textarea>
        <div>
            <input type="submit" value="Envoyer" />
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>