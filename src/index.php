<?php
session_start();
// If the user /could/ be an admin, and there is a page requested;
// If the user /is not/ and admin, and the page requested is the admin page;
// Return to guest welcome.
$is_admin = false;
if (isset($_SESSION['admin'])) {
	$is_admin = $_SESSION['admin'];
}
if (isset($_REQUEST['page'])) {
	$page = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['page']);
	$is_secure = false;
	if ($is_admin == true && $page == 'admin') {
		$is_secure = true;
	} else if ($page != 'admin') {
		$is_secure = true;
	}
} else {
	if ($is_admin == true) {
		header('location: index.php?page=admin?admin=welcome');
	} else {
		header('location: index.php?page=welcome');
	}
}

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
} else {
	header('location: index.php?page=welcome');
}

?>
