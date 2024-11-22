<?php
include 'db_connect.php';

if(isset($_POST['submit'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $sql = "SELECT AES_DECRYPT(Passwords,'Jinx') AS DecryptedPassword FROM Admin WHERE Username LIKE '$username'";
    $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){
        if($row['DecryptedPassword'] === $password){
            echo "Success";
            header("Location: http://localhost/Reserve/adminpage.php");
            session_start();
            $_SESSION['admin'] = $username;
        } else {
            echo "Password is not correct";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Post not set";
}

?>