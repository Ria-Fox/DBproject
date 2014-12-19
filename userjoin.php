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
	  $query="select count(*) from `user` where `uid`= ".$id."";
	  $row=mysql_query($query,$conn);
	  $rs=mysql_fetch_array($row);
	  $isid=$rs[0];
    if((!$id || !$pw || !$location || !$phone || !$card) && $_REQUEST['submitted']){
	  echo("<script>
		 window.alert('Please input all fields.')
		 history.go(-1)
	  </script>");
   }
   elseif($isid>0){
	  echo("<script>
		 window.alert('Registered ID')
		 history.go(-1)
	  </script>");
   }
   else{
	$query="insert `user` values (".$id.", ".$pw.", ".$phone.", ".$location.", ".$card.")";
	$row=mysql_query($query, $conn);
	$_SESSION['type']="user";
	$_SESSION['id']=$id;
	header("location:user.php");

 }
 }
 if(!$_REQUEST['id']){
	header("location:join.php");
 }

?>
