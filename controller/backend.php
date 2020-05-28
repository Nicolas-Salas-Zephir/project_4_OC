<?php
use \nicolassalaszephir\Blog\Model\PostManager;
use \nicolassalaszephir\Blog\Model\CommentManager;
use \nicolassalaszephir\Blog\Model\RegistrationManager;


require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/RegistrationManager.php');

function adminView() {
    $navigation = "navBackend.php";
    $title = 'Ajouter un article';

    require('view/backend/insertPostView.php');
}

function addPost($title, $content, $author) {
    $postManager = new PostManager();
    $post = $postManager->insertPost(htmlspecialchars($title), $content, htmlspecialchars($author));

    if(!$post) {
        throw new Exception('Impossible d\'ajouter un poste');
    } else {
        header('Location: index.php?action=postsAdmin&page=1#list-posts-admin');
    }
}

function  postsBlogAdmin($pages) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $totalPosts = $postManager->countPosts();

    $title = 'Tableau de bord'; 
    $navigation = "navBackend.php";
    $count = 0;
    
    $title = 'Tableau de bord';
    $depart = 0;
    $postsPerPage = 3;
    $totalPage = ceil($totalPosts / $postsPerPage); 

    if ((int) ($pages <= $totalPage)) {
        $page = intval($pages);
    } elseif ((int) ($pages > $totalPage)) {
        header('Location: index.php?action=postsAdmin&page=1#paginationNav');
    } else {
        $page = 1;
    }

    $depart = ($page - 1) * $postsPerPage;

    $posts = $postManager->getPosts((int) $depart, (int) $postsPerPage);
    $comment = $commentManager->checkFlag(1);
    $comments = $commentManager->getCommentsFlag(1);
    
    require('view/backend/listPostsAdminView.php');
}

function postBackend($id) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost($id);
    $comments = $commentManager->getComments((int) $id);

    $title = 'Article ' . $id; 
    $navigation = "navBackend.php";

    if (!$post) {
        throw new Exception('l\'article n\'existe pas  !');
    }
    else {
        require('view/backend/postAdminView.php');
    }
}

function printPost($postId) {
    $postManager = new PostManager();
    $post = $postManager->getPost((int) $postId);

    $title = 'Mon blog'; 
    $navigation = "navBackend.php";
    
    require('view/backend/editPostView.php');
}

function updatePost($content, $author, $title, $id) {
    $postManager = new PostManager();
    $affectedLines = $postManager->editPost((string) $content, (string) $author, (string) $title, (int) $id);

    if(!$affectedLines) {
        throw new Exception('Impossible de modifier l\'article !');
    } else {
        header('Location: index.php?action=postAdmin&id=' . $id);
    }
}

function removePost($id) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $affectedLines = $postManager->deletePost((int) $id);
    $deleteComments = $commentManager->deleteComments((int) $id); 

    if(!$affectedLines) {
        throw new Exception("Impossible d'effacer le commentaire !");
    } else {
        header('Location: index.php?action=postsAdmin&page=1');
    }
}

function userRegistration() {
    $title = 'Identification';

    require('view/backend/registrationView.php');
}

function addUser($pseudo, $email, $pass_hache, $role = 0) {
    $registerManager = new RegistrationManager();
    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $affectedLines = $registerManager->insertUser((string) htmlspecialchars($pseudo), (string) htmlspecialchars($email), htmlspecialchars($pass_hache), $role);

    if(!$affectedLines) {
        throw new Exception("Impossible d'ajouter un utilisateur !");
    } else {
        header('Location: index.php?action=identification');
    }
}

function checkUser($pseudo, $email, $pass_hache, $role = 0) {
    $registerManager = new RegistrationManager();
    $checkPseudo = $registerManager->checkPseudo((string) $pseudo);
    $checkEmail = $registerManager->checkEmail((string) $email);

    foreach($checkPseudo as $totalPseudo);
    foreach($checkEmail as $totalEmail);

    if ($totalPseudo < 1 && $totalEmail < 1) {
        addUser($pseudo, $email, $pass_hache, $role);
    } else {
        $errorMessage = "Le pseudo ou l'adresse email est déja utilisé";
        require('view/backend/registrationView.php');  
    } 
}

function verifyUser($pseudo) {
    $registerManager = new RegistrationManager();
    $user = $registerManager->getUser($pseudo);
    $isPasswordCorrect = password_verify($_POST['password'], $user['password']);
    $title = 'Identification';

    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['pseudo'] = htmlspecialchars($pseudo);
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
    } else {
        $errorMessage = "Mauvais identifiant ou mot de passe";
        require('view/backend/identificationView.php');  
    }
     
}

function identifyView() {
    $title = 'Identification';
    require('view/backend/identificationView.php');
}

function addSuperUsers() {
    $registerManager = new RegistrationManager();
    $users = $registerManager->getUsers();

    $title = 'Nouvel utilisateur'; 
    $navigation = "navBackend.php";
    
    require('view/backend/insertUsersView.php');
}

function addRoleToTheUser($pseudo, $email, $pass_hache, $role) {
    $registerManager = new RegistrationManager();
    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $affectedLines = $registerManager->insertUser((string) htmlspecialchars($pseudo), (string) htmlspecialchars($email), htmlspecialchars($pass_hache), (string) htmlspecialchars($role));
    
    if(!$affectedLines) {
        throw new Exception("Impossible d'ajouter un rôle à l'utilisateur !");
    } else {
        header('Location: index.php?action=addSuperUsers#superUser');
    }
}

function removeComment($id, $postId) {
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->deleteComment((int) $id);

    if(!$affectedLines) {
        throw new Exception("Impossible d'effacer le commentaire !");
    } else {
        header('Location: index.php?action=postAdmin&id=' . $postId . '#comment' . $id);
    }
}

function removeMember($id) {
    $postManager = new PostManager();
    $affectedLines = $postManager->deleteUser((int) $id);

    if(!$affectedLines) {
        throw new Exception("Impossible d'effacer l'utilisateur !");
    } else {
        header('Location: index.php?action=addSuperUsers#superUser');
    }
}

function incrementReportingAdmin($flag, $postId, $id) {
    $commentManager = new CommentManager();
    $comments = $commentManager->editComment((int) $flag, (int) $postId, (int) $id);

    if (!$comments) {
        throw new Exception(' le commentaire n\'existe pas  !');
    } else {
        header('Location: index.php?action=postAdmin&id=' . $postId . '#comment' . $id);
    }
    
}

function flagPostsAdmin() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost((int) $_GET['id']);
    $comments = $commentManager->getComments((int) $_GET['id']);

    if (!$post) {
        throw new Exception(' le commentaire n\'existe pas !');
    }
    else {
        require('view/frontend/postView.php');
    }
}

function sessionDestroy() {
    session_start();
    session_destroy();
    header('Location: index.php');
}

function redirect() {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 0 || !isset($_SESSION['role'])) {
        header('Location: index.php');
    }
}