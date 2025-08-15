<?php
session_start();
ob_start();
?>
<!-- No blank lines or spaces above this! -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>MBC Center Training And Consulting</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">
    
    <!-- owl carousel css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- font awesmoe icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/templatemo-topic-listing.css" rel="stylesheet">

    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/css/intlTelInput.css" />

    <!-- require functions.php file -->
    <?php require('functions.php'); ?>
    <!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

-->
</head>

<body id="top">

    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="./images/logo.png" width="150" alt="">
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_2">Browse Topics</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_3">How it works</a>
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
                                <li><a class="dropdown-item" href="contact.php">Contact Form</a></li>

                                <li><a class="dropdown-item" href="careers.php">Careers</a></li>

                                <li><a class="dropdown-item" href="our-company.php">Our Company</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="d-none d-lg-block ms-auto">
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <!-- Affichage du nom de l'utilisateur connecté -->
                            <div class="dropdown">
                                <a class="btn btn-outline-light dropdown-toggle d-flex align-items-center" 
                                    href="#" role="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <?php echo htmlspecialchars(explode(' ', $_SESSION['full_name'])[0]); ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="profile.php">
                                        <i class="bi bi-person me-2"></i>Mon profil
                                    </a></li>
                                    <li><a class="dropdown-item" href="logout.php">
                                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                    </a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <!-- Lien de connexion si l'utilisateur n'est pas connecté -->
                            <a href="login.php" class="btn btn-outline-light">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <div class="d-none d-lg-block ms-2 position-relative">
                            <a href="favorites.php" class="navbar-icon fas fa-heart"></a>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="font-size: 12px;background-color: #13547a;">
                                <?php
                                    if(count($offer->getFavoriteByUserIdAndItemId($_SESSION['user_id'])) > 0) {
                                        echo '+' . count($offer->getFavoriteByUserIdAndItemId($_SESSION['user_id']));
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
