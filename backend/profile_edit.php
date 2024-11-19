<?php
session_start();
include 'db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $f_name = $conn->real_escape_string(trim($_POST['f_name']));
    $l_name = $conn->real_escape_string(trim($_POST['l_name']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $dob = $conn->real_escape_string(trim($_POST['dob']));    
    $userid = $_SESSION['userid'];

    $sql = "UPDATE Users SET First_Name = '$f_name', Last_Name = '$l_name', Email = '$email', Date_of_Birth = '$dob' 
            WHERE User_ID = '$userid';";

    if ($conn->query($sql)){
        echo "Update user information success" . "<br>";
    } else{
        echo "Error" . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT * FROM User_Image WHERE User_ID = ?;";
    $check = $conn->prepare($sql);
    $check->bind_param("i", $userid);
    $check->execute();
    $rowcheck = $check->get_result();

    if ($rowcheck->num_rows === 0) {
        // No existing record, perform INSERT
        $sql = "INSERT INTO User_Image (User_ID, Image_name, Image_data) VALUES (?, ?, ?)";
        echo "row = 0";
    } else {
        // Existing record found, perform UPDATE
        $sql = "UPDATE User_Image SET Image_name = ?, Image_data = ? WHERE User_ID = ?";
        echo "row != 0";
    }
    

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['image']['type'];
        
        if (in_array($fileType, $allowedTypes)) {
            // Get image name and data
            $imageName = $_FILES['image']['name'];
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            
            // Prepare SQL statement to insert image into database
            $stmt = $conn->prepare($sql);

            if ($rowcheck->num_rows === 0){
                $stmt->bind_param("isb", $userid, $imageName, $null);
            } else {
                $stmt->bind_param("sbi", $imageName, $null, $userid);
            }
            // Send image data as blob
            $stmt->send_long_data(1, $imageData);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Image uploaded and stored in database successfully!";
            } else {
                echo "Error: Could not save image in database.";
            }
            
            $stmt->close();
        } else {
            echo "Error: Invalid file type.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
header("Location: http://localhost/Reserve/profilepage.php");
}
?>