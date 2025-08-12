<?php
session_start();
require('functions.php');

// Traitement de l'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Validation des données
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = $_POST['userType'];
    $terms = isset($_POST['terms']) ? true : false;

    // Validation des données
    $errors = [];

    if (empty($firstName)) $errors[] = "Le prénom est requis";
    if (empty($lastName)) $errors[] = "Le nom est requis";
    if (empty($email)) $errors[] = "L'email est requis";
    if (empty($password)) $errors[] = "Le mot de passe est requis";
    if (empty($confirmPassword)) $errors[] = "La confirmation du mot de passe est requise";
    if (empty($role)) $errors[] = "Le type de compte est requis";
    if (!$terms) $errors[] = "Vous devez accepter les termes et conditions";

    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Adresse email invalide';
    }

    // Vérification de la longueur du mot de passe
    if (strlen($password) < 8) {
        $errors[] = 'Le mot de passe doit contenir au moins 8 caractères';
    }

    // Vérification de la correspondance des mots de passe
    if ($password !== $confirmPassword) {
        $errors[] = 'Les mots de passe ne correspondent pas';
    }

    // Vérification du rôle
    if (!in_array($role, ['client', 'admin'])) {
        $errors[] = 'Rôle invalide';
    }

    // Si des erreurs, on redirige avec les erreurs
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        $_SESSION['old'] = $_POST;
        header("Location: register.php");
        exit();
    }

    // Concaténation du nom complet
    $name = $firstName . ' ' . $lastName;

    // Hachage du mot de passe
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $userObj->insertToUser(
        $name,
        $_POST['email'],
        $password_hash,
        $_POST['userType']
    );

}

// Traitement de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Récupération et nettoyage des données
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Stocker l'email pour le réafficher en cas d'erreur
    $_SESSION['login_email'] = $email;
    
    // Validation des champs
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = 'Tous les champs sont obligatoires';
        $_SESSION['active_form'] = 'login';
        header("Location: login.php");
        exit();
    }
    
    try {
        // Requête préparée pour éviter les injections SQL
        $stmt = $con->prepare("SELECT user_id, full_name, email, password, status FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Vérification du mot de passe
            if (password_verify($password, $user['password'])) {
                // Connexion réussie - initialisation de la session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['logged_in'] = true;
                
                // Gestion du "Se souvenir de moi"
                if (isset($_POST['remember'])) {
                    $cookie_name = "remember_me";
                    $cookie_value = $user['user_id'] . ':' . hash('sha256', $user['password']);
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 30 jours
                }
                
                // Mise à jour de la date de dernière connexion
                $updateStmt = $con->prepare("UPDATE user SET last_login = NOW() WHERE user_id = ?");
                $updateStmt->bind_param("i", $user['user_id']);
                $updateStmt->execute();
                
                // Supprimer les données temporaires
                unset($_SESSION['login_email']);
                
                // Redirection en fonction du rôle
                if ($user['status'] === 'admin') {
                    header("Location: admin_page.php");
                } else {
                    header("Location: client_page.php");
                }
                exit();
            }
        }
        
        // Si on arrive ici, l'authentification a échoué
        $_SESSION['login_error'] = 'Email ou mot de passe incorrect';
        $_SESSION['active_form'] = 'login';
        
    } catch (Exception $e) {
        $_SESSION['login_error'] = 'Erreur système: ' . $e->getMessage();
    }
    
    header("Location: login.php");
    exit();
}

// Si aucune action n'est reconnue, redirection vers l'accueil
header("Location: index.php");
exit();
?>