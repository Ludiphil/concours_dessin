<?php
// start the session
session_start();

// destroy the session
session_destroy();

// redirect to the login page
header('Location: connexion.html');
exit();
?>