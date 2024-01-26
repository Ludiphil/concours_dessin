<?php
// Include the database connection file
include 'db_connect.php';

// Get the form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

// Create the SQL query
$sql = "UPDATE Utilisateur SET prenom = ?, nom = ?, adresse = ?, login = ?, mdp = ? WHERE login = ?";

$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("ssssss", $firstname, $lastname, $address, $email, $mdp, $_SESSION['username']);

// Execute the statement
$stmt->execute();

// Check if the update was successful
if ($stmt->affected_rows > 0) {
    echo "Mise à jour réussie";
} else {
    echo "Erreur lors de la mise à jour";
}

// Close the connection
$conn->close();
?>