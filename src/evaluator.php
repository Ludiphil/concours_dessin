<?php
// start the session
session_start();

// check if the user is an evaluator
if ($_SESSION['role'] != 'evaluator') {
    // if not, redirect to the login page
    header('Location: connexion.html');
    exit();
}

// if the user is an evaluator, include the evaluator HTML file
include 'evaluateur.html';
?>