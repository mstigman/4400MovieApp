<?php

/**
  * Configuration for database connection
  *
  */

$host       = "localhost:3306";
$username   = "root";
$password   = "password";
$dbname     = "team63"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>
