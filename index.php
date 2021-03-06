<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
?>
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

	if($type == "user"){
	   header("location:user.php");
	}
	if($type == "owner"){
	   header("location:owner.php");
	}

	include("db.php");
	include("option.php");
	$conn = connect();
?>

	<div class="page-header">
	<center><h1>PosHotel</h1></center>
	</div>
	<center>
<div class="panel panel-default">
<div class="panel-body">
<table class="table">
	<tr>
		<td width="33%">
			<form action="login.php" method="post">
		<div class="panel panel-info">
			<div class="panel-heading">Login</div>
			<div class="panel-body">
				<div class="input-group" style="width:100%">
				  <span class="input-group-addon" style="width:25%">ID</span>
				  <input type="text" name="user_id" class="form-control"/>
				</div>
				<div class="input-group" style="width:100%">
				  <span class="input-group-addon" style="width:25%">PW</span>
				  <input type="password" name="user_pw" class="form-control"/>
				</div>
			<div class="panel-footer">
				<table style="width:100%">
				<tr><td align="left"><input type="checkbox" name="isowner"> Hotel Owner</td>
				<td align="right"><input type="submit" class="btn btn-default" value="로그인"></td></tr>
				</table>
			</div>
			</div>
		</div>
			</form>
		</td>
		<td width="33%">
		<div class="panel panel-info">
			<div class="panel-heading">Join</div>
			<div class="panel-body">
<?php
    $query = "SELECT COUNT(*) FROM `user`";
	$row = mysql_query($query,$conn);
	$rst = mysql_fetch_array($row);
		echo("현재 ".$rst[0]." 명이 서비스를 이용하고 있습니다.");
?>
				<br>지금 가입해서 호텔을 간편하게 예약하세요.
			<div class="panel-footer" align="right">
				<div class="btn-group">
				<button type="button" class="btn btn-default" onclick="window.location='userjoin.php'">유저 가입하기</button>
				<button type="button" class="btn btn-default" onclick="window.location='ownerjoin.php'">오너 가입하기</button>
				</div>
			</div>
			</div>
		</div>
		</td>
		<td width="33%">
		   <form action="search.php" method="post">
		   <div class="panel panel-primary">
			<div class="panel-heading">Search for Hotels</div>
			<div class="panel-body">
				<table style="width:100%">
				<tr><td style="width:95%">
				<div class="input-group" style="width:100%">
				  <span class="input-group-addon" style="width:30%">Location</span>
				  <select id="" name="location">
<?php
    $query = "SELECT `lid`, `name` FROM `location`";
	$row = mysql_query($query,$conn);
	while($rst = mysql_fetch_array($row)){
		echo("<option value=".$rst[0]);
		echo(">".$rst[1]."</option>");
	}
?>
        	</select>
				</div>
				</td>
				<td style="width:5%" rowspan="3"/>
				<td rowspan="3"><input type="submit" class="btn btn-default" value="검색"></td>
				</tr><tr><td>
				<div class="input-group" style="width:100%">
				  <span class="input-group-addon" style="width:30%">Price</span>
				  <select id="" name='price'>
					<option value=0 selected="selected">10,000~49,000</option>
					<option value=1>50,000~99,000</option>
					<option value=2>100,000~199,000</option>
					<option value=3>200,000~</option>
			  	  </select>
				</div>
				</td>
				</tr><tr><td>
						<div class="input-group" style="width:100%">
						  <span class="input-group-addon" style="width:30%">Breakfast</span>
						  <input type="checkbox" name="breakfast">
						</div>
					</td>
					</tr>
					</table>
			</div>
		</div>
			</form>
		 </td>
	</tr>

	<tr><td>
	<div class="panel panel-success">
    <div class="panel-heading">Recommanded Hotel based on Rating</div>
	<table class="table">
	<?php
	   $query = "SELECT `name`, IFNULL(`rate_total`/`rate_user`,0) AS `rating` FROM `hotel` ORDER BY `rating` DESC LIMIT 10";
	   $row = mysql_query($query,$conn);
	   echo("<tr><th>Hotel name</th><th>Ratings</th></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			echo("<td>".$rst[0]."</td>");
			echo("<td>".sprintf("%1.1f",$rst[1])."</td>");
		  echo("</tr>");
	}
	?>
	</table></div></td><td>
	<div class="panel panel-success">
    <div class="panel-heading">Recommanded Hotel based on Price</div>
	<table class="table">
	<?php
	   $query = "SELECT H.`name` , R.`num` , R.`price` FROM  `hotel` H, `room` R WHERE H.`hid` = R.`hid` ORDER BY  `price` LIMIT 10";
	   $row = mysql_query($query,$conn);
	   echo("<tr><th>Hotel name</th><th>Room number</th><th>Room Price</th></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".$rst[1]."</td>");
			 echo("<td>".$rst[2]."</td>");
		  echo("</tr>");
	}
	?>
	</table></div></td><td>
	<div class="panel panel-success">
    <div class="panel-heading">Recommanded Hotel based on Options</div>
	<table class="table">
	<?php
	   $query = "SELECT H.`name` , R.`num` , R.`option` FROM  `hotel` H, `room` R WHERE H.`hid` = R.`hid` ORDER BY  R.`option` DESC LIMIT 10";
	   $row = mysql_query($query,$conn);
	   echo("<tr><th>Hotel name</th><th>Room number</th><th>Room Option</th></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".$rst[1]."</td>");
			 echo("<td>".option_str($rst[2])."</td>");
		  echo("</tr>");
	}
	echo("</table></td></tr>");
	?>
	</table></div></td>
	</tr>

</table>
</div></div>

</center>
</body>
</html>
