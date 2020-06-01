<?php
namespace nicolassalaszephir\Blog\controller;

use \nicolassalaszephir\Blog\Model\PostManager;
use \nicolassalaszephir\Blog\Model\CommentManager;
use \nicolassalaszephir\Blog\Model\RegistrationManager;


require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/RegistrationManager.php');

class Backend {

    private $post;
    private $comment;
    private $registration;

    public function __construct() {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
        $this->registration = new RegistrationManager();
    }

    public function adminView() {
        $navigation = "navBackend.php";
        $title = 'Ajouter un article';
    
        require('view/backend/insertPostView.php');
    }
    
    public function addPost($title, $content, $author, $id_members) {
        
        $post = $this->post->insertPost(htmlspecialchars($title), $content, htmlspecialchars($author), $id_members);
    
        if(!$post) {
            throw new Exception('Impossible d\'ajouter un poste');
        } else {
            header('Location: index.php?action=postsAdmin&page=1#list-posts-admin');
        }
    }
    
    public function  postsBlogAdmin($pages) {
        
        $totalPosts = $this->post->countPosts();

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
    
        $posts = $this->post->getPosts((int) $depart, (int) $postsPerPage);
        $comment = $this->comment->checkFlag(1);
        $comments = $this->comment->getCommentsFlag(1);
        
        require('view/backend/listPostsAdminView.php');
    }
    
    public function postBackend($id) {
        
        $totalComments = $this->comment->checkComments((int) $_GET['id']);
        
        $post = $this->post->getPost($id);
        $comments = $this->comment->getComments((int) $id);
    
        $title = 'Article ' . $id; 
        $navigation = "navBackend.php";
    
        if (!$post) {
            throw new Exception('l\'article n\'existe pas  !');
        }
        else {
            require('view/backend/postAdminView.php');
        }
    }
    
    public function printPost($postId) {
        
        $post = $this->post->getPost((int) $postId);
    
        $title = 'Mon blog'; 
        $navigation = "navBackend.php";
        
        require('view/backend/editPostView.php');
    }
    
    public function updatePost($content, $author, $title, $id) {
        
        $affectedLines = $this->post->editPost((string) $content, (string) $author, (string) $title, (int) $id);
    
        if(!$affectedLines) {
            throw new Exception('Impossible de modifier l\'article !');
        } else {
            header('Location: index.php?action=postAdmin&id=' . $id);
        }
    }
    
    public function removePost($id) {
    
        $affectedLines = $this->post->deletePost((int) $id);
        $deleteComments = $this->comment->deleteComments((int) $id); 
    
        if(!$affectedLines) {
            throw new Exception("Impossible d'effacer le commentaire !");
        } else {
            header('Location: index.php?action=postsAdmin&page=1');
        }
    }
    
    public function userRegistration() {
        $title = 'Inscription';
    
        require('view/backend/registrationView.php');
    }
    
    public function addUser($pseudo, $email, $pass_hache, $role = 0) {
        
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $affectedLines = $this->registration->insertUser((string) htmlspecialchars($pseudo), (string) htmlspecialchars($email), htmlspecialchars($pass_hache), $role);
    
        if(!$affectedLines) {
            throw new Exception("Impossible d'ajouter un utilisateur !");
        } else {
            header('Location: index.php?action=identification');
        }
    }
    
    public function checkUser($pseudo, $email, $pass_hache, $role = 0) {
        
        $checkPseudo = $this->registration->checkPseudo((string) $pseudo);
        $checkEmail = $this->registration->checkEmail((string) $email);
        $title = 'Inscription';
    
        foreach($checkPseudo as $totalPseudo);
        foreach($checkEmail as $totalEmail);
    
        if ($totalPseudo < 1 && $totalEmail < 1) {
            self::addUser($pseudo, $email, $pass_hache, $role);
        } else {
            $errorMessage = "Le pseudo ou l'adresse email est déja utilisé";
            require('view/backend/registrationView.php');  
        } 
    }
    
    public function verifyUser($pseudo) {
        
        $user = $this->registration->getUser($pseudo);
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
    
    public function identifyView() {
        $title = 'Identification';
        require('view/backend/identificationView.php');
    }
    
    public function addSuperUsers() {
        
        $users = $this->registration->getUsers();
    
        $title = 'Nouvel utilisateur'; 
        $navigation = "navBackend.php";
        
        require('view/backend/insertUsersView.php');
    }
    
    public function addRoleToTheUser($pseudo, $email, $pass_hache, $role) {
        
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $affectedLines = $this->registration->insertUser((string) htmlspecialchars($pseudo), (string) htmlspecialchars($email), htmlspecialchars($pass_hache), (string) htmlspecialchars($role));
        
        if(!$affectedLines) {
            throw new Exception("Impossible d'ajouter un rôle à l'utilisateur !");
        } else {
            header('Location: index.php?action=addSuperUsers#superUser');
        }
    }
    
    public function removeComment($id, $postId) {
        
        $affectedLines = $this->comment->deleteComment((int) $id);
    
        if(!$affectedLines) {
            throw new Exception("Impossible d'effacer le commentaire !");
        } else {
            header('Location: index.php?action=postAdmin&id=' . $postId . '#comment' . $id);
        }
    }
    
    public function removeMember($id) {
        
        $affectedLines = $this->post->deleteUser((int) $id);
    
        if(!$affectedLines) {
            throw new Exception("Impossible d'effacer l'utilisateur !");
        } else {
            header('Location: index.php?action=addSuperUsers#superUser');
        }
    }
    
    public function incrementReportingAdmin($flag, $postId, $id) {
       
        $comments = $this->comment->editComment((int) $flag, (int) $postId, (int) $id);
    
        if (!$comments) {
            throw new Exception(' le commentaire n\'existe pas  !');
        } else {
            header('Location: index.php?action=postAdmin&id=' . $postId . '#comment' . $id);
        }
        
    }
    
    public function flagPostsAdmin() {
        
        $post = $this->post->getPost((int) $_GET['id']);
        $comments = $this->comment->getComments((int) $_GET['id']);
    
        if (!$post) {
            throw new Exception(' le commentaire n\'existe pas !');
        }
        else {
            require('view/frontend/postView.php');
        }
    }
    
    public function sessionDestroy() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }
    
    public function redirect() {
        if (isset($_SESSION['role']) && $_SESSION['role'] == 0 || !isset($_SESSION['role'])) {
            header('Location: index.php');
        }
    }
}
