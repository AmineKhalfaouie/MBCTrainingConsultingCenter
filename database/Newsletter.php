<?php
class Newsletter {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function subscribe($email) {
        // Check if email already exists
        $stmt = $this->db->con->prepare("SELECT news_id FROM newsletter WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return false; // Email already subscribed
        }
        // Insert new email
        $stmt = $this->db->con->prepare("INSERT INTO newsletter (email) VALUES (?)");
        return $stmt->execute([$email]);
    }

    public function unsubscribe($email) {
        $stmt = $this->db->con->prepare("DELETE FROM newsletter WHERE email = ?");
        return $stmt->execute([$email]);
    }

    public function getSubscribers() {
        $stmt = $this->db->con->query("SELECT email FROM newsletter WHERE status = 1");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>