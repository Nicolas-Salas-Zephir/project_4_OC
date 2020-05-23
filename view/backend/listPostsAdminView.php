<?php ob_start(); ?>


<?php if(isset($_SESSION['role']) && $_SESSION['role'] === "modo" || $_SESSION['role'] === "admin"): ?>
    <?php if($comment['report_flag'] == 1): ?>
    <h1 class="text-danger text-center mb-5"><?= $comment['report_flag'] ?> commentaire signalé</h1>
    <?php elseif($comment['report_flag'] > 1): ?>
    <h1 class="text-danger text-center mb-5"><?= $comment['report_flag'] ?> commentaires signalés</h1>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] === "modo" || isset($_SESSION['role']) && $_SESSION['role'] === "admin"): ?>
    <?php if($comment['report_flag'] >= 1): ?>
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
    <h1 id="list-posts-admin" class="text-center mb-5">Liste des articles publiés</h1>
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
<?php endif; ?>
<?php if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor"): ?>
    <?php if (isset($_GET['page']) && $_GET['page']): ?>
    <div class="mb-5">
        <nav id="paginationNav" aria-label="Page navigation example">
            <ul class="pagination pagination-sm d-flex justify-content-center ">
                <?php if($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=postsAdmin&amp;page=<?= $_GET['page'] - 1 ?>#paginationNav" aria-disabled="true">Retour</a>
                </li>
                <?php elseif($_GET['page'] == 1): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-disabled="true">Retour</a>
                </li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $totalPage; $i++): ?>
                    <?php if($i == $_GET['page']): ?>
                            <li class="page-item active" aria-current="page"><a href="index.php?action=postsAdmin&amp;page=<?= $i ?>#paginationNav" class="page-link" href="#"><?= $i ?></a></li>
                        <?php else: ?>
                            <li class="page-item"><a href="index.php?action=postsAdmin&amp;page=<?= $i ?>#paginationNav" class="page-link" href="#"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>    
                <?php if($_GET['page'] >= 1 && $_GET['page'] < $totalPage): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=postsAdmin&amp;page=<?= $_GET['page'] + 1 ?>#paginationNav" tabindex="1" aria-disabled="true">Suivant</a>
                </li>
                <?php elseif($_GET['page'] == $totalPage): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="1" aria-disabled="true">Suivant</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php 
$posts->closeCursor(); 
$content = ob_get_clean(); 
require('templateBackend.php'); 
?>