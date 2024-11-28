<?php
include 'db_connect.php';
session_start();
$userid = $_SESSION['userid'];
$property_id = isset($_GET['property_id']) ? (int)$_GET['property_id'] : 0;

$sql = "SELECT * FROM Leases WHERE Renter_id = '$userid';";
$check = $conn->prepare($sql);
$check->execute();
$rowcheck = $check->get_result();

if($rowcheck->num_rows === 0){
    //pass
} else {
    $conn->close();
    echo "You already have room.";
    exit();
}

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

    $newstatus = "Rented";
    $sql = "UPDATE Properties SET Status = '$newstatus' WHERE Property_ID = $property_id ;";
    $new = $conn->prepare($sql);
    $new->execute();
    
    $conn->close();
    header("Location: http://localhost/Reserve/roompage.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>