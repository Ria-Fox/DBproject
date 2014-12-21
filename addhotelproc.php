<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
   include("db.php");
   $conn=connect();
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $oid = $_SESSION["id"];
	$phone=$_REQUEST['phone'];
	$name=$_REQUEST['name'];
	$location=$_REQUEST['location'];
	$address=$_REQUEST['address'];
    if((!$phone || !$name || !$location || !$address ) && $_REQUEST['submitted']){
	  echo("<script>
		 window.alert('Please input all fields.')
		 history.go(-1)
	  </script>");
   }
   else{
	  $query="insert `hotel` ( `oid`, `name`, `phone`, `location`, `address` ) values ('".$oid."', '".$name."', '".$phone."', '".$location."', '".$address."')";
	$row=mysql_query($query, $conn);
	header("location:owner.php");

 }
 }

?>
