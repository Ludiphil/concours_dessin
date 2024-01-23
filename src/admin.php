<?php
// start the session
session_start();

// check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    // if not, redirect to the login page
    header('Location: connexion.html');
    exit();
}

// if the user is an admin, include the admin HTML file
include 'administrateur.html';
?>