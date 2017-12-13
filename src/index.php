<?php
session_start();
// If the user /could/ be an admin, and there is a page requested;
// If the user /is not/ and admin, and the page requested is the admin page;
// Return to guest welcome.
if (isset($_SESSION['admin']) && isset($_REQUEST['page'])) {
	if ($_SESSION['admin'] == false && $_REQUEST['page'] == 'admin') {
		header('location: index.php?page=welcome');
	}
}
// If the user /can't/ be an admin, and there is a page request;
// If the page requested is the admin page;
// Return to guest welcome.
elseif (!isset($_SESSION['admin']) && isset($_REQUEST['page'])) {
	if ($_REQUEST['page'] == 'admin') {
		header('location: index.php?page=welcome');
	}
}
// If there is no page requested;
// If the user /could/ be an admin;
// If the user /is/ and admin;
// Go to admin welcome, otherwise return to guest welcome.
elseif (!isset($_REQUEST['page'])) {
	if (isset($_SESSION['admin'])) {
		if ($_SESSION['admin'] == true) {
			header('location: index.php?page=admin&admin=welcome');
		}
	} else {
		header('location: index.php?page=welcome');
	}
}
// In every other situation (I.E: Page requested that isnt the admin page);
// load all skeleton includes & grab requested page from 'pages'.
else {

	include('./scripts/config.php');
	include('./skeleton/top.html');

	// If the user /could/ be and admin;
	// If the user /is/ and admin;
	// Load the admin navigation bar, otherwise load the guest one.
	if (isset($_SESSION['admin'])) {
		if ($_SESSION['admin'] == true) {
			include('./skeleton/navigation-admin.php');
		}
	} else {
		include('./skeleton/navigation.php');
	}

	$page = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['page']);
	include('./pages/'.$page.'.php');

	include('./skeleton/bottom.html');
}
?>
