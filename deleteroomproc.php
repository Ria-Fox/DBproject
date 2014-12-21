<?php
   include("db.php");
   $conn=connect();
   session_start();
	$hid=$_REQUEST['hid'];
	$rid=$_REQUEST['rid'];
	$query="delete from `room` where `rid`=".$rid;
	mysql_query($query, $conn);
	header("location:info.php?hid=".$hid);
?>
