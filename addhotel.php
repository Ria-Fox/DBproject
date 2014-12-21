<!DOCTYPE html>
<html lang="ko">
   <head>
		<meta charset="utf-8" http-equiv="ContentType" content="text/html;charset=UTF-8"/>
				<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
	 </head>
	<body style="padding:5px">
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<form action="addhotelproc.php" method="post">
		<center><div class="panel panel-default" style="width:640px">
		<div class="panel-heading">
		<center><h1>PosHotel <small>hotel registration</small></h1></center>
		</div>
  		<div class="panel-body">
		<table class="table">
		   <tr>
			  <td align="right">Name : </td>
			  <td><input type="text" name="name"></td>
		   </tr>
		   <tr>
			  <td align="right">Phone : </td>
			  <td><input type="text" name="phone"></td>
		   </tr>
		   <tr>
			  <td align="right">Location : </td>
			  <td>
			  	<select id="" name="location">
<?php
	include("db.php");
	$conn = connect();
    $query = "SELECT `lid`, `name` FROM `location`";
	$row = mysql_query($query,$conn);
	while($rst = mysql_fetch_array($row)){
		echo("<option value=".$rst[0]);
		echo(">".$rst[1]."</option>");
	}
?>
        	</select>
			  </td>
		   </tr>
		   <tr>
			  <td align="right">Address : </td>
			  <td><input type="text" name="address"></td>
		   </tr>
		</table>
		</div>
		<div class="panel-footer" align="right">
			<button type="button" class="btn btn-default" onclick="history.go(-1)">취소</button>
			<input type="hidden" name="submitted" value=1><input type="submit" class="btn btn-primary" value="등록하기">
		</div></center>
		</form>
	 </body>
  </html>

