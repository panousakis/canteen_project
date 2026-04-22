<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "canteen_system";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης με τη βάση δεδομένων: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
