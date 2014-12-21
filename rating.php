<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
   include("db.php");
   $conn=connect();
   session_start();
	$hid=$_REQUEST['hid'];
	$rid=$_REQUEST['rid'];
	$rating=$_REQUEST['rating'];
	$query="UPDATE `hotel` SET `rate_total`=`rate_total`+".$rating.",`rate_user`=`rate_user`+1 WHERE `hid`=".$hid;
	mysql_query($query, $conn);
	echo("<script language='javascript' type='text/javascript'>");
	echo("window.alert('".$rating."점을 주셨습니다.');");
	echo("window.location=\"info.php?hid=".$hid."&rid=".$rid."\";");
	echo("</script>");
?>
