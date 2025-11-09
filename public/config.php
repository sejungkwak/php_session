<?php

/* Define username and password */
// I am commenting it out, as credentials are now stored in the localhost database.
//$Username = "Steve";
//$Password = "pass";

/**
 * Configuration for database connection
 *
 */

$host = "localhost";
$username = "root";
$password = "";
$dbname = "sessionDB";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);