<?php
// start the session
session_start();

// check if the user is a competitor
if ($_SESSION['role'] != 'competitor') {
    // if not, redirect to the login page
    header('Location: connexion.html');
    exit();
}

// if the user is a competitor, include the competitor HTML file
include 'participants.html';
?>