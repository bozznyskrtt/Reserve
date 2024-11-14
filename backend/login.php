<?php
include 'db_connect.php';

$email = $conn->real_escape_string(trim($_POST['email']));

$sql = "SELECT User_ID, First_Name, Passwords FROM Users WHERE Email LIKE '$email';";

if (isset($_POST['submit'])) {

    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);

    if($result = $conn->query($sql)){

        $row = $result->fetch_array();

        if($row['Passwords'] === $password){
            echo "Password is correct";
            $passwordcorrect = true;
            session_start();
            
            $_SESSION["userid"] = $row['User_ID'];
            $_SESSION["username"] = $row['First_Name'];
            $_SESSION["is_logged_in"] = true;
            header("Location: http://localhost/Reserve/mainpage.php");
        }
        else{
            echo "Password is not correct, Please try again";
        }
    }
    else{
        echo "query failed: " .$conn->error;
    }

}
$conn -> close();
?>