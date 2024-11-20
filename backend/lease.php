<?php
include 'db_connect.php';
session_start();
$userid = $_SESSION['userid'];
$property_id = isset($_GET['property_id']) ? (int)$_GET['property_id'] : 0;

$sql = "SELECT User_ID, Monthly_Rent FROM Properties WHERE Property_ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$property_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $owner_id = $row['User_ID'];
    $monthly = $row['Monthly_Rent'];
    $deposit = $monthly*3;
    echo "User ID: " . $owner_id ."&nbsp;". "Monthly: ". $monthly ."&nbsp;". "Deposit: ". $deposit ."<br>";
} else {
    echo "No user found for the given Property ID.";
}

echo date("Y-m-d H:i:s") . "<br>";
$time = new DateTime();
$today = $time->format('Y-m-d');
$time->modify('+1 year');
$todaynextyear = $time->format('Y-m-d');
echo $today . "&nbsp;&nbsp;" . $todaynextyear . "<br>";
$status = "On going";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "INSERT INTO Leases (Owner_ID, Renter_ID, Property_ID, Start_Date, End_Date, Monthly_Rent, Deposit_Amount, Status)
            VALUE ('$owner_id', '$userid', '$property_id', '$today', '$todaynextyear', '$monthly', '$deposit', '$status')";
    $pdo = $conn->prepare($sql);
    $pdo->execute();

    $conn->close();
    header("Location: http://localhost/Reserve/roompage.html"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>