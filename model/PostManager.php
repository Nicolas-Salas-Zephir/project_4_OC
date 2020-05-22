<?php
namespace nicolassalaszephir\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager {

    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(create_date, \'%d/%m/%Y\') AS create_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function insertPost($title, $content, $author) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, content, author, create_date) VALUES (?, ?, ?, NOW())');
        $affectedLines = $req->execute(array($title, $content, $author));

        return $affectedLines;
    }

    public function getPosts($depart, $postsPerPage) {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(create_date, \'%d/%m/%Y\') AS create_date_fr FROM posts ORDER BY id DESC LIMIT ' . $depart .' , '. $postsPerPage);
        
        return $req;
    }

    public function countPosts() {
        $db = $this->dbConnect();
        $totalPostsReq = $db->query('SELECT id FROM posts');
        $totalePosts = $totalPostsReq->rowCount();

        return $totalePosts;
    }

    public function editPost($content, $author, $title, $id) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET content = ?, author = ?, title = ? WHERE id= ?');
        $affectedLines = $req->execute(array($content, $author, $title, $id));

        return $affectedLines;
    }

    public function deletePost($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $req->execute(array($id));

        return $affectedLines;
    }  

    public function deleteUser($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM members WHERE id = ?');
        $affectedLines = $req->execute(array($id));

        return $affectedLines;
    }  
}