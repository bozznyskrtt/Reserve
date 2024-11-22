<?php 
include 'db_connect.php';
session_start();

if (isset($_SESSION['username'])) {
    $sql = "SELECT * FROM Users ORDER BY User_ID ASC;";
    $userresult = $conn->query($sql);

    $sql = "SELECT * FROM Properties ORDER BY Property_ID ASC;";
    $propertyresult = $conn->query($sql);
} else {
    echo "Please log in";
}
?>