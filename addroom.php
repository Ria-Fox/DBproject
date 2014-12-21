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
    $hid = $_REQUEST["hid"];
	$hname=$_REQUEST['hname'];
?>
		<form action="addroomproc.php" method="post">
		<center><div class="panel panel-default" style="width:640px">
		<div class="panel-heading">
		<center><h1>PosHotel <small>room registration</small></h1></center>
		</div>
  		<div class="panel-body">
		<table class="table">
			<tr>
			  <td align="right">Hotel : </td>
			  <td><input type="hidden" name="hid" value=<?=$hid?>><?=$hname?></td>
		    </tr>
		   <tr>
			  <td align="right">Room Number : </td>
			  <td><input type="number" name="num"></td>
		   </tr>
		   <tr>
			  <td align="right">Price : </td>
			  <td><input type="number" name="price"></td>
		   </tr>
		   <tr>
			  <td align="right">Options : </td>
			  <td><input type="number" name="option"></td>
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

