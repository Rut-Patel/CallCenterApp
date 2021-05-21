<?php
$title = "Password Update";
include "./includes/header.php";

if(empty($_SESSION['id']) || $_SESSION['id'] == ''){
    header("Location:sign-in.php");
}

$arg = array (
	array( "type" => "password",
			"name" => "inputPassword",
			"value" => "",
			"label" => "New Password"
		),
		array( "type" => "password",
			"name" => "inputConfirm",
			"value" => "",
			"label" => "Re-type Password"
		),		
);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $inputPassword = "";
  $inputConfirm = "";
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $inputPassword = trim($_POST['inputPassword']);
  $inputConfirm = trim($_POST['inputConfirm']);
  $userEmail = $_SESSION['email_data'];

  $con = db_connect();

  $sql = "UPDATE users SET Password=crypt('$inputPassword', gen_salt('bf')) WHERE EmailAddress='$userEmail'";

    
    if ($inputPassword != $inputConfirm) {
    	$message = "New password and re-type must be same. Please try again.";
    }
   else if (strlen($inputPassword) < PASS_LENGTH) {
     $message = "Password must be at least " . PASS_LENGTH . " characters long."; 
    }
    else if(pg_query($con,$sql)){
      $message = "Password changed successfully";
      header("location:sign-in.php");
    }
    else{
      $message = "Please try again <a href='change-password.php'>Retry</a>";
    }
}




?>
<h3><?php echo $message; ?></h3>
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Password update</h1>
    
    <?php  display_form($arg); ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>
</form>