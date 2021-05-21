<?php

/*
Name: Rut Patel
Date: 22-September-2020
WEBD-3201-02
*/

$title = "Calls Registration";
include "./includes/header.php";

if(empty($_SESSION['id']) || $_SESSION['id'] == ''){
    header("Location:sign-in.php");
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$name = "" ;
	$date = "";

}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$conn = db_connect();
	$name = trim($_POST['inputClient']);
	$date = trim($_POST['inputDate']);

	$sql = "INSERT INTO calls(ClientName,Reg_Date) VALUES ('$name','$date')";

		if(pg_query($conn,$sql))
		{
			$message = "Call Data successfully added to the system";
		}
		else
		{
			$message = "An error occured while entering your data to the system";
		}

}

$variable = array(
				array("th" => "ID"
				),
				array("th" => "Client Name"
				),
				array("th" => "Call Date"
				),
);

$arg = array (
	array( "type" => "Date",
			"name" => "inputDate",
			"value" => "",
			"label" => "Date" 
		),
		
		
);
?>
<h2><?php echo $message; ?></h2>
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Call Registration</h1>
   
	
	<label for="inputClient" >Client Name</label>
	<select class="form-control" name="inputClient" style="height: 50px">
		
		<?php
		 	$info = "";
    	$conn = db_connect();
    	$sql1 = "SELECT * from clients";
    	$result = pg_query($conn,$sql1);
			for($i=0; $i < pg_num_rows($result); $i++)
    	{
    		$ID = pg_fetch_result($result, $i ,'FirstName');
    		?>
    		<option value="<?php echo $ID; ?>">
    			<?php
    	$name = pg_fetch_result($result, $i ,'FirstName');
    	echo $name;
    	echo "<br>";
    	}
    	?>
		</option>
	</select><br/>
	<label for="inputDate" >Call Date</label>
  	<?php display_form($arg); ?>
    <button class="btn btn-lg btn-primary btn-block" style="margin-top: 40px" type="submit">Register</button><br/><br/>
    <?php
	$stmp = "SELECT * FROM calls";
 	display_table($stmp, $variable); ?>
</form>
<?php 
include "./includes/footer.php";
?>
