<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function signup($fname, $lname, $email, $phone, $password, $image) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $unique_id = rand(time(), 1000000);
        $status = "Online";

        $stmt = $this->db->prepare("INSERT INTO users (unique_id, fname, lname, email, phone, password, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $unique_id, $fname, $lname, $email, $phone, $hashed_password, $image, $status);
        
        if ($stmt->execute()) {
            return $unique_id;
        }
        return false;
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                session_regenerate_id(true);
                return $row;
            }
        }
        return false;
    }

    public function updatePassword($uid, $old_p, $new_p) {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE unique_id = ?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();

        if (password_verify($old_p, $res['password'])) {
            $hashed = password_hash($new_p, PASSWORD_DEFAULT);
            $upd = $this->db->prepare("UPDATE users SET password = ? WHERE unique_id = ?");
            $upd->bind_param("si", $hashed, $uid);
            return $upd->execute();
        }
        return false;
    }
    
    public function setStatus($uid, $status) {
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE unique_id = ?");
        $stmt->bind_param("si", $status, $uid);
        return $stmt->execute();
    }
}
