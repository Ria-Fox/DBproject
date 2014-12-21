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
		<form action="userjoinproc.php" method="post">
		<center><div class="panel panel-default" style="width:640px">
		<div class="panel-heading">
		<center><h1>PosHotel <small>join page</small></h1></center>
		</div>
  		<div class="panel-body">
		<table class="table">
		   <tr>
			  <td align="right">ID : </td>
			  <td><input type="text" name="id"></td>
		   </tr>
		   <tr>
			  <td align="right">Password : </td>
			  <td><input type="password" name="pw"></td>
		   </tr>
		   <tr>
			  <td align="right">Phone Number : </td>
			  <td><input type="text" name="phone"></td>
		   </tr>
		   <tr>
			  <td align="right">location : </td>
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
			  <td align="right">Card Number : </td>
			  <td><input type="text" name="card"></td>
		   </tr>
		</table>
		</div>
		<div class="panel-footer" align="right">
			<button type="button" class="btn btn-default" onclick="history.go(-1)">취소</button>
			<input type="hidden" name="submitted" value=1><input type="submit" class="btn btn-primary" value="가입하기">
		</div></center>
		</form>
	 </body>
  </html>

