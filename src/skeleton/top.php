<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon" />
		<title>CookBook-db</title>
		<link rel="stylesheet" href="./css/complete.css">
		<link href="https://fonts.googleapis.com/css?family=Spectral+SC:700|Open+Sans:300,400|Nunito" rel="stylesheet">
	</head>
	<body>
		<div id="page-title">
			<div class="cookbook-logo">
				<img src="./media/branding/logo.png" alt="CookBook-db website logo" />
			</div>
			<div class="title-heading">
				<h1>CookBook-db<br></h1><span>Your recipes, only a few keystrokes away.</span>
			</div>
			<div class="header-access-container">
				<?php if ($_REQUEST['page'] == 'login') {?>
				<div class="login">
					<a href="index.php"><button>Home</button></a>
				</div>
				<?php } else { ?>
				<div class="login">
					<a href="index.php?page=login"><button>Login</button></a>
				</div>
				<div class="logout">
					<button class="hidden" href="#/">Logout</button>
				</div>
				<?php } ?>
			</div>
		</div>
