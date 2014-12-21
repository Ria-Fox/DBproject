<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
   include("db.php");
   $conn=connect();
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
     $id=$_REQUEST['id'];
    $pw=$_REQUEST['pw'];
	$phone=$_REQUEST['phone'];
	  $query="select count(*) from `owner` where `oid`= '".$id."'";
	  $row=mysql_query($query,$conn);
	  $rs=mysql_fetch_array($row);
	  $isid=$rs[0];
    if((!$id || !$pw || !$phone ) && $_REQUEST['submitted']){
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
	  $query="insert `owner` values ('".$id."', '".$pw."', '".$phone."')";
	$row=mysql_query($query, $conn);
	$_SESSION['type']="owner";
	$_SESSION['id']=$id;
	header("location:owner.php");

 }
 }
 if(!$_REQUEST['id']){
	header("location:index.php");
 }

?>
