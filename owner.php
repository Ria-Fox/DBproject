<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" http-equiv="ContentType" content="text/html;charset=UTF-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"/>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
</head>
<body style="padding:5px">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/respond.js"></script>

<?php
	session_start();
	$_SESSION["type"] = "owner";
	$_SESSION["id"] = "주인";
	$type = $_SESSION["type"];
	$id = $_SESSION["id"];
	$hid = $_POST["hid"];
	include("db.php");
	$conn = connect();
?>

	<div class="page-header">
	<center><h1>PosHotel <small>owner page</small></h1></center>
	</div>
	<center>
<div class="panel panel-default">
<div class="panel-body">
<table class="table">
	<tr>
		<td width="50%">
			<div class="panel panel-info">
			<div class="panel-heading">Hotel owner</div>
			<div class="panel-body">
				환영합니다, <?=$id?> 님.
			</div></div>
		</td>
		<td width="50%">
		   <form method="post">
		   	<div class="panel panel-primary">
		   	<div class="panel-heading">Search for my hotel</div>
			<div class="panel-body">
      		<select id="" name="hid" style="width:100%">
      		<option value=0
      		<?php if($hid==0) echo(" selected='selected' "); ?>
      			>내 호텔 검색</option>
<?php
    $query = "SELECT `hid`, `name` FROM `hotel` WHERE `oid`='".$id."'";
	$row = mysql_query($query,$conn);
	while($rst = mysql_fetch_array($row)){
		echo("<option value=".$rst[0]);
		if($hid==$rst[0]) echo(" selected='selected' ");
		echo(">".$rst[1]."</option>");
	}
?>
        	</select>
      		<br/><p align="right"><input type="submit" class="btn btn-default"/></p>
      		</div></div>
			</form>
		 </td>
	</tr>

	<tr><td>
	<div class="panel panel-success">
    <div class="panel-heading">My Hotel List</div>
	<table class="table">
	<?php
	   $query = "SELECT `name`, IFNULL(`rate_total`/`rate_user`,0) AS `rating` FROM `hotel` WHERE `oid`='".$id."'";
	   $row = mysql_query($query,$conn);
	   echo("<tr><th>Hotel name</th><th>Ratings</th><th>Details</th></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			echo("<td>".$rst[0]."</td>");
			echo("<td>".sprintf("%1.1f",$rst[1])."</td>");
			echo("<td style='width:1%'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-info-sign'/></button></td>");
		  echo("</tr>");
		}
	?>
	</table></div></td><td>
	<div class="panel panel-success">
    <div class="panel-heading">My Rooms in Hotels</div>
	<table class="table">
	<?php
	   $query = "SELECT H.`name` , R.`num` , R.`price` FROM  `hotel` H,  `room` R WHERE H.`hid` = R.`hid` AND ( ".($hid==0?1:0)." OR R.`hid`='".($hid)."' ) AND `oid`='".$id."' ORDER BY H.`hid`, R.`num`";
	   $row = mysql_query($query,$conn);
	   echo("<tr><th>Hotel name</th><th>Room number</th><th>Room Price</th><th>Details</th></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".$rst[1]."</td>");
			 echo("<td>".$rst[2]."</td>");
			 echo("<td style='width:1%'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-info-sign'/></button></td>");
		  echo("</tr>");
	}
	?>
	</table></div></td></tr>
	
</table>
</div></div>

</center>
</body>
</html>
