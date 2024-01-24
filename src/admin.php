<?php
// start the session
session_start();

// check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // if not, redirect them to the home page
    header('Location: index.html');
    exit();
}


// if the user is logged in and is an admin, display the admin page
include 'administrateur.html';



?>