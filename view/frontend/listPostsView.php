<?php $title = 'PAGE PRINCIPALE'; ?>

<?php ob_start(); ?>

        
<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <a href="index.php?action=post&id=<?php echo $data['id']; ?>"><?= $data['title'] ?></a>
            <br>
            <em>le <?= $data['create_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= $data['content'] ?>
            <br />
            <!-- <em><a href="index.php?action=post&id=<?php echo $data['id']; ?>">Commentaires</a></em> -->
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>