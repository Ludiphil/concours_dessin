<?php
// Inclure les informations de connexion à votre base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "siteweb";

// Connexion à la base de données MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer tous les fichiers du répertoire
$dir = "D:\OneDrive - ESEO\Eseo\E4a\web\BDD_projet\imageBDD - Copie";
$images = glob($dir . "/*.{jpg,png,gif}", GLOB_BRACE);

// Parcourir toutes les images
foreach ($images as $image) {
    // Récupérer le contenu de l'image
    $imageContent = file_get_contents($image);

    // Échapper le contenu de l'image pour l'insertion SQL
    $imageContent = mysqli_real_escape_string($conn, $imageContent);

    // Préparer la requête SQL pour insérer l'image dans la table Dessin
    $sql = "INSERT INTO Dessin (leDessin) VALUES ('$imageContent')";

    // Exécuter la requête SQL
    if (!$conn->query($sql)) {
        echo "Erreur lors de l'insertion de l'image : " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>