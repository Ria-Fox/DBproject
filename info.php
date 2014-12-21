<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" http-equiv="ContentType" content="text/html;charset=UTF-8"/>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
</head>
<body style="padding:5px">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

<?php
	session_start();
	$type = $_SESSION["type"];
	$id = $_SESSION["id"];
	$hid = $_GET["hid"];
	$rid = $_GET["rid"];
	include("db.php");
	$conn = connect();

    $query = "SELECT `name`, `address`, `phone`, IFNULL(`rate_total`/`rate_user`,0), `oid` AS `rating` FROM `hotel` WHERE `hid`='".$hid."'";
	$row = mysql_query($query,$conn);
	$rst = mysql_fetch_array($row);
	$hotel_name = $rst[0];
	$hotel_addr = $rst[1];
	$hotel_phone = $rst[2];
	$hotel_rating = $rst[3];
	$hotel_oid = $rst[4];
	 $query = "SELECT `num`, `price`, `option` FROM `room` R WHERE `rid`='".$rid."'";
	$row = mysql_query($query,$conn);
	$rst = mysql_fetch_array($row);
	$room_num = $rst[0];
	$room_price = $rst[1];
	$room_option = $rst[2];
?>

	<div class="page-header">
	<center><h1>PosHotel <small>hotel info</small></h1></center>
	</div>
	<center>
<div class="panel panel-default">
<div class="panel-body">
<table class="table">
	<tr>
		<td width="50%">
			<div class="panel panel-info">
			<div class="panel-heading">Hotel information</div>
			<div class="panel-body">
				<h2><?=$hotel_name?></h2>
				</div><div class="panel-footer">
				Rating: <?=sprintf("%1.1f",$hotel_rating)?><br>
				Phone: <?=$hotel_phone?><br>
				Address: <?=$hotel_addr?>
			</div></div>
		</td>
		<td width="50%">
			<div class="panel panel-info"
<?php
	if( $rid == 0 ) echo("style='display:none'");
?>
			>
			<div class="panel-heading">Room information</div>
			<div class="panel-body">
				<h2>Room <?=$room_num?></h2>
				</div><div class="panel-footer">
				Price: <?=$room_price?><br>
				Options: <?=$room_option?>
			</div></div>
		</td>
	</tr>

	<tr><td>
	<div class="panel panel-success">
    <div class="panel-heading">Room List in this Hotel</div>
	<table class="table">
	<?php
	   $query = "SELECT H.`name` , R.`num` , R.`price`, H.`hid`, R.`rid` FROM  `hotel` H,  `room` R WHERE H.`hid` = R.`hid` AND R.`hid`='".$hid."' ORDER BY H.`hid`, R.`num`";
	   $row = mysql_query($query,$conn);
	   echo("<tr><th>Hotel name</th><th>Room number</th><th>Room Price</th><th>Details</th></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".$rst[1]."</td>");
			 echo("<td>".$rst[2]."</td>");
			 echo("<td style='width:1%'><button type='button' class='btn btn-default btn-xs'
			 	 onclick='window.location=\"info.php?hid=".$rst[3]."&rid=".$rst[4]."\";'>
			 	<span class='glyphicon glyphicon-info-sign'/></button></td>");
		  echo("</tr>");
	}
	?>
	</table></div></td><td>
	<div class="panel panel-primary">
    <div class="panel-heading">To Do</div>
    <div class="panel-body">
	<div class="btn-group">
	<?php
		if( $type == "user" ){
			echo("<button type='button' class='btn btn-default'>룸 예약</button>");
			echo("<button type='button' class='btn btn-default'>룸 예약 취소</button>");
		}
		if( $type == "owner" && $id == $hotel_oid ){
			echo("<button type='button' class='btn btn-default' 
				onclick='window.location=\"addroom.php?hname=".$hotel_name."&hid=".$hid."\";'>룸 추가</button>");
			if( $rid )
			echo("<button type='button' class='btn btn-default'
				onclick='window.location=\"deleteroomproc.php?hid=".$hid."&rid=".$rid."\";'>룸 삭제</button>");
		}
	?>
	</div>
	<?php
	if( $type != "user" && $type != "owner" ){
		echo( "로그인해주세요" );
	}?>
	<div class="btn-group">
	<button type='button' class='btn btn-default' onclick="history.go(-1)">뒤로 가기</button>
	<button type='button' class='btn btn-default' onclick="window.location='index.php'">메인페이지로</button>
	</div>
	</div></div></td></tr>
	
</table>
</div></div>

</center>
</body>
</html>
