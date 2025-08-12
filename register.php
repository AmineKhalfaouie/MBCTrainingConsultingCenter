<?php
session_start();
require('functions.php');

$errors = [];
$old = [];

if (isset($_SESSION['register_errors'])) {
    $errors = $_SESSION['register_errors'];
    unset($_SESSION['register_errors']);
}

if (isset($_SESSION['old'])) {
    $old = $_SESSION['old'];
    unset($_SESSION['old']);
}

$success = false;
if (isset($_SESSION['register_success'])) {
    $success = $_SESSION['register_success'];
    unset($_SESSION['register_success']);
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription | MBC Consulting</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-topic-listing.css" rel="stylesheet">
    
    <style>
        .register-section {
            background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);
            padding: 100px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .register-header {
            background: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);
            padding: 30px;
            text-align: center;
        }
        
        .register-header h2 {
            color: white;
            margin: 0;
            font-weight: 700;
        }
        
        .register-body {
            padding: 40px;
        }
        
        .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            border: 2px solid #eaeaea;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #80d0c7;
            box-shadow: 0 0 0 0.25rem rgba(19, 84, 122, 0.1);
        }
        
        .form-select {
            border-radius: 50px;
            padding: 12px 20px;
            border: 2px solid #eaeaea;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .form-select:focus {
            border-color: #80d0c7;
            box-shadow: 0 0 0 0.25rem rgba(19, 84, 122, 0.1);
        }
        
        .register-btn {
            background: #13547a;
            border: none;
            color: white;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            margin-top: 15px;
        }
        
        .register-btn:hover {
            background: #0d3c58;
            transform: translateY(-3px);
        }
        
        .register-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #eaeaea;
        }
        
        .register-footer a {
            color: #13547a;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .register-footer a:hover {
            color: #0d3c58;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #eaeaea;
        }
        
        .divider span {
            padding: 0 15px;
            color: #717275;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #717275;
            z-index: 10;
        }
        
        .password-container {
            position: relative;
        }
        
        .role-info {
            background-color: #e6f7ff;
            border-left: 4px solid #1890ff;
            border-radius: 4px;
            padding: 10px 15px;
            margin-top: -10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .register-body {
                padding: 30px;
            }
            
            .register-section {
                padding: 50px 20px;
            }
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
            padding: 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
            padding: 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1.5rem;
        }
        
        .custom-border-btn {
            border: 2px solid #13547a;
            color: #13547a;
            background: transparent;
            border-radius: 50px;
            padding: 10px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        
        .custom-border-btn:hover {
            background: #13547a;
            color: white;
        }
    </style>
</head>

<body id="top">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="./images/logo.png" width="150" alt="MBC Consulting">
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="index.php" class="navbar-icon bi-house smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_1">Accueil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_2">Offres</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_3">Fonctionnement</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_4">FAQs</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_5">Contact</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Pages</a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="topics-listing.php">Liste des offres</a></li>
                                <li><a class="dropdown-item" href="contact.php">Formulaire de contact</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="d-none d-lg-block">
                        <a href="index.php" class="navbar-icon bi-house smoothscroll"></a>
                    </div>
                </div>
            </div>
        </nav>

        <section class="register-section">
            <div class="container">
                <div class="register-card">
                    <div class="register-header">
                        <h2>Créer un compte</h2>
                    </div>
                    
                    <div class="register-body">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                <?php echo htmlspecialchars($success); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="check_Data.php" method="post" id="registerForm">
                            <input type="hidden" name="register" value="1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" 
                                               placeholder="Votre prénom" required
                                               value="<?php echo isset($old['firstName']) ? htmlspecialchars($old['firstName']) : ''; ?>">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" 
                                               placeholder="Votre nom" required
                                               value="<?php echo isset($old['lastName']) ? htmlspecialchars($old['lastName']) : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="votre@email.com" required
                                       value="<?php echo isset($old['email']) ? htmlspecialchars($old['email']) : ''; ?>">
                            </div>
                            
                            <div class="mb-3 password-container">
                                <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required minlength="8">
                                <span class="password-toggle bi bi-eye" id="togglePassword"></span>
                                <div class="form-text">Minimum 8 caractères</div>
                            </div>
                            
                            <div class="mb-3 password-container">
                                <label for="confirmPassword" class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="••••••••" required>
                                <span class="password-toggle bi bi-eye" id="toggleConfirmPassword"></span>
                            </div>
                            
                            <div class="mb-3">
                                <label for="userType" class="form-label">Type de compte <span class="text-danger">*</span></label>
                                <select class="form-select" id="userType" name="userType" required>
                                    <option value="" selected disabled>Sélectionnez un type</option>
                                    <option value="client" <?php echo (isset($old['userType']) && $old['userType'] === 'client') ? 'selected' : ''; ?>>Client</option>
                                    <option value="admin" <?php echo (isset($old['userType']) && $old['userType'] === 'admin') ? 'selected' : ''; ?>>Administrateur</option>
                                </select>
                                
                                <div class="role-info mt-2">
                                    <p class="mb-0">
                                        <strong>Client :</strong> Accès aux offres et services<br>
                                        <strong>Administrateur :</strong> Gestion complète du système (accès spécial requis)
                                    </p>
                                </div>
                            </div>
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required <?php echo (isset($old['terms']) && $old['terms']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="terms">
                                    J'accepte les <a href="#" target="_blank">termes et conditions</a> <span class="text-danger">*</span>
                                </label>
                            </div>
                            
                            <button type="submit" class="register-btn">S'inscrire</button>
                            
                            <div class="divider">
                                <span>Vous avez déjà un compte ?</span>
                            </div>
                            
                            <div class="text-center">
                                <a href="login.php" class="btn custom-border-btn">Se connecter</a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="register-footer">
                        <p>En vous inscrivant, vous acceptez nos <a href="#" target="_blank">conditions d'utilisation</a> et notre <a href="#" target="_blank">politique de confidentialité</a>.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="index.php">
                        <img src="./images/main-logo.png" style="width: 250px;" alt="MBC Consulting">
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Liens utiles</h6>

                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="index.php" class="site-footer-link">Accueil</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="index.php#section_2" class="site-footer-link">Offres</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="index.php#section_4" class="site-footer-link">FAQs</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="contact.php" class="site-footer-link">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Contact</h6>

                    <p class="text-white d-flex mb-1">
                        <a href="tel:+21697054079" class="site-footer-link">
                            +216 97 054 079
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <a href="mailto:mbctrainingsite72@outlook.com" class="site-footer-link">
                            mbctrainingsite72@outlook.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                    <p class="copyright-text mt-lg-5 mt-4">Copyright © <?php echo date('Y'); ?> MBC Consulting. Tous droits réservés.
                    </p>
                </div>

            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour basculer la visibilité du mot de passe
            function setupPasswordToggle(toggleId, inputId) {
                const toggle = document.querySelector(toggleId);
                const input = document.querySelector(inputId);
                
                if (toggle && input) {
                    toggle.addEventListener('click', function() {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        this.classList.toggle('bi-eye');
                        this.classList.toggle('bi-eye-slash');
                    });
                }
            }
            
            // Configuration des toggles
            setupPasswordToggle('#togglePassword', '#password');
            setupPasswordToggle('#toggleConfirmPassword', '#confirmPassword');
            
            // Validation du formulaire
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                let isValid = true;
                
                // Validation des mots de passe
                if (password.length < 8) {
                    isValid = false;
                    alert('Le mot de passe doit contenir au moins 8 caractères');
                }
                
                if (password !== confirmPassword) {
                    isValid = false;
                    alert('Les mots de passe ne correspondent pas');
                }
                
                // Validation des termes
                const terms = document.getElementById('terms');
                if (!terms.checked) {
                    isValid = false;
                    alert('Vous devez accepter les termes et conditions');
                }
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>