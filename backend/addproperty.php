<?php

include 'db_connect.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize input data
    $Property_Name = $conn->real_escape_string(trim($_POST['Property_Name']));
    $Address = $conn->real_escape_string(trim($_POST['Address']));
    $Unit_Number = $conn->real_escape_string(trim($_POST['Unit_Number']));
    $Area = intval(trim($_POST['Area']));
    $Property_Type = $conn->real_escape_string(trim($_POST['Property_Type']));
    $Number_of_Bedroom = intval(trim($_POST['Number_of_Bedroom']));
    $Number_of_Bathroom = intval(trim($_POST['Number_of_Bathroom']));
    $Monthly_Rent = intval(trim($_POST['Monthly_Rent']));
    $Status = $conn->real_escape_string(trim($_POST['Status']));
    $userid = $_SESSION['userid'];

    // Insert data into the database
    $sql = "INSERT INTO Properties (User_ID, Property_Name, Address, Unit_Number, Area, Property_Type, Number_of_Bedroom, Number_of_Bathrooms, Monthly_Rent, Status)
            VALUES ('$userid', '$Property_Name', '$Address', '$Unit_Number', '$Area', '$Property_Type', '$Number_of_Bedroom', '$Number_of_Bathroom', '$Monthly_Rent', '$Status')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully". "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $property_id = $conn->insert_id;

    // Loop through each file
    foreach ($_FILES['images']['name'] as $index => $imageName) {
        // Check if there's an error with this file
        if ($_FILES['images']['error'][$index] == 0) {
            $fileType = $_FILES['images']['type'][$index];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            
            if (in_array($fileType, $allowedTypes)) {
                // Get the image data
                $imageData = file_get_contents($_FILES['images']['tmp_name'][$index]);

                // Prepare SQL statement to insert image into database
                $stmt = $conn->prepare("INSERT INTO Property_Image (Property_id, Image_name, Image_data)
                                        VALUES ('$property_id', ?,?)");                   
                $stmt->bind_param("sb", $imageName, $null);
                // Send image data as blob
                $stmt->send_long_data(1, $imageData);
                $stmt->execute();
                
                if ($stmt->affected_rows > 0) {
                    echo "Uploaded image: " . htmlspecialchars($imageName) . "<br>";
                } else {
                    echo "Error: Could not save image " . htmlspecialchars($imageName) . "<br>";
                }
                
                $stmt->close();
            } else {
                echo "Error: Invalid file type for " . htmlspecialchars($imageName) . "<br>";
            }
        } else {
            echo "Error: Could not upload file " . htmlspecialchars($imageName) . "<br>";
        }
    }
}

$conn->close();

header("Location: http://localhost/Reserve/mainpage.php");
?>