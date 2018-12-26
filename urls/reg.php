<?php 
	include "../includes/db.php";

	$requestBody = file_get_contents("php://input");

	$request = json_decode($requestBody, true);
	
	$name = $request["name"];
	$login = $request["login"];
	$password = $request["password"];
	$email = $request["email"];
	

	if ($stmt = mysqli_prepare($connect, "SELECT COUNT(*) FROM users WHERE login = ?")) {
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $count_login);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
	}

	if ($stmt = mysqli_prepare($connect, "SELECT COUNT(*) FROM users WHERE email = ?")) {
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $count_email);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
	}

	if($count_login == 0){
		if($count_email == 0){
			$hash_password = password_hash($password, PASSWORD_BCRYPT);
			$query = "INSERT INTO users VALUES (NULL, '$name', '$login', '$hash_password', '$email')";
			$result = mysqli_query($connect, $query);
			if ($result) {
				$status_code = "HTTP/1.0 200 OK";
				$status = [
					    "name" => $name,
					    "login" => $login,
					    "email" => $email
					];
			}
			else {
				$status_code = "HTTP/1.0 500 Internal Server Error";
				$status = [
					    "message" => "Internal Server Error"
					];
			}
			
		}
		else{
			$status_code = "HTTP/1.0 500 Internal Server Error";
			$status = [
				"message" => "A user with this email exists"
			];
		}
		
	}
	else{
		$status_code = "HTTP/1.0 500 Internal Server Error";
		$status = [
			    "message" => "Login already exists"
			];
	}
	
	
	header('Content-Type: application/json');
	header($status_code);
	mysqli_close($connect);
	$jsonResult = json_encode($status);
	echo $jsonResult;

 ?>