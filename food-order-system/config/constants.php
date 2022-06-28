<?php
// Start Session
session_start();

// Create constants to store Non Repeating values
    define('SITEURL','http://localhost/learn/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');
    $con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    $db_select = mysqli_select_db($con, DB_NAME);
?>