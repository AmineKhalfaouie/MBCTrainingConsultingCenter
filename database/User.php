<?php
class User {
    public $db = null;

    public function __construct(DBController $db) {
        if (!isset($db->con)) {
            return null;
        }
        $this->db = $db;
    }

    // Vérifie si un email existe déjà dans la base
    public function emailExists($email) {
        $stmt = $this->db->con->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

    // Insertion d'un utilisateur
    public function insertToUser($name, $email, $password_hash, $role) {
        // Vérifier si l'email existe déjà
        if ($this->emailExists($email)) {
            $_SESSION['register_errors'] = ['Cet email est déjà enregistré'];
            $_SESSION['old'] = $_POST;
            header("Location: register.php");
            exit();
        }

        // Insertion
        $stmt = $this->db->con->prepare(
            "INSERT INTO user (full_name, email, password, status, created_at, updated_at)
             VALUES (?, ?, ?, ?, NOW(), NOW())"
        );
        $stmt->bind_param("ssss", $name, $email, $password_hash, $role);

        if ($stmt->execute()) {
            $_SESSION['register_success'] = 'Compte créé avec succès!';
            header("Location: login.php?success=1");
            exit();
        } else {
            $_SESSION['register_errors'] = ['Erreur lors de la création du compte: ' . $stmt->error];
            $_SESSION['old'] = $_POST;
            header("Location: register.php");
            exit();
        }
    }

    // Mise à jour de la dernière connexion et redirection
    public function updateLastLoginAndRedirect($user) {
        $updateStmt = $this->db->con->prepare("UPDATE user SET last_login = NOW() WHERE user_id = ?");
        $updateStmt->bind_param("i", $user['user_id']);
        $updateStmt->execute();

        // Redirection selon le rôle
        header('Location: ' . ($user['status'] === 'admin' ? 'admin_page.php' : 'index.php'));
        exit();
    }
}
?>
