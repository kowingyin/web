<?php
	$hostname = '127.0.0.1';
	$username = 'root';
	$pwd = '';
	$db = 'fyp';

	$conn = mysqli_connect($hostname, $username, $pwd, $db)
	or die(mysqli_connect_error());
	mysqli_query($conn,'SET NAMES UTF8');//chinese
	mysqli_query($conn, 'Asia/Hong_Kong	');
?>
