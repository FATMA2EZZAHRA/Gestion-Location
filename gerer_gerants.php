<?php
    // Connexion à la base de données
    include('db.php');

    // Récupérer tous les gérants depuis la base de données
    $query = "SELECT * FROM gerants";
    $result = mysqli_query($conn, $query);

    // Ajouter un gérant
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $fax = $_POST['fax'];
        $adresse = $_POST['adresse'];
        $depot_id = $_POST['depot_id'];

        // Insertion du nouveau gérant
        $insert_query = "INSERT INTO gerants (nom, prenom, email, telephone, fax, adresse, depot_id) 
                         VALUES ('$nom', '$prenom', '$email', '$telephone', '$fax', '$adresse', '$depot_id')";
        if (mysqli_query($conn, $insert_query)) {
            echo "<p>Gérant ajouté avec succès.</p>";
        } else {
            echo "<p>Erreur : " . mysqli_error($conn) . "</p>";
        }
    }

    // Suppression d'un gérant
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM gerants WHERE id = '$delete_id'";
        if (mysqli_query($conn, $delete_query)) {
            echo "<p>Gérant supprimé avec succès.</p>";
        } else {
            echo "<p>Erreur : " . mysqli_error($conn) . "</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Gérants</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<header>
    <h1>Gestion des Gérants</h1>
</header>

<main>
    <h2>Liste des Gérants</h2>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($gerant = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $gerant['nom']; ?></td>
                    <td><?php echo $gerant['prenom']; ?></td>
                    <td><?php echo $gerant['email']; ?></td>
                    <td><?php echo $gerant['telephone']; ?></td>
                    <td>
                        <a href="modifier_gerant.php?id=<?php echo $gerant['id']; ?>">Modifier</a>
                        <a href="gerer_gerants.php?delete_id=<?php echo $gerant['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Ajouter un Gérant</h3>
    <form action="gerer_gerants.php" method="POST">
        <label for="nom">Nom</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" required>

        <label for="fax">Fax</label>
        <input type="text" name="fax">

        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" required>

        <label for="depot_id">Dépôt</label>
        <input type="number" name="depot_id" required>

        <button type="submit">Ajouter</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 RENMAT</p>
</footer>

</body>
</html>
