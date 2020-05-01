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

// function goodPassword() {
//     if (isset($_POST['username']) && $_POST['username'] == "nicolas" && isset($_POST['password']) && $_POST['password'] == '0000') {
//         header('Location: index.php?action=postsAdmin');
//     } else {
//         throw new Exception('Ce mot de passe n\'existe pas');
//     }
// }

function postBackend($id) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost($id);
    // $comments = $commentManager->getComments($_GET['id']);

    if (!$post) {
        throw new Exception(' l\'article n\'existe pas  !');
    }
    else {
        require('view/backend/postAdminView.php');
        // header('Location: index.php?action=postsAdmin&id=' . $_GET['id']);
    }
}

function printPost($postId) {
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);

    require('view/backend/editpostView.php');
}

function updatePost($content, $author, $title, $id) {
    $postManager = new PostManager();
    
    $affectedLines = $postManager->editPost($content, $author, $title, $id);

    if($affectedLines === false) {
        throw new Exception('Impossible de modifier l\'article !');
    } else {
        // header('Location: index.php?action=post&id=' . $postId);
        header('Location: index.php?action=postsAdmin&id=' . $id);
    }
}

function removePost($id) {
    $postManager = new PostManager();
    $affectedLines = $postManager->deletePost($id);

    if($affectedLines === false) {
        throw new Exception("Impossible d'effacer le commentaire !");
    } else {
        header('Location: index.php?action=postAdmin&id=' . $id);
    }
}



