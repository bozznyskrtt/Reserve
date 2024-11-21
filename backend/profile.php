<?php
include 'db_connect.php';
session_start();

$userid = $_SESSION['userid'];

$sql = "SELECT * FROM Users WHERE User_ID = '$userid';";

if($result = $conn->query($sql)){
    $user = $result->fetch_assoc();
} else {
    echo "Error" . $sql . "<br>" > $conn->error;
}

$sql = "SELECT * FROM Properties WHERE User_ID = '$userid';";

$propresult = $conn->query($sql);
$conn->close();
?>