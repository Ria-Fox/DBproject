<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
function connect(){
	$conn = mysql_connect("brynn.postech.ac.kr","rienkim", "20110437") or die("Unable to select database");
	mysql_select_db("rienkim", $conn) or die("Unable to select database");
	return $conn;
}
?>
