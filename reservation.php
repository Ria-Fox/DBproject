<?php
   include("db.php");
   $conn=connect();
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
	  $uid = $_SESSION["id"];
	  $hid = $_REQUEST["hid"];
	  $rid = $_REQUEST["rid"];
	  $rs_data=$_REQUEST['rs_date'];

	  if(!$rs_date && $_REQUEST['submitted']){
	  echo("<script>
		 window.alert('Please input date.(".$uid.",".$hid.",".$rid.",".$rs_date.")')
		 history.go(-1)
	  </script>");
	  }
      else{
	    $query="select max(rsid) from reservation";
	    $row = mysql_query($query,$conn);
	    $rst = mysql_fetch_array($row);
	    $maximum = $rst[0];
	    $query="insert 'reservation` values (".$uid.", ".$hid.", ".$rid.", ".$maximum.", ".$rs_date.")";
	    $row=mysql_query($query, $conn);
	    header("location:user.php");
	  }
   }

?>
