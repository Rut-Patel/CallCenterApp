<?php

/* 
Name: Rut Patel
Date: 17-September-2020
WEBD-3201-02
*/

/* fumction to redirect the user */
function redirect($url){
	header("location:". $url);
	ob_flush();
}
function setMessage($msg){
	
	$_SESSION['message'] = $msg;

}
function getMessage(){
	return $_SESSION['message'];

}
function isMessage(){
	return isset($_SESSION['message'])?true:false;

}
function removeMessage(){
	unset($_SESSION['message']);
}
function flashMessage(){
	$message = "";
	if (isMessage()) {
    	$message = getMessage();
    	removeMessage();
	}
	return $message;
}
function dump($arg){
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}
function logdata($log_data){
	if (!file_exists('DATE_log.txt')) {
		file_put_contents('DATE_log.txt', '----USER LOG DATA----');
	}

	date_default_timezone_set('America/Toronto');
	$email = $_SESSION['email_data'];
	$time_stamp = date('m/d/y h:iA', time());

	$log_file_data = file_get_contents('DATE_log.txt');
	$log_file_data .= "Sign $log_data at $time_stamp $email\n";

	file_put_contents('DATE_log.txt', $log_file_data);	
}
//Display from is used to display the form.
function display_form($arg)
{
	foreach ($arg as $field) 
	{
		echo "<label for='".$field["name"]."' class='sr-only'>".$field["label"]."</label>";
		echo "<input type='".$field["type"]."' name='".$field["name"]."' value='".$field["value"]."' class='form-control' placeholder='".$field["label"]."' required autofocus><br/>";
	}
}



function display_table($stmp, $variable)
{

$con = db_connect();
$sql1 = $stmp;
  $result = pg_query($con,$sql1);

if (pg_num_rows($result)) 
{
	echo "<table style='margin-left:-150px' border='1' width='700'><tr>"; 
	foreach ($variable as $value) {
		echo "<th> ".$value["th"]." </th>";
	}
	while ($i = pg_fetch_row($result)) {
		echo "</tr><tr>";
		foreach ($i as $value) {
			echo "<td>",$value,"</td>";
		
		}
		echo "</tr>";
	}
	echo "</table><br/>";
}
}

//dsiplays the profile picture of the clients.
function display_image($stmp, $variable){
	$con = db_connect();
  	$sql1 = $stmp;
    $result = pg_query($con,$sql1);
    echo "<table style='margin-left:-150px' border='1' width='700'>";
   foreach ($variable as $value) {
		echo "<th> ".$value["th"]." </th>";
	}
      for($i = 0; $i < pg_num_rows($result); $i++){
	$id = pg_fetch_result($result, $i, 'Id');
        $email = pg_fetch_result($result, $i, 'EmailAddress');
        $firstName = pg_fetch_result($result, $i, 'FirstName');
        $LastName = pg_fetch_result($result, $i, 'LastName');
        $phone = pg_fetch_result($result, $i, 'Phone');
        $logo = pg_fetch_result($result, $i, 'logo_path');
        echo "
        		<tr>
        		<td style='padding: 10px;'>
        			". $id ."
        			</td>
        			<td style='padding: 10px;'>
        			". $email ."
        			</td>
        			<td style='padding: 10px;'>
        			". $firstName ."
        			</td>
        			<td style='padding: 10px;'>
        			". $LastName ."
        			</td>
        			<td style='padding: 10px;'>
        			". $phone ."
        			</td>
        			<td style='padding: 10px;'>
        			<img alt='Profile Picture' style='height:100px; width:100px;' src='". $logo ."' />
        			</td>
        		</tr>";
      }
      echo "</table>";
}

//Changes the status of the salsesperson.
function FNIsActive($stmp, $variable)
{

$con = db_connect();
$sql_stmp = $stmp;
$result = pg_query($con,$sql_stmp);

if (pg_num_rows($result)) 
{
	echo "<table style='margin-left:-150px' border='1' width='700'><tr>"; 
	foreach ($variable as $value) {
		echo "<th> ".$value["th"]." </th>";
	}
	while ($i = pg_fetch_row($result)) {
		echo "</tr><tr>";
		foreach ($i as $value) {
			echo "<td>",$value,"</td>";
		
		}
		echo "<td>
			  <form action='isactive.php' method='POST'>

			  	<input type='radio' name='isactive' value='t' />Active<br/>
			  	<input type='radio' name='isactive' value='f' />InActive<br/>
			  	<input type='submit' value='Update' />

			  </form>
			  </td>";
		echo "</tr>";
	}
	echo "</table><br/>";
}
}

//Generating the reset password message for the user.
function Reset_password($email){
	if (!file_exists('Reset_password.txt')) {
		file_put_contents('Reset_password.txt', '----Reset Password Link----');
	}
	
	date_default_timezone_set('America/Toronto');
	$time_stamp = date('m/d/y h:iA', time());

	$log_file_data = file_get_contents('Reset_password.txt');
	$log_file_data .= "\n\tHello $email
						A password reset request has be made on your account at $time_stamp.
						If you have made the request then please follow the following steps.
						Otherwise please ignore this e-mail.
						\n\tRegards,
						\n\tThe Company Team.";

	file_put_contents('Reset_password.txt', $log_file_data);	
}

?>