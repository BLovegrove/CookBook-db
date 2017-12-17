<?php
session_start();

// If the admin session variable has been set, use it for '$is_admin', else use default (false).
if (isset($_SESSION['admin'])) {
	$is_admin = $_SESSION['admin'];
} else {
	$is_admin = 0;
}
// If a page is requested, set '$page' as the page request variable,
// If request variable is 'admin', and the user is an admin, proceed (set '$is_secure' to true),
// If request variable is not 'admin', proceed.
if (isset($_GET['page'])) {
	$page = (string)$_GET['page'];

	if ($is_admin == 1) {
		$is_secure = true;
	} else {
		if ($page == 'admin') {
			$is_secure = false;
		} else {
			$is_secure = true;
		}
	}
}
// If no page is requested, and the user is an admin, go to the admin welcome page,
// Otherwise, go to the guest one.
else {

	if ($is_admin == 1) {
		header('location: index.php?page=admin&admin=welcome');
		exit;
	} else {
		header('location: index.php?page=welcome');
		exit;
	}
}

// If the request and session values are up to scratch, load in the site structure.
if ($is_secure == true) {
	include('./scripts/config.php');
	include('./skeleton/top.php');

	// If the user is and admin;
	// Load the admin navigation bar, otherwise load the guest one.
	if ($is_admin == 1) {
		include('./skeleton/navigation-admin.php');
	} else {
		include('./skeleton/navigation.php');
	}
	?><div id="page-content"><?php
	if ($page != 'admin') {
		include("./pages/$page.php");
	} else {
		$page_admin = preg_replace('/[0-9a-zA-Z]-/','',$_GET['admin']);
		include("./admin/$page_admin.php");
	}
	?></div><?php

	include('./skeleton/bottom.php');
} else {
	header('location: index.php');
	exit;
}
// Otherwise redirect with 'safe' parameters.
?>
