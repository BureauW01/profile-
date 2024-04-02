<!DOCTYPE html>
<html>
<head>
    <title>Afficher un utilisateur</title>
    <link rel="stylesheet" href="user.php">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<h2>Afficher un utilisateur</h2>
<form  method="get">
    <label for="id">ID de l'utilisateur :</label><br>
    <input type="text" id="id" name="id" required><br><br>
    <input type="submit" value="Afficher">
</form>

<?php
// Vérifier si un ID a été soumis
if(isset($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur soumis
    $id = $_GET['id'];

    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "utilisateur");
    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
    }

    // Récupérer les informations de l'utilisateur spécifique depuis la base de données
    $sql = "SELECT nom, prenom, fonction, numero, photo FROM user WHERE id = $id";
    $result = $mysqli->query($sql);

    // Afficher les informations de l'utilisateur
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>" . $row["prenom"] . " " . $row["nom"] . "</h3>";
        echo "<p><strong>Fonction :</strong> " . $row["fonction"] . "</p>";
        echo "<p><strong>Numéro :</strong> " . $row["numero"] . "</p>";
        echo "<img src='photos/" . $row["photo"] . "' width='250'><br><br>";
    } else {
        echo "Aucun utilisateur trouvé avec cet ID.";
    }

    // Fermer la connexion
    $mysqli->close();
}
?>

</body>
</html>
