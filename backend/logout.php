<?php
session_start();
session_unset();
session_destroy();
header("Location: mainpage.php"); // Redirect to login page
exit();
?>