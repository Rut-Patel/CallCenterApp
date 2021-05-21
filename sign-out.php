<?php
session_start();

/*
Name: Rut Patel
Date: 17-September-2020
WEBD-3201-02
*/

require("./includes/functions.php");

session_start();
session_destroy();
header("location:sign-in.php");
setMessage("You are successfully signed out.");

$log_data = " out success ";
logdata($log_data);


?>
