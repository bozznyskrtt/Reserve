<?php 

include 'db_connect.php';
session_start();
$userid = $_SESSION['userid'];

$sql = "SELECT Image_data FROM User_Image WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$userid);
$stmt->execute();
$stmt->bind_result($image_data);

if($stmt->fetch()){
    header("Content-Type: Image/jpeg");
    echo $image_data;
} else {
    // Handle case where image data isn't found, e.g., output a placeholder image
    header("Content-Type: image/jpg");
    readfile('FLA_9580.jpg'); // Path to a placeholder image
}

$stmt->close();
$conn->close();
?>