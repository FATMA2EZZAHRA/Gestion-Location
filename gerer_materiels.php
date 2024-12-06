<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'database.php';

// Gestion des matériels
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_materiel'])) {
        $nom = $_POST['nom'];
        $categorie = $_POST['categorie'];
        $quantite = $_POST['quantite'];
        $description = $_POST['description'];

        $query = $pdo->prepare('INSERT INTO materiels (nom, categorie, quantite, description) VALUES (:nom, :categorie, :quantite, :description)');
        $query->execute([
            'nom' => $nom,
            'categorie' => $categorie,
            'quantite' => $quantite,
            'description' => $description
        ]);
    } elseif (isset($_POST['delete_materiel'])) {
        $id = $_POST['materiel_id'];
        $query = $pdo->prepare('DELETE FROM materiels WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}

// Récupérer tous les matériels
$query = $pdo->query('SELECT * FROM materiels');
$materiels = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Matériels</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Gérer Matériels</h1>
    </header>

    <main>
        <section>
            <h2>Liste des Matériels</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Quantité</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materiels as $materiel): ?>
                        <tr>
                            <td><?= htmlspecialchars($materiel['nom']) ?></td>
                            <td><?= htmlspecialchars($materiel['categorie']) ?></td>
                            <td><?= htmlspecialchars($materiel['quantite']) ?></td>
                            <td><?= htmlspecialchars($materiel['description']) ?></td>
                            <td>
                                <form method="POST" action="gerer_materiels.php" style="display:inline;">
                                    <input type="hidden" name="materiel_id" value="<?= $materiel['id'] ?>">
                                    <button type="submit" name="delete_materiel">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Ajouter un Matériel</h2>
            <form method="POST" action="gerer_materiels.php">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>

                <label for="categorie">Catégorie</label>
                <input type="text" name="categorie" id="categorie" required>

                <label for="quantite">Quantité</label>
                <input type="number" name="quantite" id="quantite" required>

                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>

                <button type="submit" name="add_materiel">Ajouter</button>
            </form>
        </section>
    </main>

    <footer>
        &copy; 2024 RENMAT. Tous droits réservés.
    </footer>
</body>
</html>
