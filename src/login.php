

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
    if ($password == $user['motDePasse']) {
        // Password is correct, start the sess  ion and save user data into session
        $_SESSION['role'] = 'user';
        $_SESSION['username'] = $username;
        if($user['login'] == 'Manitou'){
            $_SESSION['role'] = 'admin';
            $_SESSION['username'] = $username;
            header('Location: admin.php');
            exit();
        }
        header('Location: index.html');
        exit();
    } else {
        header('Location: connexion.html?error=1');
        exit();
        

    }
} else {
    header('Location: connexion.html?error=1');
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


