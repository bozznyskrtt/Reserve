<?php
include 'db_connect.php';

$property_id = isset($_GET['property_id']) ? (int)$_GET['property_id'] : 0;

$sql = "SELECT Image_data FROM Property_Image WHERE Property_ID = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$stmt->bind_result($image_data);

if ($stmt->fetch()) {
    // Set the header to the correct image type
    header("Content-Type: image/jpeg"); // Adjust this based on image type if necessary
    echo $image_data;
} else {
    // Handle case where image data isn't found, e.g., output a placeholder image
    header("Content-Type: image/jpg");
    readfile('FLA_9580.jpg'); // Path to a placeholder image
}

$stmt->close();
$conn->close();
?>