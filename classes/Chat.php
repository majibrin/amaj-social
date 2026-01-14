<?php
class Chat {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function sendMessage($sender, $receiver, $msg) {
        $stmt = $this->db->prepare("INSERT INTO messages (incoming_id, outgoing_id, message, date_created) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $receiver, $sender, $msg);
        return $stmt->execute();
    }

    public function getMessages($me, $them) {
        $sql = "SELECT * FROM messages 
                WHERE (incoming_id = ? AND outgoing_id = ?) 
                OR (incoming_id = ? AND outgoing_id = ?) 
                ORDER BY message_id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiii", $me, $them, $them, $me);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function markAsRead($me, $them) {
        $stmt = $this->db->prepare("UPDATE messages SET is_read = 1 WHERE incoming_id = ? AND outgoing_id = ?");
        $stmt->bind_param("ii", $me, $them);
        return $stmt->execute();
    }
}
