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
	$type = $_SESSION["type"];
	$id = $_SESSION["id"];
	echo $id;
	//if(!$id){
	//   header("location:index.php");
	//}

	include("db.php");
	$conn = connect();
	$query="select `location` from `user` where `uid`=`".$id."`";
	$row=mysql_query($query,$conn);
	$rst=mysql_fetch_array($row);
	/*$add=$rst[0];*/
?>

	<div class="page-header">
	   <center><h1>PosHotel <small>user page</small></h1></center>
	</div>
	<center>
<div class="panel panel-default">
<div class="panel-body">
<table class="table">
	<tr>
		<td width="33%">
			<div class="panel panel-info">
			<div class="panel-heading">User</div>
			<div class="panel-body">
			   환영합니다,  <?=$id?> 님.
			</div>
			</div>
		</div>
			</form>
		</td>
		<td colspan="2">
		   <form action="search.php" method="post">
		   <div class="panel panel-primary">
			<div class="panel-heading">Search for Hotels</div>
			<div class="panel-body">
				<table style="width:100%">
				<tr><td style="width:95%">
				<div class="input-group" style="width:100%">
				  <span class="input-group-addon" style="width:25%">Location</span>
				  <input type="text" name="location" class="form-control"/>
				</div>
				</td>
				<td style="width:5%" rowspan="3"/>
				<td rowspan="3"><input type="submit" class="btn btn-default"></td>
				</tr><tr><td>
				<div class="input-group" style="width:100%">
				  <span class="input-group-addon" style="width:25%">Price</span>
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
						  <span class="input-group-addon" style="width:25%">Breakfast</span>
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
</table>
</div></div>

	<tr><td>
	<div class="panel panel-success">
	   <div class="panel-heading">Search result</div>
	<table class="table">
	<?php
	   $location=$_POST["location"];
	   $value=$_POST["price"];
	   $breakfast=$_POST["breakfast"];
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
	   
	   $query = "SELECT h.name, h.rate_total/h.rate_user as rating, r.num, r.price from hotel h, room r where h.hid=r.hid and h.location=".$location." and r.price>=".$lower_price." and r.price<=".$upper_price." and r.option=".$option."";
	   $row = mysql_query($query,$conn);
	   echo("<tr><th>Hotel name</th><th>Ratings</th><th>Room Number</th><th>Price</th>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".$rst[1]."</td>");
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