<?php
include 'db.php';

$type = $_GET['type'];
$id = $_GET['id'];

if ($type === 'user') {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
} elseif ($type === 'property') {
    $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
}

if ($stmt->execute([$id])) {
    header("Location: adminpage.php");
} else {
    echo "Error deleting record.";
}
?>