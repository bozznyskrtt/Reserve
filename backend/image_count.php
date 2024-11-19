<?php 
include 'db_connect.php';

// Retrieve the property_id and current index from the query parameters
$property_id = isset($_GET['property_id']) ? (int)$_GET['property_id'] : null;
$index = isset($_GET['index']) ? (int)$_GET['index'] : null;
$images = [];

// Fetch all images for this property
if ($property_id !== null) {
    $sql = "SELECT Image_ID FROM Property_Image WHERE Property_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all image IDs into an array
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['Image_ID']; // Store each image ID in the array
    }

    // // Count the total number of images
    $image_count = count($images);

    // echo "Image IDs: ";
    // print_r($images);  // Display the array of image IDs
    // echo "<br>Image Count: $image_count";  // Display the number of images

} else {
    // Handle the case where property_id is not provided or invalid
    $image_count = 0;
    echo "Property ID is invalid or missing.";
}
?>