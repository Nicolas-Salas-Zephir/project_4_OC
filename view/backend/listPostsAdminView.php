<?php ob_start(); ?>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] !== "modo"): ?>
<h1 id="list-posts-admin" class="text-center mb-5">Liste des articles publiés</h1>
<?php endif; ?>
<?php if(isset($_SESSION['role']) && $_SESSION['role'] === "modo"): ?>
    <?php if($comment['report_flag'] == 1): ?>
    <h1 class="text-danger text-center mb-5"><?= $comment['report_flag'] ?> commentaire signalé</h1>
    <?php elseif($comment['report_flag'] > 1): ?>
    <h1 class="text-danger text-center mb-5"><?= $comment['report_flag'] ?> commentaires signalés</h1>
    <?php elseif($comment['report_flag'] == 0): ?>
    <h1 class="text-danger text-center mb-5">Il n'y a aucun commentaires signalés</h1>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] === "modo" || $_SESSION['role'] === "admin"): ?>
    <?php if($comment['report_flag'] > 1): ?>
        <div class="row mb-5">
            <div class="col-sm-12">
                <div class="table-responsive-sm">
                    <table class="table table-striped table-dark">
                        <caption>Liste des commentaires signalés</caption>
                        <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">Auteurs</th>
                            <th scope="col">Commentaires</th>
                            <th scope="col">Signalements</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($flagComments = $comments->fetch()): ?>
                                <tr>
                                    <th scope="row"><?= $count += 1 ?></th>
                                    <td><?= $flagComments['author']; ?></td>
                                    <td><?= $flagComments['comment']; ?></td>
                                    <td>
                                        <a href="index.php?action=postAdmin&id=<?= $flagComments['post_id']; ?>#comment<?= $flagComments['id']; ?>" class="text-light">Voir</a>  
                                    </td>
                                </tr>
                        <?php endwhile; ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] !== "modo"): ?>
    <?php while ($data = $posts->fetch()): ?>
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 ">
                <div id="post-id" class="post post-backend mb-5 mt-5">
                    <div class="post-main">
                        <div class="post-content d-flex flex-row justify-content-between align-items-center">
                            <div class="post-main__content">
                                <p><i class="fas fa-user mr-3"></i><?= $data['author']; ?></p>                            
                                <h2><?= $data['title']; ?></h2>
                                <p><?php
                                        $rest = substr($data['content'], 0, 300); 
                                        echo $rest;
                                    ?> [ ... ]</p>
                            </div>
                            <div id="eye-icon-<?= $comment['post_id']; ?>" class="post-main__view">
                                <a href="index.php?action=postAdmin&id=<?= $data['id']; ?>#postBakend"><i class="far fa-eye text-info"></i></a>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php
endif;
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>