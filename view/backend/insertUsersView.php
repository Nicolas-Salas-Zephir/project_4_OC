<?php 
ob_start(); 
$count = 0;
?>  
        <h1 id="superUser">Titre</h1>

        

        <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = $users->fetch()): ?>
                    <?php if(isset($user['role']) && !$user['role'] == "" ): ?>
                    <tr>
                        <th scope="row"><?= $count += 1 ?></th>
                        <td><?= $user['pseudo']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td>
                        <?php if($user['role'] == "modo" ): ?>
                            <?= "Modérateur" ?>
                        <?php elseif($user['role'] == "admin"): ?>
                            <?= "Administrateur" ?>
                        <?php elseif($user['role'] == "editor"): ?>
                            <?= "Éditeur" ?>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="row mb-5 mt-5">
            <div class="col-md-12">
                <form action="index.php/action=validRole" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputRole">Rôle</label>
                            <select class="form-control" id="inputRole">
                                <option value=""></option>
                                <option value="admin">Administrateur</option>
                                <option value="modo">Modérateur</option>
                                <option value="editor">Éditeur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputpseudo">Pseudonyme</label>
                            <input class="form-control" type="text" id="inputpseudo">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4">
                        </div>
                    </div>
                </form>
            </div>
        </div>



        

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>