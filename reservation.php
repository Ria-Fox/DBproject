<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
  
   session_start();
   include("db.php");
   $conn=connect();

	  $uid = $_SESSION["id"];
	  $hid = $_REQUEST["hid"];
	  $rid = $_REQUEST["rid"];
	  $date = $_REQUEST['date'];
	  $cancel = $_REQUEST['cancel'];

	$query="SELECT 1 FROM `reservation` WHERE `rid`='".$rid."' AND `time`='".$date."'";
	$row = mysql_query($query,$conn);
	$count=mysql_num_rows($row);

	$query="SELECT 1 FROM `reservation` WHERE `uid`='".$uid."' AND `rid`='".$rid."' AND `time`='".$date."'";
	$row = mysql_query($query,$conn);
	$mycount=mysql_num_rows($row);

	echo("<script language='javascript' type='text/javascript'>");
	if( !$cancel ){
		if( $mycount ){
			echo("window.alert('이미 해당 날짜에 예약하신 상태입니다.');");
		}else if( $count ){
			echo("window.alert('해당 날짜는 이미 다른 유저에 의해 예약된 상태입니다.');");
		}else{
			$query="INSERT INTO `reservation` (`uid`,`hid`,`rid`,`time`) VALUES ('".$uid."', '".$hid."', '".$rid."', '".$date."')";
	    	mysql_query($query, $conn);
			echo("window.alert('예약되었습니다.');");
	    }
	}else{
		if( $mycount ){
			$query="DELETE FROM `reservation` WHERE `uid`='".$uid."' AND `rid`='".$rid."' AND `time`='".$date."'";
	    	mysql_query($query, $conn);
			echo("window.alert('예약을 취소하셨습니다.');");
		}else{
			echo("window.alert('해당 날짜에 예약한 내역이 없습니다');");
		}
	}
	echo("window.location=\"info.php?hid=".$hid."&rid=".$rid."\";");
	echo("</script>");
 ?>
