<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'database.php';

// Gestion des clients
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_client'])) {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];

        $query = $pdo->prepare('INSERT INTO clients (nom, email, telephone, adresse) VALUES (:nom, :email, :telephone, :adresse)');
        $query->execute([
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'adresse' => $adresse
        ]);
    } elseif (isset($_POST['delete_client'])) {
        $id = $_POST['client_id'];
        $query = $pdo->prepare('DELETE FROM clients WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}

// Récupérer tous les clients
$query = $pdo->query('SELECT * FROM clients');
$clients = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Clients</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Gérer Clients</h1>
    </header>

    <main>
        <section>
            <h2>Liste des Clients</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= htmlspecialchars($client['nom']) ?></td>
                            <td><?= htmlspecialchars($client['email']) ?></td>
                            <td><?= htmlspecialchars($client['telephone']) ?></td>
                            <td><?= htmlspecialchars($client['adresse']) ?></td>
                            <td>
                                <form method="POST" action="gerer_clients.php" style="display:inline;">
                                    <input type="hidden" name="client_id" value="<?= $client['id'] ?>">
                                    <button type="submit" name="delete_client">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Ajouter un Client</h2>
            <form method="POST" action="gerer_clients.php">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="telephone">Téléphone</label>
                <input type="text" name="telephone" id="telephone" required>

                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" required>

                <button type="submit" name="add_client">Ajouter</button>
            </form>
        </section>
    </main>

    <footer>
        &copy; 2024 RENMAT. Tous droits réservés.
    </footer>
</body>
</html>
