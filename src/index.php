<?php
session_start();

$is_admin = false;
$is_secure = false;

// If the admin session variable has been set, use it for '$is_admin', else use default (false).
if (isset($_SESSION['admin'])) {
	$is_admin = $_SESSION['admin'];
}
// If a page is requested, set '$page' as the page request variable,
// If request variable is 'admin', and the user is an admin, proceed (set '$is_secure' to true),
// If request variable is not 'admin', proceed.
if (isset($_REQUEST['page'])) {
	$page = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['page']);
	if ($is_admin == true && $page == 'admin') {
		$is_secure = true;
	} else if ($page != 'admin') {
		$is_secure = true;
	}
}
// If no page is requested, and the user is an admin, do to the admin welcome page,
// Otherwise, go to the gues tone.
else {
	if ($is_admin == true) {
		header('location: index.php?page=admin?admin=welcome');
	} else {
		header('location: index.php?page=welcome');
	}
}

// If the request and session values are up to scratch, load in the site structure.
if ($is_secure == true) {
	include('./scripts/config.php');
	include('./skeleton/top.html');

	// If the user is and admin;
	// Load the admin navigation bar, otherwise load the guest one.
	if ($is_admin == true) {
		include('./skeleton/navigation-admin.php');
	} else {
		include('./skeleton/navigation.php');
	}

	if ($page != 'admin') {
		include("./pages/$page.php");
	} else {
		$page_admin = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['admin']);
		include("./admin/$page_admin.php");
	}

	include('./skeleton/bottom.html');
}
// Otherwise redirect with 'safe' parameters.
else {
	header('location: index.php?page=welcome');
}

?>
