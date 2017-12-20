<?php
include('./config.php');
session_start();

$return = (object) null;
$status = '';
$data = '';

$username = $_POST['username'];
$password = $_POST['password'];

if (mysqli_fetch_array(mysqli_query($dbconnect, "SELECT count(0) FROM admins WHERE username = '$username'"))[0] == 1) {
	$user = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT * FROM admins WHERE username = '$username'"));
	$password_db = $user['password'];
	if ($password_db != null && $password_db != '') {
		if (password_verify($password, $password_db) == true) {
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['admin'] = 1;
			$status = 'success';
			$data = '';
		} else {
			$status = 'error';
			$data = "Error: Unable to sign in. Reason: Incorrect Username/Password combination.";
		}
	} else {
		$status = 'error';
		$data = "Error: Unable to sign in. Reason: Unable to confirm password.";
	}
} else {
	$status = 'error';
	$data = "Error: Unable to sign in. Reason: User does not exist.";
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>
