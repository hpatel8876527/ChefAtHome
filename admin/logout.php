<?php

session_start();

// Logout Admin User

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    
    unset($_SESSION['admin']);
    header('Location: /admin');
    exit;

}


?>