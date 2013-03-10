<?php
  //返回json格式文件
  header("Content-Type:application/json");
	
	session_start();
	
	if(isset($_SESSION['usrid']))
	{
		unset($_SESSION['usrid']);
	}
	
	if(isset($_SESSION['usrname']))
	{
		unset($_SESSION['usrname']);
	}
	
	$leftglid = -1;
	if(isset($_SESSION['leftglid']))
	{
		$leftglid = $_SESSION['leftglid'];
		unset($_SESSION['leftglid']);
	}

	$rightglid = -1;
	if(isset($_SESSION['rightglid']))
	{
		$rightglid = $_SESSION['rightglid'];
		unset($_SESSION['rightglid']);
	}
	
  session_destroy();
  
	$outstr = "";
	$outstr .= "leftglid=".$leftglid;
	$outstr .= "&rightglid=".$rightglid;
	$array = array('resflag'=>'success', 'outstr'=>$outstr);
	echo json_encode($array);
?>