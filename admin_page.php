<?php
session_start();

// Vérifier si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['session'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin - Centre d'émigration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: linear-gradient(135deg, #6a9eff, #3a7bd5);
            --sidebar-width: 250px;
            --header-height: 70px;
            --primary-color: #4a6fcb;
            --secondary-color: #5c8df9;
            --light-bg: #f5f9ff;
            --text-dark: #333;
            --text-light: #fff;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: var(--light-bg);
            color: var(--text-dark);
        }

        /* Sidebar styling */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: var(--text-light);
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar-menu li {
            position: relative;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .sidebar-menu li a:hover {
            background: rgba(255, 255, 255, 0.1);
            padding-left: 25px;
        }

        .sidebar-menu li a i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-menu li.active a {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--text-light);
        }

        .has-dropdown > a::after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 20px;
            transition: transform 0.3s;
        }

        .has-dropdown.active > a::after {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            list-style: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
            background: rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu.show {
            max-height: 500px;
        }

        .dropdown-menu li a {
            padding-left: 60px;
            font-size: 0.9rem;
        }

        .dropdown-menu li a i {
            font-size: 0.9rem;
        }

        /* Main content styling */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            height: var(--header-height);
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .header-left h1 {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .search-box {
            position: relative;
            margin-right: 20px;
        }

        .search-box input {
            padding: 8px 15px 8px 40px;
            border-radius: 20px;
            border: 1px solid #ddd;
            outline: none;
            width: 250px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .user-profile span {
            font-weight: 600;
        }

        /* Content area */
        .content {
            padding: 30px;
            flex: 1;
            overflow-y: auto;
        }

        .dashboard-title {
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-title h2 {
            font-size: 1.8rem;
            color: var(--primary-color);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
        }

        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: #777;
            font-size: 0.9rem;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-bottom: 30px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .card-header h3 {
            font-size: 1.3rem;
            color: var(--primary-color);
        }

        .card-header a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f8fafd;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            color: #666;
            font-weight: 600;
        }

        tbody tr:hover {
            background-color: #f9fbfe;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status.active {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status.pending {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .status.rejected {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .btn {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #3a5bb5;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background: rgba(74, 111, 203, 0.1);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            border-top: 1px solid #eee;
            background: white;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar-header h2, .sidebar-header p, .sidebar-menu li a span {
                display: none;
            }
            .sidebar-menu li a {
                justify-content: center;
                padding: 15px;
            }
            .sidebar-menu li a i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            .has-dropdown > a::after {
                display: none;
            }
            .dropdown-menu {
                position: absolute;
                left: 70px;
                top: 0;
                width: 200px;
                box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }
            .search-box input {
                width: 150px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>ImmigraPro</h2>
            <p>Centre d'émigration</p>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span>Gestion des clients</span>
                </a>
            </li>
            <li class="has-dropdown active">
                <a href="#">
                    <i class="fas fa-cogs"></i>
                    <span>Gestion des services</span>
                </a>
                <ul class="dropdown-menu show">
                    <li><a href="#"><i class="fas fa-passport"></i> Offre Visa</a></li>
                    <li><a href="#"><i class="fas fa-file-contract"></i> Contrat de travail</a></li>
                    <li><a href="#"><i class="fas fa-graduation-cap"></i> Éducation</a></li>
                    <li><a href="#"><i class="fas fa-language"></i> Langue</a></li>
                    <li><a href="#"><i class="fas fa-home"></i> Logement</a></li>
                    <li><a href="#"><i class="fas fa-plane"></i> Transport</a></li>
                    <li><a href="#"><i class="fas fa-file-alt"></i> Traduction de documents</a></li>
                    <li><a href="#"><i class="fas fa-handshake"></i> Intégration culturelle</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-comments"></i>
                    <span>Centre de consultation</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-file-invoice"></i>
                    <span>Facturation</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-bar"></i>
                    <span>Rapports</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="header-left">
                <h1>Tableau de bord</h1>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=4a6fcb&color=fff" alt="Admin">
                    <span>Admin</span>
                    <i class="fas fa-chevron-down" style="margin-left: 10px;"></i>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="dashboard-title">
                <h2>Gestion des clients</h2>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouveau client
                </button>
            </div>

            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(74, 111, 203, 0.1); color: var(--primary-color);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>142</h3>
                        <p>Clients actifs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(40, 167, 69, 0.1); color: var(--success-color);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>89</h3>
                        <p>Dossiers approuvés</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(255, 193, 7, 0.1); color: var(--warning-color);">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-info">
                        <h3>32</h3>
                        <p>En attente</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(220, 53, 69, 0.1); color: var(--danger-color);">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>21</h3>
                        <p>Dossiers rejetés</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Dossiers récents</h3>
                    <a href="#">Voir tout <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <img src="https://ui-avatars.com/api/?name=Marie+Dubois&background=random" width="30" height="30" style="border-radius: 50%; margin-right: 10px;">
                                        Marie Dubois
                                    </div>
                                </td>
                                <td>Visa étudiant</td>
                                <td>22/07/2023</td>
                                <td><span class="status active">Approuvé</span></td>
                                <td><button class="btn btn-outline">Détails</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <img src="https://ui-avatars.com/api/?name=Jean+Martin&background=random" width="30" height="30" style="border-radius: 50%; margin-right: 10px;">
                                        Jean Martin
                                    </div>
                                </td>
                                <td>Contrat de travail</td>
                                <td>20/07/2023</td>
                                <td><span class="status pending">En attente</span></td>
                                <td><button class="btn btn-outline">Détails</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <img src="https://ui-avatars.com/api/?name=Sophie+Leroy&background=random" width="30" height="30" style="border-radius: 50%; margin-right: 10px;">
                                        Sophie Leroy
                                    </div>
                                </td>
                                <td>Traduction de documents</td>
                                <td>18/07/2023</td>
                                <td><span class="status active">Approuvé</span></td>
                                <td><button class="btn btn-outline">Détails</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <img src="https://ui-avatars.com/api/?name=Pierre+Bernard&background=random" width="30" height="30" style="border-radius: 50%; margin-right: 10px;">
                                        Pierre Bernard
                                    </div>
                                </td>
                                <td>Visa travail</td>
                                <td>15/07/2023</td>
                                <td><span class="status rejected">Rejeté</span></td>
                                <td><button class="btn btn-outline">Détails</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <img src="https://ui-avatars.com/api/?name=Lucie+Petit&background=random" width="30" height="30" style="border-radius: 50%; margin-right: 10px;">
                                        Lucie Petit
                                    </div>
                                </td>
                                <td>Programme d'éducation</td>
                                <td>12/07/2023</td>
                                <td><span class="status pending">En attente</span></td>
                                <td><button class="btn btn-outline">Détails</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Centre de consultation d'émigration</h3>
                    <a href="#">Nouvelle consultation <i class="fas fa-plus"></i></a>
                </div>
                <p>Notre centre de consultation offre des services personnalisés pour vous aider à naviguer dans les processus d'immigration. Nos consultants experts sont disponibles pour vous conseiller sur les meilleures options selon votre situation.</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
                    <div style="background: rgba(74, 111, 203, 0.05); padding: 20px; border-radius: 10px;">
                        <h4 style="margin-bottom: 15px; color: var(--primary-color);">
                            <i class="fas fa-globe-americas" style="margin-right: 10px;"></i>
                            Consultation initiale
                        </h4>
                        <p>Évaluation de votre profil et conseils sur les meilleures options d'immigration disponibles.</p>
                    </div>
                    <div style="background: rgba(74, 111, 203, 0.05); padding: 20px; border-radius: 10px;">
                        <h4 style="margin-bottom: 15px; color: var(--primary-color);">
                            <i class="fas fa-file-alt" style="margin-right: 10px;"></i>
                            Préparation de dossier
                        </h4>
                        <p>Aide à la préparation et vérification de tous les documents nécessaires pour votre demande.</p>
                    </div>
                    <div style="background: rgba(74, 111, 203, 0.05); padding: 20px; border-radius: 10px;">
                        <h4 style="margin-bottom: 15px; color: var(--primary-color);">
                            <i class="fas fa-home" style="margin-right: 10px;"></i>
                            Intégration locale
                        </h4>
                        <p>Conseils sur le logement, les écoles, les soins de santé et l'adaptation culturelle.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2023 ImmigraPro - Centre d'émigration. Tous droits réservés.</p>
        </div>
    </div>

    <script>
        // Gestion des dropdowns du sidebar
        document.querySelectorAll('.has-dropdown > a').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                const parent = this.parentElement;
                const dropdown = parent.querySelector('.dropdown-menu');
                
                // Fermer les autres dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(d => {
                    if (d !== dropdown) {
                        d.classList.remove('show');
                        d.parentElement.classList.remove('active');
                    }
                });
                
                // Toggle le dropdown actuel
                dropdown.classList.toggle('show');
                parent.classList.toggle('active');
            });
        });
        
        // Fermer les dropdowns quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.has-dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(d => {
                    d.classList.remove('show');
                    d.parentElement.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>