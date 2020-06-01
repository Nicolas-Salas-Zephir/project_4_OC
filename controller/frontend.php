<?php
namespace nicolassalaszephir\Blog\controller;

use \nicolassalaszephir\Blog\Model\PostManager;
use \nicolassalaszephir\Blog\Model\CommentManager;


require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class Frontend {

    private $post;
    private $comment;

    public function __construct() {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
    }

    public function listPosts() {

        $title = 'Page principale';
        $depart = 0;
        $postsPerPage = 3;
    
        $posts = $this->post->getPosts((int) $depart, (int) $postsPerPage);
        
        session_start();
        require('view/frontend/listPostsView.php');
    }
    
    public function post() {
    
        $post = $this->post->getPost((int) $_GET['id']);
        $comments = $this->comment->getComments((int) $_GET['id']);
        $totalComments = $this->comment->checkComments((int) $_GET['id']);
    
        $title = $post['title'];
    
        if (!$post) {
            header('Location: index.php');
        }
        else {
            require('view/frontend/postView.php');
        }
    }
    
    public function addComment($postId, $author, $comment, $id_members) {
    
        $affectedLines = $this->comment->postComment((int) $postId, $author, htmlspecialchars($comment), $id_members);
    
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            session_start();
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
    
    public function  postsBlog($pages) {
        
        $totalPosts = $this->post->countPosts();

        $title = 'Blog';
        $postsPerPage = 4;
        $totalPage = ceil($totalPosts / $postsPerPage); 
    
        if ($pages <= $totalPage) {
            $page = intval($pages);
        } elseif ($pages > $totalPage) {
            header('Location: index.php?action=blog&page=1#blog');
        } else {
            $page = 1;
        }
    
        $depart = ($page - 1) * $postsPerPage;
    
        $posts = $this->post->getPosts($depart, $postsPerPage);
    
        session_start();
        require('view/frontend/listPostsView.php');
    }
    
    public function incrementReporting($flag, $postId, $id) {
        
        $comments = $this->comment->editComment((int) $flag, (int) $postId, (int) $id);
    
        if (!$comments) {
            throw new Exception(' le commentaire n\'existe pas  !');
        } else {
            header('Location: index.php?action=post&id=' . $postId . '#stop-comment' . $id);
        }
    }
    
    public function authorDescript() {
        $title = 'Ma biographie'; 
    
        require('view/frontend/authorDescripView.php');
    }
    
}
