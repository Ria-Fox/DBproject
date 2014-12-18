<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" http-equiv="ContentType" content="text/html;charset=UTF-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"/>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
</head>
<body>
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/respond.js"></script>

	<center><t3><b>PosHotel</b></t3></center>
	<center>
<table class="table" border="0">
	<tr>
		<td>
			<form action="login.php" method="post">
				ID : <input type="text" name="user_id"><br>
				PASS : <input type="text" name="user_pass"><input type="submit"><br>
				Hotel Owner : <input type="checkbox" name="isowner">
			</form>
		</td>
		<td>
		   <form action="search.php" method="get">
			  Location : <input type="text" name="location"> 
			  price : 
			  <select id="" name='price'>
				 <option value=0 selected="selected">10,000~49,000</option>
				 <option value=1>50,000~99,000</option>
				 <option value=2>100,000~199,000</option>
				 <option value=3>200,000~</option>
			  </select>
			  breakfast : <input type="checkbox" name="breakfast">
			  <input type="submit">
			</form>
		 </td>
	</tr>

<?php
include("db.php");
$conn = connect();
$query = "SELECT `index`, `dept`, `no`, `name` FROM `members`";
$row = mysql_query($query, $conn);
while($rst = mysql_fetch_array($row)){
	echo("<tr>");
		echo("<td>".$rst[0]."</td>");
		echo("<td>".$rst[1]."</td>");
		echo("<td>".$rst[2]."</td>");
		echo("<td>".$rst[3]."</td>");
	echo("</tr>");
}
?>

</table>
</center>
</body>
</html>
