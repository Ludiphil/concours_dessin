

<?php
// start the session
include 'db_connect.php';

session_start();


// get the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];


// Create the SQL query
$sql = "SELECT * FROM Utilisateur WHERE login = ?";
$stmt = $conn->prepare($sql);

// Bind the login parameter
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // Get the user data
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $user['motDePasse'])) {
        // Password is correct, start the sess  ion and save user data into session
        $_SESSION['role'] = 'user';
        header('Location: index.html');
        exit();
    } else {
        header('Location: connexion.html?error=1');
        console.log("erreur de mot de passe")
        exit();
        

    }
} else {
    header('Location: connexion.html?error=1');
    console.log("erreur de login")
    exit();


}

// if ($username == 'Manitou' && $password == 'LemeilleurDG') {
//     $_SESSION['role'] = 'admin';
// } 

// if ($_SESSION['role'] == 'admin') {
//     header('Location: admin.php');
// } 


// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
</body>
</html>