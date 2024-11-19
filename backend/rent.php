<?php
// Include the database connection
include 'db_connect.php';
include 'image_count.php';
// Get the Property_ID from the URL
$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;
echo $image_count;
$count_image = $image_count;

if ($property_id > 0) {
    // Query the database for the specific property
    $sql = "SELECT * FROM Properties WHERE Property_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $property = $result->fetch_assoc();
    } else {
        echo "Property not found.";
        exit;
    }
} else {
    echo "Invalid property ID.";
    exit;
}
?>