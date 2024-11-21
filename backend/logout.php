<?php
session_start();
session_unset();
session_destroy();
header("Location: loginpage.html"); // Redirect to login page
exit();
?>