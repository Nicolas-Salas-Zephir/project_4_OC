<?php
use \nicolassalaszephir\Blog\Model\PostManager;
use \nicolassalaszephir\Blog\Model\CommentManager;



require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new PostManager();

    $posts = $postManager->getPosts();
    
    session_start();
    require('view/frontend/listPostsView.php');
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    if (!$post) {
        throw new Exception(' le commentaire n\'existe pas  !');
    }
    else {
        require('view/frontend/postView.php');
    }
}

function addComment($postId, $author, $comment) {
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        session_start();
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function  postBlog() {
    $postManager = new PostManager();
    $posts = $postManager->getPostsBlog();
    session_start();

    require('view/frontend/listPostsView.php');
}

function incrementReporting($flag, $postId, $id) {
    $commentManager = new CommentManager();
    $comments = $commentManager->editComment($flag, $postId, $id);

    if (!$comments) {
        throw new Exception(' le commentaire n\'existe pas  !');
    } else {
        header('Location: index.php?action=post&id=' . $postId . '#comment');
    }
    
}

// function addStatement($declared, $id, $postId) {
//     $commentManager = new CommentManager();
//     $comments = $commentManager->declaredComment($declared, $id);

//     $count = 0;


//     if (!$comments) {
//         throw new Exception('Impossible de déclarer le commentaire !');
//     }
//     else {
//         header('Location: index.php?action=post&id=' . $postId . '#comments');
//     }
//     require('view/frontend/listPostsView.php');
// }

function authorDescript() {
    require('view/frontend/authorDescripView.php');
}