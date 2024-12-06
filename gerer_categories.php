<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'database.php';

// Gestion des catégories
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_categorie'])) {
        $nom = $_POST['nom'];

        $query = $pdo->prepare('INSERT INTO categories (nom) VALUES (:nom)');
        $query->execute(['nom' => $nom]);
    } elseif (isset($_POST['delete_categorie'])) {
        $id = $_POST['categorie_id'];
        $query = $pdo->prepare('DELETE FROM categories WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}

// Récupérer toutes les catégories
$query = $pdo->query('SELECT * FROM categories');
$categories = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Catégories</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Gérer Catégories</h1>
    </header>

    <main>
        <section>
            <h2>Liste des Catégories</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $categorie): ?>
                        <tr>
                            <td><?= htmlspecialchars($categorie['nom']) ?></td>
                            <td>
                                <form method="POST" action="gerer_categories.php" style="display:inline;">
                                    <input type="hidden" name="categorie_id" value="<?= $categorie['id'] ?>">
                                    <button type="submit" name="delete_categorie">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Ajouter une Catégorie</h2>
            <form method="POST" action="gerer_categories.php">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>

                <button type="submit" name="add_categorie">Ajouter</button>
            </form>
        </section>
    </main>

    <footer>
        &copy; 2024 RENMAT. Tous droits réservés.
    </footer>
</body>
</html>
