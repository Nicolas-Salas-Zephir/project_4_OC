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
    session_start();

    require('view/backend/insertPostView.php');
}

// function addPost($title, $content, $author) {
//     $postManager = new PostManager();
//     $post = $postManager->insertPost($title, $content, $author);
//     // $getPost = $postManager->getPost($postId);

//     $path = './public/images/miniatures/' . $id . '.jpg';
//     echo "<pre>";
//     var_dump($_FILES);
//     var_dump($path);
//     echo "</pre>";
//     // lastInsertId
//     if (isset($_FILES['miniature'])) {
//         if (exif_imagetype($_FILES['miniature']['tmp_name']) == 2) {
//             move_uploaded_file($_FILES['miniature']['tmp_name'], $path);
//         } else {
//             throw new Exception(' Votre image doit être au format jpg');  
//         }
//     }
//     if(!$post) {
//         throw new Exception('Impossible d\'ajouter un poste');
//     } else {
//         header('Location: index.php?action=postsAdmin#list-posts-admin');
//     }
// }

function listPostsAdmin() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $posts = $postManager->getPostsBlog();
    $title = 'Tableau de bord'; 
    $navigation = "navBackend.php";
    $count = 0;
    
    session_start();
    
    if (isset($_SESSION['role']) && $_SESSION['role'] === "modo" || $_SESSION['role'] === "admin") {
        $comment = $commentManager->checkFlag(1);
        $comments = $commentManager->getCommentsFlag(1);
    } 
    
    require('view/backend/listPostsAdminView.php');
}

function postBackend($id) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost($id);
    $comments = $commentManager->getComments($id);
    

    $title = 'Article ' . $id; 
    $navigation = "navBackend.php";

    if (!$post) {
        throw new Exception('l\'article n\'existe pas  !');
    }
    else {
        session_start();
        require('view/backend/postAdminView.php');
    }
}

function printPost($postId) {
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);

    $title = 'Mon blog'; 
    $navigation = "navBackend.php";
    
    session_start();
    require('view/backend/editpostView.php');
}

function updatePost($content, $author, $title, $id) {
    $postManager = new PostManager();
    $affectedLines = $postManager->editPost($content, $author, $title, $id);

    if(!$affectedLines) {
        throw new Exception('Impossible de modifier l\'article !');
    } else {
        header('Location: index.php?action=postAdmin&id=' . $id);
    }
}

function removePost($id) {
    $postManager = new PostManager();
    $affectedLines = $postManager->deletePost($id);

    if(!$affectedLines) {
        throw new Exception("Impossible d'effacer le commentaire !");
    } else {
        header('Location: index.php?action=postsAdmin');
    }
}

function userRegistration() {
    $title = 'Identification';
    require('view/backend/registrationView.php');
}

function addUser($pseudo, $email, $pass_hache, $role = 0) {
    $registerManager = new RegistrationManager();
    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $affectedLines = $registerManager->insertUser(htmlspecialchars($pseudo), htmlspecialchars($email), htmlspecialchars($pass_hache), $role);
    
    if(!$affectedLines) {
        throw new Exception("Impossible d'ajouter un utilisateur !");
    } else {
        header('Location: index.php?action=identification');
    }
}

function checkUser($pseudo, $email, $pass_hache, $role = 0) {
    $registerManager = new RegistrationManager();
    $checkPseudo = $registerManager->checkPseudo($pseudo);
    $checkEmail = $registerManager->checkEmail($email);

    foreach($checkPseudo as $totalPseudo);
    foreach($checkEmail as $totalEmail);

    if ($totalPseudo < 1 && $totalEmail < 1) {
        addUser($pseudo, $email, $pass_hache, $role);
    } elseif ($totalPseudo > 1 || $totalEmail > 1) {
        echo "<pre>";
            var_dump("Total pseudo : " . $totalPseudo);
            var_dump("Total email : " . $totalEmail );
            var_dump($pseudo);
            var_dump($email );
        echo "</pre>";
        throw new Exception("Ce pseudo ou adresse email sont déja utilisés");
    } 
}

function verifyUser($pseudo) {
    $registerManager = new RegistrationManager();
    $user = $registerManager->getUser($pseudo);
    $isPasswordCorrect = password_verify($_POST['password'], $user['password']);

    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['pseudo'] = htmlspecialchars($pseudo);
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

function identifyView() {
    session_start();
    $title = 'Identification';
    require('view/backend/identificationView.php');
}

function addSuperUsers() {
    $registerManager = new RegistrationManager();
    $users = $registerManager->getUsers();

    $title = 'Nouvel utilisateur'; 
    $navigation = "navBackend.php";
    if(!$users) {
        throw new Exception("Impossible de voir les utilisateurs !");
    } else {
        session_start();
    }
    require('view/backend/insertUsersView.php');
}

function addRoleToTheUser($pseudo, $email, $pass_hache, $role) {
    $registerManager = new RegistrationManager();
    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $affectedLines = $registerManager->insertUser(htmlspecialchars($pseudo), htmlspecialchars($email), htmlspecialchars($pass_hache), htmlspecialchars($role));
    
    if(!$affectedLines) {
        throw new Exception("Impossible d'ajouter un rôle à l'utilisateur !");
    } else {
        header('Location: index.php?action=addSuperUsers#superUser');
    }
}

function removeComment($id, $postId) {
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->deleteComment($id);

    if(!$affectedLines) {
        throw new Exception("Impossible d'effacer le commentaire !");
    } else {
        header('Location: index.php?action=postAdmin&id=' . $postId . '#comment' . $id);
    }
}

function removeMember($id) {
    $postManager = new PostManager();
    $affectedLines = $postManager->deleteUser($id);

    if(!$affectedLines) {
        throw new Exception("Impossible d'effacer l'utilisateur !");
    } else {
        header('Location: index.php?action=addSuperUsers#superUser');
    }
}

function checkCommentsFlag() {
    $commentManager = new CommentManager();
    $checkFlags = $commentManager->checkFlag();

    // foreach($checkFlags as $checkFlag);

    // if ($checkFlag < 1) {
    //     var_dump($checkFlag);
    //     var_dump("Total flaaaag : " . $checkFlag['report_flag']);
    // } elseif ($checkFlag > 1) {
    //     echo "<pre>";
    //         var_dump("Total flag : " . $checkFlag['report_flag']);
    //     echo "</pre>";
    //     // throw new Exception("Ce signalement n'existe pas");
    // } 
}

function incrementReportingAdmin($flag, $postId, $id) {
    $commentManager = new CommentManager();
    $comments = $commentManager->editComment($flag, $postId, $id);

    if (!$comments) {
        throw new Exception(' le commentaire n\'existe pas  !');
    } else {
        header('Location: index.php?action=postAdmin&id=' . $postId . '#comment' . $id);
    }
    
}

function flagPostsAdmin() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    if (!$post) {
        throw new Exception(' le commentaire n\'existe pas !');
    }
    else {
        require('view/frontend/postView.php');
    }
}

// function checkFlag($commentId) {
//     $commentManager = new CommentManager();
//     $checkFlags = $commentManager->getComment($commentId);

//     if(!$checkFlags) {
//         throw new Exception("Impossible de trouver le signalement");
//     } else {
//         var_dump($commentId);
//         // header('Location: index.php?action=postAdmin&id=56#postBakend');
//     }
// }



function sessionDestroy() {
    session_start();
    session_destroy();
    header('Location: index.php');
}