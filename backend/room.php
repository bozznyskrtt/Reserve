<?php
include 'db_connect.php';
session_start();

$userid = $_SESSION['userid'];
$sql = "SELECT * FROM Leases WHERE Renter_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$userid);
$stmt->execute();
$result = $stmt->get_result();

if($lease = $result->fetch_assoc()){
    $start_date = new DateTime($lease['Start_Date']);
    $end_date = new DateTime($lease['End_Date']);
    $monthly = $lease['Monthly_Rent'];
    $deposit = $lease['Deposit_Amount'];
    $lease_id =  $lease['Lease_ID'];

    $today = new DateTime();
    $interval = $today->diff($start_date);
    $monthdiff = ($interval->y * 12) + $interval->m;

    $sql = "SELECT * FROM Payments WHERE Lease_ID = ?";
    $pdo = $conn->prepare($sql);
    $pdo->bind_param("i",$lease_id);
    $pdo->execute();
    $record = $pdo->get_result();

    if($record->num_rows === 0){
        $payment = $monthly+$deposit;
        // echo $payment;
    } else {
        $recordcount = $record->num_rows;
        if($monthdiff-$recordcount>0){
            $payment = $monthly;
            // echo $payment;
        } else {
            $payment = 0;
            // echo $payment;
        }
    }

} else {
    echo "Lease not found.";
}

$conn->close();
?>