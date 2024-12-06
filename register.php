<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $query->execute([
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);

    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
    </header>

    <main>
        <form method="POST" action="register.php">
            <h2>Créer un compte</h2>
            <label for="name">Nom complet</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Inscription</button>
            <p>Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
        </form>
    </main>

    <footer>
        &copy; 2024 RENMAT. Tous droits réservés.
    </footer>
</body>
</html>
