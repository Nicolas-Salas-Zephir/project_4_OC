<?php 

$title = 'LOGIN'; 
ob_start(); 
?>
    <!-- d-flex flex-column justify-content-center align-items-center -->
    <div class="identification d-flex flex-column justify-content-center">
        <div class="row  mb-5">
            <div class="col-lg-12 d-flex justify-content-center ">
                <h1>LOGIN</h1>
            </div>
            <div class="col-lg-12 d-flex justify-content-center ">
                <p><a href="index.php">Retour à la page d'accueil</a></p>
            </div>
        </div>

        <div class="row d-flex justify-content-center ">
            <div class="col-lg-4 ">
                <form action="index.php?action=addPost" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control"  id="title" name="title" aria-describedby="emailHelp" placeholder="Votre nom"/>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="author" name="author" placeholder="Mot de passe"/>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>