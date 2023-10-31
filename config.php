<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$db_name = 'phonebook_db';

	$conn = mysqli_connect($hostname, $username, $password, $db_name);

	if(!$conn){
		echo 'Database not connected!';
	}else{
		#echo 'Connected successfully!';
	}

?>