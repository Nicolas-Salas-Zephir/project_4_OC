<?php
use \nicolassalaszephir\Blog\Model\PostManager;
use \nicolassalaszephir\Blog\Model\CommentManager;



require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function adminView() {
    require('view/backend/insertPostView.php');
}

function addPost($title, $content, $author) {
    $postManager = new PostManager();
    $post = $postManager->insertPost($title, $content, $author);
    var_dump($post);

    if($post === false) {
        throw new Exception('Impossible d\'ajouter un poste');
    } else {
        header('Location: index.php?action=admin');
    }
}

function identifyView() {
    require('view/backend/identificationView.php');
}

function listPostsAdmin() {
    $postManager = new PostManager();
    $posts = $postManager->getPostsBlog();

    require('view/backend/listPostsAdminView.php');
}

function password() {
    if (isset($_POST['username']) && $_POST['username'] == "nicolas" && isset($_POST['password']) && $_POST['password'] == '0000') {
        var_dump($_POST);
        listPostsAdmin();
    } else {
        throw new Exception('Ce mot de passe n\'existe pas');
    }
}
