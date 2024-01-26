<?php
// Include the database connection file
include 'db_connect.php';

// Get the form data
$postal_code = $_POST['postal_code'];
$city = $_POST['city'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$first_name = $_POST['firstname']; // Add this line
$last_name = $_POST['lastname']; // Add this line

// Check if the passwords match
if ($password !== $confirm_password) {
    echo "The passwords do not match.";
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Create the SQL query
$sql = "INSERT INTO Utilisateur (nom, prenom, adresse, login, motDePasse)
VALUES ('$last_name', '$first_name', '$city $postal_code', '$email', '$hashed_password')"; // Modify this line

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header('Location: connexion.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>