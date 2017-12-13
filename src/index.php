<?php
if (!$_SESSION['is-admin'] && $_REQUEST['page'] == 'admin') {
	header('location: index.php?page=welcome');
} else {
	session_start();
	include('./scripts/config.php');
	include('./skeleton/top.php');
	include('./skeleton/navigation.php');
	include('./skeleton/bottom.php');
}
?>
