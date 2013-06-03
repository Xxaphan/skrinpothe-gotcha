<?php
	$link = mysql_connect('localhost','U_10003225','Zxksupje3htsEAZM'); 
	if (!$link) { 
		die('Could not connect to MySQL: ' . mysql_error()); 
	} 



	$name = $_POST['username'];
	$pass = $_POST['password'];

	//$name = "skrin";
	//$pass = "skrin";

	$return_arr = array();
	

	$fetch = mysql_query("SELECT id FROM DB_10003225.gotcha_users where username='".$name."' and password='" .$pass."'"); 

	$res = mysql_fetch_assoc($fetch);


	if($res != null){
		echo $res["id"];
	}else{
		echo "-1";
	}


	mysql_close($link); 

	
?>