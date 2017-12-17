<?php if ($_GET['page'] == 'login' && $is_admin == 1) {header('location: index.php'); exit;} ?>

<div class="admin-access">
	<form id="login-form" class="static-form" enctype="multipart/form-data" autocomplete="false">
		<h3>Sign in</h3>
		<hr>
		<li class="form-field">
			<label for="username">User Name: </label><br>
			<input id="login-user-name" type="text" name="username" placeholder="Type your User Name here">
		</li><br>
		<li class="form-field">
			<label for="password">Password: </label><br>
			<input id="login-password" type="password" name="password" placeholder="Type your Password here">
		</li><br>
		<li class="form-button">
			<button id="login-submit" name="sign_in">SIGN IN</button>
		</li>
	</form>
</div>
