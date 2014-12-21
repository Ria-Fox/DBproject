<?php
   include("db.php");
   $conn=connect();
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $hid=$_REQUEST['hid'];
	$num=$_REQUEST['num'];
	$price=$_REQUEST['price'];
	$option=$_REQUEST['option'];

	if( !$option )
		$option = 0;

    if((!$num || !$price ) && $_REQUEST['submitted']){
	  echo("<script>
		 window.alert('Please input all fields.')
		 history.go(-1)
	  </script>");
   }
   else{
	  $query="insert `room` ( `hid`, `num`, `price`, `option` ) values ('".$hid."', '".$num."', '".$price."', '".$option."')";
	$row=mysql_query($query, $conn);
	header("location:info.php?hid=".$hid);

 }
 }

?>
