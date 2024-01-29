<?php

function connectToDatabase() {

    // Change Database Credentials
    $host = "localhost"; 
    $dbname = "chef_at_home"; 
    $username = "root"; 
    $password = "root"; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Return pdo connection object
        return $pdo;

    } catch (PDOException $e) {

        // Handle connection errors
        die("Connection failed: " . $e->getMessage());
    }

}


function isAdminLoggedIn() {
    
    // Check if the 'admin' session variable is set
    if (isset($_SESSION['admin'])) {
        return true;
    } else {
        return false;
    }
}