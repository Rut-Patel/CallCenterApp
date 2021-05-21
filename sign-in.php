<?php

/*
Name: Rut Patel
Date: 17-September-2020
WEBD-3201-02
*/

$title = "WEBD3201 Login Page";
include "./includes/header.php";

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$email = "";
	$pass = "" ;

}
else if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email = trim($_POST['inputEmail']);
	$pass = trim($_POST['inputPassword']);

	$_SESSION['email'] = $email;

	if(user_authenticate($email,$pass) != false ){
		if (salesperson_isactive($email)) {
	
			
		
	{
		$_SESSION['id'] = true;
		


		if(admin_authenticate($email) == true)
		{
			$_SESSION['id'] = "id";

		}
		$_SESSION['email_data'] = $email;
		// LOG Data
		$log_data = " in success ";
		logdata($log_data);
		header("location:dashboard.php");
	}

}
}
}
	else {
	session_start();
	session_unset();
	session_destroy();
	session_start();
	setMessage("Invalid data. Please Try Again.");
	header("location:sign-in.php");

	// LOG DATA
	$_SESSION['email_data'] = $email;
	$log_data = " in failed ";
	logdata($log_data);
}


?>   
<h2><?php echo $message; ?></h2>
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="inputEmail" class="form-control" value=""  placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

<?php
include "./includes/footer.php";
?>
