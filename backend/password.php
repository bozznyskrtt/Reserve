<?php
include 'db_connect.php';

if (isset($_POST['submit'])) {
    // Sanitize input data
    $f_name = $conn->real_escape_string(trim($_COOKIE['f_name']));
    $l_name = $conn->real_escape_string(trim($_COOKIE['l_name']));
    $tel = $conn->real_escape_string(trim($_COOKIE['tel']));
    $email = $conn->real_escape_string(trim($_COOKIE['email']));
    $dob = $conn->real_escape_string(trim($_COOKIE['dob']));
    $emc = $conn->real_escape_string(trim($_COOKIE['emc']));
    $password = $conn->real_escape_string(trim($_POST['Password']));
    $repassword = $conn->real_escape_string(trim($_POST['RePassword']));
    // Insert data into the database
    $sql = "INSERT INTO Users (First_Name, Last_Name, Phone_Number, Email, Date_of_Birth, Emergency_Contact, Passwords)
            VALUES ('$f_name', '$l_name', '$tel', '$email', '$dob', '$emc', '$password')";

    if ($password === $repassword){
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else {
        echo "Please try again";
    }
}

$sql ="SELECT User_ID, First_Name FROM Users WHERE Email LIKE '$email';";

if($result = $conn->query($sql)){
    $row = $result->fetch_array();

    session_start();
    $_SESSION['userid'] = $row['User_ID'];
    $_SESSION['username'] = $row['First_Name'];
    $_SESSION['is_logged_in'] = TRUE;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn -> close();

header("Location: http://localhost/Reserve/mainpage.php");

?>