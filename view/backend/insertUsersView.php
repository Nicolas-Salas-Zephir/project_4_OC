<?php 
ob_start(); 
$count = 0;
?>  
        <div class="row">
            <div class="col-sm-12">
                <h1 id="superUser" class="mb-5">Ajouter un utilisateur</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive-sm">
                    <table class="table table-striped table-dark">
                        <caption>Liste des utilisateurs</caption>
                        <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Effacer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($user = $users->fetch()): ?>
                                <?php if(isset($user['role']) && !$user['role'] == "" ): ?>
                                <tr>
                                    <th scope="row"><?= $count += 1 ?></th>
                                    <td><?= $user['pseudo']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td class="">
                                    <?php if($user['role'] == "modo" ): ?>
                                        <?= "Modérateur" ?>
                                    <?php elseif($user['role'] == "admin"): ?>
                                        <?= "Admin" ?>
                                    <?php elseif($user['role'] == "editor"): ?>
                                        <?= "Éditeur" ?>
                                    <?php endif; ?>
                                    </td>
                                    <td><a href="index.php?action=deleteUser&amp;id=<?= $user['id'] ?>"><img src="./public/images/cross.svg" class="cross-role text-right" alt="icône-effacer"></a></td>
                                </tr>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <h3 class="mt-5">Créer un nouvel utilisateur et l’ajouter à ce site.</h3>                    
        <div class="row mb-5 mt-5">
            <div class="col-md-12">
                <form action="index.php?action=validRole" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputRole">Rôle</label>
                            <select class="form-control" id="inputRole" name="role">
                                <option value="" selected></option>
                                <option value="admin">Administrateur</option>
                                <option value="modo">Modérateur</option>
                                <option value="editor">Éditeur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputpseudo">Pseudonyme</label>
                            <input class="form-control" type="text" id="inputpseudo" name="pseudo">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Mot de passe</label>
                            <input type="password" class="form-control" id="inputPassword4" name="password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Retaper votre mot de passe</label>
                            <input type="password" class="form-control" id="inputPassword4" name="password1">
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>