<?php 
	
	$host = "localhost";
	$user = "root";
	$pw   = "";
	$db   = "d_wolf";

	$connect = mysqli_connect($host, $user, $pw, $db);
	if(mysqli_connect_errno())
        echo 'Ошибка подключения к БД: '.mysqli_connect_error();
?>