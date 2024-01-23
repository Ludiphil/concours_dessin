<?php
$servername = "localhost";
$username = "etudiant";
$password = "N3twork!";
$dbname = "siteweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>