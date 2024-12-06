<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'database.php';

// Gestion des dépôts
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_depot'])) {
        $code = $_POST['code'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $fax = $_POST['fax'];

        $query = $pdo->prepare('INSERT INTO depots (code, adresse, telephone, fax) VALUES (:code, :adresse, :telephone, :fax)');
        $query->execute([
            'code' => $code,
            'adresse' => $adresse,
            'telephone' => $telephone,
            'fax' => $fax
        ]);
    } elseif (isset($_POST['delete_depot'])) {
        $id = $_POST['depot_id'];
        $query = $pdo->prepare('DELETE FROM depots WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}

// Récupérer tous les dépôts
$query = $pdo->query('SELECT * FROM depots');
$depots = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Dépôts</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Gérer Dépôts</h1>
    </header>

    <main>
        <section>
            <h2>Liste des Dépôts</h2>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>Fax</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($depots as $depot): ?>
                        <tr>
                            <td><?= htmlspecialchars($depot['code']) ?></td>
                            <td><?= htmlspecialchars($depot['adresse']) ?></td>
                            <td><?= htmlspecialchars($depot['telephone']) ?></td>
                            <td><?= htmlspecialchars($depot['fax']) ?></td>
                            <td>
                                <form method="POST" action="gerer_depots.php" style="display:inline;">
                                    <input type="hidden" name="depot_id" value="<?= $depot['id'] ?>">
                                    <button type="submit" name="delete_depot">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Ajouter un Dépôt</h2>
            <form method="POST" action="gerer_depots.php">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" required>
                
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" required>
                
                <label for="telephone">Téléphone</label>
                <input type="text" name="telephone" id="telephone" required>
                
                <label for="fax">Fax</label>
                <input type="text" name="fax" id="fax" required>
                
                <button type="submit" name="add_depot">Ajouter</button>
            </form>
        </section>
    </main>

    <footer>
        &copy; 2024 RENMAT. Tous droits réservés.
    </footer>
</body>
</html>
