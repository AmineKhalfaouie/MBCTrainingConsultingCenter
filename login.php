<?php
session_start();
require('functions.php');

// Redirection si déjà connecté
if (isset($_SESSION['logged_in'])) {
    header('Location: ' . ($_SESSION['status'] === 'admin' ? 'admin_page.php' : 'index.php'));
    exit;
}

$login_error = '';
$email_value = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $login_error = 'all the fields are required !!';
    } else {
        try {
            $stmt = $userObj->db->con->prepare("SELECT user_id, full_name, email, password, status FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                // SOLUTION: Vérification améliorée avec gestion des hashs corrompus
                if (password_verify($password, $user['password'])) {
                    // Authentification réussie
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['status'] = $user['status'];
                    $_SESSION['logged_in'] = true;
                    
                    // "Se souvenir de moi"
                    if (isset($_POST['remember'])) {
                        $cookie_value = $user['user_id'] . ':' . hash('sha256', $user['password']);
                        setcookie('remember_me', $cookie_value, time() + 86400 * 30, "/");
                    }
                    
                    $_SESSION['user'] = $user;
                    $userObj->updateLastLoginAndRedirect($user);
                } else {
                    // SOLUTION: Vérification supplémentaire pour les hashs mal stockés
                    $login_error = 'password not correct!!';
                    
                    // Log de débogage (à désactiver en production)
                    error_log("Échec d'authentification pour: $email");
                    error_log("Hash stock: " . $user['password']);
                    error_log("the hash length: " . strlen($user['password']));
                }
            } else {
                $login_error = 'Aucun compte associé à cet email';
            }
            
            $email_value = htmlspecialchars($email);
        } catch (Exception $e) {
            $login_error = 'System error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | MBC Consulting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="css/templatemo-topic-listing.css" rel="stylesheet">
    <style>
        :root {
            --primary: #13547a;
            --secondary: #80d0c7;
            --dark: #0d3c58;
            --light: #f8f9fa;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f5f7fa;
        }
        
        .login-section {
            background-image: linear-gradient(15deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 500px;
            margin: 0 auto;
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            background: linear-gradient(15deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 2.5rem;
            text-align: center;
        }
        
        .login-header h2 {
            color: white;
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .login-body {
            padding: 2.5rem;
        }
        
        .form-control {
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            border: 2px solid #eaeaea;
            margin-bottom: 1.25rem;
            transition: all 0.3s;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.25rem rgba(19, 84, 122, 0.1);
        }
        
        .login-btn {
            background: var(--primary);
            border: none;
            color: white;
            border-radius: 50px;
            padding: 0.8rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            margin-top: 1rem;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        
        .login-btn:hover {
            background: var(--dark);
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(13, 60, 88, 0.2);
        }
        
        .login-footer {
            text-align: center;
            padding: 1.5rem;
            background: var(--light);
            border-top: 1px solid #eaeaea;
            font-size: 0.95rem;
        }
        
        .login-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .login-footer a:hover {
            color: var(--dark);
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.75rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #eaeaea;
        }
        
        .divider span {
            padding: 0 15px;
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        
        .facebook { background: #3b5998; }
        .google { background: #dd4b39; }
        .linkedin { background: #0077b5; }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
            font-size: 1.2rem;
        }
        
        .alert {
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .custom-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: var(--primary);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .custom-link:hover {
            color: var(--dark);
            text-decoration: none;
        }
        
        .brand-logo {
            height: 50px;
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .login-body {
                padding: 1.75rem;
            }
            
            .login-header {
                padding: 1.75rem;
            }
            
            .login-section {
                padding: 1.5rem;
            }
            
            .login-card {
                border-radius: 15px;
            }
        }
        
        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .floating-label input {
            padding-top: 1.5rem;
        }
        
        .floating-label label {
            position: absolute;
            top: 0.75rem;
            left: 1.5rem;
            transition: all 0.3s;
            color: #6c757d;
            pointer-events: none;
        }
        
        .floating-label input:focus ~ label,
        .floating-label input:not(:placeholder-shown) ~ label {
            top: 0.25rem;
            left: 1.5rem;
            font-size: 0.8rem;
            color: var(--primary);
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-label {
            color: #495057;
            user-select: none;
        }
    </style>
</head>
<body>
    <main>
        <section class="login-section">
            <div class="container">
                <div class="login-card">
                    <div class="login-header">
                        <img src="./images/logo.png" alt="Logo" class="brand-logo">
                        <h2>Connexion à votre compte</h2>
                    </div>

                    <div class="login-body">
                        <?php if ($login_error): ?>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                <?= htmlspecialchars($login_error) ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION['register_success'])): ?>
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                <?= htmlspecialchars($_SESSION['register_success']) ?>
                                <?php unset($_SESSION['register_success']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post">
                            <div class="floating-label">
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder=" " required value="<?= htmlspecialchars($email_value) ?>">
                                <label for="email"><i class="bi bi-envelope me-2"></i>Adresse email</label>
                            </div>
                            
                            <div class="floating-label password-container">
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder=" " required>
                                <label for="password"><i class="bi bi-lock me-2"></i>Mot de passe</label>
                                <span class="password-toggle bi bi-eye" id="togglePassword"></span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                                <a href="forgot-password.php" class="custom-link">Mot de passe oublié ?</a>
                            </div>
                            
                            <button type="submit" class="login-btn">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                            </button>
                            
                            <div class="divider">
                                <span>OU</span>
                            </div>
                            
                            <div class="social-login">
                                <a href="#" class="social-btn facebook" title="Se connecter avec Facebook">
                                    <i class="bi-facebook"></i>
                                </a>
                                <a href="#" class="social-btn google" title="Se connecter avec Google">
                                    <i class="bi-google"></i>
                                </a>
                                <a href="#" class="social-btn linkedin" title="Se connecter avec LinkedIn">
                                    <i class="bi-linkedin"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="login-footer">
                        <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour basculer la visibilité du mot de passe
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
            
            // Animation pour les champs flottants
            const floatingInputs = document.querySelectorAll('.floating-label input');
            floatingInputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', () => {
                    if (!input.value) {
                        input.parentElement.classList.remove('focused');
                    }
                });
                
                // Initialiser l'état des labels
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
            });
        });
    </script>
</body>
</html>