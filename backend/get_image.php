<?php
include 'db_connect.php';
include 'image_count.php';

$property_id = isset($_GET['property_id']) ? (int)$_GET['property_id'] : null;
$index = isset($_GET['index']) ? (int)$_GET['index'] : null;
// // Retrieve the property_id and current index from the query parameters
// $property_id = isset($_GET['property_id']) ? (int)$_GET['property_id'] : null;
// $index = isset($_GET['index']) ? (int)$_GET['index'] : null;
// $images = [];

// // Fetch all images for this property
// $sql = "SELECT Image_ID FROM Property_Image WHERE Property_ID = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $property_id);
// $stmt->execute();
// $result = $stmt->get_result();

// // Fetch all image IDs into an array
// while ($row = $result->fetch_assoc()) {
//     $images[] = $row['Image_ID']; // Store each image ID in the array
// }

// // // Count the total number of images
// $image_count = count($images);

// // Output the image IDs and image count for debugging
// echo "Image IDs: ";
// print_r($images);  // Display the array of image IDs
// echo "<br>Image Count: $image_count";  // Display the number of images

$sql = "SELECT Image_data FROM Property_Image WHERE Image_ID = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $images[$index]);
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