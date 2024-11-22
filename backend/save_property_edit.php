<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $conn->real_escape_string($_POST['property_id']);
    $title = $conn->real_escape_string(trim($_POST['property_title']));
    $description = $conn->real_escape_string(trim($_POST['property_description']));
    $price = $conn->real_escape_string($_POST['property_price']);
    $location = $conn->real_escape_string(trim($_POST['property_location']));

    $sql = "UPDATE Properties 
            SET Property_Name = ?, Description = ?, Monthly_Rent = ?, Address = ? 
            WHERE Property_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $title, $description, $price, $location, $property_id);

    if ($stmt->execute()) {
        echo "Property details updated successfully.";
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Code to handle image upload
        }
    } else {
        echo "Error updating property: " . $stmt->error;
    }
    $stmt->close();
    header("Location: propertyviewpage.php");
}
?>
