<?php
include 'db_connect.php';

$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : null;

// Check if files are uploaded
if (!isset($_FILES['property_images']) || !$property_id) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Missing image files or property ID']);
    exit();
}


// Process each uploaded image
$images = $_FILES['property_images'];
$fileCount = count($images['name']);

try {
    $conn->begin_transaction();
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
    for ($i = 0; $i < $fileCount; $i++) {
        $imageTmpName = $images['tmp_name'][$i];
        $imageType = $images['type'][$i];
        $imageSize = $images['size'][$i];

        // Check file type and size
        if (!in_array($imageType, $allowedTypes)) {
            throw new Exception("Invalid file type for file $i. Only JPEG, PNG, and GIF are allowed.");
        }

        if ($imageSize > 5 * 1024 * 1024) { // 5MB limit
            throw new Exception("File size for file $i exceeds 5MB limit.");
        }

        // Read the image file as binary data
        $imageData = file_get_contents($imageTmpName);

        // Insert the image into the database
        $query = "INSERT INTO Property_Image (Property_ID, Image_name, Image_data) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isb", $property_id, $imageTmpName, $imageData);
        $stmt->send_long_data(2, $imageData);
        $stmt->execute();
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Images uploaded successfully.']);
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $stmt->close();
    $conn->close();
}

?>