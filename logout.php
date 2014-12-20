<?php
	session_start();
	session_unset(type);
	session_unset(id);
	$_SESSION = array();
	session_destroy();
	header("Location:index.php");
?>