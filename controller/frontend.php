<?php
use \nicolassalaszephir\Blog\Model\PostManager;
use \nicolassalaszephir\Blog\Model\CommentManager;



require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new PostManager();
    
    $posts = $postManager->getPosts();
    

    require('view/frontend/listPostsView.php');
}

function post()
{
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

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function removeComment($id, $postId) {
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->deleteComment($id);

    if($affectedLines === false) {
        throw new Exception("Impossible d'effacer le commentaire !");
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function  postBlog() {
    $postManager = new PostManager();
    $posts = $postManager->getPostsBlog();

    require('view/frontend/listPostsView.php');
}

// function updateComment($postId, $id, $comment, $author) {
//     $commentManager = new CommentManager();
    
//     $affectedLines = $commentManager->editComment($postId, $id, $comment, $author);

//     if($affectedLines === false) {
//         throw new Exception('Impossible de modifier le commentaire !');
//     } else {
//         header('Location: index.php?action=post&id=' . $postId);
//     }
// }




