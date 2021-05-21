<?php
/*
Name: Rut Patel
Date: 17-September-2020
WEBD-3201-02
*/

require "includes/constants.php";
require "includes/functions.php";
require "includes/db.php";





//$result = pg_execute($conn, "user_select", array("jdoe@dcmail.ca"));

$result1 = pg_execute($conn, "user_update_login_time", array("jdoe@dcmail.ca"));
$result = pg_execute($conn, "user_select_all", array());

if (pg_num_rows($result) == 1) {
		$user = pg_fetch_assoc($result, 0);
		dump($user);	

		// authenticate a user
		$is_user = password_verify("some_password", $user["password"]);

		echo "Is user authenticated: " . $is_user . "</br>";

}

?>