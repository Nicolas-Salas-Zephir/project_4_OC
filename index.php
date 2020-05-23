<?php
require('controller/frontend.php');
require('controller/backend.php');

try { 
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || isset($_SESSION['role']) && $_SESSION['role'] == "editor" || isset($_SESSION['role']) && $_SESSION['role'] == "modo") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    post();
                } else {
                    throw new Exception('Aucun identifiant d\'article envoyé');
                }
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 0 || !isset($_SESSION['role'])) {
                post();
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == 'addComment') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || isset($_SESSION['role']) && $_SESSION['role'] == "editor" || isset($_SESSION['role']) && $_SESSION['role'] == "modo" || isset($_SESSION['role']) && $_SESSION['role'] == 0) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant d\'article envoyé');
                }
            } elseif (!isset($_SESSION['role'])) {
                header('Location: index.php');
            } 
        } elseif ($_GET["action"] == "admin") {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "editor") {
                adminView();
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == "modo" ) {
                header('Location: index.php?action=postsAdmin&page=1');
            } else {
                redirect();
            }
        } elseif ($_GET["action"] == "addPost") {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])) {
                addPost($_POST['title'], $_POST['content'], $_POST['author']); 
            } elseif(isset($_SESSION['role']) && $_SESSION['role'] == 0) {
                header('Location: index.php');
            } else {
                redirect();
            }
        } elseif ($_GET['action'] == "blog") {
            if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
                postsBlog($_GET['page']);
            } else {
                header('Location: index.php');
            }
        } elseif ($_GET['action'] == "postsAdmin") {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "editor" || $_SESSION['role'] == "modo") {
                if (isset($_GET['page'])) {
                    if(!empty($_GET['page']) && $_GET['page'] > 0) {
                        postsBlogAdmin($_GET['page']);
                    }
                } else {
                    throw new Exception("La page n'existe pas !!!");
                }
            } else {
                redirect();
            }                
        } elseif ($_GET['action'] == "postAdmin" ) {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "editor" || $_SESSION['role'] == "modo") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    postBackend($_GET['id']);
                } else {
                    throw new Exception('Aucun identifiant d\'article envoyé'); 
                }
            } else {
                redirect();
            }
        } elseif ($_GET["action"] == "viewAdminPost") {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "editor") {
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {   
                    printPost($_GET['postId']);
                } else {
                    throw new Exception('Aucun identifiant de article envoyé');
                }
            } elseif ($_SESSION['role'] == "modo") {
                throw new Exception('Vous n\'avez pas les droits suffisants');
            } else {
                redirect();
            }
             
        } elseif ($_GET["action"] == "editPost") {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "editor") {
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {  
                    updatePost($_POST['content'], $_POST['author'], $_POST['title'], $_GET['postId']);
                } else {
                    throw new Exception('Aucun identifiant d\'article envoyé');
                }
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == "modo") {
                throw new Exception('Vous n\'avez pas les droits suffisants');
            } else {
                redirect();
            }
        } elseif ($_GET['action'] == 'deletePost') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "editor") {
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                    removePost($_GET['postId']);
                } else {
                    throw new Exception("Aucun identifiant d'article envoyé");
                }
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                throw new Exception('Vous n\'avez pas les droits suffisants');
            } else {
                redirect();
            }
        } elseif ($_GET['action'] == "userRegistration") {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || !isset($_SESSION['role'])) {
                userRegistration();
            } else {
                header('Location: index.php');   
            }
        } elseif ($_GET['action'] == 'registration') {
            session_start();
            if (!isset($_SESSION['role'])) {
                if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && !isset($_POST['role'])) {
                    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
                        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            if ($_POST['password'] === $_POST['password1']) {
                                checkUser($_POST['username'], $_POST['email'], $_POST['password']);
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
                    header('Location: index.php?action=userRegistration');
                }
            } else {
                header('Location: index.php');
            }
        } elseif($_GET['action'] == 'identification') {
            session_start();
            if (!isset($_SESSION['role'])) {
                identifyView();
            } else {
                header('Location: index.php');
            }
        } elseif($_GET['action'] == "identificationValidation") {
            session_start();
            if (!isset($_SESSION['role'])) {
                if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                        verifyUser($_POST['pseudo']);
                    }
                } else {
                    header('Location: index.php?action=identification');
                }
            } else {
                header('Location: index.php');
            }
        } elseif($_GET['action'] == 'logout') {
            session_start();
            if (isset($_SESSION['role'])) {
                sessionDestroy();
            } else {
                header('Location: index.php');
            }
        } elseif($_GET['action'] == 'addSuperUsers') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                addSuperUsers();
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == 'validRole') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['role'])) {
                    if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['role'])) {
                        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            if ($_POST['password'] === $_POST['password1']) {
                                addRoleToTheUser($_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['role']);
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
                    throw new Exception("Aucun utisateur n'a été ajouté");
                }
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == 'deleteComment') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "modo") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    removeComment($_GET['id'], $_GET['postId']);
                } else {
                    throw new Exception("Aucun commentaire n'a été supprimé");
                }
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == 'authorDescript') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" ||isset($_SESSION['role']) && $_SESSION['role'] == "modo" || isset($_SESSION['role']) && $_SESSION['role'] == "editor" || isset($_SESSION['role']) && $_SESSION['role'] == 0) {
                authorDescript();
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == 'deleteUser') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    removeMember($_GET['id'], $_GET['postId']);
                } else {
                    throw new Exception("Aucun utilisateur n'a été supprimé");
                }
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == 'reporting') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" ||isset($_SESSION['role']) && $_SESSION['role'] == "modo" || isset($_SESSION['role']) && $_SESSION['role'] == "editor" || isset($_SESSION['role']) && $_SESSION['role'] == 0) {
                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['commentId']) && $_GET['commentId'] > 0 && isset($_GET['flag']) && $_GET['flag'] == 0) {
                    incrementReporting($_GET['flag'] + 1, $_GET['id'], $_GET['commentId']);
                } else {
                    header('Location: index.php');
                }
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == 'reportCancel') {
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" ||isset($_SESSION['role']) && $_SESSION['role'] == "modo") {
                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['commentId']) && $_GET['commentId'] > 0 && isset($_GET['flag']) && $_GET['flag'] == 1) {
                    incrementReportingAdmin($_GET['flag'] + 1, $_GET['id'], $_GET['commentId']);
                } else {
                    throw new Exception("Aucun signalement a été retiré ");
                }
            } else {
                throw new Exception("La page n'existe pas !!!");
            }
        } elseif ($_GET['action'] == is_null(NULL)) {
            throw new Exception("La page n'existe pas !!!");
        }
    } else {
        listPosts();
    }
}
catch(Exception $e) { 
    $ErrorMessage = $e->getMessage();
    require 'view/frontend/errorView.php';
}
