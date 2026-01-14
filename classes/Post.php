<?php
class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($uid, $msg, $img) {
        $stmt = $this->db->prepare("INSERT INTO posts (unique_id, post_msg, post_img, created) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iss", $uid, $msg, $img);
        return $stmt->execute();
    }

    public function getFeed($limit = 20) {
        $sql = "SELECT p.*, u.fname, u.lname, u.image as user_img 
                FROM posts p 
                JOIN users u ON p.unique_id = u.unique_id 
                ORDER BY p.created DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function toggleLike($pid, $uid) {
        // Check if liked
        $check = $this->db->prepare("SELECT like_id FROM likes WHERE post_id = ? AND user_id = ?");
        $check->bind_param("ii", $pid, $uid);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $stmt = $this->db->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
            $action = "unliked";
        } else {
            $stmt = $this->db->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
            $action = "liked";
        }
        $stmt->bind_param("ii", $pid, $uid);
        $stmt->execute();
        
        // Update post count cache
        $this->db->query("UPDATE posts SET likes = (SELECT COUNT(*) FROM likes WHERE post_id = $pid) WHERE postid = $pid");
        
        return $action;
    }

    public function addComment($pid, $uid, $comment) {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $pid, $uid, $comment);
        return $stmt->execute();
    }
}
