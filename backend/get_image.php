<?php
include 'db_connect.php';

// Retrieve the property_id and current index from the query parameters
$property_id = isset($_GET['property_id']) ? (int)$_GET['property_id'] : null;
$current_index = isset($_GET['index']) ? (int)$_GET['index'] : 0;

// Fetch all images for this property
$sql = "SELECT Image_data FROM Property_Image WHERE Property_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize the images array
$images = [];
while ($row = $result->fetch_assoc()) {
    // Base64 encode the image data and add it to the images array
    $images[] = base64_encode($row['Image_data']);
}

// Count the number of images
$image_count = count($images);

// Debugging: Display the number of images
echo "Number of images: " . $image_count . "<br>";

// Get the current image index and ensure it's within bounds
$current_image = null;
if ($image_count > 0) {
    $current_index = $current_index % $image_count; // Ensure index is within bounds
    $current_image = $images[$current_index];
} else {
    echo "No images available for this property.";
}

?>