<?php
	session_start();
	// session_destroy(VK);
	unset($_SESSION['token']);
	unset($_SESSION['user_id']);
	unset($_SESSION['email']);
	header('location: /');
?>
    