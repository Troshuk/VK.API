<?php
	require_once("config.php");
	if(empty($_GET['token'])){
		header("location: /");
	} else {
		$_SESSION['token'] = $_GET['token'];
		$_SESSION['user_id'] = $_GET['user_id'];
		$_SESSION['email'] = $_GET['email'];
		header('location: /');
	}
?>