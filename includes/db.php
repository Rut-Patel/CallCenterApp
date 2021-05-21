<?php
/*
Name: Rut Patel
Date: 22-September-2020
WEBD-3201-02
*/

function db_connect(){
	return pg_connect("host=". DB_HOST ." port=".DB_PORT ." dbname=".DATABASE." user=".DB_ADMIN." password=" .DB_PASSWORD);
}
$conn = db_connect();
$user_update_login_time_stmt = pg_prepare($conn, "user_update_login_time", "UPDATE users SET LastAccess = NOW() WHERE EmailAddress = $1");
$user_retrive_stmt = pg_prepare($conn, "user_retrive", "SELECT * from users");
$user_select_stmp = pg_prepare($conn, "user_select", "SELECT * from users WHERE EmailAddress = $1");
$user_select_all_stmp = pg_prepare($conn, "user_select_all", "SELECT * from users");
$client_select_all = pg_prepare($conn,"client_select_all", 'SELECT * from clients limit $1 offset $2');


function user_select($email)
{
	$conn = db_connect();
	$result = pg_execute($conn, "user_select", array($email));
	if (pg_num_rows($result) == 1) {
			 return pg_fetch_assoc($result, 0);
	 }

	 return false;
}

function  user_authenticate($email, $pass)
{
	$user_info = user_select($email);
	if(password_verify($pass, $user_info['password']) == 1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function admin_authenticate($email)
{
	$user_info = user_select($email);

	if($user_info['type'] == 'a')
	{
		return true;
	}
	else
	{
		return false;
	}
}

function salesperson_isactive($email){
	$user_info = user_select($email);
	if ($user_info['enable'] == 't') {
		return true;
	}
	else{
		return false;
	}
}


?>