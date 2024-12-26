<?php

// Ensure session is only started if it's not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once '../model/function.php';

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    
    <title>
        <?php
        echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
        ?>
    </title>
    <link rel="stylesheet" href="../public/css/style.css?v3" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-jrk0uIp99hTRQlKOvTM3AQp9NT1l/x+O1E6+HxgDZtvaTWBn4KabQbxYgT5bRZXRRvRlYk4f79/KhVk6h5k7Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
        function showMessage(message, type) {
            if (message) {
                let alertBox = document.createElement('div');
                alertBox.className = `alert ${type}`;
                alertBox.innerText = message;
                document.body.insertBefore(alertBox, document.body.firstChild);
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 3000);
            }
        }
    </script>
    <style>
        .alert {
            padding: 20px;
            color: white;
            margin-bottom: 15px;
        }
        .alert.success {background-color: #4CAF50;} /* Green */
        .alert.danger {background-color: #f44336;} /* Red */
    </style>
</head>

<body>

    <div class="sidebar hidden-print">
        <div class="logo-details">
        
        <i><img src="../public/img/nebg3.png" alt="Icon" /></i>
        <span class="logo_name">Nova electro</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="dashboard.php" ? "active" : "" ?> ">
                <i class="fas fa-home"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="client.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="client.php" ? "active" : "" ?> ">
                <i class="fas fa-user"></i>
                <span class="links_name">Client</span>
                </a>
            </li>
            <li>
                <a href="fournisseur.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="fournisseur.php" ? "active" : "" ?> ">
                <i class="fas fa-truck"></i>
                    <span class="links_name">Fournisseur</span>
                </a>
            </li>
            <li>
                <a href="categorie.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="categorie.php" ? "active" : "" ?> ">
                <i class="fas fa-folder"></i>
                    <span class="links_name">Catégorie</span>
                </a>
            </li>
            <li>
                <a href="vente.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="vente.php" ? "active" : "" ?> ">
                <i class="fas fa-shopping-cart"></i>
                    <span class="links_name">Vente</span>
                </a>
            </li>
            <li>
                <a href="article.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="article.php" ? "active" : "" ?> ">
                <i class="fas fa-newspaper"></i>
                    <span class="links_name">Article</span>
                </a>
            </li>

            <li>
                <a href="commande.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="commande.php" ? "active" : "" ?> ">
                    
                    <i class="bx bx-box"></i>
                    <span class="links_name">Commandes</span>
                </a>
            </li>
            <li class="log_out">
                <a href="../model/deconnexion.php">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="hidden-print">
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">
                    <?php
                    echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
                    ?>
                </span>
            </div>
        </nav>