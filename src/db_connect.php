<?php
$servername = "localhost";
$username = "etudiant";
$password = "N3twork!";
$dbname = "siteweb";
$dbport = 3306;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $dbport);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>