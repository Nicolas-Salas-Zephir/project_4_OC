<?php
require('controller/frontend.php');
require('controller/backend.php');

try { 
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET["action"] == "viewComment") {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {   
                printComment($_GET['postId'], $_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET["action"] == "editComment") {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {  
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    updateComment($_GET['postId'], $_GET['id'], $_POST['comment'], $_POST['author']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                removeComment($_GET['id'], $_GET['postId']);
            } else {
                throw new Exception("Aucun commentaire n'a été effacé");
            }
        } elseif ($_GET["action"] == "admin") {
            adminView();            
        } elseif ($_GET["action"] == "addPost") {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])) {
                addPost($_POST['title'], $_POST['content'], $_POST['author']); 
            } 
        } elseif ($_GET['action'] == "blog") {
            postBlog();
        } elseif ($_GET['action'] == "identification") {
            identifyView();
        } elseif ($_GET['action'] == "postsAdmin") {
            listPostsAdmin();
        }
    } else {
        listPosts();
    }
}
catch(Exception $e) { 
    $ErrorMessage = $e->getMessage();
    require 'view/frontend/errorView.php';
}
