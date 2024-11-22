<?php
session_start();
include 'db_connect.php';

$userid = $_SESSION['userid'];

$sql = "SELECT * FROM Leases WHERE Renter_id = '$userid';";
$check = $conn->prepare($sql);
$check->execute();
$rowcheck = $check->get_result();

if($rowcheck->num_rows === 0){
    header("Location: http://localhost/Reserve/youhavenoroom.html");
    $conn->close();
} else {
    $conn->close();
    header("Location: http://localhost/Reserve/roompage.php");
}
?>