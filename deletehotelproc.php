<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
   include("db.php");
   $conn=connect();
   session_start();
	$hid=$_REQUEST['hid'];
	$query="delete from `hotel` where `hid`=".$hid;
	mysql_query($query, $conn);
	header("location:index.php");
?>
