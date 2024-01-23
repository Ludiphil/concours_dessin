<?php
// start the session
session_start();

if (session_status() == PHP_SESSION_ACTIVE) {
    echo 'Les sessions sont activées.';
} else {
    echo 'Les sessions ne sont pas activées.';
}

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
?>