<?php
// db_connect.php
$conn = new mysqli("localhost", "root", "root", "Reserve");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>