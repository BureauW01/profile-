<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "utilisateur");

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
    }

    // Récupérer les informations du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $fonction = $_POST['fonction'];
    $numero = $_POST['numero'];

    // Traitement de l'upload de la photo
    $photo = $_FILES['photo']['name'];
    $target_dir = "photos/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    // Vérifier si le fichier a bien été uploadé
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "Le fichier " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " a bien été téléchargé.";
    } else {
        echo "Désolé, une erreur s'est produite lors du téléchargement du fichier.";
    }

    // Préparer la requête d'insertion
    $sql = "INSERT INTO user (nom, prenom, fonction, numero, photo) VALUES ('$nom', '$prenom', '$fonction', '$numero', '$photo')";

    // Exécuter la requête
    if ($mysqli->query($sql) === TRUE) {
        echo "Nouvel utilisateur ajouté avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $mysqli->error;
    }

    // Fermer la connexion
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="add.php">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<h2>Ajouter un utilisateur</h2>
<form  method="post" enctype="multipart/form-data">
    <label for="nom">Nom :</label><br>
    <input type="text" id="nom" name="nom" required><br>
    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" name="prenom" required><br>
    <label for="fonction">Fonction :</label><br>
    <input type="text" id="fonction" name="fonction" required><br>
    <label for="numero">Numéro :</label><br>
    <input type="text" id="numero" name="numero" required><br>
    <label for="photo">Photo :</label><br>
    <input type="file" id="photo" name="photo" accept="image/*" required><br><br>
    <input type="submit" value="Ajouter">
</form>

</body>
</html>
