<?php
$title = "Password Reset";
include "./includes/header.php";

$arg = array (
	array( "type" => "email",
			"name" => "inputEmail",
			"value" => "",
			"label" => "Email"
		)
);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $inputEmail = "";
  
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $inputEmail = $_POST['inputEmail'];

  $con = db_connect();

  $sql = "SELECT EmailAddress From users WHERE EmailAddress='$inputEmail'";

    $result = pg_query($con,$sql);
    if ($inputEmail = "") {
    	$message = "Please enter you email in the field.";

    }
    else if(!pg_num_rows($result)){
      $message = "Please Check you email for Futher Steps.";
    }
    else if(pg_num_rows($result)){
      $message = "Please Check you email for Futher Steps.";
      $inputEmail = $_POST['inputEmail'];
      Reset_password($inputEmail);
    }
    else{
      $message = "Please try again <a href='reset.php'>Retry</a>";
    }
}




?>
<h3><?php echo $message; ?></h3>
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Password Reset</h1>
    
    <?php  display_form($arg); ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Click here to Reset Password</button>
</form>
<?php 
include "./includes/footer.php";
?>
	