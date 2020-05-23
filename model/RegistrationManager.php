<?php
namespace nicolassalaszephir\Blog\Model;

require_once("model/Manager.php");

class RegistrationManager extends Manager {

    function insertUser($pseudo, $email, $role, $pass_hache) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO members (pseudo, email,  password, role, inscription_date) VALUES(?, ?, ?, ?, CURDATE())');
        $affectedLines = $req->execute(array($pseudo, $email, $role, $pass_hache));
        
        return $affectedLines;
    }

    function checkPseudo($pseudo) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(pseudo) as total_pseudo FROM members WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $result = $req->fetch();

        return $result;
    }

    function checkEmail($email) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(email) as total_email FROM members WHERE email = ?');
        $req->execute(array($email));
        $result = $req->fetch();

        return $result;
    }

    function getUser($pseudo) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, role, password FROM members WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $result = $req->fetch();

        return $result;
    }

    function getUsers() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM members');

        return $req;
    }
}