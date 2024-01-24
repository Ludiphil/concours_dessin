<?php
// start the session
session_start();

// get the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// check the credentials (this is just a placeholder, you should check the credentials against a database)
if ($username == 'admin' && $password == 'password') {
    $_SESSION['role'] = 'admin';
} elseif ($username == 'competitor' && $password == 'password') {
    $_SESSION['role'] = 'competitor';
} elseif ($username == 'evaluator' && $password == 'password') {
    $_SESSION['role'] = 'evaluator';
} else {
    // if the credentials are wrong, redirect back to the login page with an error message
    header('Location: connexion.html?error=1');
    exit();
}

// if the credentials are correct, redirect to the correct page based on the role
if ($_SESSION['role'] == 'admin') {
    header('Location: admin.php');
} elseif ($_SESSION['role'] == 'competitor') {
    header('Location: competitor.php');
} elseif ($_SESSION['role'] == 'evaluator') {
    header('Location: evaluator.php');
}

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
        session_start();
        $_SESSION['user'] = $user;
        echo "Login successful";
        header('Location: index.html');
        exit();
    } else {
        echo "Invalid password";
        header('Location: login.php');
        exit();
    }
} else {
    echo "Invalid login";
    header('Location: login.php');
    exit();
}

// check the credentials (this is just a placeholder, you should check the credentials against a database)
if ($username == 'admin' && $password == 'password') {
    $_SESSION['role'] = 'admin';
} else(){

}
// elseif ($username == 'competitor' && $password == 'password') {
//     $_SESSION['role'] = 'competitor';
// } elseif ($username == 'evaluator' && $password == 'password') {
//     $_SESSION['role'] = 'evaluator';
// } else {
//     // if the credentials are wrong, redirect back to the login page with an error message
//     header('Location: connexion.html?error=1');
//     exit();
// }

// if the credentials are correct, redirect to the correct page based on the role
if ($_SESSION['role'] == 'admin') {
    header('Location: admin.php');
} 
// elseif ($_SESSION['role'] == 'competitor') {
//     header('Location: competitor.php');
// } elseif ($_SESSION['role'] == 'evaluator') {
//     header('Location: evaluator.php');
// }

// Close the connection
$conn->close();
?>