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
                throw new Exception('Aucun identifiant de article envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de article envoyé');
            }
        } elseif ($_GET["action"] == "viewComment") {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {   
                printComment($_GET['postId'], $_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de article envoyé');
            }
        } elseif ($_GET["action"] == "editComment") {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {  
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    updateComment($_GET['postId'], $_GET['id'], $_POST['comment'], $_POST['author']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de article envoyé');
            }
        } 
        // elseif ($_GET['action'] == 'deleteComment') {
        //     if (isset($_GET['id']) && $_GET['id'] > 0) {
        //         removeComment($_GET['id'], $_GET['postId']);
        //     } else {
        //         throw new Exception("Aucun commentaire n'a été effacé");
        //     }
        // } 
        elseif ($_GET["action"] == "admin") {
                adminView();
        } elseif ($_GET["action"] == "addPost") {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])) {
                addPost($_POST['title'], $_POST['content'], $_POST['author']); 
            } 
        } elseif ($_GET['action'] == "blog") {
            postBlog();
        } elseif ($_GET['action'] == "postsAdmin") {
            listPostsAdmin();
        } elseif ($_GET['action'] == "postAdmin" ) {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                postBackend($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de article envoyé');
            }
        } elseif ($_GET["action"] == "viewAdminPost") {
            if (isset($_GET['postId']) && $_GET['postId'] > 0) {   
                printPost($_GET['postId']);
            } else {
                throw new Exception('Aucun identifiant de article envoyé');
            }
        } elseif ($_GET["action"] == "editPost") {
            if (isset($_GET['postId']) && $_GET['postId'] > 0) {  
                updatePost($_POST['content'], $_POST['author'], $_POST['title'], $_GET['postId']);
            } else {
                throw new Exception('Aucun identifiant de article envoyé');
            }
        } elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                removePost($_GET['postId']);
            } else {
                throw new Exception("Aucun article n'a été effacé");
            }
        } elseif ($_GET['action'] == "userRegistration") {
            userRegistration();
        } elseif ($_GET['action'] == 'registration') {
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
                if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        if ($_POST['password'] === $_POST['password1']) {
                            addUser($_POST['username'], $_POST['email'], $_POST['password']);
                        } else {
                            throw new Exception('Les mots de passe de sont pas identiques !');
                        }
                    } else {
                        throw new Exception('Ce n\'est pas une adresse mail valide !');
                    }
                }  else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception("Aucun article n'a été effacé");
            }
        } elseif($_GET['action'] == 'identification') {
            identifyView();
            // echo $_SERVER['REQUEST_METHOD'];
        } elseif($_GET['action'] == "identificationValidation") {
            if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                    verifyUser($_POST['pseudo']);
                }
            } else {
                throw new Exception('Mauvais identifiant ou mot de passe !');
            }
        } elseif($_GET['action'] == 'logout') {
            sessionDestroy();
        } elseif($_GET['action'] == 'addSuperUsers') {
            addSuperUsers();
        } 
    } else {
        listPosts();
    }
}
catch(Exception $e) { 
    $ErrorMessage = $e->getMessage();
    require 'view/frontend/errorView.php';
}
