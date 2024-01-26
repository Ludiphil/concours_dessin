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
        <div id="dialog" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-4 rounded">
                <p>Voulez-vous valider ces informations ?</p>
                <button id="confirm" type="submit" class="bg-blue-500 text-white p-2 rounded" onclick="action = 'profil.php'">Oui</button>
                <button id="cancel" class="bg-red-500 text-white p-2 rounded">Non</button>
            </div>
        </div>
        
        <script>
            window.onload = function() {
                fetch('navbar.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('navbar').innerHTML = data;
                });
        
                // pop up 
                document.getElementById('submit').addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('dialog').classList.remove('hidden');
                });
        
                document.getElementById('confirm').addEventListener('click', function() {
                    document.getElementById('modif').submit();
                });
        
                document.getElementById('cancel').addEventListener('click', function() {
                    document.getElementById('dialog').classList.add('hidden');
                });
            };
        </script>




        <form id="modif" action="update_user.php" method="post">
            <div class="pt-20 flex justify-center items-center">
                <div class="w-full max-w-xs">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <h2 class="block text-gray-700 text-sm font-bold mb-2">Profil</h2>
                        <label for="firstname">Prénom</label>
                        <input id="firstname" name="firstname" type="text" class="border border-gray-300 p-2 mb-2" value="<?php echo $user['prenom']; ?>">
                        <label for="lastname">Nom</label>
                        <input id="lastname" name="lastname" type="text" class="border border-gray-300 p-2 mb-2" value="<?php echo $user['nom']; ?>">
                        <label for="address">Rue</label>
                        <input id="address" name="address" type="text" class="border border-gray-300 p-2 mb-2" value="<?php echo $user['adresse']; ?>">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="border border-gray-300 p-2 mb-2" value="<?php echo $user['login']; ?>">
                        <label for="mdp">mot de passe</label>
                        <input id="mdp" name="mdp" type="password" class="border border-gray-300 p-2 mb-2" value="">
                        <button id="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Mettre à jour</button>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>

<?php
} else {
    echo "Utilisateur non trouvé";
}

// Close the connection
$conn->close();
?>