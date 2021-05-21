<?php


/*
Name: Rut Patel
Date: 21-September-2020
WEBD-3201-02
*/
$title = "Salesperson Registration";
include "./includes/header.php";

if(empty($_SESSION['id']) || $_SESSION['id'] == ''){
    header("Location:sign-in.php");
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$email = "";
	$pass = "" ;
	$confrimpass = "";
	$first = "" ;
	$last = "" ;
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$conn = db_connect();
	$email = trim($_POST['inputEmail']);
	$pass = trim($_POST['inputPassword']);
	$confrimpass = trim($_POST['inputConfirm']);
	$first = trim($_POST['inputFirst']);
	$last = trim($_POST['inputLast']);

	$sql = "INSERT INTO users(EmailAddress, Password, FirstName, LastName, LastAccess, EnrolDate, Enable, Type) VALUES('$email',crypt('$pass', gen_salt('bf')),'$first','$last','2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 's')";

	if($pass == $confrimpass)
	{
		
		if(pg_query($conn,$sql))
		{
		$message = "Salesperson has been successfully added to the system";
		}
		else
		{
			$message = "An error occured while entering your data to the system";
		}
	}
	else
	{
		 $message = "Please verify you passwords fields & Try Again";
	}

}
$variable = array(
				array("th" => "ID"
				),
				array("th" => "Email ID"
				),
				array("th" => "First Name"
				),
				array("th" => "Last Name"
				),
				array("th" => "Last Access"
				),
				array("th" => "Type"
				),
				array("th" => "IsActive?"
				),
);

$arg = array (
	array( "type" => "email",
			"name" => "inputEmail",
			"value" => "",
			"label" => "Email Address" 
		),
		array( "type" => "text",
			"name" => "inputFirst",
			"value" => "",
			"label" => "First Name" 
		),
		array( "type" => "text",
			"name" => "inputLast",
			"value" => "",
			"label" => "Last Name" 
		),
		array( "type" => "password",
			"name" => "inputPassword",
			"value" => "",
			"label" => "Password" 
		),
		array( "type" => "password",
			"name" => "inputConfirm",
			"value" => "",
			"label" => "Confirm Password" 
		),
);
?>
<table style="margin-left: 250px;">
	<tr><td>
<h2><?php echo $message; ?></h2>
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Salesperson Registration</h1>
    <?php display_form($arg); ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button><br/><br/>
</form>
</td></tr><tr><td>
    <?php
	$stmp = "SELECT Id, EmailAddress, FirstName, LastName, LastAccess, Type FROM users WHERE type='s'";
?>

<?php 	FNIsActive($stmp, $variable); ?>
</td></tr></table>
<?php 
include "./includes/footer.php";
?>