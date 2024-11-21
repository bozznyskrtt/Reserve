<?php 
include 'db_connect.php';

$sql = "SELECT * FROM Users ORDER BY User_ID ASC;";
$userresult = $conn->query($sql);

$sql = "SELECT * FROM Properties ORDER BY Property_ID ASC;";
$propertyresult = $conn->query($sql);

?>