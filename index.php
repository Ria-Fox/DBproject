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
			  Location : <input type="text" name="location"><br> 
			  price : 
			  <select id="" name='price'>
				 <option value=0 selected="selected">10,000~49,000</option>
				 <option value=1>50,000~99,000</option>
				 <option value=2>100,000~199,000</option>
				 <option value=3>200,000~</option>
			  </select><br>
			  breakfast : <input type="checkbox" name="breakfast"><br>
			  <input type="submit">
			</form>
		 </td>
	</tr>
	<?php
	   include("db.php");
	   $conn = connect();
	   echo("<tr><td>Recommand Hotel based on Rating<br>");
		  echo("<table border=0>");
	   $query = "SELECT `name`, IFNULL(`rate_total`/`rate_user`,0) AS `rating` FROM `hotel` ORDER BY `rating` DESC LIMIT 10";
	   $row = mysql_query($query,$conn);
	   echo("<tr><td>|Hotel name|</td><td>|Ratings|</td></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			echo("<td>".$rst[0]."</td>");
			echo("<td>".sprintf("%1.1f",$rst[1])."</td>");
		  echo("</tr>");
	}
	echo("</table></td>");
	echo("<td>Recommand Hotel based on Price<br>");
		  echo("<table border=0>");
	   $query = "SELECT H.`name` , R.`num` , R.`price` FROM  `hotel` H, `room` R WHERE H.`hid` = R.`hid` ORDER BY  `price` DESC LIMIT 10";
	   $row = mysql_query($query,$conn);
	   echo("<tr><td>|Hotel name|</td><td>|Room number|</td><td>|Room Price|</td></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".$rst[1]."</td>");
			 echo("<td>".$rst[2]."</td>");
		  echo("</tr>");
	}
	echo("</table></td>");
	echo("<td>Recommand Hotel based on options<br>");
		  echo("<table border=0>");
	   $query = "SELECT H.`name` , R.`num` , R.`option` FROM  `hotel` H, `room` R WHERE H.`hid` = R.`hid` ORDER BY  R.`option` DESC LIMIT 10";
	   $row = mysql_query($query,$conn);
	   echo("<tr><td>|Hotel name|</td><td>|Room number|</td><td>|Room Option|</td></tr>");
	   while($rst = mysql_fetch_array($row)){
		  echo("<tr>");
			 echo("<td>".$rst[0]."</td>");
			 echo("<td>".$rst[1]."</td>");
			 echo("<td>".$rst[2]."</td>");
		  echo("</tr>");
	}
	echo("</table></td></tr>");
	?>


</table>
</center>
</body>
</html>
