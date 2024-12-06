<?php
    // Connexion à la base de données
    include('db.php');

    // Récupérer les contrats de location
    $query = "SELECT * FROM contrats_location";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Contrats de Location</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<header>
    <h1>Gestion des Contrats de Location</h1>
</header>

<main>
    <h2>Liste des Contrats de Location</h2>

    <table>
        <thead>
            <tr>
                <th>Numéro du Contrat</th>
                <th>Nom du Client</th>
                <th>Date du Contrat</th>
                <th>Total Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($contrat = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $contrat['numero_contrat']; ?></td>
                    <td><?php echo $contrat['client_id']; ?></td>
                    <td><?php echo $contrat['date_contrat']; ?></td>
                    <td><?php echo $contrat['total_location']; ?>€</td>
                    <td>
                        <a href="modifier_contrat.php?id=<?php echo $contrat['id']; ?>">Modifier</a>
                        <a href="supprimer_contrat.php?id=<?php echo $contrat['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Ajouter un Contrat</h3>
    <form action="ajouter_contrat.php" method="POST">
        <label for="numero_contrat">Numéro du Contrat</label>
        <input type="text" name="numero_contrat" required>
        
        <label for="client_id">Client ID</label>
        <input type="number" name="client_id" required>
        
        <label for="depot_id">Dépôt</label>
        <input type="number" name="depot_id" required>
        
        <label for="total_location">Total Location (€)</label>
        <input type="number" name="total_location" required>

        <button type="submit">Ajouter</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 RENMAT</p>
</footer>

</body>
</html>
