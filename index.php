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

<table class="table">
	<tr>
		<th>Team14</th>
	</tr>
	<tr>
		<th>#</th>
		<th>Dept</th>
		<th>Student No.</th>
		<th>Name</th>
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

</body>
</html>
