<?php
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/Reserve/loginpage.html"); // Redirect to login page
exit();
?>