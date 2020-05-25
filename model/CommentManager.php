<?php
namespace nicolassalaszephir\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, flag, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments (post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getComment($commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, post_id, flag, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }

    public function deleteComment($commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));

        return $affectedLines;
    }
    
    public function deleteComments($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE post_id = ?');
        $affectedLines = $req->execute(array($id));

        return $affectedLines;
    }

    public function checkFlag($flag) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(flag) as report_flag, post_id FROM comments WHERE flag = ?');
        $req->execute(array($flag));
        $result = $req->fetch();

        return $result;
    }

    function getCommentsFlag($flag) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE flag = ?');
        $req->execute(array($flag));

        return $req;
    }

    public function editComment($flag, $postId, $id) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET flag = ?, post_id = ? WHERE id= ?');
        $affectedLines = $req->execute(array($flag, $postId, $id));

        return $affectedLines;
    }

    function checkComments($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(post_id) as total_comment FROM comments WHERE post_id = ?');
        $req->execute(array($postId));
        $result = $req->fetch();

        return $result;
    }
}