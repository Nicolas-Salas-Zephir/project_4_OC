<?php 

$title = 'LOGIN'; 
ob_start(); 
?>
    <!-- d-flex flex-column justify-content-center align-items-center -->
    <div class="identification d-flex flex-column justify-content-center">
        <div class="row  mb-5">
            <div class="col-lg-12 d-flex justify-content-center ">
                <h1>Se connecter</h1>
            </div>
            <div class="col-lg-12 d-flex justify-content-center ">
                <p><a href="index.php">Retour à la page d'accueil</a></p>
            </div>
        </div>

        <div class="row d-flex justify-content-center ">
            <div class="col-md-4 ">
                <form action="index.php?action=addPost" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg"  id="username" name="username" placeholder="Votre nom"required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Mot de passe"required/>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>