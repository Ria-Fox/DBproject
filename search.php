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
	//if(!$id){
	//   header("location:index.php");
	//}

	$location=$_POST["location"];
	$value=$_POST["price"];
	$breakfast=$_POST["breakfast"];

	include("db.php");
	$conn = connect();
	$query="select `location` from `user` where `uid`=`".$id."`";
	$row=mysql_query($query,$conn);
	$rst=mysql_fetch_array($row);
	/*$add=$rst[0];*/
?>

	<div class="page-header">
	   <center><h1>PosHotel <small>search page</small></h1></center>
	</div>
	<center>
<div class="panel panel-default">
<div class="panel-body">
<table class="table">
	<tr>
		<td width="33%">
			<div class="panel panel-info">
			<div class="panel-heading">Search Result</div>
			<div class="panel-body">
			   검색 결과는 아래와 같습니다.
			   <p align="right"><button type="button" class="btn btn-default" onclick="window.location='index.php'">메인 페이지로 돌아가기</button></p>
			</div>
			</div>
		</div>
			</form>
		</td>
		<td width="33%">
		<div class="panel panel-info">
			<div class="panel-heading">Notice</div>
			<div class="panel-body">
<?php
    $query = "SELECT COUNT(*) FROM `hotel`";
	$row = mysql_query($query,$conn);
	$rst = mysql_fetch_array($row);
		echo("현재 ".$rst[0]."곳의 호텔, ");
	$query = "SELECT COUNT(*) FROM `room`";
	$row = mysql_query($query,$conn);
	$rst = mysql_fetch_array($row);
		echo($rst[0]."개의 방이 기다리고 있습니다.");
?>
				<br>호텔을 간편하게 예약하세요.
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
		if( $location==$rst[0] )echo(" selected='selected' ");
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
					<option value=0
					<?php if( $value==0 )echo(" selected='selected' ");?>
					>10,000~49,000</option>
					<option value=1
					<?php if( $value==1 )echo(" selected='selected' ");?>
					>50,000~99,000</option>
					<option value=2
					<?php if( $value==2 )echo(" selected='selected' ");?>
					>100,000~199,000</option>
					<option value=3
					<?php if( $value==3 )echo(" selected='selected' ");?>
					>200,000~</option>
			  	  </select>
				</div>
				</td>
				</tr><tr><td>
						<div class="input-group" style="width:100%">
						  <span class="input-group-addon" style="width:30%">Breakfast</span>
						  <input type="checkbox" name="breakfast"
<?php if( $breakfast ) echo(" checked ");?>
						  >
						</div>
					</td>
					</tr>
					</table>
			</div>
		</div>
			</form>
		 </td>
	  </tr>
</table>
</div></div>

	<tr><td>
	<div class="panel panel-success">
	   <div class="panel-heading">Search result</div>
	<table class="table">
	<?php
	   //$location=1;
	   //$value=1;
	   $lower_price=10000;
	   $upper_price=49000;
	   if($value==0)
	   {
		  $lower_price=10000;
		  $upper_price=49000;
	   }else if($value==1)
	   {
		  $lower_price=50000;
	      $upper_price=99000;
	   }
	   else if($value==2)
	   {
		  $lower_price=100000;
		  $upper_price=199000;
	   }else if($value==3)
       {
		  $lower_price=200000;
		  $upper_price=99999999;
	   }

	   if($breakfast==on)
	   {
		  $option=1;
	   }else
	   {
		  $option=0;
	   }
	   
	   ?>
	   <tr><th>Hotel name</th><th>Ratings</th><th>Room Number</th><th>Price</th><th width="1">Reservation</th>
	   <?php
	   $query = "SELECT h.name, IFNULL(h.rate_total/h.rate_user,0) as rating, r.num, r.price, r.rid from hotel h, room r where h.hid=r.hid and h.location=".$location." and r.price>=".$lower_price." and r.price<=".$upper_price." and r.option=".$option."";
	   $row = mysql_query($query,$conn);
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".sprintf("%1.1f",$rst[1])."</td>");
			 echo("<td>".$rst[2]."</td>");
			 echo("<td>".$rst[3]."</td>");
		  echo("</tr>");
		}
	?>
	</table></div></td><td>
	<div class="panel panel-success">

</center>
</body>
</html>
