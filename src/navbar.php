<?php
// start the session
session_start();

// Include the database connection file
include 'db_connect.php';


// Perform a query
$sql = "SELECT * FROM Dessin";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("SQL Error: " . $conn->error);
}


if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    //echo "<p>ID du dessin : " . $row["numDessin"] . "</p>";
  }
} else {
  echo "0 results";
}
echo "</div>";
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<!-- navbar.php -->
<nav class="mt-6 rounded-2xl relative flex items-center justify-between px-2 py-3 mb-3 shadow-lg bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-800 ">
  <a href="index.html" class="text-xl font-bold text-pink-400">
      Concours de dessins
  </a>
  <div class="space-x-4">
      <a href="concours.php" class="text-black hover:text-gray-200">Concours</a>
      <a href="dessins.html" class="text-black hover:text-gray-200">Dessins</a>
      <?php if (!isset($_SESSION['role'])): ?>
          <!-- show these buttons only if the user is not logged in -->
          <a href="inscription.html" class="text-black hover:text-gray-200">Inscription</a>
          <a href="connexion.php" class="text-white hover:text-gray-200 border border-blue-400 bg-blue-500 rounded-lg p-2">Connexion</a>
      <?php endif; ?>
      <?php if (isset($_SESSION['role'])): ?>
          <!-- show this button only if the user is logged in -->
          <a href="profil.php" class="text-white hover:text-gray-200 border border-blue-400 bg-blue-500 rounded-lg p-2">Profil</a>
          <a href="deconnexion.php" class="text-white hover:text-gray-200 border border-red-400 bg-red-500 rounded-lg p-2">Déconnexion</a>
      <?php endif; ?>
  </div>
</nav>
</html>