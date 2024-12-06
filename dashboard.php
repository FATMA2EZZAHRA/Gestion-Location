<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'database.php';

// Récupérer l'utilisateur connecté
$query = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$query->execute(['id' => $_SESSION['user_id']]);
$user = $query->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue, <?= htmlspecialchars($user['name']) ?></h1>
    </header>

    <main>
        <section class="dashboard">
            <h2>Gestion des Locations</h2>
            <nav class="navigation">
                <ul>
                    <li><a href="gerer_depots.php">Gérer Dépôts</a></li>
                    <li><a href="gerer_clients.php">Gérer Clients</a></li>
                    <li><a href="gerer_materiels.php">Gérer Matériels</a></li>
                    <li><a href="gerer_fournisseurs.php">Gérer Fournisseurs</a></li>
                    <li><a href="gerer_categories.php">Gérer Catégories</a></li>
                    <li><a href="gerer_gerants.php">Gérer Gérants</a></li>
                    <li><a href="contrat_location.php">Contrats de Location</a></li>
                </ul>
            </nav>
            <a href="logout.php" class="button logout">Déconnexion</a>
        </section>
    </main>

    <footer>
        &copy; 2024 RENMAT. Tous droits réservés.
    </footer>
</body>
</html>
