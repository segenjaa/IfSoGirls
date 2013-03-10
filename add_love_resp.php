<?php
  //返回json格式文件
  header("Content-Type:application/json");
	session_start();
	
	$usrid = "";
	if(isset($_SESSION['usrid']))
	{
		$usrid = $_SESSION['usrid'];
	}
	else
	{
		$faltstr = "unvalid user";
		$array = array('resflag'=>'fail','fault'=>$faltstr);
		echo json_encode($array);
		exit;
	}
	
	$girlid = $_POST['girlid'];
	
	require_once("dbconn.php");
  $dbConn = new CDBConn();
	
	$strsql = "";
	$strsql .= "insert record(girlid, usrid) ";
	$strsql .= "values(";
	$strsql .= $girlid.",";
	$strsql .= $usrid.")";
	
	$result = $dbConn->db_query($strsql);
	if($result)
	{
		$array = array('resflag'=>'success');
		echo json_encode($array);
		
		exit;
	}
	else
	{
		$faltstr='Error：';
		$faltstr.=$strsql;
		$array = array('resflag'=>'fail','fault'=>$faltstr);
		echo json_encode($array);
			
		exit;
	}
?>