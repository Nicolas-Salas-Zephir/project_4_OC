<?php ob_start(); ?>

    <?php if (isset($_GET['action'])): ?>
        <div id="blog" class="row blog-posts-content d-flex justify-content-center"> 
    <?php else: ?>
        <div class="row blog-posts-content"> 
    <?php endif ?>
    <?php while ($data = $posts->fetch()): ?>
        <?php if (isset($_GET['action']) == 'blog'): ?>
            <div class="col-sm-12 col-md-8">
        <?php else: ?>
            <div class="col-sm-12 col-lg-6">
        <?php endif; ?>
            <div class="post mb-5 mt-5">
                <div class="post-img"></div>
                <div class="post-main">
                    <div class="post-content">
                        <p class="d-flex align-items-baseline"><i class="fas fa-user mr-3"></i><?= $data['author']; ?></p>
                        <h2><a href="index.php?action=post&id=<?= $data['id']; ?>#content-article"><?= $data['title']; ?></a></h2>
                        <p><?php
                            $rest = substr($data['content'], 0, 300); 
                            echo $rest;
                        ?>
                        <a href="index.php?action=post&id=<?= $data['id']; ?>#content-article">Lire la suite</a>
                        </p>
                    </div>
                </div>
                <?php if (isset($_GET['action'])): ?>   
                <div class="d-flex align-items-baseline post-footer border-top">
                    <div>
                        <p>Le <?= $data['create_date_fr']; ?></p>
                    </div>
                    <div class="post-link">
                        <a href="index.php?action=post&id=<?= $data['id']; ?>#comments">Voir les commentaires</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php if (isset($_GET['page']) && $_GET['page']): ?>
    <div class="d-flex justify-content-center mb-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for($i = 1; $i <= $totalPage; $i++): ?>
                    <?php if($i == $page): ?>
                            <li class="page-item active" aria-current="page"><a href="index.php?action=blog&amp;page=<?= $i ?>" class="page-link" href="#"><?= $i ?></a></li>
                        <?php else: ?>
                            <li class="page-item"><a href="index.php?action=blog&amp;page=<?= $i ?>" class="page-link" href="#"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>    
            </ul>
        </nav>
    </div>
<?php endif; ?>
<?php
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('templateFrontend.php'); ?>