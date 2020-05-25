<?php
use \nicolassalaszephir\Blog\Model\PostManager;
use \nicolassalaszephir\Blog\Model\CommentManager;


require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new PostManager();

    $title = 'Page principale';
    $depart = 0;
    $postsPerPage = 3;

    $posts = $postManager->getPosts((int) $depart, (int) $postsPerPage);

    session_start();
    require('view/frontend/listPostsView.php');
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost((int) $_GET['id']);
    $comments = $commentManager->getComments((int) $_GET['id']);
    $totalComments = $commentManager->checkComments((int) $_GET['id']);

    $title = 'Mon Article'; 

    if (!$post) {
        header('Location: index.php');
    }
    else {
        require('view/frontend/postView.php');
    }
}

function addComment($postId, $author, $comment) {
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment((int) $postId, $author, htmlspecialchars($comment));

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        session_start();
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function  postsBlog($pages) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $totalPosts = $postManager->countPosts();

    $title = 'Blog';
    $postsPerPage = 1;
    $totalPage = ceil((int) ($totalPosts / $postsPerPage)); 

    if ((int) ($pages <= $totalPage)) {
        $page = intval($pages);
    } elseif ((int) ($pages > $totalPage)) {
        header('Location: index.php?action=blog&page=1#blog');
    } else {
        $page = 1;
    }

    $depart = (int) (($page - 1) * $postsPerPage);

    $posts = $postManager->getPosts((int) $depart, (int) $postsPerPage);

    session_start();
    require('view/frontend/listPostsView.php');
}

function incrementReporting($flag, $postId, $id) {
    $commentManager = new CommentManager();
    $comments = $commentManager->editComment((int) $flag, (int) $postId, (int) $id);

    if (!$comments) {
        throw new Exception(' le commentaire n\'existe pas  !');
    } else {
        header('Location: index.php?action=post&id=' . $postId . '#stop-comment' . $id);
    }
}

function authorDescript() {
    $title = 'Ma biographie'; 

    require('view/frontend/authorDescripView.php');
}
