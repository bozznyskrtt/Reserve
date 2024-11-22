<?php
include 'db_connect.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validate data
if (isset($data['editType'])){
    if ($data['editType'] === 'user') {
        $userId = $data['User_ID'];
        $firstName = $data['First_Name'];
        $lastName = $data['Last_Name'];
        $email = $data['Email'];
        $phoneNumber = $data['Phone_Number'];

        // Update query
        $stmt = $conn->prepare("UPDATE Users SET First_Name = ?, Last_Name = ?, Email = ?, Phone_Number = ? WHERE User_ID = ?");
        $stmt->bind_param('ssssi', $firstName, $lastName, $email, $phoneNumber, $userId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'type' => 'user']);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();

    } elseif($data['editType'] === 'property'){
        $propertyId = $data['Property_ID'];
        $propertyName = $data['Property_Name'];
        $address = $data['Address'];
        $unitNumber = $data['Unit_Number'];
        $area = $data['Area'];
        $propertyType = $data['Property_Type'];
        $bedrooms = $data['Number_of_Bedroom'];
        $bathrooms = $data['Number_of_Bathrooms'];
        $monthlyRent = $data['Monthly_Rent'];
        $status = $data['Status'];

        // Prepare your SQL query to update property
        $query = "UPDATE properties SET Property_Name = ?, Address = ?, Unit_Number = ?, Area = ?, Property_Type = ?, Number_of_Bedroom = ?, Number_of_Bathrooms = ?, Monthly_Rent = ?, Status = ? WHERE Property_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssisiiisi", $propertyName, $address, $unitNumber, $area, $propertyType, $bedrooms, $bathrooms, $monthlyRent, $status, $propertyId);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();

    } elseif($data['editType'] === 'delete'){
        $table = $data['Table'];
        if ($table == 'user') {
            $table = 'Users';
        } else {
            $table = "Properties";
        }
        $idtype = $data['IDType'];
        $id = $data['ID'];

        $sql = "DELETE FROM `$table` WHERE `$idtype` = ?";
        $pdo = $conn->prepare($sql);
        $pdo->bind_param("i", $id);

        if ($pdo->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $conn->close();
    }
    else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
}  else {
    echo json_encode(['success' => false, 'error' => 'No edit type specified.']);
}


?>