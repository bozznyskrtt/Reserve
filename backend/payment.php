<?php 
include 'db_connect.php';
session_start();

$userid = $_SESSION['userid'];
$paymenttype = isset($_POST['selectedType']) ? htmlspecialchars($_POST['selectedType']) : "credit";

$sql = "SELECT Lease_ID,Owner_ID,Monthly_Rent FROM Leases WHERE Renter_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$userid);
$stmt->execute();
$lease = $stmt->get_result();

if($leasedata = $lease->fetch_assoc()){
    $leaseid = $leasedata['Lease_ID']; 
    $ownerid = $leasedata['Owner_ID'];
    $rent = $leasedata['Monthly_Rent'];
} else {
    echo "Lease not found.";
}

$sql = "INSERT INTO Payments( Lease_ID, Payer_ID, Reciever_ID, Payment_Datetime, Amount, Payment_Type) 
        VALUE (?,?,?,?,?,?)";

$datetime = new DateTime();
$datetime = $datetime->format('Y-m-d H:i:s');

$pdo = $conn->prepare($sql);
$pdo->bind_param("iiisis", $leaseid, $userid, $ownerid, $datetime, $rent, $paymenttype);

if($pdo->execute()){
    header("Location: http://localhost/Reserve/paymentsuccesspage.html");
} else {
    
}





?>