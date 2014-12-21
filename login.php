<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
   clearstatcache();
   include("db.php");
   $conn=connect();
   session_start();
   $id=$_REQUEST['user_id'];
   $pass=$_REQUEST['user_pw'];
   $owner=$_REQUEST['isowner'];
   if(!$id || !$pass){
	  echo("
	  	<script language='javascript' type='text/javascript'>
			window.alert('Please input your id and password');
		 </script>");
   }
   if(!$owner){
	  $query="select `uid` from `user` where `uid`='".$id."' and `pw`='".$pass."'";
	  $result=mysql_query($query);
	  $count=mysql_num_rows($result);
	  if($count==1){
		 $_SESSION["type"]="user";
		 $_SESSION["id"]=$id;
		 header("location:user.php");
	  }
	  else{
		 echo("
	  	<script language='javascript' type='text/javascript'>
			window.alert('Login Failed');
			history.go(-1);
		 </script>");
	  }
   }
   else{
	  $query="select `oid` from `owner` where `oid`='".$id."' and `pw`='".$pass."'";
	  $result=mysql_query($query);
	  $count=mysql_num_rows($result);
	  if($count==1){
		 $_SESSION["type"]="owner";
		 $_SESSION["id"]=$id;
		 header("location:owner.php");
	  }
	  else{
		 echo("
	  	<script language='javascript' type='text/javascript'>
			window.alert('Login Failed');
			history.go(-1);
		 </script>");
	  }
   }
?>