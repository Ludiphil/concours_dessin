<?php
// start the session
session_start();

// check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // if not, redirect them to the home page
    header('Location: index.html');
    exit();
}

// if the user is logged in and is an admin, display the admin page
include 'administrateur.html';

include 'db_connect.php';

// Perform a query
$sql = "SELECT * FROM Dessin";
$result = $conn->query($sql);

echo "<div style='background-color: yellow;'>";
if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<p>ID du dessin : " . $row["numDessin"] . "</p>";
  }
} else {
  echo "0 results";
}
echo "</div>";
$conn->close();

?>