<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENMAT - Accueil</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue chez RENMAT</h1>
    </header>

    <main>
        <section class="intro">
            <h2>Gestion des Locations de Matériels</h2>
            <p>Connectez-vous ou inscrivez-vous pour accéder au système.</p>
            <a href="login.php" class="button">Connexion</a>
            <a href="register.php" class="button">Inscription</a>
        </section>
    </main>

    <footer>
        &copy; 2024 RENMAT. Tous droits réservés.
    </footer>
</body>
</html>
