<?php

/*
Name: Rut Patel
Date: 21-September-2020
WEBD-3201-02
*/

$title = "Client Registration";
include "./includes/header.php";


if(empty($_SESSION['id']) || $_SESSION['id'] == ''){
    header("Location:sign-in.php");
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$email = "";
	$first = "" ;
	$last = "" ;
	$phone = "";
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$conn = db_connect();
	$email = trim($_POST['inputEmail']);
	$first = trim($_POST['inputFirst']);
	$last = trim($_POST['inputLast']);
	$phone = trim($_POST['inputPhone']);
	$filename = $_FILES["uploadfile"]["name"];
	$tmp_name = $_FILES["uploadfile"]["tmp_name"];
	$path = "file_uploaded/" .$filename ;

	$sql = "INSERT INTO clients(EmailAddress, FirstName, LastName, Phone,logo_path) VALUES('$email','$first','$last','$phone','$path')";

		
		 $message = "";

	  if ($_FILES['uploadfile']['error'] != 0) {
	    $message = "Problem uploading your file";
	  }

	  else if ($_FILES['uploadfile']['size'] > MAXIMUM_FILE_SIZE) {
	    $message = "Selected file size big it should bge less than " . MAXIMUM_FILE_SIZE_MB;
	  }
	 else if ($_FILES['uploadfile']['type'] != "image/jpeg" && $_FILES['uploadfile']['type'] != "image/pjpeg" && $_FILES['uploadfile']['type'] != "image/gif" && $_FILES['uploadfile']['type'] != "image/png") {
	    $message = "Your profile picture must be in picture format";
	  }
	 else{
	 	if(pg_query($conn,$sql))
		{
			$message = "Client has been successfully added to the system";
		}
		else
		{
			$message = "An error occured while entering your data to the system";
		}

	    move_uploaded_file($_FILES['uploadfile']['tmp_name'], "./file_uploaded/$filename");
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
				array("th" => "Phone"
				),
				array("th" => "Uploaded Logo"
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
		array( "type" => "text",
			"name" => "inputPhone",
			"value" => "",
			"label" => "Phone" 
		),
		array( "type" => "file",
			"name" => "uploadfile",
			"value" => "",
			"label" => "Upload New File" 
		),
		
);
 
?>

<h2><?php echo $message; ?></h2>
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Client Registration</h1>
    <?php display_form($arg); ?>

	<label for="inputSalesperson" class="sr-only">SalesPerson Name</label>
	<?php
	$email = $_SESSION['email_data'];
	 if(admin_authenticate($email) == true)
	{ ?>
	<select class="form-control" name="inputSalesperson" style="height: 50px">
		
		<?php

		 	$info = "";
    	$conn = db_connect();
    	$sql1 = "SELECT * from users WHERE type = 's'";
    	$result = pg_query($conn,$sql1);
			for($i=0; $i < pg_num_rows($result); $i++)
    	{
    		$ID = pg_fetch_result($result, $i ,'Id');
    		?>
    		<option value="<?php echo $ID; ?>">
    			<?php
    	$name = pg_fetch_result($result, $i ,'FirstName');
    	echo $name;
    	echo "<br>";
    	}
    	?>
		</option>
	</select>
<?php } ?>  

    <button class="btn btn-lg btn-primary btn-block" style="margin-top: 40px" type="submit">Register</button><br/><br/>

    <?php
	$stmp = "SELECT * FROM clients ";
 	 display_image($stmp, $variable); ?>
</form>
 