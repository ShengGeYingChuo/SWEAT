<?php
	$user = $_POST["username"];
	$pw = $_POST["password"];
	$host = 'localhost';
	
	try{
		$conn = mysqli_connect($host,$user,$pw);
	}catch(Exception $e){
		echo "alert('wrong password or username')";
		exit();
	}
	header("Location:http://localhost/test/read.html");

?>