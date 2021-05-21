<?php

include "includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$isactive = "";
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$isactive = trim($_POST['isactive']);	
	$conn = db_connect();
	$sql1 = "SELECT * FROM users";
	$rec1 = pg_query($conn, $sql1);
	$sql2 = "SELECT * FROM users WHERE Type='s'";
	$rec2 = pg_query($conn, $sql2);

	$get_rec = pg_fetch_result($rec2, 'EmailAddress');

	$sql3 = "UPDATE users SET Enable='$isactive' WHERE (EmailAddress='$get_rec' AND Type='s')";
	$rec3 = pg_query($conn, $sql3);

	if ($rec3) {
		$msg = "You have successfully active or deactive the salesperson.";
	}
	else{
		$msg = "Try agian";
	}

}

echo $msg;
?>
<br/>
<?php
echo $get_rec;
?>
