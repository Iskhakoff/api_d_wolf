<?php 
	include "../includes/db.php";

	$requestBody = file_get_contents("php://input");

	$request = json_decode($requestBody, true);

	$login = $request["login"];
	$password = $request["password"];

	if ($request == null || !array_key_exists("login", $request) || !array_key_exists("password", $request) || $request["login"] == null) {
		header('Content-Type: application/json');
		header("HTTP/1.0 400 Bad Request");
	    $error = [
	        "message" => "Bad Request",
	    ];
	    $jsonError = json_encode($error);
	    echo $jsonError;
	    exit();
	}

	if ($stmt = mysqli_prepare($connect, "SELECT COUNT(*) FROM users WHERE login = ? LIMIT 1")) {
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $count);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
	}

	if ($count == 0) {
		$status_code = "HTTP/1.0 404 Not found";
		$status = [
		    "message" => "Wrong username or password"
		];
	}else{
		if ($stmt = mysqli_prepare($connect, "SELECT * FROM users WHERE login = ?")) {
			mysqli_stmt_bind_param($stmt, "s", $login);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id, $name, $login_bind, $pass_bind, $email, $dictionary);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
		}
		if (password_verify($password, $pass_bind)) {
			$status_code = "HTTP/1.0 200 OK";
			$status = [
			    "id" => $id,
			    "name" => $name,
			    "login" => $login_bind,
			    "email" => $email
			];
		}
		else {
			$status_code = "HTTP/1.0 404 Not Found";
			$status = [
			    "message" => "Wrong username or password"
			];
		}
	}

	header('Content-Type: application/json');
	header($status_code);
	mysqli_close($connect);
	$jsonResult = json_encode($status);
	echo $jsonResult;
 ?>