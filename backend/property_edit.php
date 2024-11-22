<?php
session_start();
include 'db_connect.php';

if (!isset($_GET['property_id'])) {
    die("Error: Property ID not provided.");
}

$property_id = $conn->real_escape_string($_GET['property_id']);
$sql = "SELECT * FROM Properties WHERE Property_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Error: Property not found.");
}

$property = $result->fetch_assoc();
$stmt->close();
?>
