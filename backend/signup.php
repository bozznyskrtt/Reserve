<?php
if (isset($_POST['submit'])) {
    setcookie("f_name", $_POST['f_name'], time() + 3600, "/");
    setcookie("l_name", $_POST['l_name'], time() + 3600, "/");
    setcookie("tel", $_POST['tel'], time() + 3600, "/");
    setcookie("email", $_POST['email'], time() + 3600, "/");
    setcookie("dob", $_POST['dob'], time() + 3600, "/");
    setcookie("emc", $_POST['emc'], time() + 3600, "/");
    header("Location: " . $_SERVER['PHP_SELF'] . "?reload=true");
    exit();
}
if(isset($_COOKIE["f_name"])) {
    echo "Welcome back, " . $_COOKIE["f_name"];
    header("Location: http://localhost/Reserve/passwordpage.html");
    exit;
} 
else {
    echo "Cookie not set";
}
?>