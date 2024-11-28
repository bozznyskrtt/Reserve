<?php
// Include database connection
include 'db_connect.php';

// Set the response header to JSON
header('Content-Type: application/json');

// Validate the HTTP method
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Parse input parameters (assuming they are passed in the query string)
$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : null;
$index = isset($_GET['index']) ? intval($_GET['index']) : null;

// Validate inputs
if (!$property_id || $index === null) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Missing property_id or index']);
    exit();
}

try {
    // Start a transaction
    $conn->begin_transaction();

    // Fetch the image to verify it exists
    $getImageQuery = "SELECT Image_ID FROM Property_Image WHERE Property_ID = ? LIMIT 1 OFFSET ?";
    $stmt = $conn->prepare($getImageQuery);
    $stmt->bind_param("ii", $property_id, $index);
    $stmt->execute();
    $stmt->bind_result($image_id);

    if ($stmt->fetch()) {
        $stmt->close();

        // Delete the image entry from the database
        $deleteQuery = "DELETE FROM Property_Image WHERE Image_ID = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $image_id);

        if ($deleteStmt->execute()) {
            $deleteStmt->close();

            // Commit the transaction
            $conn->commit();

            // Return success response
            echo json_encode(['success' => true, 'message' => 'Image deleted successfully']);
        } else {
            throw new Exception('Failed to delete the image from the database');
        }
    } else {
        throw new Exception('Image not found');
    }
} catch (Exception $e) {
    // Rollback transaction in case of an error
    $conn->rollback();

    // Return error response
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Close database connection
$conn->close();
?>