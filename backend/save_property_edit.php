<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $property_id = $_POST['property_id'];
    $property_title = $conn->real_escape_string(trim($_POST['property_title']));
    $property_price = $conn->real_escape_string(trim($_POST['property_price']));
    $property_location = $conn->real_escape_string(trim($_POST['property_location']));
    $property_unitnumber = $conn->real_escape_string(trim($_POST['property_unitnumber']));
    $property_area = $conn->real_escape_string(trim($_POST['property_area']));
    $property_type = $conn->real_escape_string(trim($_POST['property_type']));

    // Update property in the database
    $sql = "UPDATE Properties SET Property_Name = ?, Monthly_Rent = ?,Property_Type = ?, Area = ?, Unit_Number= ?, Address = ? WHERE Property_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisiisi", $property_title, $property_price,$property_type,$property_area,$property_unitnumber, $property_location, $property_id);

    if ($stmt->execute()) {
        // Redirect back to the profile page after successful update
        header("Location: http://localhost/Reserve/profilepage.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
