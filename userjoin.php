<?php
   include("db.php");
   $conn=connect();
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
     $id=$_REQUEST['id'];
    $pw=$_REQUEST['pw'];
   $location=$_REQUEST['location'];
      $phone=$_REQUEST['phone'];
     $card=$_REQUEST['card'];
    if((!$id || !$pw || !$location || !$phone || !$card) && $_REQUEST['submitted']){
	  echo("<script>
		 window.alert('Please input all fields.')
		 history.go(-1)
	  </script>");
   }
   elseif(!$id){
	  echo("No input");
   }
   else{
$query="insert `user` (`uid`, `pw`, `phone`, `location`, `card`) values (`".$id."`, `".$pw."`, `".$phone."`, `".$location."`, `".$card."`)";
$row=mysql_query($query, $conn);
$_SESSION['type']="user";
$_SESSION['id']=$id;
header("location:user.php");
 }
 }

?>
