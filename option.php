<?php
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
function option_str( $op ){
	$str = "없음";
	$options = 0;
	if( $op & 2 ){
		if( !$options ){
			$options++;
			$str="";
		}else{
			$str = $str.", ";
		}
		$str = $str."조식";
	}
	if( $op & 1 ){
		if( !$options ){
			$options++;
			$str="";
		}else{
			$str = $str.", ";
		}
		$str = $str."와이파이";
	}
	return $str;
}
?>
