<?php
// Include the database connection file
include 'db_connect.php';

// Start the session
session_start();

// Create the SQL query
$sql = "SELECT * FROM Utilisateur WHERE login = ?";
$stmt = $conn->prepare($sql);

// Bind the login parameter
$stmt->bind_param("s", $_SESSION['username']);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // Get the user data
    $user = $result->fetch_assoc();
?>
<!-- HTML code here -->



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gradient-to-b from-pink-500 to-blue-500 bg-no-repeat min-h-screen bg-cover coiny-regular">
    <div class="container mx-auto px-4">
        <div id="navbar"></div>
        <script>
            window.onload = function() {
                fetch('navbar.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('navbar').innerHTML = data;
                });
            };
        </script>
        <div class="w-full max-w-xs">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="block text-gray-700 text-sm font-bold mb-2">Profil</h2>
                <label for="firstname">Prénom</label>
                <p id="firstname" class="border border-gray-300 p-2 mb-2"><?php echo $user['prenom']; ?></p>
                <label for="lastname">Nom</label>
                <p id="lastname" class="border border-gray-300 p-2 mb-2"><?php echo $user['nom']; ?></p>
                <label for="address">Rue</label>
                <p id="address" class="border border-gray-300 p-2 mb-2"><?php echo $user['adresse']; ?></p>
                <label for="email">Email</label>
                <p id="email" class="border border-gray-300 p-2 mb-2"><?php echo $user['login']; ?></p>
                <label for="mdp">Mot de passe</label>
                <p id="mdp" class="border border-gray-300 p-2 mb-2">******</p>
                <a href="modification_profil.php" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline block text-center mt-4">Modifier les informations du profil</a>
            </div>
        </div>
        <!-- <div class="pt-20 flex justify-center items-center">
            
            <div class="w-full max-w-xs">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="block text-gray-700 text-sm font-bold mb-2">Profil</h2>
                    <label for="firstname">Prénom</label>
                    <p id="firstname" class="border border-gray-300 p-2 mb-2"></p>
                    <label for="lastname">Nom</label>
                    <p id="lastname" class="border border-gray-300 p-2 mb-2"></p>
                    <label for="address">Rue</label>
                    <p id="address" class="border border-gray-300 p-2 mb-2"></p>
                    <label for="postal_code">Code postal</label>
                    <p id="postal_code" class="border border-gray-300 p-2 mb-2"></p>
                    <label for="city">Ville</label>
                    <p id="city" class="border border-gray-300 p-2 mb-2"></p>
                    <label for="email">Email</label>
                    <p id="email" class="border border-gray-300 p-2 mb-2"></p>
                    <label for="mdp">Mot de passe</label>
                    <p id="mdp" class="border border-gray-300 p-2 mb-2"></p>
                    <a href="modification_profil.html" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline block text-center mt-4">Modifier les informations du profil</a>

                </div>
            </div> -->
        </div>
    </div>
</body>
</html>


<?php
} else {
    echo "Utilisateur non trouvé";
}

// Close the connection
$conn->close();
?>